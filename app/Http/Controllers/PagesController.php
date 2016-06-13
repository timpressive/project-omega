<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Control;

class PagesController extends Controller
{
    // authentication screen
    protected function index() {
        if (Control::hasAccess()) {
            return redirect('overzicht');
        }
    	return view('home');
    }

    // user overview screen
    protected function overview(Request $request) {
        if (Control::hasAccess()) {
    	   return view('pages.overview');
        } else {
            return redirect('/');
        }
    }
}
