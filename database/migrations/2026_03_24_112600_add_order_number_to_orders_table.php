<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Step 1: ADD the column first (nullable so existing rows don't break)
        Schema::table('orders', function (Blueprint $table) {
            if (!Schema::hasColumn('orders', 'order_number')) {
                $table->string('order_number')->nullable()->after('id');
            }
        });

        // Step 2: Fill existing rows with unique order numbers
        $orders = DB::table('orders')
            ->where(function ($q) {
                $q->whereNull('order_number')
                    ->orWhere('order_number', '');
            })->get();

        foreach ($orders as $order) {
            do {
                $number = 'ORD-' . date('Y') . '-' . random_int(10000, 99999);
            } while (DB::table('orders')->where('order_number', $number)->exists());

            DB::table('orders')
                ->where('id', $order->id)
                ->update(['order_number' => $number]);
        }

        // Step 3: Now safe to make it unique and not nullable
        Schema::table('orders', function (Blueprint $table) {
            $table->string('order_number')->unique()->nullable(false)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('order_number');
        });
    }
};