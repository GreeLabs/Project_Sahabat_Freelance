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
            $table->unsignedBigInteger('id_user');  
            $table->unsignedBigInteger('id_mitra');  
            $table->text('isi_pesan');  
            $table->timestamp('tanggal')->useCurrent();  
            $table->string('jenis');  
            $table->timestamps();  
  
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');  
            $table->foreign('id_mitra')->references('id')->on('users')->onDelete('cascade');  
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
