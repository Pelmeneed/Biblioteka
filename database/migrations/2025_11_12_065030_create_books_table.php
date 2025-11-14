<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('fullname', 255)->index();
            $table->bigInteger('type_of_book_id')->unsigned();
            $table->bigInteger('author_id')->unsigned();
            $table->bigInteger('publishing_id')->unsigned();
            $table->year('year_of_publish');
            $table->integer('count_of_sheets')->unsigned();
            $table->integer('count_of_items')->unsigned();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
