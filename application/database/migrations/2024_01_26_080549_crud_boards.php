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
          Schema::create("boards", function (Blueprint $table) {
            $table->id();
            $table->integer("sort")->nullable(true);
            $table->integer("enable")->default(1);
             $table->string("title","200");$table->string("alias","200");$table->text("description")->nullable();
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
         Schema::dropIfExists("boards");
    }
};
