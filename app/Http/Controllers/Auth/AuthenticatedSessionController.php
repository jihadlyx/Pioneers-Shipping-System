<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('site.auth.Login.login');
//        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $authenticated = $request->authenticate();
        if ($authenticated) {
            $request->session()->regenerate();
            // Redirect to the intended page on successful login
            return redirect()->route('dashboard.index', ['page_id' => 9]);
        }

        // Redirect back to the login page with an error message on failed login
        return redirect()->route('login')->with([
            "message" => [
                "type" => "error",
                "title" => "يرجى التأكد من بريدك الإلكتروني وكلمة السر",
                "text" => ""
            ]
        ]);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('dashboard.index', ["page_id" => 9]);
    }
}
