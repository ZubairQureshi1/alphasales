<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class DateSheetSection extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    protected $appends = ['section_name'];
    public $fillable = [
        'section_id', 'date_sheet_id',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'section_id' => 'integer',
        'date_sheet_id' => 'integer',
    ];
    public function getSectionNameAttribute()
    {
        $section = Section::find($this->section_id);
        return $section->name;
    }
}
