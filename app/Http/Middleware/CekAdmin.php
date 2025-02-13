<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CekAdmin
{
  /**
   * Handle an incoming request.
   *
   * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
   */
  public function handle(Request $request, Closure $next): Response
  {
    if (Auth::check()) {
      $user = Auth::user();
      if ($user->level == 0) {
        return $next($request);
      } else {
        return redirect()->back()->with('error', 'Ups, Akses Dilarang !.');
      }
    }

    // Menggunakan with untuk mengalihkan ke halaman login dengan pesan error
    return redirect()->route('auth-login')->with('error', 'Silahkan login dahulu!');
  }
}
