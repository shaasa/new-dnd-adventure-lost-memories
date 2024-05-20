<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("ALTER TABLE shows MODIFY COLUMN type ENUM('skill', 'spell', 'characteristic', 'equipment')");
        Schema::table('shows', function (Blueprint $table) {
                $table->boolean('show')->after('type')->default(false);
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("ALTER TABLE shows MODIFY COLUMN type ENUM('skill', 'spell', 'characteristic')");
        Schema::table('shows', function (Blueprint $table) {
            $table->dropColumn('show');
        });
    }
};