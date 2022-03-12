<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('username');
            $table->string('email')->unique();
            $table->foreignId('nationality_id')->nullable()->constrained('countries');
            $table->foreignId('residence_id')->nullable()->constrained('countries');
            $table->foreignId('level_id')->nullable()->constrained('user_levels');
            $table->string('phone');
            $table->string('avatar')->nullable();
            $table->string('password');
            $table->string('device_token')->nullable();
            $table->string('lang', 4)->default('en');
            $table->enum('sex', ['male', 'female']);
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
