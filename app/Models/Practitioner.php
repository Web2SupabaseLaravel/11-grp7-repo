<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Practitioner extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $table = 'practitioner';
    protected $primaryKey = 'practitioner_id';
    public $timestamps = false;

    protected $fillable = [
        'full_name', 'password', 'address', 'phone', 'specialty',
        'review_count', 'rating', 'working_hours', 'qualifications', 'email'
    ];

    protected $hidden = [
        'password',
    ];

    public function getRoleAttribute()
    {
        return 'practitioner';
    }

    public function medicalRecords()
    {
        return $this->hasMany(MedicalRecord::class, 'practitioner_id', 'practitioner_id');
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class, 'practitioner_id', 'practitioner_id');
    }

    public function services()
    {
        return $this->belongsToMany(Service::class, 'practitioner_offers_service', 'practitioner_id', 'service_id');
    }

    public function treatmentPlans()
    {
        return $this->hasMany(TreatmentPlan::class, 'practitioner_id', 'practitioner_id');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class, 'practitioner_id', 'practitioner_id');
    }
}