<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Candidat extends Model
{
    protected $fillable = [
        'number', 'lead', 'co-lead', 'moto'
    ];
}
