<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BootcampCandidature extends Model
{
    protected $fillable = ['nom', 'email', 'telephone', 'motivation', 'type_activite', 'statut'];
}
