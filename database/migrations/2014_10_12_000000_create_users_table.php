<?php

use App\Models\User;
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
            $table->string('firstname');
            $table->string('lastname');
            $table->string('email')->unique();
            $table->integer('nationality_id')->nullable();
            $table->integer('residence_id')->nullable();
            $table->string('addresse')->nullable();
            $table->string('currency')->default('aed');
            $table->boolean('allow_notifications')->default(1);
            $table->string('latitude', 30)->nullable();
            $table->string('longitude', 30)->nullable();
            $table->string('phone');
            $table->string('avatar')->nullable();
            $table->string('password');
            $table->string('device_token')->nullable();
            $table->string('lang', 4)->default('en');
            $table->enum('sex', ['male', 'female']);
            $table->string('role', 10)->default(User::CUSTOMER);
            $table->timestamp('email_verified_at')->nullable();
            $table->softDeletes();
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
