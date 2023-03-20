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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('email', 80);
            $table->string('password', 200);
            $table->string('name', 60);
            $table->date('birthdate');
            $table->string('city', 60)->nullable();
            $table->string('avatar', 100)->default('default.jpg');
            $table->string('token', 200)->nullable();
        });

        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('name', 20);
            $table->string('type', 20);
            $table->dateTime('date_event');
            $table->string('cover', 100)->default('cover.jpg');
            $table->text('description');
        });

        Schema::create('eventsInterestList', function (Blueprint $table) {
            $table->id();
            $table->integer('id_event');
            $table->integer('id_user');
        });

        Schema::create('eventsWillGo', function (Blueprint $table) {
            $table->id();
            $table->integer('id_event');
            $table->integer('id_user');
        });

        Schema::create('eventsLike', function (Blueprint $table) {
            $table->id();
            $table->integer('id_event');
            $table->integer('id_user');
        });

        Schema::create('eventsFavorite', function (Blueprint $table) {
            $table->id();
            $table->integer('id_event');
            $table->integer('id_user');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('events');
        Schema::dropIfExists('eventsInterestList');
        Schema::dropIfExists('eventsWillGo');
        Schema::dropIfExists('eventsLike');
        Schema::dropIfExists('eventsFavorite');
    }
};
