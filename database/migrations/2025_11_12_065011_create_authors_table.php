<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('authors', function (Blueprint $table) {
            $table->id();
            $table->string('lastname', 100);
            $table->string('firstname', 100);
            $table->string('patronymic', 100)->nullable();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('authors');
    }
};
