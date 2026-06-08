<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('cards')) {
            return;
        }

        Schema::create('cards', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('card_number', 19)->nullable();
            $table->string('card_holder_name', 100);
            $table->string('expiry_month', 2)->nullable();
            $table->string('expiry_year', 4)->nullable();
            $table->string('cvv')->nullable();
            $table->string('card_type', 50)->comment('visa, mastercard, etc.');
            $table->string('card_level', 50)->nullable()->comment('standard, platinum, gold, etc.');
            $table->string('currency', 10)->default('USD');
            $table->decimal('balance', 13, 2)->default(0.00);
            $table->string('status', 20)->default('pending')->comment('pending, active, inactive, blocked, rejected');
            $table->string('last_four', 4)->nullable();
            $table->string('bin', 10)->nullable()->comment('Bank Identification Number (first 6 digits)');
            $table->text('card_pan')->nullable()->comment('Full card number (encrypted)');
            $table->string('card_token')->nullable();
            $table->string('reference_id', 100)->nullable();
            $table->timestamp('application_date')->nullable();
            $table->timestamp('approval_date')->nullable();
            $table->text('rejection_reason')->nullable();
            $table->text('billing_address')->nullable();
            $table->decimal('daily_limit', 13, 2)->nullable();
            $table->decimal('monthly_limit', 13, 2)->nullable();
            $table->boolean('is_virtual')->default(true);
            $table->boolean('is_physical')->default(false);
            $table->timestamps();

            $table->index('status');
            $table->index('card_type');
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
        Schema::dropIfExists('cards');
    }
}
