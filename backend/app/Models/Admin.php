<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Admin extends Model
{
    protected $primaryKey = 'admin_id';
    use HasFactory;
    protected $table = 'admin'; 
}
