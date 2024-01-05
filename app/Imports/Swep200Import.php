<?php

namespace App\Imports;

use App\Swep200;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class Swep200Import implements ToModel, WithHeadingRow, ToCollection
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Swep200([
            'matric_number' => $row['matric_number'],
            'itcu_score' => $row['itcu_score'],
            'dept_score' => $row['dept_score'],
        ]);
    }

    public function collection(Collection $rows)
    {
        foreach ($rows as $row) 
        {
            Swep200::where([
                'matric_number' => $row[0],
            ]);
        }
    }
}
