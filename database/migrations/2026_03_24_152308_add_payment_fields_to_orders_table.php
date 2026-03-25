<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            if (!Schema::hasColumn('orders', 'razorpay_order_id')) {
                $table->string('razorpay_order_id')->nullable()->after('payment_method');
            }
            if (!Schema::hasColumn('orders', 'payment_id')) {
                $table->string('payment_id')->nullable()->after('razorpay_order_id');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn(['razorpay_order_id', 'payment_id']);
        });
    }
};