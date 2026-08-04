<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WebinaireInscription extends Model
{
    protected $fillable = ['nom', 'email', 'telephone', 'type_activite', 'statut'];
}
