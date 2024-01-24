<?php

namespace App\Http\Middleware;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

use Closure;

class ValidateUrl{
     //Function that checks that the URL exists. If not, redirects the page and return a message.
     public function handle(Request $request, Closure $next): Response
     {
         $url = $request->input('img_url');
         if(!filter_var($url, FILTER_VALIDATE_URL)){
             return redirect('/')->with('error','Invalid URL, please insert a valid one.');
         }
         return $next($request);
     }
}
