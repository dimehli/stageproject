<?php

namespace App\Models;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Demande extends Model
{
    protected $fillable = [
        'date_demande', 'nom_demandeur', 'departement', 'emargement', 'type_materiel',
         'probleme_constate'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}

