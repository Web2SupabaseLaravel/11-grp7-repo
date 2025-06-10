<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PractitionerOffersService extends Model
{
    protected $table = 'practitioner_offers_service';
    protected $primaryKey = null; // Composite key, no single primary key
    public $incrementing = false;
    public $timestamps = false;
}