<?php

namespace App\Http\Controllers\Web;
use App\Http\Controllers\Controller;

class BaseController extends Controller
{
    public function __construct() {
        $this->middleware(function ($request, $next) {
            if(\Session::get("CurrentLanguage") != null) {
                \App::setLocale(\Session::get("CurrentLanguage"));
            }
            else {
                \Session::put("CurrentLanguage", "en");
                \App::setLocale("en");
            }
            return $next($request);
        });
    }
}