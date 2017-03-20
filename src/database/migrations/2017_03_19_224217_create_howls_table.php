<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Migration up and down for table howls.
 *
 * Class CreateHowlsTable
 */
class CreateHowlsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /**
         * Create Howls table and add relations.
         */
        Schema::create('howls', function (Blueprint $table) {
            $table->bigIncrements('id'); // Large id number
            $table->unsignedInteger('user_id'); // Users id
            $table->string('howl', 160); // 160 char status update.
            $table->text('cache')->nullable(); // cache data.

            $table->timestamps(); // Created and updated timestamp.
            $table->softDeletes(); // Soft delete timestamp. (Timestamp => Deleted, NULL => NOT Deleted)

            $table->foreign('user_id') // Foreign key constraint on user_id
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
        Schema::dropIfExists('howls');
    }
}
