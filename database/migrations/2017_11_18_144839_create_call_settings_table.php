<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCallSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('call_settings', function (Blueprint $table) {
            $table->increments('id');
			$table->string('number', 17);
			$table->integer('seconds');
			$table->string('cid_prefix', 6);
			$table->timestamp('last_call')->useCurrent();
			$table->timestamp('stop_call')->nullable();
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
        Schema::dropIfExists('call_settings');
    }
}
