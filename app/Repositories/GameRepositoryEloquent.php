<?php

namespace App\Repositories;

use App\Model\Game;
use App\Validators\GameValidator;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Eloquent\BaseRepository;

/**
 * Class GameRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class GameRepositoryEloquent extends BaseRepository implements GameRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Game::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function getTopUpComingGame(int $number)
    {
        return $this->scopeQuery(function ($query) use ($number) {
            return $query->where('first_release_date', '>', now())
                ->whereNotNull('first_release_date')
                ->orderBy('popularity', 'DESC')
                ->limit($number);
        })->all();
    }

    public function getGameBySlug($slug)
    {
        return $this->scopeQuery(function ($query) use ($slug) {
            return $query
                ->with([
                    'platform.platform',
                    'developed' => function ($query) {
                        $query->where('developer', 1);
                    },
                    'publisher_game' => function ($query) {
                        $query->where('publisher', 1);
                    },
                    'developed.company',
                    'publisher_game.company'
                ])
                ->where('slug', $slug);
        })->first();
    }
}
