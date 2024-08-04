<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Enums\TypeEnum;

return new class extends Migration
{
    /**
     * Run the migrations.
     */

    public function up(): void
    {

        Schema::create('characters', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->boolean('mandatory')->default(false);
            $table->string('race')->nullable();
            $table->string('class')->nullable();
            $table->integer('level')->default(1);
            $table->string('alignment')->default('CG');
            $table->boolean('spells')->default(0);
            $table->timestamps();
        });

        Schema::create('games', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('status', ['ongoing', 'finished', 'suspended'])->default('ongoing');
            $table->integer('players_count');
            $table->timestamps();
        });

        //Per un eventuale sviluppo futuro
        Schema::create('character_sheets', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('value');
            $table->enum('type', ['spell', 'skill', 'characteristic']);
            $table->timestamps();
        });

        Schema::create('shows', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('game_id')->constrained()->onDelete('cascade');
            $table->enum('type', ['spell', 'skill', 'characteristic','equipment']);
            $table->boolean('show')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

        Schema::dropIfExists('games');
        Schema::dropIfExists('characters');
        Schema::dropIfExists('character_sheet');
        Schema::dropIfExists('shows');
    }
};
