<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppearanceSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('appearance_settings')) {
            return;
        }

        Schema::create('appearance_settings', function (Blueprint $table) {
            $table->id();
            $table->string('primary_color')->default('#C41E3A');
            $table->string('primary_color_dark')->default('#881337');
            $table->string('primary_color_light')->default('#FB7185');
            $table->string('secondary_color')->default('#9F1239');
            $table->string('secondary_color_dark')->default('#4C0519');
            $table->string('secondary_color_light')->default('#FDA4AF');
            $table->string('text_color')->default('#111827');
            $table->string('bg_color')->default('#f9fafb');
            $table->string('sidebar_bg_color')->default('#1E050D');
            $table->string('sidebar_text_color')->default('#ffffff');
            $table->string('card_bg_color')->default('#ffffff');
            $table->boolean('use_gradient')->default(true);
            $table->string('gradient_direction')->default('to right');
            $table->text('custom_css')->nullable();
            $table->boolean('disable_animations')->default(false);
            $table->text('notes')->nullable();
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
        Schema::dropIfExists('appearance_settings');
    }
}
