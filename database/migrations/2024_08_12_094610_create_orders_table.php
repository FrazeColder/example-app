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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('shopify_id')->unique()->index();
            $table->bigInteger('order_number')->unique()->index();
            $table->enum('status', ['OPEN', 'AWAITING CUSTOMER RESPONSE', 'IN REVISION', 'REJECTED', 'PRINTING', 'SHIPPING', 'DONE'])->default('OPEN');
            $table->enum('financial_status', ['PENDING', 'AUTHORIZED', 'PARTIALLY_PAID', 'PAID', 'PARTIALLY_REFUNDED', 'REFUNDED', 'VOIDED'])->nullable();
            $table->enum('fulfillment_status', ['PENDING', 'FULFILLED', 'PARTIAL', 'UNFULFILLED'])->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('fulfillment_provider')->nullable();
            $table->string('fulfillment_id')->nullable();
            $table->string('shipment_provider')->nullable();
            $table->string('shipment_tracking_number')->nullable();
            $table->decimal('shipping_price')->nullable();
            $table->string('tags')->nullable();
            $table->boolean('stop_refreshing');
            $table->string('signed_url')->index();
            $table->boolean('signed_url_active')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
