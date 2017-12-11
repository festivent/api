<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Organizer
 *
 * @property int $id
 * @property string $name
 * @property string|null $telephone
 * @property string|null $email
 * @property int|null $user_id
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Event[] $events
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Organizer whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Organizer whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Organizer whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Organizer whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Organizer whereTelephone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Organizer whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Organizer whereUserId($value)
 * @mixin \Eloquent
 */
class Organizer extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'name', 'telephone', 'email', 'user_id'
    ];

    /**
     * Organizer user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * Organizer events.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function events()
    {
        return $this->hasMany(Event::class, 'organizer_id', 'id');
    }
}
