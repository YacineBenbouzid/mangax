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
        Schema::create('mangas', function (Blueprint $table) {
            $table->id();
            $table->string( 'image');
            $table->string( 'banner');
            $table->string('name');
            $table->text('description')->nullable();;
            $table->integer('nviews')->default(0); // Set default value to 0
            $table->integer('nvd')->default(0); // Set default value to 0
            $table->integer('nvw')->default(0); // Set default value to 0
            $table->integer('nvm')->default(0); // Set default value to 0

            $table->string('link')->nullable();
            $table->string('genre_1')->nullable();

            $table->string('genre_2')->nullable();

            $table->string('genre_3')->nullable();
            $table->string('type')->nullable();






            $table->unsignedBigInteger('user_id'); // Define the foreign key column
            $table->foreign('user_id') // Set the foreign key constraint
                  ->references('id') // References the 'id' column
                  ->on('users') // On the 'mangas' table
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
        Schema::dropIfExists('mangas');
    }
};
