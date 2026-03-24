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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
        $table->foreignId('order_id')->constrained()->onDelete('cascade');

        // Billing
        $table->string('first_name');
        $table->string('last_name');
        $table->string('company_name')->nullable();
        $table->string('email');
        $table->string('phone');
        $table->string('country');
        $table->string('address_line1');
        $table->string('address_line2')->nullable();
        $table->string('city');
        $table->string('state');
        $table->string('postcode');

        // Shipping (if different)
        $table->boolean('ship_to_different')->default(false);
        $table->string('shipping_first_name')->nullable();
        $table->string('shipping_last_name')->nullable();
        $table->string('shipping_company_name')->nullable();
        $table->string('shipping_email')->nullable();
        $table->string('shipping_phone')->nullable();
        $table->string('shipping_country')->nullable();
        $table->string('shipping_address_line1')->nullable();
        $table->string('shipping_address_line2')->nullable();
        $table->string('shipping_city')->nullable();
        $table->string('shipping_state')->nullable();
        $table->string('shipping_postcode')->nullable();

        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
