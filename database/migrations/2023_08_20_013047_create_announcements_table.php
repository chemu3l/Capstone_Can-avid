<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateAnnouncementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('announcements', function (Blueprint $table) {
            $table->id();
            $table->string('announcements');
            $table->string('announcements_what');
            $table->string('announcements_who');
            $table->date('announcements_when');
            $table->string('announcements_where');
            $table->string('announcements_why');
            $table->string('announcements_how');
            $table->string('status');
            $table->unsignedBigInteger('profile_id');
            $table->json('announcements_images');
            $table->date('announcements_uploaded')->default(DB::raw('CURRENT_DATE'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('announcements');
    }
}
