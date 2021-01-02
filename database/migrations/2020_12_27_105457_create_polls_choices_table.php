<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePollsChoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('choices', function (Blueprint $table) {
            $table->uuid('id')->primary()->unique();
            $table->uuid('poll_id');
            $table->foreign('poll_id')
            ->references('id')
            ->on('polls')
            ->onDelete('cascade');
            $table->string('choice');
            $table->integer('vote_count')->default(0);
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
        Schema::dropIfExists('choices');
    }
}
