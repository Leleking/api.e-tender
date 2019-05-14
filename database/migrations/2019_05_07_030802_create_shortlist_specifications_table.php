<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShortlistSpecificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shortlist_specifications', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('project_id');
            $table->integer('experience');
            $table->boolean('average_budget');
            $table->boolean('shuffle');
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
        Schema::dropIfExists('shortlist_specifications');
    }
}
