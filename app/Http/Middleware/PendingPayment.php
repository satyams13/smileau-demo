<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

use Auth;

class PendingPayment
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $user   = Auth::user();
        $action = $request->route()->getName();
        if ($user && !$user->stripe_id && !in_array($action, ['payment-index', 'payment-charge'])) {
            return redirect('/payment');
        }

        return $next($request);
    }
}
