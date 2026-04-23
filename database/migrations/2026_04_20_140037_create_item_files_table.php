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
        Schema::create('item_files', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('item')->constrained('kaos_kaki');
            $table->text('url')->nullable();
            $table->boolean('is_primary')->default(false);
            $table->text('key')->nullable();
            $table->text('thumbnail')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('item_files');
    }
};
