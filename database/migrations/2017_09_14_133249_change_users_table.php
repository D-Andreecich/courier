<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->decimal('rating', '2', '1')->default(0);
	        $table->integer('total_rating')->unsigned()->default(0);
	        $table->integer('total_rates')->unsigned()->default(0);
            $table->string('avatar')->default('/uploads/avatars/default.jpg')->change();
            $table->decimal('social_id', '30','0');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
}
