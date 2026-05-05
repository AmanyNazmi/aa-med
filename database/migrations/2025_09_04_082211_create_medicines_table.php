<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('medicines', function (Blueprint $table) {

            $table->increments('med_id');
            $table->string('med_name', 100);
            $table->text('med_use')->nullable();             
            $table->text('side_eff')->nullable();            
            $table->text('med_warning')->nullable();        
            $table->text('preg_warning')->nullable();        
            $table->string('alter_med', 100)->nullable();   
            $table->boolean('pres_required')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('medicines');
    }
};
