<?php

namespace App\Repositories;

use App\Models\Address;

class AddressRepository
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
        $query = Address::query();

        // Search name
        $query->orWhere('name', 'ILIKE', $likeQuery);

        return $query;
    }
}