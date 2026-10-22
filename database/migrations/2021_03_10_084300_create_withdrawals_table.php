<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWithdrawalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('withdrawals', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('txn_id')->nullable();
            $table->integer('user')->nullable();
            $table->string('uname')->nullable();
            $table->string('amount')->nullable();
            $table->string('to_deduct')->nullable();
            $table->string('status')->nullable();
            $table->string('payment_mode')->nullable();
            $table->text('paydetails')->nullable();
            $table->string('type')->nullable();
            $table->string('date')->nullable();
            $table->string('bal')->nullable();
            $table->text('Description')->nullable();
            $table->string('accountname')->nullable();
            $table->string('accountnumber')->nullable();
            $table->string('bankname')->nullable();
            $table->string('Accounttype')->nullable();
            $table->text('bankaddress')->nullable();
            $table->string('country')->nullable();
            $table->string('swiftcode')->nullable();
            $table->string('iban')->nullable();
            $table->string('crypto_currency')->nullable();
            $table->string('crypto_network')->nullable();
            $table->string('wallet_address')->nullable();
            $table->string('paypal_email')->nullable();
            $table->string('wise_fullname')->nullable();
            $table->string('wise_email')->nullable();
            $table->string('wise_country')->nullable();
            $table->string('skrill_email')->nullable();
            $table->string('skrill_fullname')->nullable();
            $table->string('venmo_username')->nullable();
            $table->string('venmo_phone')->nullable();
            $table->string('zelle_email')->nullable();
            $table->string('zelle_phone')->nullable();
            $table->string('zelle_name')->nullable();
            $table->string('cash_app_tag')->nullable();
            $table->string('cash_app_fullname')->nullable();
            $table->string('revolut_fullname')->nullable();
            $table->string('revolut_email')->nullable();
            $table->string('revolut_phone')->nullable();
            $table->string('alipay_id')->nullable();
            $table->string('alipay_fullname')->nullable();
            $table->string('wechat_id')->nullable();
            $table->string('wechat_name')->nullable();
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
        Schema::dropIfExists('withdrawals');
    }
}
