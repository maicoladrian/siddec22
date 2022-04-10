<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asistencia extends Model
{
    use HasFactory;

    protected $table = 'asistencias';
    protected $primaryKey = 'id_asistencia';
    protected $fillable = [
        'fecha',
        'hora',
        'asistencia_id_personal',
        'asistencia_id_horario',
        'motivo',
        'mac'
    ];

    public function personal()
    {
        return $this->belongsTo(Personale::class, 'asistencia_id_personal', 'id_personal');
    }

    public function horario()
    {
        return $this->belongsTo(Horario::class, 'asistencia_id_horario', 'id_horario');
    }

    // mutator para motivo en mayúsculas
    public function setMotivoAttribute($value)
    {
        $this->attributes['motivo'] = strtoupper($value);
    }

    // accesor para motivo en mayúsculas
    public function getMotivoAttribute($value)
    {
        return strtoupper($value);
    }

}
