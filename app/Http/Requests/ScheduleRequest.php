<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ScheduleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $requiredOrNot = $this->isMethod('POST') ? 'required' : 'sometimes';

        return [
            'title' => ['nullable', 'string', 'max:255'],

            'timetable_data'                => [$requiredOrNot, 'array'],
            'timetable_data.days'           => [$requiredOrNot, 'array', 'min:1'],
            'timetable_data.days.*'         => ['string', 'in:segunda,terca,quarta,quinta,sexta,sabado'],
            'timetable_data.slots_per_day'  => [$requiredOrNot, 'integer', 'min:1', 'max:15'],
            'timetable_data.timetable'      => [$requiredOrNot, 'array'],

            // Cada dia dentro de timetable
            'timetable_data.timetable.*'             => ['array'],
            'timetable_data.timetable.*.*.slot'       => ['required', 'integer', 'min:1'],
            'timetable_data.timetable.*.*.subject_id' => ['nullable', 'integer', 'exists:subjects,id'],
            'timetable_data.timetable.*.*.start_time' => ['nullable', 'date_format:H:i'],
            'timetable_data.timetable.*.*.end_time'   => ['nullable', 'date_format:H:i'],
        ];
    }

    public function messages(): array
    {
        return [
            'timetable_data.required'                    => 'A grade de horários é obrigatória.',
            'timetable_data.days.required'               => 'Informe os dias da semana com aula.',
            'timetable_data.days.min'                    => 'Selecione pelo menos um dia da semana.',
            'timetable_data.days.*.in'                   => 'Dia da semana inválido. Use: segunda, terca, quarta, quinta, sexta ou sabado.',
            'timetable_data.slots_per_day.required'      => 'Informe a quantidade de aulas por dia.',
            'timetable_data.slots_per_day.min'           => 'O mínimo é 1 aula por dia.',
            'timetable_data.slots_per_day.max'           => 'O máximo é 15 aulas por dia.',
            'timetable_data.timetable.required'          => 'A grade de aulas é obrigatória.',
            'timetable_data.timetable.*.*.slot.required' => 'O número do horário (slot) é obrigatório.',
            'timetable_data.timetable.*.*.subject_id.exists' => 'A matéria informada não existe.',
            'timetable_data.timetable.*.*.start_time.date_format' => 'O horário de início deve estar no formato HH:MM.',
            'timetable_data.timetable.*.*.end_time.date_format'   => 'O horário de fim deve estar no formato HH:MM.',
        ];
    }
}
