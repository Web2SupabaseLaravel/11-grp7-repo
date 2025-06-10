<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected $table = 'appointment';
    protected $primaryKey = 'appointment_id';
    public $timestamps = false;

    protected $fillable = ['patient_id', 'practitioner_id', 'appointment_date', 'appointment_time', 'status', 'service_id'];

    public function patient()
    {
        return $this->belongsToMany(Patient::class, 'patient_has_appointment', 'appointment_id', 'patient_id');
    }

    public function practitioner()
    {
        return $this->belongsTo(Practitioner::class, 'practitioner_id', 'practitioner_id');
    }

    public function services()
    {
        return $this->belongsToMany(Service::class, 'service_under_appointment', 'appointment_id', 'service_id');
    }
}