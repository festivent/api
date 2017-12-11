<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\Address\SearchRequest;
use App\Http\Requests\API\Address\StoreRequest;
use App\Http\Resources\AddressResource;
use App\Models\Address;
use App\Repositories\AddressRepository;

/**
 * @resource Address
 *
 * The address routes.
 */
class AddressController extends Controller
{
    /**
     * Search
     *
     * Search in available addresses.
     *
     * @param SearchRequest $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function search(SearchRequest $request)
    {
        $query = $request->get('query');
        $addresses = AddressRepository::querySearch($query)
            ->with(['province', 'county'])
            ->paginate()->appends([
                'query' => $request->get('query')
            ]);

        return AddressResource::collection($addresses);
    }

    /**
     * Store
     *
     * Store the given address.
     *
     * @param StoreRequest $request
     * @return AddressResource
     */
    public function store(StoreRequest $request)
    {
        $address = Address::create(
            $request->validated()
        );

        return new AddressResource($address);
    }
}
