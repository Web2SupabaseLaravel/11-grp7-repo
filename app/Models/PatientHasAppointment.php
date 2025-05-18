<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PatientHasAppointment extends Model
{
    protected $table = 'patient_has_appointment';
    protected $primaryKey = null; // Composite key, no single primary key
    public $incrementing = false; // No auto-incrementing key
    public $timestamps = false; // If the table doesn't have timestamps
}