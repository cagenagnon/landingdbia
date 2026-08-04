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
            ? 'Inscription confirmée, un e-mail vous a été envoyé. N\'hésitez pas à vérifier vos spams si vous ne le voyez pas dans votre boîte de réception.'
            : 'Inscription enregistrée avec succès.';

        return response()->json([
            'message' => $message,
            'data' => [
                'id' => $inscription->id,
                'type_activite' => $inscription->type_activite,
                'email_envoye' => $mailSent,
            ],
            'warnings' => $mailSent ? [] : ['Inscription enregistrée. Le message de confirmation peut prendre quelques minutes.'],
        ], 201);
    }
}
