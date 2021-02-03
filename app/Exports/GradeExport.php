<?php

namespace App\Exports;

use App\Grade;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Facades\DB;

class GradeExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Grade::join('students', 'grades.nim', '=', 'students.nim')
            ->select(
                'grades.nim',
                'students.nama',
                'grades.nilai_pengajuan',
                'grades.nilai_bimbingan',
                'grades.nilai_sidang'
            )
            ->where('students.jurusan','Teknik Informatika')
            ->get();

    }

    public function headings(): array
    {
        return [
            'NIM',
            'NAMA',
            'NILAI PROPOSAL',
            'NILAI BIMBINGAN',
            'NILAI SIDANG',
        ];
    }

    
}
