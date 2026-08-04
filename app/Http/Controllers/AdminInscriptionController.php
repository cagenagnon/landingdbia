<?php

namespace App\Http\Controllers;

use App\Models\BootcampCandidature;
use App\Models\WebinaireInscription;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\StreamedResponse;

class AdminInscriptionController extends Controller
{
    public function dashboard(): View
    {
        return view('admin.inscriptions');
    }

    public function webinaire(Request $request): JsonResponse
    {
        $result = $this->buildPaginatedResult(WebinaireInscription::query(), $request);

        return response()->json($result);
    }

    public function bootcamp(Request $request): JsonResponse
    {
        $result = $this->buildPaginatedResult(BootcampCandidature::query(), $request);

        return response()->json($result);
    }

    public function exportWebinaireCsv(Request $request): StreamedResponse
    {
        return $this->exportCsv(WebinaireInscription::query(), $request, 'webinaire-inscriptions.csv');
    }

    public function exportBootcampCsv(Request $request): StreamedResponse
    {
        return $this->exportCsv(BootcampCandidature::query(), $request, 'bootcamp-candidatures.csv');
    }

    private function buildPaginatedResult(Builder $query, Request $request): array
    {
        $perPage = max(5, min((int) $request->query('per_page', 10), 100));
        $search = trim((string) $request->query('search', ''));
        $sortBy = (string) $request->query('sort_by', 'created_at');
        $sortDir = strtolower((string) $request->query('sort_dir', 'desc')) === 'asc' ? 'asc' : 'desc';

        $allowedSorts = ['nom', 'email', 'telephone', 'created_at', 'statut'];
        if (!in_array($sortBy, $allowedSorts, true)) {
            $sortBy = 'created_at';
        }

        if ($search !== '') {
            $query->where(function (Builder $builder) use ($search): void {
                $builder->where('nom', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('telephone', 'like', "%{$search}%");
            });
        }

        $paginator = $query
            ->orderBy($sortBy, $sortDir)
            ->paginate($perPage)
            ->appends($request->query());

        return [
            'message' => 'Inscriptions recuperees avec succes.',
            'filters' => [
                'search' => $search,
                'sort_by' => $sortBy,
                'sort_dir' => $sortDir,
                'per_page' => $perPage,
            ],
            'data' => $paginator->items(),
            'meta' => [
                'current_page' => $paginator->currentPage(),
                'last_page' => $paginator->lastPage(),
                'per_page' => $paginator->perPage(),
                'total' => $paginator->total(),
            ],
        ];
    }

    private function exportCsv(Builder $query, Request $request, string $filename): StreamedResponse
    {
        $search = trim((string) $request->query('search', ''));

        if ($search !== '') {
            $query->where(function (Builder $builder) use ($search): void {
                $builder->where('nom', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('telephone', 'like', "%{$search}%");
            });
        }

        $rows = $query->orderByDesc('created_at')->get([
            'nom',
            'email',
            'telephone',
            'type_activite',
            'statut',
            'created_at',
        ]);

        $response = new StreamedResponse(function () use ($rows): void {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, ['Nom', 'Email', 'Telephone', 'Type activite', 'Statut', 'Date inscription']);

            foreach ($rows as $row) {
                fputcsv($handle, [
                    $row->nom,
                    $row->email,
                    $row->telephone,
                    $row->type_activite,
                    $row->statut,
                    optional($row->created_at)->format('Y-m-d H:i:s'),
                ]);
            }

            fclose($handle);
        });

        $response->headers->set('Content-Type', 'text/csv; charset=UTF-8');
        $response->headers->set('Content-Disposition', "attachment; filename={$filename}");

        return $response;
    }
}
