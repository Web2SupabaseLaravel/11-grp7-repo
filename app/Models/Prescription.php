<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prescription extends Model
{
    protected $table = 'prescription';
    protected $primaryKey = 'prescription_id';
    public $timestamps = true;

    protected $fillable = ['details'];

    public function patients()
    {
        return $this->belongsToMany(Patient::class, 'patient_has_prescription', 'prescription_id', 'patient_id');
    }
}