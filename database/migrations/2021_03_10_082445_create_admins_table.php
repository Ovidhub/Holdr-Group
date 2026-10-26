<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('firstName');
            $table->string('lastName');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('phone')->nullable();
            $table->string('dashboard_style')->default('light')->nullable();
            $table->string('remember_token')->nullable();
            $table->string('acnt_type_active')->nullable();
            $table->string('status')->nullable();
            $table->string('cstatus')->nullable();
            $table->string('type')->nullable();
            $table->string('enable_2fa')->default('disabled')->nullable();
            $table->string('token_2fa')->nullable();
            $table->string('token_2fa_expiry')->nullable();
            $table->string('pass_2fa')->nullable();
            $table->string('password_token')->nullable();
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
        Schema::dropIfExists('admins');
    }
}
