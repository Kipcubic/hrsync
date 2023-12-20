<?php

namespace App\Traits;

trait StatusTrait
{
    public static function getStatuses(): array
    {
        return [
            0 => 'Pending',
            1 => 'Approved',
            2 =>'Withdrawn',
            3 => 'Rejected',
            // Add more statuses as needed
        ];
    }

    public function getStatusStringAttribute(): string
    {
        $statuses = self::getStatuses();

        return $statuses[$this->attributes['status']] ?? 'Unknown';
    }
}




