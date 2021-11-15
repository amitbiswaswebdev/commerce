<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductAttributeGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_attribute_groups', function (Blueprint $table) {
            $table->id();
            $table->string('code', 100)->unique()->index();
            $table->string('set_code', 100)->references('code')->on('product_attribute_sets')->constrained()->onDelete('cascade');
            $table->string('level', 100);
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
        Schema::dropIfExists('product_attribute_groups');
    }
}
