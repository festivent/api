<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\County
 *
 * @property int $id
 * @property int $province_id
 * @property string $name
 * @property-read \App\Models\Province $province
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\County whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\County whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\County whereProvinceId($value)
 * @mixin \Eloquent
 */
class County extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'province_id', 'name'
    ];

    /**
     * @var array
     */
    protected $hidden = [
        'province_id'
    ];

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * Country province.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function province()
    {
        return $this->belongsTo(Province::class, 'province_id', 'id');
    }
}
