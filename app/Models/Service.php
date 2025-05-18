<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $table = 'service';
    protected $primaryKey = 'service_id';
    public $timestamps = false;

    protected $fillable = ['service_name', 'price', 'duration', 'description'];

    public function appointments()
    {
        return $this->belongsToMany(Appointment::class, 'service_under_appointment', 'service_id', 'appointment_id');
    }

    public function practitioners()
    {
        return $this->belongsToMany(Practitioner::class, 'practitioner_offers_service', 'service_id', 'practitioner_id');
    }
}