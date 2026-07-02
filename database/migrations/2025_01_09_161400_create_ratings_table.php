<?php

use Illuminate\Database\Migrations\Migration;  
use Illuminate\Database\Schema\Blueprint;  
use Illuminate\Support\Facades\Schema;  
  
class CreateRatingsTable extends Migration  
{  
    public function up()  
    {  
        Schema::create('ratings', function (Blueprint $table) {  
            $table->id();  
            $table->foreignId('pekerjaan_id'); 
            $table->foreignId('mitra_id');   
            $table->foreignId('user_id')->constrained();  
            $table->integer('rating')->between(1, 5); // Assuming a 1-5 rating scale  
            $table->text('comment')->nullable();  
            $table->timestamps();  
        });  
    }  
  
    public function down()  
    {  
        Schema::dropIfExists('ratings');  
    }  
}  
