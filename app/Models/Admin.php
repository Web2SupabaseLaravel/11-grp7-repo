<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Admin extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $table = 'admin';
    protected $primaryKey = 'admin_id';
    public $timestamps = false;

    protected $fillable = ['staff_id', 'email', 'password', 'role'];

    protected $hidden = ['password'];

    public function getRoleAttribute()
    {
        return $this->attributes['role'] ?? 'admin';
    }
}