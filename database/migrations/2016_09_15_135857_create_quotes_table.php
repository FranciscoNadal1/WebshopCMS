<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
   public function up()  
{
    Schema::create('quotes', function(Blueprint $table)
    {
         $table->increments('id');
                     $table->timestamps();         

         // our new fields
                     $table->string('text');
                     $table->string('author');
                     $table->string('background');
    });
}
}
