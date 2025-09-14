<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReviewsTable extends Migration
{
    public function up()
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('destination_id')->constrained('destinations', 'destination_id')->onDelete('cascade');
            $table->integer('rating')->default(0);
            $table->text('comment')->nullable();
            $table->timestamps();
        });

    }

    public function down()
    {
        Schema::dropIfExists('reviews');
    }
}
