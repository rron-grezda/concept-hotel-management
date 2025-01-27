<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateRoomsForeignKey extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
{
    Schema::table('rooms', function (Blueprint $table) {
        $table->dropForeign(['hotel_id']);
        $table->foreign('hotel_id')->references('id')->on('hotels')->onDelete('cascade');
    });
}

public function down()
{
    Schema::table('rooms', function (Blueprint $table) {
        $table->dropForeign(['hotel_id']); // Hiq lidhjen me cascade
        $table->foreign('hotel_id')->references('id')->on('hotels'); // Rikthe lidhjen pa cascade
    });
}

}
