<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class HeadFine extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    public $table = 'head_fines';

    protected $dates = ['deleted_at'];

    public $fillable = [
        'name',
        'amount',
        'vendor_share_amount',

    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'string',

        'amount' => 'integer',
        'vendor_share_amount' => 'string',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required',
    ];

    public function headFineStudent()
    {
        return $this->hasMany('App\Models\HeadFineStudent', 'head_id');
    }

    // ------------------------ Accessors for text fields which capitalize first letter ----------------------

    public function getNameAttribute($value)
    {
        if ($value == null) {
            return '---';
        } else {

            return ucwords($value);
        }
    }

}
