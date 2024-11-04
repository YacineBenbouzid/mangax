<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chapters', function (Blueprint $table) {
            $table->id();
            $table->string('n_chapter');
            $table->string('image');
            $table->date('date');
            $table->string('link');

            $table->unsignedBigInteger('manga_id'); // Define the foreign key column
            $table->foreign('manga_id') // Set the foreign key constraint
                  ->references('id') // References the 'id' column
                  ->on('mangas') // On the 'mangas' table
                  ->onDelete('cascade');

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
        Schema::dropIfExists('chapters');
    }
};
