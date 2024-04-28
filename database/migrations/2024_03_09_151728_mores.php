<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('mores', function (Blueprint $table) {
            $table->id();
            $table->string('done');
            $table->string('pin');
            $table->string('task_id');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mores');
    }
};
