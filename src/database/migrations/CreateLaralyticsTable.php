<?php


namespace Elijahcruz\Laralytics\database\migrations;


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLaralyticsTable extends Migration
{
    
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('laralytics', function (Blueprint $table) {
            $table->id();
            $table->string('path');
            $table->json('data')->default('{}');
            $table->timestamp('realtime')->nullable();
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
        Schema::dropIfExists('laralytics');
    }

}
