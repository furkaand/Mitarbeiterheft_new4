<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('trainings', function (Blueprint $table) {
            $table->id();
            $table->string('department');       // Abteilung
            $table->string('cost_center');     // Kostenstelle
            $table->text('purpose')->nullable(); // Ziel der Maßnahme (nullable)
            $table->date('date');              // Termin
            $table->string('participants');    // Teilnehmer (kommagetrennt oder JSON)
            $table->string('organizer');       // Veranstalter
            $table->decimal('planned_costs');  // Kosten geplant
            $table->string('requested_by');    // Beantragt von
            $table->text('confirmation')->nullable(); // Unterschrift und Datum als JSON
            $table->text('rejection_reason')->nullable(); // Begründung für Ablehnung
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('trainings');
    }
};
