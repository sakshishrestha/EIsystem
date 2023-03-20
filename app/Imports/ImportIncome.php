<?php

namespace App\Imports;

use App\Models\Income;
use Maatwebsite\Excel\Concerns\ToModel;

class ImportIncome implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Income([
                'user_id' => $row[0],
                'salary' => $row[1],
                'date' => $row[2],
        ]);
    }
}
