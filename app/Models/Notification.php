<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $table = 'notifications';
    protected $primaryKey = 'notification_id';
    public $timestamps = true;

    protected $fillable = ['message', 'date'];

    public function patients()
    {
        return $this->belongsToMany(Patient::class, 'receives', 'notification_id', 'patient_id');
    }
}