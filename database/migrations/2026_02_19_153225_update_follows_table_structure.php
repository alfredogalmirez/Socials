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
        Schema::table('follows', function (Blueprint $table) {
            $table->renameColumn('user_id', 'follower_id');
            $table->renameColumn('friend_id', 'followed_id');

            $table->dropColumn('status');

            $table->unique(['follower_id', 'followed_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('follows', function (Blueprint $table) {
            $table->dropUnique(['follower_id', 'followed_id']);
            $table->renameCOlumn('follower_id', 'user_id');
            $table->renameCOlumn('followed_id', 'friend_id');
            $table->string('status')->nullable();
        });
    }
};
