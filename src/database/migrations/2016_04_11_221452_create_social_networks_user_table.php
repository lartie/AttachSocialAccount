<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSocialNetworksUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('social_networks_user', function (Blueprint $table) {
            $table->increments('id');

            $table->string('token');
            $table->string('uid', 191);
            $table->string('nickname');
            $table->string('name')->default(null)->nullable();
            $table->string('email')->default(null)->nullable();
            $table->string('avatar');

            $table->integer('user_id')->unsigned()->index();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('social_networks_id')->unsigned()->index();
            $table->foreign('social_networks_id')->references('id')->on('social_networks')->onDelete('cascade');
            $table->timestamps();

            $table->unique(['uid', 'social_networks_id'], 'account');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('social_networks_user');
    }
}
