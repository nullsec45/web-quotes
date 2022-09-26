<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuoteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quote_tag', function (Blueprint $table) {
            $table->id();
            $table->biginteger("quote_id")->unsigned();
            $table->biginteger("tag_id")->unsigned();
            $table->timestamps();

            $table->foreign("quote_id")->references("id")->on("quotes")->onDelete("cascade");
            $table->foreign("tag_id")->references("id")->on("tags")->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('quote_tag');
    }
}
