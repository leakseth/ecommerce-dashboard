<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
   public function home() {
    return view('frontends.home');
    }

    public function shop() {
        return view('frontends.shop');
    }

    public function about() {
        return view('frontends.about');
    }

    public function contact() {
        return view('frontends.contact');
    }

}
