<?php

namespace App\Http\Middleware;

use App\Models\Address;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckOwner
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function authorize()
    {
        return true;
    }
    public function handle($request, Closure $next)
    {
        $user = Auth::user();
        $address = Address::find($request->id);

        if ($address && $address->user_id != $user->id) {
            return response()->json([
                'status' => false,
                'message' => 'Unauthorized'
            ], 403);
        }

        return $next($request);
    }
}
