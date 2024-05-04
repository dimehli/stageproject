<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $fillable = [
        'date_intervention',
        'heure_intervention',
        'action_realisees',
        'date_fin_intervention',
        'heure_fin_intervention',
        'probleme_resolu',
        'actions'
    ];
    public $timestamps = false;
}

