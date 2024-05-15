<?php

use App\Models\Player;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use NotificationChannels\Discord\Discord;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::table('players', function (Blueprint $table) {
            $table->string('discord_private_channel_id')->default('')->after('discord_id');
        });
        $players = app(Player::class)->all();
        foreach ($players as $player) {
            $channelId = app(Discord::class)->getPrivateChannel($player->discord_id);
            $player->discord_private_channel_id = $channelId;
            $player->save();
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::table('players', function (Blueprint $table) {
            $table->dropColumn('discord_private_channel_id');
        });
    }
};
