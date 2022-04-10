<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cargo extends Model
{
    use HasFactory;

    protected $table = 'cargos';
    protected $primaryKey = 'id_cargo';
    protected $fillable = [
        'descripcion_cargo'
    ];

    public function personal()
    {
        return $this->belongsTo(Personale::class, 'id_cargo', 'personal_id_cargo');
    }

    // mutador para guardar en mayusculas descripcion_cargo
    public function setDescripcionCargoAttribute($value)
    {
        $this->attributes['descripcion_cargo'] = strtoupper($value);
    }

    // accesor para mostrar en mayusculas descripcion_cargo
    public function getDescripcionCargoAttribute($value)
    {
        return strtoupper($value);
    }
}
