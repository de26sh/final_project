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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->foreignId('sub_category_id')->constrained('sub_categories')->onDelete('cascade');
            $table->foreignId('family_id')->nullable()->constrained()->onDelete('set null');

            $table->string('name');
            $table->decimal('price', 10, 2)->nullable();

            $table->text('short_description')->nullable();
            $table->longText('long_description')->nullable();

            $table->enum('status', ['published', 'draft', 'unpublished'])->default('draft');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
