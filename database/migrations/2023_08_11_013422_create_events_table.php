<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('events');
            $table->string('events_description');
            $table->date('events_uploaded')->default(DB::raw('CURRENT_DATE'));
            $table->dateTime('events_started');
            $table->dateTime('events_end');
            $table->json('events_images');
            $table->unsignedBigInteger('profile_id');
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('events');
    }
}





