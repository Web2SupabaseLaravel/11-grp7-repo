<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceUnderAppointment extends Model
{
    protected $table = 'service_under_appointment';
    protected $primaryKey = null; // Composite key, no single primary key
    public $incrementing = false;
    public $timestamps = false;
}