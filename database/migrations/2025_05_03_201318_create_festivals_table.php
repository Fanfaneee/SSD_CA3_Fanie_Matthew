<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('festivals', function (Blueprint $table) {
        $table->id();
        $table->string('name'); // Nom du festival
        $table->string('image')->nullable(); // URL de l'image
        $table->string('location'); // Lieu
        $table->string('genre'); // Genre (rock, pop, etc.)
        $table->text('lineup'); // Liste des artistes (JSON ou texte)
        $table->decimal('price', 8, 2)->nullable(); // Prix
        $table->date('start_date'); // Date de début
        $table->date('end_date'); // Date de fin
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('festivals');
    }
};
