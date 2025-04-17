<?php

namespace App\Models;
use App\Models\Patient;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable; // If you want to log parents in
use Illuminate\Notifications\Notifiable;

class ParentModel extends Authenticatable
{
    use Notifiable;

    protected $table = 'parent'; // Table name is 'parent', not 'parents'
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
    ];

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
