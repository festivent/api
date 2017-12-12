<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\Event\SearchRequest;
use App\Http\Requests\API\Event\StoreRequest;
use App\Http\Requests\API\Event\UpdateRequest;
use App\Http\Resources\EventResource;
use App\Http\Resources\EventsCollection;
use App\Models\Event;
use App\Repositories\EventRepository;
use Auth;
use Illuminate\Http\UploadedFile;
use Storage;

/**
 * @resource Event
 *
 * The event routes.
 */
class EventController extends Controller
{
    /**
     * Search
     *
     * Search in available events.
     *
     * @param SearchRequest $request
     * @return EventsCollection
     */
    public function search(SearchRequest $request)
    {
        $query = $request->get('query');
        $events = EventRepository::querySearch($query)
            ->paginate()->appends([
                'query' => $request->get('query')
            ]);

        return new EventsCollection($events);
    }

    /**
     * Store
     *
     * Store a new event by given attributes.
     *
     * @param StoreRequest $request
     * @return EventResource
     */
    public function store(StoreRequest $request)
    {
        $attributes = $request->validated();
        if ($image = $request->file('image')) {
            $attributes['image'] = $this->storeImage($image);
        }

        /** @var Event $event */
        $event = Auth::user()->events()->create($attributes);

        return $this->show($event);
    }

    /**
     * Show
     *
     * Show the given event.
     *
     * @param Event $event
     * @return EventResource
     */
    public function show(Event $event)
    {
        return new EventResource($event);
    }

    /**
     * Update
     *
     * Update the given event.
     *
     * @param Event $event
     * @param UpdateRequest $request
     * @return EventResource
     */
    public function update(Event $event, UpdateRequest $request)
    {
        $attributes = $request->validated();
        if ($image = $request->file('image')) {
            $attributes['image'] = $this->storeImage($image);
        }

        $event->update(
            $attributes
        );

        return $this->show($event);
    }

    /**
     * Delete
     *
     * Delete the given event.
     *
     * @param Event $event
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy(Event $event)
    {
        $event->delete();

        return response()->json();
    }

    /**
     * Store the given image.
     *
     * @param UploadedFile $file
     * @return false|string
     */
    private function storeImage(UploadedFile $file)
    {
        return Storage::disk('public')->putFile('images', $file);
    }
}
