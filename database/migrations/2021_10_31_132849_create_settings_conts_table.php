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
            $table->string('use_crypto_feature')->default('true')->nullable();
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
            $table->string('fee')->default('0')->nullable();
            $table->string('currency_rate')->default('1')->nullable();
            $table->string('s_currency')->default('USD')->nullable();
            $table->string('telegram_bot_api')->nullable();
            $table->string('btc')->default('enabled')->nullable();
            $table->string('eth')->default('enabled')->nullable();
            $table->string('ltc')->default('enabled')->nullable();
            $table->string('link')->default('enabled')->nullable();
            $table->string('bnb')->default('enabled')->nullable();
            $table->string('aave')->default('enabled')->nullable();
            $table->string('usdt')->default('enabled')->nullable();
            $table->string('bch')->default('enabled')->nullable();
            $table->string('xrp')->default('enabled')->nullable();
            $table->string('xlm')->default('enabled')->nullable();
            $table->string('ada')->default('enabled')->nullable();
            $table->string('bat')->default('enabled')->nullable();
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
