<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePageContentsTable extends Migration
{
    public function up()
    {
        if (Schema::hasTable('page_contents')) {
            return;
        }

        Schema::create('page_contents', function (Blueprint $table) {
            $table->id();
            $table->string('page', 50);
            $table->string('section_key', 100);
            $table->string('label');
            $table->string('section_group', 100)->default('General');
            $table->string('type', 20)->default('text');
            $table->text('value')->nullable();
            $table->integer('sort_order')->default(0);
            $table->timestamps();
            $table->unique(['page', 'section_key']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('page_contents');
    }
}
