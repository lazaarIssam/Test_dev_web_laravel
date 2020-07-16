<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnUserId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('stars', function (Blueprint $table) {
            //Ajout Clef étrangère(CE) qui reference le createur de l'objet star
            //Cette CE va se créer apres la colone de la clef primaire de la table stars
            //Adding a foreign key to reference the creator of the object star
            //This foreign key will be created after the primary key in the stars table
            $table->bigInteger('user_id')->unsigned()->after('id');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('stars', function (Blueprint $table) {
            //si on fait un roll back on doit obligatoirement supprimer cette CE
            //in case of roll back we need to delete the foreign key 
            $table->dropForeign(['user_id']);
            //ici on supprime la colone de la CE
            //here we delete the clomn of the foreign key all together
            $table->dropColumn('user_id');
        });
    }
}
