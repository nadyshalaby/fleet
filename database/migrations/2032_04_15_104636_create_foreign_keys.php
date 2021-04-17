<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateForeignKeys extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('station_trip', function (Blueprint $table) {
            $table->foreignId('trip_id')->constrained('trips')->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->foreignId('station_id')->constrained('stations')->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->integer('stop_order')->default(1);
        });

        Schema::table('trip_user', function (Blueprint $table) {
            $table->foreignId('trip_id')->constrained('trips')->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->foreignId('user_id')->constrained('users')->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->foreignId('pickup_station_id')->constrained('stations')->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->foreignId('arrival_station_id')->constrained('stations')->onDelete('CASCADE')->onUpdate('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    }
}
