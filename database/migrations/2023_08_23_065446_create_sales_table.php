<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->BigInteger('productID');
            $table->string('product_name');
            $table->double('item_price');
            $table->double('item_cost');
            $table->double('shipping_charge');
            $table->double('shipping_cost');
            $table->double('total_sold');
            $table->bigInteger('returns')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};
