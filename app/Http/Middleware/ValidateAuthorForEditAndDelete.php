<?php

namespace App\Http\Middleware;

use Closure;
use App\Post;

class ValidateAuthorForEditAndDelete
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(is_object($request->post)) {
            $post = $request->post;
        } elseif(is_numeric($request->post)){
            $post = Post::onlyTrashed()->findOrFail($request->post);
        }
        else {
            return redirect(abort(401));
        }
        if(!$post->user_id == auth()->id()) {
            return redirect(abort(401));
        }
        return $next($request);
    }
}
