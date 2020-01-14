<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Association.
 *
 * @package namespace App\Model;
 */
class Association extends Model implements Transformable
{
    const GAMES = 1;
    const EVENTS = 2;
    const PLATFORMS = 3;

    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $timestamps = false;
    protected $fillable = [];

}
