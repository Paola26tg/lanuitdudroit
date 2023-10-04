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
        Schema::create('calendars', function (Blueprint $table) {
            $table->id('idCalendar');
            $table->bigInteger('idEvent')->unsigned();
            $table->string('subtitle');
            $table->string('day');
            $table->string('time');
            $table->softDeletes();
            $table->timestamps();

             $table->foreign('idEvent')
                ->references('idEvent')
                ->on('events')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('calendars');
    }
};
