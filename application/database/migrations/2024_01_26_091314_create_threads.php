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
        Schema::create('threads', function (Blueprint $table) {
            $table->id();
            $table->integer("board_id");
            $table->boolean("ismain")->default(false);
            $table->integer('thread_id')->nullable(true);
            $table->integer("id_reply")->nullable(true);
            $table->string("name",200)->nullable(true);
            $table->longText('content_json')->nullable(true);
            $table->longText('content_txt')->nullable(true);

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
        Schema::dropIfExists('threads');
    }
};
