<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIrsRefundSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('irs_refund_settings')) {
            return;
        }

        Schema::create('irs_refund_settings', function (Blueprint $table) {
            $table->id();
            $table->decimal('min_amount', 10, 2)->default(0.00);
            $table->decimal('max_amount', 10, 2)->default(10000.00);
            $table->decimal('processing_fee', 5, 2)->default(0.00);
            $table->integer('processing_time')->default(5);
            $table->text('instructions')->nullable();
            $table->boolean('enable_refunds')->default(true);
            $table->boolean('require_verification')->default(true);
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
        Schema::dropIfExists('irs_refund_settings');
    }
}
