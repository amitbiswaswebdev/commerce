<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductAttributeAttributeGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_attribute_attribute_groups', function (Blueprint $table) {
            $table->string('group_code', 100)->references('code')->on('product_attribute_groups')->constrained()->onDelete('cascade');
            $table->string('attribute_code', 100)->references('code')->on('product_attributes')->constrained()->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_att_att_groups');
    }
}
