<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration
{
  /**
  * Run the migrations.
  *
  * @return void
  */
  public function up()
  {
    Schema::create('categories', function (Blueprint $table) {
      $table->bigIncrements('id');
      $table->integer('parent_id')->nullable();
      $table->string('title_es');
      $table->string('title_en')->nullable();
      $table->string('title_pt')->nullable();
      $table->string('desc_es');
      $table->string('desc_en')->nullable();
      $table->string('desc_pt')->nullable();
      $table->string('image_path')->nullable();
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
    Schema::dropIfExists('categories');
  }
}
