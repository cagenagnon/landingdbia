<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBootcampCandidatureRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nom' => ['required', 'string', 'min:3', 'max:120', 'regex:/^[\pL]+(?:[ \'-][\pL]+)*$/u'],
            'email' => ['required', 'email', 'max:190'],
            'telephone' => ['required', 'string', 'max:30', 'regex:/^[0-9]+$/'],
            'motivation' => ['nullable', 'string', 'max:2000'],
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
            'telephone.required' => 'Le numéro de téléphone est obligatoire.',
            'telephone.regex' => 'Le numéro de téléphone doit contenir uniquement des chiffres.',
            'motivation.max' => 'La motivation ne peut pas dépasser 2000 caractères.',
        ];
    }
}
