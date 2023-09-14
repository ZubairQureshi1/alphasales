<?php

namespace App\Imports\Exams;

use App\DateSheetStudent;
use Maatwebsite\Excel\Concerns\ToModel;

class ResultImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new DateSheetStudent([
            //
        ]);
    }
}
