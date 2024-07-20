<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterEventSpeakers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('event_speakers', function (Blueprint $table) {
            //
            $table->string('facebook_url');
            $table->string('twitter_url');
            $table->string('linkedin_url');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('event_speakers', function (Blueprint $table) {
            //
        });
    }
}
