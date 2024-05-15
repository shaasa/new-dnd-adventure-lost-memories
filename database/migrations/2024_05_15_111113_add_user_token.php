<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (!Schema::hasColumn('players', 'token')) {
            Schema::table('players', function ($table) {
                $table->string('token', 80)->after('discord_private_channel_id')
                    ->unique()
                    ->nullable()
                    ->default(null);
            });
        }

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user', function (Blueprint $table) {
            $table->dropColumn('token');
        });
    }
};
