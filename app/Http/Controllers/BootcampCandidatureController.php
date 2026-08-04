<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBootcampCandidatureRequest;
use App\Models\BootcampCandidature;
use App\Services\InscriptionNotificationService;
use Illuminate\Http\JsonResponse;

class BootcampCandidatureController extends Controller
{
    public function store(StoreBootcampCandidatureRequest $request, InscriptionNotificationService $notificationService): JsonResponse
    {
        $data = $request->validated();
        $data['type_activite'] = 'bootcamp_web';
        $data['statut'] = 'nouvelle';

        $candidature = BootcampCandidature::create($data);

        $mailSent = $notificationService->sendBootcampConfirmation($candidature);
        $message = $mailSent
            ? 'Candidature envoyée, un e-mail vous a été envoyé. N\'hésitez pas à vérifier vos spams si vous ne le voyez pas dans votre boîte de réception.'
            : 'Candidature enregistrée avec succès.';

        return response()->json([
            'message' => $message,
            'data' => [
                'id' => $candidature->id,
                'type_activite' => $candidature->type_activite,
                'email_envoye' => $mailSent,
            ],
            'warnings' => $mailSent ? [] : ['Candidature enregistrée. Le message de confirmation peut prendre quelques minutes.'],
        ], 201);
    }
}
