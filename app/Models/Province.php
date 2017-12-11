<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Province
 *
 * @property int $id
 * @property string $name
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\County[] $counties
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $users
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Province whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Province whereName($value)
 * @mixin \Eloquent
 */
class Province extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'name'
    ];

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * Province counties.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function counties()
    {
        return $this->hasMany(County::class, 'province_id', 'id');
    }

    /**
     * Province users.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany(
            User::class,
            'user_provinces',
            'province_id',
            'user_id',
            'id'
        );
    }
}
