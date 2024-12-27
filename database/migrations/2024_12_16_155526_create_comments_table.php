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
        Schema::create('comments', function (Blueprint $table) {
            $table->id(); // Clé primaire
            $table->text('content'); // Contenu du commentaire
            $table->foreignId('post_id')->constrained()->onDelete('cascade'); // Relation avec 'posts'
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Relation avec 'users'
            $table->timestamps(); // created_at et updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comments');
    }
};
