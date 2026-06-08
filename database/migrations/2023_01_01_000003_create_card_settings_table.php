<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCardSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('card_settings')) {
            return;
        }

        Schema::create('card_settings', function (Blueprint $table) {
            $table->id();
            $table->decimal('standard_fee', 10, 2)->default(5.00);
            $table->decimal('gold_fee', 10, 2)->default(15.00);
            $table->decimal('platinum_fee', 10, 2)->default(25.00);
            $table->decimal('black_fee', 10, 2)->default(50.00);
            $table->decimal('monthly_fee', 10, 2)->default(2.00);
            $table->decimal('topup_fee_percentage', 5, 2)->default(1.00);
            $table->boolean('is_enabled')->default(true);
            $table->decimal('max_daily_limit', 10, 2)->default(10000.00);
            $table->decimal('min_daily_limit', 10, 2)->default(100.00);
            $table->text('description')->nullable();
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
        Schema::dropIfExists('card_settings');
    }
}
