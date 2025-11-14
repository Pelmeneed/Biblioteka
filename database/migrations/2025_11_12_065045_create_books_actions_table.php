<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('books_actions', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('book_id')->unsigned()->index();
            $table->bigInteger('reader_id')->unsigned()->index();
            $table->date('get_date');
            $table->date('return_date')->nullable();
            $table->integer('count')->unsigned()->default(1);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('books_actions');
    }
};
