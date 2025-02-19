<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('project_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->constrained()->onDelete('cascade'); // Привязка к проекту
            $table->string('locale', 2); // 'en', 'ru' и т. д.
            $table->string('title'); // Заголовок
            $table->text('short_desc')->nullable(); // Краткое описание
            $table->longText('full_desc')->nullable(); // Полное описание
            $table->unique(['project_id', 'locale']); // Уникальность перевода по языку
        });
    }

    public function down()
    {
        Schema::dropIfExists('project_translations');
    }
};
