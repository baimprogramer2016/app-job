<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Route;
use App\Models\RoleAksesModel;
use Illuminate\Support\Facades\Auth;

class isCheckMenu
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $urlCurrent =   Route::current()->getPrefix() . '/' . Route::current()->getName();
        $pregmacth = "/proses-/i";
        $checkdata  =   RoleAksesModel::where([
            ["koderole", Auth::user()->koderole],
            ["kodeakses", $urlCurrent]
        ])
            ->get()->count();
        if ($checkdata > 0 || Auth::user()->koderole == 'admin') {
            return $next($request);
        } elseif (preg_match($pregmacth, $urlCurrent)) {
            return $next($request);
        }

        return redirect()->route('forbidden')->with('message', "Anda tidak memiliki akses ke - " . $urlCurrent);
    }
}
