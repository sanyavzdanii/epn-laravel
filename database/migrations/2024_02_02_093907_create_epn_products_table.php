<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEPNProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('e_p_n_products', function (Blueprint $table) {
            $table->id();
            $table->integer('id_category');
            $table->string('name');
            $table->text('description');
            $table->string('img');
            $table->json('all_img');
            $table->json('prices');
            $table->float('price', 14, 2);
            $table->float('lowest_price', 14, 2)->default(0.00);
            $table->string('affiliate_link');
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
        Schema::dropIfExists('e_p_n_products');
    }
}
