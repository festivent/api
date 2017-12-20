<?php

namespace App\Repositories;

use App\Models\Event;
use App\Models\User;
use DB;
use Illuminate\Database\Eloquent\Collection;

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

    public static function getUserEvents(User $user)
    {
        $results = DB::select('SELECT * FROM get_user_events(?)', [
            $user->id
        ]);

        $events = new Collection();
        foreach ($results as $result) {
            $event = new Event();
            $event->setRawAttributes((array) $result);

            $events->push($event);
        }

        return $events;
    }
}