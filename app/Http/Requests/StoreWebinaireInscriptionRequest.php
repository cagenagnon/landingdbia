<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreWebinaireInscriptionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nom' => ['required', 'string', 'min:3', 'max:120', 'regex:/^[\pL]+(?:[ \'-][\pL]+)*$/u'],
            'email' => ['required', 'email', 'max:190', 'unique:webinaire_inscriptions,email'],
            'telephone' => ['required', 'string', 'max:30', 'regex:/^[0-9]+$/'],
        ];
    }

    public function messages(): array
    {
        return [
            'nom.required' => 'Le nom complet est obligatoire.',
            'nom.min' => 'Le nom doit contenir au moins 3 caractères.',
            'nom.regex' => 'Le nom doit contenir uniquement des lettres.',
            'email.required' => 'L\'adresse e-mail est obligatoire.',
            'email.email' => 'Veuillez saisir une adresse e-mail valide.',
            'email.unique' => 'Cette adresse e-mail est déjà inscrite au Webinaire.',
            'telephone.required' => 'Le numéro de téléphone est obligatoire.',
            'telephone.regex' => 'Le numéro de téléphone doit contenir uniquement des chiffres.',
        ];
    }
}
