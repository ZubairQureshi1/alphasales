<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class AdmissionByEnquiryForm extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    public $table = 'admission_by_enquiry_forms';

    protected $dates = ['deleted_at'];

    protected $appends = ['enquiry_data'];

    public $fillable = [
        'enquiry_id', 'is_admitted',
    ];

    protected $casts = [
    ];
    public static $rules = [
    ];

    public function getEnquiryDataAttribute()
    {
        $value = Enquiry::withTrashed()->find($this->enquiry_id);
        return $value;
    }

    public function enquiry()
    {
        return $this->belongsTo('App\Models\Enquiry');
    }
}
