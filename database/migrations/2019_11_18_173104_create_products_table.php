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
            $table->bigIncrements('id');

            $table->string('name');
            $table->text('description');
            $table->string("isbn");
            $table->string("year");

            $table->string("slug")->unique();
            $table->float('price')->default(0);
            $table->unsignedInteger('stock')->default(0);
            $table->boolean('status')->default(1); //0->Inactivo, 1->Activo
            $table->boolean('outstanding')->default(0); //0->Inactivo, 1->Activo

            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('subcategory_id');
            $table->unsignedBigInteger("country_id");
            
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('category_id')
                  ->references('id')->on('categories')
                  ->onDelete('cascade');

            $table->foreign('subcategory_id')
                  ->references('id')->on('subcategories')
                  ->onDelete('cascade');

            $table->foreign("country_id")
                  ->references('id')->on("countries")
                  ->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropSoftDeletes(); //add this line
        });
    }
}
