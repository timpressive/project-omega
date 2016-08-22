<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;

use App\Http\Requests;
use App\Settings;
use App\Control;

class AdminController extends Controller
{
	// fire up the dashboard
	protected function index() {
		return view('admin.dashboard')->with(['settings' => $settings]);
	}

	protected function game() {
		$started = Control::active();
		$paused = Control::paused();

		return view('admin.controls')->with(['started' => $started, 'paused' => $paused]);
	}

	protected function settings() {
		$settings = [
			'access-code' => Settings::getByTerm('access-code'),
			'pin-code' => Settings::getByTerm('pin-code'),
			'console-pass' => Settings::getByTerm('console-pass'),
			'console-command' => Settings::getByTerm('console-command'),
			'memo' => Settings::getByTerm('memo'),
			'hours' => Settings::getHours(),
			'minutes' => Settings::getMinutes(),
			'seconds' => Settings::getSeconds(),
		];
		return view('admin.settings')->with(['settings' => $settings]);
	}

	protected function instructions() { return view('admin.instructions'); }

	protected function setcodes(Request $request) {
		$this->validate($request, [
			'pin-code' => 'required|digits:4',
			'access-code' => 'required|min:4',
		]);
		if ($request->input('pin-code') !== NULL) {
			Settings::change('pin-code', $request->input('pin-code'));
		}
		if ($request->input('access-code') !== NULL) {
			Settings::change('access-code', $request->input('access-code'));
		}

		Session::flash('flash_message', 'Codes gewijzigd!');
		return redirect()->back();
	}

	protected function setduration(Request $request) {
		$this->validate($request, [
			'hours' => 'required|min:0|max:5|digits:1',
			'minutes' => 'required|min:0|max:59|digits:2',
			'seconds' => 'required|min:0|max:59|digits:2'
		]);

		$input = $request->all();

		// Set duration to milliseconds
		$duration = $input['hours']*3600 + $input['minutes']*60 + $input['seconds'];

		Settings::change('time', $duration);

		Session::flash('flash_message', 'Spelduur gewijzigd!');
		return redirect()->back();
	}

	protected function setconsole(Request $request) {
		$this->validate($request, [
			'console-pass' => 'required|min:4',
			'console-command' => 'required|min:2',
			'memo' => 'required'
		]);

		if ($request->input('console-pass') !== NULL) {
 			Settings::change('console-pass', $request->input('console-pass'));
		}
		if ($request->input('console-command') !== NULL) {
			Settings::change('console-command', $request->input('console-command'));
		}
		if ($request->input('memo') !== NULL) {
			Settings::change('memo', $request->input('memo'));
		}

		Session::flash('flash_message', 'Console instellingen gewijzigd!');
		return redirect()->back();
	}

	protected function resetconsole(Request $request) {
		Settings::change('console-pass', Settings::getByTerm('console-pass-default'));
		Settings::change('console-command', Settings::getByTerm('console-command-default'));
		Settings::change('memo', Settings::getByTerm('memo-default'));

		Session::flash('flash_message', 'Standaard console-instellingen hersteld!');
		return redirect()->back();
	}

	// TIMER CONTROLS
	protected function startgame(Request $request) {
		if ($request->ajax()) {
            Control::start();
		}
	}
	protected function stopgame(Request $request) {
		if ($request->ajax()) {
			Control::stop();
		}
	}
	protected function pausegame(Request $request) {
		if ($request->ajax()) {
        	Control::pause();
		}
	}
    protected function penalty(Request $request) {
		if ($request->ajax()) {
			Control::penalty();
		}
	}
	protected function started(Request $request) {
		if ($request->ajax()) {
			return Control::active();
		}
	}
	protected function paused(Request $request) {
		if ($request->ajax()) {
			return Control::paused();
		}
	}
}
