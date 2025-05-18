<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Billing extends Model
{
    protected $table = 'billing';
    protected $primaryKey = 'billing_id';
    public $timestamps = true;

    protected $fillable = ['patient_id', 'status', 'amount'];

    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id', 'patient_id');
    }
}