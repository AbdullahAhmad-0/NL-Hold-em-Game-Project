<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class UserLoginAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $id_ = session('id');

        if ($id_) {
            $user = User::where('id', session('id'))->first();

            if ($user && Hash::check(session('password'), $user->password)) {
                return $next($request);
            } else {
                return redirect('/game/sign-in')->with([
                    'error' => 'Invalid credentials',
                    'old_email' => session('email')
                ]);
            }
        }

        return redirect('/game/sign-in');
    }
}
