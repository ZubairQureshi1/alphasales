<?php

namespace App\Imports;

use App\Result;
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
        return new Result([
            //
        ]);
    }
}