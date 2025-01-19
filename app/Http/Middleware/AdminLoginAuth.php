<?php

namespace App\Http\Middleware;

use App\Models\User_admin;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class AdminLoginAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $id_ = session('id_a');

        try {
            if ($id_) {
                $user = User_admin::where('email', session('email_a'))->first();
                if ($user && Hash::check(session('password_a'), $user->password)) {
                    return $next($request);
                } else {
                    return redirect('/login_admin')->with([
                        'error' => 'Invalid credentials',
                        'old_email' => session('email')
                    ]);
                }
            }
        } catch (\Exception $e) {
            return redirect('/login_admin')->with([
                'error' => 'Invalid credentials',
                'old_email' => session('email')
            ]);
        }

        return redirect('/login_admin');
    }
}
