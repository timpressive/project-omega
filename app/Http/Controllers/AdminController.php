<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Settings;

class AdminController extends Controller
{
    // fire up the dashboard
    protected function index() {
        $settings = Settings::get();
    	return view('admin.dashboard')->with(['settings' => $settings]);
    }

    protected function game() {
        return view('admin.controls');
    }

    protected function settings() {
        $settings = [
            'access-code' => Settings::getByTerm('access-code'),
            'pin-code' => Settings::getByTerm('pin-code'),
            'hours' => Settings::getHours(),
            'minutes' => Settings::getMinutes(),
            'seconds' => Settings::getSeconds(),
        ];
        return view('admin.settings')->with(['settings' => $settings]);
    }

    protected function instructions() {
    	return view('admin.instructions');
    }

    protected function setcodes(Request $request) {
    	if ($request->input('pin-code') !== NULL) {
            Settings::change('pin-code', $request->input('pin-code'));
        }
        if ($request->input('access-code') !== NULL) {
            Settings::change('access-code', $request->input('access-code'));
        }

        return redirect()->back();
    }

    protected function setduration(Request $request) {
        $this->validate($request, [
            'hours' => 'required|min:0|max:3',
            'minutes' => 'required|min:0|max:59',
            'seconds' => 'required|min:0|max:59'
        ]);

        $input = $request->all();

        // Set duration to milliseconds
        $duration = $input['hours']*3600 + $input['minutes']*60 + $input['seconds'];

        Settings::change('time', $duration);

        return redirect()->back();
    }

    protected function startcountdown() {
        $duration = Settings::getByTerm('time');
        exec('sudo python /var/www/project-omega/resources/assets/python/timer.py '.$duration, $out);

        return $out;
    }
}
