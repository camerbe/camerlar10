<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->tinyText('titre');
            $table->mediumText('chapeau');
            $table->longText('article');
            $table->unsignedBigInteger('hit');
            $table->string('image');
            $table->string('source')->index();
            $table->string('auteur')->index();
            $table->string('keyword')->nullable();
            $table->string('imagewidth')->nullable();
            $table->string('imageheigth')->nullable();
            $table->string('slug',300)->unique();
            $table->dateTime('dateparution')->index();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('rubrique_id');
            $table->char('pays_code');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('rubrique_id')->references('id')->on('rubriques');
            $table->foreign('pays_code')->references('code')->on('pays');
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
