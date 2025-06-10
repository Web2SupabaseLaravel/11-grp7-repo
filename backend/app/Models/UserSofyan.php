<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserSofyan extends Model
{
    use HasFactory;

    protected $table = 'user_Sofyan'; 

    protected $primaryKey = 'user_id';

    protected $fillable = [
        'user_id',
        'username',
        'email',
        'role',
        'status',
    ];

    public $timestamps = false; // إذا ما عندك created_at و updated_at في الجدول
}
