<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Models\Product;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        // $request->authenticate();

        // $request->session()->regenerate();

        // return redirect('dashboard');

            $input = $request->all();
            $product = Product::all();
    
            if (auth()->attempt(array('email' => $input['email'], 'password' => $input['password']))) {
                if (auth()->user()->is_admin == 1) {
                    return redirect()->route('adminHome');
                } else {
                    $product = Product::all();
                    return redirect()->route('dashboard',['products'=> $product]);
                }
            } else {
                return redirect()->route('auth.login')->with('error', 'email or Password wrong');
            }
        
    }



    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
