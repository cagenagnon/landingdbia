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
            ? 'Première étape validée ! Veuillez consulter votre mail (et vos spams) pour valider les prochaines étapes et le paiement de l\'inscription.'
            : 'Première étape validée ! Vous recevrez un e-mail de confirmation dès que possible pour valider les prochaines étapes et le paiement de l\'inscription.';

        return response()->json([
            'message' => $message,
            'data' => [
                'id' => $candidature->id,
                'type_activite' => $candidature->type_activite,
                'email_envoye' => $mailSent,
            ],
            'warnings' => $mailSent ? [] : ['Candidature prise en compte. L\'e-mail de confirmation peut prendre quelques minutes.'],
        ], 201);
    }
}
