<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PendingNews extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pending_news', function (Blueprint $table) {
            $table->id();
            $table->string("link");
            $table->string("link_hash");
            $table->boolean('processed')->default(0);
            $table->timestamp("scrap_timestamp");
            $table->timestamp("processed_timestamp")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
