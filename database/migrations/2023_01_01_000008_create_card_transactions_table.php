<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCardTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('card_transactions')) {
            return;
        }

        Schema::create('card_transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('card_id');
            $table->unsignedBigInteger('user_id');
            $table->decimal('amount', 13, 2);
            $table->string('currency', 10);
            $table->string('transaction_type', 20)->comment('purchase, refund, fee, etc.');
            $table->string('transaction_reference', 100)->nullable();
            $table->string('merchant_name')->nullable();
            $table->string('merchant_category', 100)->nullable();
            $table->string('merchant_city', 100)->nullable();
            $table->string('merchant_country', 100)->nullable();
            $table->string('status', 20)->default('completed')->comment('pending, completed, failed, disputed');
            $table->text('description')->nullable();
            $table->timestamp('transaction_date')->nullable();
            $table->timestamp('settlement_date')->nullable();
            $table->timestamps();

            $table->index('transaction_type');
            $table->index('status');
            $table->foreign('card_id')->references('id')->on('cards')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('card_transactions');
    }
}
