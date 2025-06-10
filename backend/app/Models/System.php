<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class System extends Model
{
    use HasFactory;

    protected $table = 'system_settings';
    protected $primaryKey = 'settings_id';

    // الأسماء اللي مسموح للموديل تعدلها عبر Mass Assignment
    protected $fillable = [
        'site_name',
        'site_email',
        'items_per_page',
        'maintenance_mode',
    ];

    // لو عندك timestamps (created_at, updated_at) وما عندك، ممكن تلغيها:
    public $timestamps = false;
}
