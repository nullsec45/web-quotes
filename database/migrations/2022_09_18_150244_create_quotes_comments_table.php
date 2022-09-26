<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuotesCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quote_comments', function (Blueprint $table) {
            $table->id();
            $table->text("subject");
            $table->biginteger("user_id")->unsigned();
            $table->biginteger("quote_id")->unsigned();
            $table->timestamps();

        });

        Schema::table('quote_comments', function($table) {
            $table->foreign("user_id")->references("id")->on("users")->onDelete("cascade");
            $table->foreign("quote_id")->references("id")->on("quotes")->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('quoteComments');
    }
}
