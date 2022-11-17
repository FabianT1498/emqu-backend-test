<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('latency_tests', function (Blueprint $table) {
            $table->id();
            $table->enum('status', ['FAILURE', 'SUCCESS']);
            $table->unsignedInteger('latency');
            $table->timestamps();
            $table->string('server_ipv4');
            $table->unsignedBigInteger('user_id');

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('server_ipv4')->references('ipv4')->on('servers');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('latency_tests');
    }
};
