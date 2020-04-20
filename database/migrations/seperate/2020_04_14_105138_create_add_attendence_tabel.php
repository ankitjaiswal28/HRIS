<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddAttendenceTabel extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mst_tbl_add_attdencence', function (Blueprint $table) {
            $table->bigIncrements('attendenceId');
            $table->string('user_name');
            $table->string('shift');
            $table->dateTime('in_time_Date');
            $table->dateTime('out_time_Date');
            $table->string('Stutus');
            $table->string('Flag');
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
        Schema::dropIfExists('mst_tbl_add_attdencence');
    }
}
