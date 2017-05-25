<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('user_id');
//            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->unsignedInteger('channel_id');
            $table->unsignedInteger('posts_count')->default(0);
            $table->string('agent_code');
            $table->string('client_code');
            $table->string('client_name');
            $table->string('client_phone');
//            $table->string('slug');
            $table->binary('description');
//            $table->boolean('pending')->default(true);
//
//            $table->integer('solved_by')->nullable();
//            $table->timestamp('solved_at');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tasks');
    }
}
