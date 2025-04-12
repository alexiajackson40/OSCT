<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected $primaryKey = 'CURP'; // primary key is CURP
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'No_SOL',
        'FECHA',
        'CURP',
        'PACIENTE',
        'SEXO',
        'EDAD',
        'ESCUELA',
        'DERECHOHABIENCIA',
        'AYUNO',
        'GLUCOSA',
        'TRIGLICÉRIDOS',
        'COLESTEROL TOTAL',
        'HBA1C',
        'PESO',
        'TALLA',
        'IMC',
        'ICC',
        'CINTURA',
        'CADERA',
        'COMENTARIO',
    ];

    public $timestamps = true;

    public function documents()
    {
        return $this->hasMany(Document::class, 'user_id');
    }

    public function labResults()
    {
        return $this->hasMany(LabResult::class, 'user_id');
    }

    public function measurements()
    {
        return $this->hasMany(Measurement::class, 'user_id');
    }

    public function schedules()
    {
        return $this->hasMany(Schedule::class, 'patient_id');
    }

    public function parent()
    {
        return $this->belongsTo(ParentModel::class, 'parent_id');
    }
}
