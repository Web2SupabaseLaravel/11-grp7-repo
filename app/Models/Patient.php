<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;


class Patient extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $table = 'patient';
    protected $primaryKey = 'patient_id';
    public $timestamps = false;

    protected $fillable = [
        'full_name', 'date_of_birth', 'gender', 'password', 'address',
        'phone', 'email', 'last_visit_date', 'blood_type', 'height',
        'weight', 'emergency_contact'
    ];

    protected $hidden = [
        'password',
    ];

    public function getRoleAttribute()
    {
        return 'patient';
    }
    

    public function medicalRecords()
    {
        return $this->hasMany(MedicalRecord::class, 'patient_id', 'patient_id');
    }

    public function prescriptions()
    {
        return $this->belongsToMany(Prescription::class, 'patient_has_prescription', 'patient_id', 'prescription_id');
    }

    public function billings()
    {
        return $this->hasMany(Billing::class, 'patient_id', 'patient_id');
    }

    public function notifications()
    {
        return $this->belongsToMany(Notification::class, 'receives', 'patient_id', 'notification_id');
    }

    public function appointments()
    {
        return $this->belongsToMany(Appointment::class, 'patient_has_appointment', 'patient_id', 'appointment_id');
    }

    public function treatmentPlans()
    {
        return $this->hasMany(TreatmentPlan::class, 'patient_id', 'patient_id');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class, 'patient_id', 'patient_id');
    }
}