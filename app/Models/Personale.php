<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Personale extends Model
{
    use HasFactory;

    protected $table = 'personales';
    protected $primaryKey = 'id_personal';
    protected $fillable = [
        'codigo_control',
        'mac_pc',
        'personal_id_informacion',
        'personal_id_cargo'
    ];

    public function informacion()
    {
        return $this->hasOne(Informacione::class, 'id_informacion', 'personal_id_informacion');
    }

    public function cargo()
    {
        return $this->hasOne(Cargo::class, 'id_cargo', 'personal_id_cargo');
    }

    public function asistencia()
    {
        return $this->hasMany(Asistencia::class, 'asistencia_id_personal', 'id_personal');
    }

    // mutador para guardar en mayusculas codigo_control
    public function setCodigoControlAttribute($value)
    {
        $this->attributes['codigo_control'] = strtoupper($value);
    }

    // accesor para mostrar en mayusculas codigo_control
    public function getCodigoControlAttribute($value)
    {
        return strtoupper($value);
    }
    
}
