<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreWebinaireInscriptionRequest;
use App\Models\WebinaireInscription;
use App\Services\InscriptionNotificationService;
use Illuminate\Http\JsonResponse;

class WebinaireInscriptionController extends Controller
{
    public function store(StoreWebinaireInscriptionRequest $request, InscriptionNotificationService $notificationService): JsonResponse
    {
        $data = $request->validated();
        $data['type_activite'] = 'webinaire';
        $data['statut'] = 'nouvelle';

        $inscription = WebinaireInscription::create($data);

        $mailSent = $notificationService->sendWebinaireConfirmation($inscription);
        $message = $mailSent
            ? 'Inscription prise en compte avec succès. Vous recevrez un e-mail de confirmation pour valider votre inscription. Pensez aussi à vérifier votre dossier Spam / Indésirables.'
            : 'Inscription prise en compte avec succès. Vous recevrez un e-mail de confirmation dès que possible. Pensez aussi à vérifier votre dossier Spam / Indésirables.';

        return response()->json([
            'message' => $message,
            'data' => [
                'id' => $inscription->id,
                'type_activite' => $inscription->type_activite,
                'email_envoye' => $mailSent,
            ],
            'warnings' => $mailSent ? [] : ['Inscription prise en compte. L\'e-mail de confirmation peut prendre quelques minutes.'],
        ], 201);
    }
}
