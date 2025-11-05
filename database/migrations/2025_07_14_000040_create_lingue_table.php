<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('lingue', function (Blueprint $table) {
            $table->id('id_lingua');
            $table->char('codice', 2)->unique(); // es. it, en
            $table->string('nome', 50);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lingue');
    }
};
