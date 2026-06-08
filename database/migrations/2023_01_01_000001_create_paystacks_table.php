<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaystacksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('paystacks')) {
            return;
        }

        Schema::create('paystacks', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->text('paystack_public_key')->nullable();
            $table->text('paystack_secret_key')->nullable();
            $table->string('paystack_url')->nullable();
            $table->string('paystack_email')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('paystacks');
    }
}
