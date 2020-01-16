<?php

namespace App\Http\Controllers;

use App\Repositories\AssociationRepository;
use App\Repositories\BlogRepository;
use App\Repositories\CommentRepository;
use App\Repositories\GameRepository;
use App\Repositories\ReviewRepository;
use App\Traits\GameApi;
use App\Traits\GameSpotApi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class GamingController extends Controller
{
    use GameApi, GameSpotApi;

    private $blogRepository;
    private $gameRepository;
    private $reviewRepository;
    private $associationRepository;
    private $commentRepository;

    public function __construct(
        BlogRepository $blogRepository,
        GameRepository $gameRepository,
        ReviewRepository $reviewRepository,
        AssociationRepository $associationRepository,
        CommentRepository $commentRepository)
    {
        $this->blogRepository = $blogRepository;
        $this->gameRepository = $gameRepository;
        $this->reviewRepository = $reviewRepository;
        $this->associationRepository = $associationRepository;
        $this->commentRepository = $commentRepository;
    }

    public function test()
    {
        $review = $this->getBlog(1);
        //$game = $this->getGame(1);
        dd($review);
    }

    public function home()
    {
        $upComingGames = $this->gameRepository->getTopUpComingGame(config('constant.limit_upcoming_game'));

        $topReviews = $this->reviewRepository->getTopReview(config('constant.limit_top_review'));

        $blogs = $this->blogRepository->getBlogSearch();

        $topBlog = $this->blogRepository->getTopBlog();

        $topComment = $this->commentRepository->getTopComment();

        $recentBlog = $this->blogRepository->getRecentBlog();

        return view('home')->with([
            'topBlog' => $topBlog,
            'blogs' => $blogs,
            'upcomingGames' => $upComingGames,
            'topReviews' => $topReviews,
            'topComment' => $topComment,
            'recentBlog' => $recentBlog
        ]);
    }

    public function switchTheme(Request $request)
    {
        Cookie::queue('theme', $request->input('theme'), 525600);
        return [
            'status' => 'ok'
        ];
    }

    public function gameDetail($slug)
    {
        $game = $this->gameRepository->getGameBySlug($slug);
        if (empty($game)) {
            return abort(404);
        }
        $blogs = $this->blogRepository->getBlogSearch([
            'game_id' => $game->game_id
        ]);
        //dd($game);
        return view('game.detail')->with([
            'game' => $game,
            'blogs' => $blogs,
        ]);
    }
}
