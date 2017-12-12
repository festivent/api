<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Event
 *
 * @property int $id
 * @property string $title
 * @property string|null $description
 * @property string|null $image
 * @property \Carbon\Carbon $started_at
 * @property \Carbon\Carbon|null $ended_at
 * @property float|null $price
 * @property string $price_type
 * @property int|null $capacity
 * @property int|null $age_limit
 * @property int|null $user_id
 * @property int|null $organizer_id
 * @property int $address_id
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read string key
 * @property-read \App\Models\Address $address
 * @property-read \App\Models\Organizer|null $organizer
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Event whereAddressId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Event whereAgeLimit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Event whereCapacity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Event whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Event whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Event whereEndedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Event whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Event whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Event whereOrganizerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Event wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Event wherePriceType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Event whereStartedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Event whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Event whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Event whereUserId($value)
 * @mixin \Eloquent
 */
class Event extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'title', 'description', 'image', 'started_at', 'ended_at', 'price', 'price_type', 'capacity', 'age_limit',
        'user_id', 'organizer_id', 'address_id'
    ];

    /**
     * @var array
     */
    protected $hidden = [
        'key', 'user_id', 'organizer_id', 'address_id'
    ];

    /**
     * @var array
     */
    protected $dates = [
        'started_at', 'ended_at'
    ];

    /**
     * Event user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * Event organizer.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function organizer()
    {
        return $this->belongsTo(Organizer::class, 'organizer_id', 'id');
    }

    /**
     * Event address.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function address()
    {
        return $this->belongsTo(Address::class, 'address_id', 'id');
    }

    /**
     * Load the show relations.
     *
     * @return $this
     */
    public function loadShow()
    {
        return $this->load([
            'organizer', 'address', 'address.province', 'address.county'
        ]);
    }
}
