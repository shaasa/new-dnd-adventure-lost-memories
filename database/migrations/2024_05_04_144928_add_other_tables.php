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

        Schema::table('users', function (Blueprint $table) {
            $table->string('race')->nullable()->after('password');
            $table->string('class')->nullable()->after('password');
            $table->integer('level')->default(1)->after('password');
            $table->string('alignment')->default('CG')->after('password');
        });

        Schema::create('games', function (Blueprint $table) {
            $table->id();
            $table->integer('players_count');
            $table->timestamps();
        });

        Schema::create('players', function (Blueprint $table) {
            $table->id();
            $table->foreignId('game_id')->constrained()->onDelete('cascade');
            $table->string('discord_name');
            $table->string('discord_id')->unique();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });

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
            $table->enum('type', ['spell', 'skill', 'characteristic']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('race');
            $table->dropColumn('class');
            $table->dropColumn('level');
            $table->dropColumn('alignment');
        });
        Schema::dropIfExists('games');
        Schema::dropIfExists('players');
        Schema::dropIfExists('character_sheets');
        Schema::dropIfExists('shows');
    }
};
