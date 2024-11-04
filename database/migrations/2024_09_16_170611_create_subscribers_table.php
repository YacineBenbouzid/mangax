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
        Schema::create('subscribers', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id'); // Define the foreign key column
            $table->foreign('user_id') // Set the foreign key constraint
                  ->references('id') // References the 'id' column
                  ->on('users') // On the 'mangas' table
                  ->onDelete('cascade');

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
        Schema::dropIfExists('subscribers');
    }
};
