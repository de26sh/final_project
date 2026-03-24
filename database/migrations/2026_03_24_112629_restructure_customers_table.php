<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
       $duplicates = DB::table('customers')
            ->select('email', DB::raw('MAX(id) as keep_id'))
            ->groupBy('email')
            ->get();

        foreach ($duplicates as $row) {
            // Delete all records with this email EXCEPT the latest one
            DB::table('customers')
                ->where('email', $row->email)
                ->where('id', '!=', $row->keep_id)
                ->delete();
        }

        // Step 2: For any orders pointing to deleted customer records,
        // re-point them to the kept customer id
        foreach ($duplicates as $row) {
            // Get all ids that were kept (already done above)
            // Just make sure orders reference valid customer ids
            $validId = $row->keep_id;
            $email   = $row->email;

            // Find all customer ids with this email (only keep_id remains now)
            // Update orders that had orphaned customer_id to point to keep_id
            // This handles if customer_id column already exists
            if (Schema::hasColumn('orders', 'customer_id')) {
                $allIds = DB::table('customers')->where('email', $email)->pluck('id');
                DB::table('orders')
                    ->whereIn('customer_id', $allIds)
                    ->update(['customer_id' => $validId]);
            }
        }

        // Step 3: Handle customer_id column on orders
        if (!Schema::hasColumn('orders', 'customer_id')) {
            Schema::table('orders', function (Blueprint $table) {
                $table->foreignId('customer_id')->nullable()->after('product_id')
                      ->constrained()->onDelete('set null');
            });
        }

        // Step 4: Drop order_id from customers if it exists
        if (Schema::hasColumn('customers', 'order_id')) {
            Schema::table('customers', function (Blueprint $table) {
                $table->dropForeign(['order_id']);
                $table->dropColumn('order_id');
            });
        }

        // Step 5: Now safe to add unique constraints
        Schema::table('customers', function (Blueprint $table) {
            $table->string('email')->unique()->change();
            $table->string('phone')->unique()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
        $table->dropForeign(['customer_id']);
        $table->dropColumn('customer_id');
    });

    Schema::table('customers', function (Blueprint $table) {
        $table->foreignId('order_id')->constrained()->onDelete('cascade');
        $table->dropUnique(['email']);
        $table->dropUnique(['phone']);
    });
    }
};
