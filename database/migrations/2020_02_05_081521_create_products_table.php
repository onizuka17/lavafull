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
            $table->charset = 'utf8';
            $table->collation = 'utf8_unicode_ci';
            $table->bigIncrements('id');
            $table->string('title');
            $table->string('slug');
            $table->mediumText('short_description');
            $table->text('description');
            $table->integer('price');
            $table->integer('sale_price');
            $table->boolean('active');
            $table->boolean('feature');
            $table->string('type');
            $table->string('feature_image');
            $table->string('seo_title');
            $table->mediumText('meta_keyword');
            $table->mediumText('meta_description');
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
