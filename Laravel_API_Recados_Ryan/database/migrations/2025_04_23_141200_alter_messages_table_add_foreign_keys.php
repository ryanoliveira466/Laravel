<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table("messages", function(Blueprint $table){
            //Remover colunas antigas
            $table->dropColumn(['sender', 'receiver']);

            //Adicionar as foreign keys (criando as colunas)
            $table->unsignedBigInteger('sender_id');
            $table->unsignedBigInteger('receiver_id');

            //Define os relacionamentos
            //Cascade - Deleta todos os elementos que tiverem o elemento de ID(Cascata)
            $table->foreign('sender_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('receiver_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table("messages", function(Blueprint $table){
            //Remove as foreing keys e as colunas
            $table->dropForeign('sender_id');
            $table->dropForeign('receiver_id');
            $table->dropColumn(['sender_id','receiver_id']);

            //Recriar as colunas antigas
            $table->string('sender');
            $table->string('receiver');
        });
        
    }
};
