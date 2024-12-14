<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $phone = $request->phone;
        $user = User::where('phone', $phone)->first();

        if ($user->user_type === 'provider') {

            if ($user->status === 'غير نشط') {
                return redirect()->route('payment'); // قم بتوجيه المستخدم إلى صفحة الدفع
            }
        }

        return $next($request);
    }
}
