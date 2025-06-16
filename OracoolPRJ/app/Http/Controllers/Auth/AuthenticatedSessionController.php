<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\JsonResponse;


class AuthenticatedSessionController extends Controller
{
    /** Displays login view */
    public function create(): View
    {
        return view('auth');
    }

    /** Handles user authentication */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        $user = Auth::user();
        $user->admin=false;
        $user->save();

        return redirect()->intended(route('userProfile.index', absolute: false))->with('success', __('error.logged'));
    }

    /** Handles admin authentication */
    public function storeAdmin(LoginRequest $request): RedirectResponse
    {
        $request->authenticateAdmin();

        $request->session()->regenerate();
        
        $user = Auth::user();
        $user->admin=true;
        $user->save();

        return redirect()->intended(route('controlPanel.index', absolute: false))->with('success', __('error.logged'));
    }

    /** Logs out user */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/')->with('success', __('error.logged-out'));
    }

    /** Checks if email exists */
    public function checkEmail(Request $request): JsonResponse
    {
        $email = $request->input('email');

        $user = DB::table('users')->where('email', $email)->first();
        if ($user) {
            return response()->json(['exists' => true]);
        } else {
            return response()->json(['exists' => false]);
        }
    }
}
