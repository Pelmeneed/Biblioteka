<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('readers', function (Blueprint $table) {
            $table->id();
            $table->string('lastname', 100);
            $table->string('firstname', 100);
            $table->string('patronymic', 100)->nullable();
            $table->enum('type_of_reader', ['teacher', 'student', 'other']);
            $table->bigInteger('group_id')->unsigned();
            $table->boolean('can_get_books')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('readers');
    }
};
