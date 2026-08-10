<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BackToForm
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if ($user && $user->submitted_at !== null) {
            return redirect()->route('uhs-form-dashboard');
        }

        return $next($request);
    }
}
