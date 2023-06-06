<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Direccion extends Model
{

    protected $table = 'direcciones';


    protected $fillable = [
        'user_id',
        'calle',
        'numero',
        'piso',
        'comuna',
        'codigo_postal',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}