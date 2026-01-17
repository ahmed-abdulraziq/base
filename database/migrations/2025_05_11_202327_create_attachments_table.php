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
        Schema::create('attachments', function (Blueprint $table) {
            $table->id();
            $table->string('type', 20)->default('image');
            $table->string('extension', 10)->nullable();
            $table->integer('size')->nullable();
            $table->string('name')->nullable();
            $table->string('title')->nullable();
            $table->string('usage')->nullable();
            $table->string('path', 2048);
            $table->string('sm')->nullable();
            $table->morphs('attachmentable');
            $table->nullableMorphs('owner');
            $table->softDeletes();
            $table->timestamps();

            // $table->index(['attachmentable_type', 'attachmentable_id']);
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attachments');
    }
};
