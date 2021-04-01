<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePollsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('polls', function (Blueprint $table) {
            $table->uuid('id')->primary()->unique();
            $table->uuid('organization_id');
            $table->foreign('organization_id')
            ->references('id')
            ->on('organizations')
            ->onDelete('cascade');
            $table->string('title');
            $table->text('description');
            $table->timestamp('deadline');
            $table->boolean('show_result')->default(true);
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
        Schema::dropIfExists('polls');
    }
}
