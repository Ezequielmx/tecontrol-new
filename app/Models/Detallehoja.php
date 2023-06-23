<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detallehoja extends Model
{
    use HasFactory;

    protected $fillable=[
        'hojasasistencia_id',
        'detalle',
        'certificado',
    ];

    public function user(){
        return $this->belongsTo('App\Models\User');
    }

    public function hojasasistencia(){
        return $this->belongsTo('App\Models\Hojasasistencia');
    }

    public function asistencia(){
        return $this->hojasasistencia->asistencia();
    }

    public function client(){
        return $this->asistencia->client();
    }
}
