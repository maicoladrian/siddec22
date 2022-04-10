<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Informacione extends Model
{
    use HasFactory;
    protected $table = 'informaciones';
    protected $primaryKey = 'id_informacion';
    protected $fillable = [
        'ap_paterno',
        'ap_materno',
        'nombres',
        'ci',
        'celular'
    ];

    public function personal()
    {
        return $this->belongsTo(Personal::class, 'id_informacion', 'personal_id_informacion');
    }


    // mutador para guardar en mayusculas ap_paterno, ap_materno y nombres
    public function setApPaternoAttribute($value)
    {
        $this->attributes['ap_paterno'] = strtoupper($value);
    }

    public function setApMaternoAttribute($value)
    {
        $this->attributes['ap_materno'] = strtoupper($value);
    }

    public function setNombresAttribute($value)
    {
        $this->attributes['nombres'] = strtoupper($value);
    }

    // accesor para mostrar en mayusculas ap_paterno, ap_materno y nombres
    public function getApPaternoAttribute($value)
    {
        return strtoupper($value);
    }

    public function getApMaternoAttribute($value)
    {
        return strtoupper($value);
    }

    public function getNombresAttribute($value)
    {
        return strtoupper($value);
    }
}
