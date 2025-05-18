<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MedicalRecord extends Model

{
    protected $table = 'medical_record';
    protected $primaryKey = 'record_id';
    public $timestamps = true;

    protected $fillable = [
        'patient_id', 'practitioner_id', 'report_type', 'file_url'
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id', 'patient_id');
    }

    public function practitioner()
    {
        return $this->belongsTo(Practitioner::class, 'practitioner_id', 'practitioner_id');
    }
}