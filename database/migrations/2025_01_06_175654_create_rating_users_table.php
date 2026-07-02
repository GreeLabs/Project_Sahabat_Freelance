<?php

use Illuminate\Database\Migrations\Migration;  
use Illuminate\Database\Schema\Blueprint;  
use Illuminate\Support\Facades\Schema;  
  
class CreateRatingusersTable extends Migration  
{  
    public function up()  
    {  
        Schema::create('rating_users', function (Blueprint $table) {  
            $table->id();  
            $table->foreignId('id_user');  
            $table->foreignId('id_mitra');  
            $table->integer('rating');  
            $table->text('komentar')->nullable();  
            $table->string('tag')->nullable();  
            $table->timestamps();  
        });  
    }  
  
    public function down()  
    {  
        Schema::dropIfExists('rating_users');  
    }  
}  
