<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResetCodesTable extends Migration
{
    public function up()
    {
        Schema::create('reset_codes', function (Blueprint $table) {
            $table->id();
            $table->string('email');
            $table->string('reset_code');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('expires_at')->useCurrent()->addMinutes(60); // تنتهي بعد ساعة
        });
    }

    public function down()
    {
        Schema::dropIfExists('reset_codes');
    }
}