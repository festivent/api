<?php

namespace App\Repositories;

use App\Models\Event;

class EventRepository
{
    /**
     * Search query.
     *
     * @param $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public static function querySearch($query)
    {
        $likeQuery = "%{$query}%";
        $query = Event::query();

        // Search title
        $query->orWhere('title', 'ILIKE', $likeQuery);
        $query->orderBy('started_at', 'DESC');

        return $query;
    }
}