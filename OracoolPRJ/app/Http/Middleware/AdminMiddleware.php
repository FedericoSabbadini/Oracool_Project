<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Log; // Import Log facade for logging

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
                // If the user is authenticated, proceed to check their role
                $user = Auth::user();
                \Log::info('AdminMiddleware: Checking user', ['user_id' => $user->id, 'email' => $user->email]);

                // Check if the user is an admin
                if ($user->admin) {
                    \Log::info('AdminMiddleware: User is admin, allowing access', ['user_id' => $user->id]);
                    // Allow access to the next middleware or controller
                    return $next($request);
                } else {
                    \Log::warning('AdminMiddleware: Access denied - user is not admin', ['user_id' => $user->id]);
                    // Redirect to login if the user is not an admin
                    return redirect()->to(url()->previous())->with('error', __('error.admin_required'));
                }
        } else {
            // If the user is not authenticated, redirect to login
            return redirect()->route('login.create')->with('error', __('error.login_required'));
        }

    }
}
