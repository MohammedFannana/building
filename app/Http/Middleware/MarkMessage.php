<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MarkMessage
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // This middleware is apply in kernel
        $message_id = $request->query('notification_id');
        if ($message_id) {
            $user = $request->user();
            if ($user) {
                $message =  $user->unreadNotifications()->find($message_id);
                if ($message) {
                    $message->markAsRead();
                }
            }
        }
        return $next($request);
    }
}
