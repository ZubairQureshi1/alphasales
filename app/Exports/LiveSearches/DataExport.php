<?php

namespace App\Exports\LiveSearches;

use Globals;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class DataExport implements FromQuery, WithHeadings, ShouldAutoSize, WithMapping
{
    /**
     * @return \Illuminate\Support\Collection
     */
    use Exportable;

    public $query;
    public $table_name;

    public function __construct($array)
    {
        $this->query = $array['query'];
        $this->table_name = $array['table_name'];
    }

    public function headings(): array
    {
        // $first_diff = array_diff(array_keys($this->query->get()->first()->toArray()), Globals::getTableColumnsForExportWithoutTableName($this->table_name));
        // dd(Globals::getFormattedTableColumnsNamesForExport($this->table_name, array_diff(array_keys($this->query->get()->first()->toArray()), $first_diff)));
        // return Globals::getFormattedTableColumnsNamesForExport($this->table_name, array_diff(array_keys($this->query->get()->first()->toArray()), $first_diff));
        // dd(Globals::getFormattedTableColumnsForExport($this->table_name));
        return Globals::getFormattedTableColumnsForExport($this->table_name);
    }

    public function query()
    {
        // $first_diff = array_diff(array_keys($this->query->get()->first()->toArray()), Globals::getTableColumnsForExportWithoutTableName($this->table_name)); 
        // return $this->query->select(Globals::getFormattedTableColumnsNamesForExport($this->table_name, array_diff(array_keys($this->query->get()->first()->toArray()), $first_diff) , 'data'));
        return $this->query->select(Globals::getTableColumnsForExport($this->table_name));
        /*->distinct('id')*/
    }

    public function map($data): array
    {
        // dd();
        // dd(Globals::getTableColumnsForExportWithoutTableName($this->table_name));
        $first_diff = array_diff(array_keys($data->toArray()), Globals::getTableColumnsForExportWithoutTableName($this->table_name));
        // dd($first_diff);
        // dd(array_diff(array_keys($data->toArray()), $first_diff));
        // dd($data->only(array_diff(array_keys($data->toArray()), $first_diff)));
        return $data->only(array_diff(array_keys($data->toArray()), $first_diff));
        // return $data->only(Globals::getTableColumnsForExport($this->table_name))->toArray();
    }

}
