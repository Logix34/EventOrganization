<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableTops extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('table_tops', function (Blueprint $table) {
            $table->id();
            $table->integer('event_id');
            $table->integer('total_tables');
            $table->integer('total_seats');
            $table->integer('booked_tables');
            $table->integer('booked_tickets');
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
        Schema::dropIfExists('table_tops');
    }
}
