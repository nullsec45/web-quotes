<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->string("subject", 50);
            $table->biginteger("user_id")->unsigned();
            $table->biginteger("quote_id")->unsigned();
            $table->boolean("seen")->default(false);
            
            $table->foreign("user_id")->references("id")->on("users")->onDelete("cascade");
            $table->foreign("quote_id")->references("id")->on("quotes")->onDelete("cascade");
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
        Schema::dropIfExists('notifications');
    }
}
