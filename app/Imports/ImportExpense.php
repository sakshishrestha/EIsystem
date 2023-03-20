<?php

namespace App\Imports;

use App\Models\Expense;
use Maatwebsite\Excel\Concerns\ToModel;

class ImportExpense implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        // $username = Expense::get()->all();
        // dd($username);
        return new Expense([
            'user_id' => $row[0],
            'items' => $row[1],
            'price' => $row[2],
            'date' => $row[3],
        ]);
    }
}
