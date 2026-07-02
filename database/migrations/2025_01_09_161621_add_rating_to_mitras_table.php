<?php

use Illuminate\Database\Migrations\Migration;  
use Illuminate\Database\Schema\Blueprint;  
use Illuminate\Support\Facades\Schema;  
  
class AddRatingToMitrasTable extends Migration  
{  
    public function up()  
    {  
        Schema::table('mitras', function (Blueprint $table) {  
            $table->decimal('rating', 3, 2)->default(0); // Average rating  
        });  
    }  
  
    public function down()  
    {  
        Schema::table('mitras', function (Blueprint $table) {  
            $table->dropColumn('rating');  
        });  
    }  
}  

