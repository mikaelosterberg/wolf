<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Set up a follow schema.
 *
 * Class CreateFollowersTable
 */
class CreateFollowersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('followers', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->index(); // (Stacker) The user id
            $table->unsignedInteger('follow_id')->index(); // (Victim) The user_id of the one that is followed.
            $table->timestamps();

            $table->foreign('user_id', 'fk_followers_userid_user_id') // Foreign key constraint on user_id
            ->references('id')->on('users') // Id column in users table
            ->onDelete('cascade'); // When a user is deleted purge the database.

            $table->foreign('follow_id', 'fk_followers_followid_user_id') // Foreign key constraint on user_id
            ->references('id')->on('users') // Id column in users table
            ->onDelete('cascade'); // When a user is deleted purge the database.
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('followers');
    }
}
