<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class CourseAffiliatedBody extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    public function affiliatedBody()
    {
        return $this->belongsTo(AffiliatedBody::class, 'affiliated_body_id', 'id');
    }
    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id', 'id');
    }
}
