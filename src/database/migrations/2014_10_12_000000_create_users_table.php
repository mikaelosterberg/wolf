<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;


/**
 * Create or Drop users table.
 *
 * Class CreateUsersTable
 */
class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /**
         * Setup users table.
         */
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 30); // Name
            $table->string('slug', 20)->unique(); // URL safe name
            $table->string('profile', 200)->nullAble()->default('null'); // Profile text
            $table->string('location', 255)->nullAble()->default('null'); // Location
            $table->string('email', 255)->unique(); // Email address used for auth.
            $table->string('password', 255); // Password field.
            $table->rememberToken(); // Login remember token.
            $table->timestamps(); // Common timestamps.
            $table->softDeletes(); // SoftDelete timestamps, date = deleted.
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        /**
         * Drop users.
         */
        Schema::dropIfExists('users');
    }
}
