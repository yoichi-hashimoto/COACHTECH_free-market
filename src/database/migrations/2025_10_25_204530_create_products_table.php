<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('seller_id')->constrained('users')->onDelete('cascade');
            $table->string('name');
            $table->string('brand');
            $table->foreignId('category_id')->constrained('categories')->onDelete('cascade');
            $table->unsignedInteger('price');
            $table->enum('condition', ['new','like_new','used'])->comment('商品状態');
            $table->string('description');
            $table->unsignedInteger('likes_count');
            $table->unsignedInteger('comments_count');
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
        Schema::dropIfExists('products');
    }
}
