<?php

namespace App\Http\Controllers\FrontOffice;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class StaticController extends Controller
{
    public function about()
    {
        return view('frontoffice.about');
    }

    public function cookies()
    {
        return view('frontoffice.cookies');
    }

    public function cgu()
    {
        return view('frontoffice.cgu');
    }

    public function faq()
    {
        return view('frontoffice.faq');
    }

    public function pricing()
    {
        return view('frontoffice.pricing');
    }
}
