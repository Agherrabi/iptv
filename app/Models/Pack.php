<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pack extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id','label' ,'date_creation' ,'date_experation'  , 'status','forniceur' , 'serveur' , 'panel','username' ,'period_abonnement' ,'prix' ,'avence' ,'reste' , 'moyen_paiment','status_paiment' , 'm3u', 'remarque'
    ];

    
}
