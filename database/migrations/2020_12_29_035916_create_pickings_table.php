<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePickingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pickings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pickingnumber_id')->constrained();
            $table->foreignId('labour_id')->constrained('users');
            $table->date('date');
            $table->integer('kgs_picked')->nullable();
            $table->timestamps();

            $table->unique(['pickingnumber_id', 'labour_id', 'date']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pickings');
    }
}
