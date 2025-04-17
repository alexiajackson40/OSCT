<?php

namespace App\Models;
use App\Models\Patient;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class ParentModel extends Authenticatable
{
    use Notifiable;

    protected $table = 'parent';
    protected $primaryKey = 'CURP';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'CURP',
        'first_name',
        'last_name',
        'email',
        'username',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];


    //protected $rememberTokenName = 'remember_token'; // enables "remember me" support

    public $timestamps = true;

    public function patients()
    {
        return $this->hasMany(Patient::class, 'parent_id');
    }

    public function linkedPatient()
    {
        return Patient::where('CURP', $this->student_id)->first();
    }
}
