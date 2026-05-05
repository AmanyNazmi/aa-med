<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('suggestions', function (Blueprint $table) {
            $table->increments('sugg_id'); 
            $table->string('full_name', 100); 
            $table->enum('role', ['patient', 'doctor', 'pharmacist']);
            $table->string('email', 100)->unique();
            $table->text('sugg_text');
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('suggestions');
    }
};
