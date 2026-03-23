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
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('title')->nullable();
            $table->jsonb('timetable_data');
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schedules');
    }
};

// Exemplo de como deve ser o json

// {
//   "title": "1º Semestre 2026",
//   "timetable_data": {
//     "days": ["segunda", "terca", "quarta", "quinta", "sexta"],
//     "slots_per_day": 5,
//     "timetable": {
//       "segunda": [
//         { "slot": 1, "subject_id": 3, "start_time": "07:30", "end_time": "08:20" },
//         { "slot": 2, "subject_id": 5, "start_time": "08:20", "end_time": "09:10" },
//         { "slot": 3, "subject_id": null },
//         { "slot": 4, "subject_id": 1 },
//         { "slot": 5, "subject_id": null }
//       ],
//       "terca": [
//         { "slot": 1, "subject_id": 3, "start_time": "07:30", "end_time": "08:20" },
//         { "slot": 2, "subject_id": 5, "start_time": "08:20", "end_time": "09:10" },
//         { "slot": 3, "subject_id": null },
//         { "slot": 4, "subject_id": 1 },
//         { "slot": 5, "subject_id": null }
//       ],
//       "quarta": [
//         { "slot": 1, "subject_id": 3, "start_time": "07:30", "end_time": "08:20" },
//         { "slot": 2, "subject_id": 5, "start_time": "08:20", "end_time": "09:10" },
//         { "slot": 3, "subject_id": null },
//         { "slot": 4, "subject_id": 1 },
//         { "slot": 5, "subject_id": null }
//       ],
//       "quinta": [
//         { "slot": 1, "subject_id": 3, "start_time": "07:30", "end_time": "08:20" },
//         { "slot": 2, "subject_id": 5, "start_time": "08:20", "end_time": "09:10" },
//         { "slot": 3, "subject_id": null },
//         { "slot": 4, "subject_id": 1 },
//         { "slot": 5, "subject_id": null }
//       ],
//       "sexta": [
//         { "slot": 1, "subject_id": 2, "start_time": "07:30", "end_time": "08:20" },
//         { "slot": 2, "subject_id": null },
//         { "slot": 3, "subject_id": 4 },
//         { "slot": 4, "subject_id": null },
//         { "slot": 5, "subject_id": null }
//       ]
//     }
//   }
// }