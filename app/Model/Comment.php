<?php

namespace App\Model;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Comment.
 *
 * @package namespace App\Model;
 */
class Comment extends Model implements Transformable
{
    use TransformableTrait;

    const BLOG = 1;
    const REVIEW = 2;
    const GAME = 3;

    const BEST = 1;
    const LATEST = 2;
    const OLDEST = 3;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'type', 'user_id', 'core_id', 'content', 'like', 'parent_id'
    ];


    public function reply()
    {
        return $this->hasMany(Comment::class, 'parent_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public static function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->diffForHumans();
    }

}
