<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsContsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings_conts', function (Blueprint $table) {
            $table->id();
            $table->boolean('use_crypto_feature')->default(true);
            $table->string('purchase_code')->nullable();
            $table->string('minamt')->nullable();
            $table->string('flw_public_key')->nullable();
            $table->string('flw_secret_key')->nullable();
            $table->string('flw_secret_hash')->nullable();
            $table->string('bnc_api_key')->nullable();
            $table->string('bnc_secret_key')->nullable();
            $table->string('use_transfer')->nullable();
            $table->string('min_transfer')->nullable();
            $table->string('transfer_charges')->nullable();
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
        Schema::dropIfExists('settings_conts');
    }
}
