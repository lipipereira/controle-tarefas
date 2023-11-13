<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class TasksExport implements FromCollection, WithHeadings, WithMapping
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return auth()->user()->tasks()->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Tarefa',
            'Data limite conclusão',
        ];
    }

    public function map($line): array
    {
        return [
            $line->id,
            $line->task,
            date('d/m/Y', strtotime($line->date_limit_completion))
        ];
    }
}
