<?php

namespace App\Http\Middleware;

use App\Api\Domain\Board\Services\BoardService;
use App\Api\UI\Thread\Repository\ThreadRepository;
use Closure;
use Illuminate\Http\Request;

class CheckBan
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $repository=app()->make(ThreadRepository::class);
        $board_service=app()->make(BoardService::class);
        $board=$board_service->get($request->route('alias'));
        $iscan=$repository->isCan($board);
        if($iscan==false) return response("Вы забанены");


        return $next($request);
    }
}
