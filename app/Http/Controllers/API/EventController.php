<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\Event\SearchRequest;
use App\Http\Requests\API\Event\StoreRequest;
use App\Http\Requests\API\Event\UpdateRequest;
use App\Http\Resources\EventResource;
use App\Models\Event;
use App\Repositories\EventRepository;
use Auth;
use Carbon\Carbon;
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
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function search(SearchRequest $request)
    {
        $query = $request->get('query');
        $events = EventRepository::querySearch($query)->get();
//            ->paginate()->appends([
//                'query' => $request->get('query')
//            ]);

        return EventResource::collection($events);
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

        $attributes['started_at'] = Carbon::createFromTimestamp(
            strtotime($attributes['started_at'])
        );

        if (isset($attributes['ended_at']) AND $attributes['ended_at']) {
            $attributes['ended_at'] = Carbon::createFromTimestamp(
                strtotime($attributes['ended_at'])
            );
        }

        /** @var Event $event */
        $event = Auth::user()->events()->create($attributes);
        $event->categories()->sync(
            $request->get('category_ids') ?: []
        );

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

        $event->categories()->sync(
            $request->get('category_ids') ?: []
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
