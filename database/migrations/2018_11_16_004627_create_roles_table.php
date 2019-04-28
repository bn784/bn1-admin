<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class CreateRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('roles')) {
            Schema::create('roles', function (Blueprint $table) {
                $table->Increments('id');
                $table->string('title')->nullable();
                $table->timestamps();
                
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      //  DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Schema::dropIfExists('roles');
     //   DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
