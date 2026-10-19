<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('calls', function (Blueprint $table) {
            $table->id();
            $table->string('source_call_id')->unique();
            $table->string('caller_number', 32);
            $table->string('extension', 20);
            $table->string('direction', 20);
            $table->string('status', 20);
            $table->unsignedInteger('duration')->default(0);
            $table->timestamp('started_at');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('calls');
    }
};
