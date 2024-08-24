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
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id');
            $table->enum('status', ['OPEN', 'VERIFY BY ADMINS', 'AWAITING CUSTOMER RESPONSE', 'IN REVISION', 'REJECTED', 'DONE'])->default('OPEN');
            $table->bigInteger('shopify_id')->nullable()->unique()->index();
            $table->bigInteger('shopify_product_id')->nullable()->index();
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('title');
            $table->string('sku')->nullable();
            $table->string('variant_title')->nullable();
            $table->bigInteger('shopify_variant_id')->nullable()->index();
            $table->integer('quantity');
            $table->decimal('discount')->nullable();
            $table->decimal('tax')->nullable();
            $table->decimal('refunds')->nullable();
            $table->decimal('total_unit_cost')->nullable();
            $table->decimal('total_price_gross')->nullable();
            $table->decimal('total_price_net')->nullable();
            $table->decimal('total_profit_net')->nullable();
            $table->boolean('added_manually');
            $table->boolean('split_up');
            $table->timestamps();

            $table->foreign('order_id')
                ->references('id')
                ->on('orders')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
