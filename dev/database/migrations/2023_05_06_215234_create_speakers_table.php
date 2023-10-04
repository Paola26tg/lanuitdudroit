<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('speakers', function (Blueprint $table) {
            $table->id('idSpeaker');
            $table->bigInteger('idEvent')->unsigned();
            $table->bigInteger('idCalendar')->unsigned();
            $table->string('name');
            $table->string('job');
            $table->string('social_link');
            $table->string('cover');
            $table->softDeletes();
            $table->timestamps();

             $table->foreign('idEvent')
                ->references('idEvent')
                ->on('events')
                ->onDelete('cascade')
                ->onUpdate('cascade');

             $table->foreign('idCalendar')
                ->references('idCalendar')
                ->on('calendars')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('speakers');
    }
};
