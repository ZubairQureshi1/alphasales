<?php

class ConstantStrings
{

    const PAGINATION_RANGE = '20';

    public function __construct()
    {
    }

    public static function statuses()
    {
        return $statuses = [
            'Pending', 'Completed', 'Success', 'Deleted', 'Updated', 'Removed', 'Moved to Followups', 'Moved to Admissions', 'Admitted',
        ];
    }
}
