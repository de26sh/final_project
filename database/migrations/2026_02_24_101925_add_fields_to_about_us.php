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
        Schema::table('about_us', function (Blueprint $table) {
            if (!Schema::hasColumn('about_us', 'title')) {
                $table->string('title');
            }
            if (!Schema::hasColumn('about_us', 'description')) {
                $table->text('description');
            }
            if (!Schema::hasColumn('about_us', 'image')) {
                $table->string('image')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('about_us', function (Blueprint $table) {
            $table->dropColumn(['title', 'description', 'image']);
        });
    }
};
