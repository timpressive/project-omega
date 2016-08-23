<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use File;
use Session;

use App\Http\Requests;
use App\Control;
use App\Settings;

class GamesController extends Controller
{
	protected function pincode() {
		if (Control::hasPin()) {
			return redirect('console');
		} else {
			return view('games.pin');
		}
	}

	// Ask for pin code + activate keypad and LCD screen
	protected function keypad(Request $request) {
		if($request->ajax()) {
			if (!Control::hasPin()) {
				$pin = Settings::getByTerm('pin-code');
				$output = shell_exec('sudo python /var/www/project-omega/resources/assets/python/keypad.py '.$pin);
				if ($output) {
					Session::put('pin-code', 1);
				}
				return $output;
			}
		}
	}

	// Get mastermind
	protected function mastermind($level) {
		// Check for access (homepage authentication)
		if (Control::hasAccess()) {
			if (Control::hasPin()) {
				if (Session::has('decrypted-level') && Session::get('decrypted-level') == 3) {
					return redirect('console');
				}
				// check whether the user isn't skipping levels, if so --> restart
				if (!Session::has('decrypted-level') && $level > 1) {
					return redirect('decryptie/level-1');
				} else if (Session::get('decrypted-level') < $level-1) {
					Session::forget('decrypted-level');
					return redirect('decryptie/level-1');
				}

				$redirect = '';
				switch ($level) {
					case 1:
					case 2:
						$redirect = 'decryptie/level-'.($level+1);
						break;
					case 3:
						$redirect = 'console';
						break;
					default:
						return redirect('decryptie/level-3');
						break;
				}

				return view('games.mastermind')->with(['level' => $level, 'redirect' => $redirect]);
			}
			else { return redirect('pin-code'); }
		}
		else { return redirect('/'); }
	}

	// Handle mastermind level up
	protected function decryptlevel(Request $request) {
		$request->session()->put('decrypted-level', $request->input('level'));

		return $request->session()->get('decrypted-level');
	}

	// Get console
	protected function console(Request $request) {
		if (Control::hasAccess()) {
			if (Control::hasPin() || $request->url() == url('netcat')) {
				if (!Session::has('decrypted-level') || Session::get('decrypted-level') < 3) {
					if ($request->url() == url('netcat')) {
						return view('games.console');
					}
					Session::forget('decrypted-level');
					return redirect('decryptie/level-1');
				}
				return view('games.console');
			} else {
				return redirect('pin-code');
			}
		} else {
			return redirect('/');
		}
	}

	// Open files requested through console
	protected function file($file) {
		// if file is found
		if (File::exists(storage_path('app/public/files/'.$file))) {
			$output = File::get(storage_path('app/public/files/'.$file));

			if ($file == 'wachtwoorden.txt') {
				$access = Settings::getByTerm('access-code');
				$pin = Settings::getByTerm('pin-code');
				$console = Settings::getByTerm('console-pass');

				$output = str_replace('<access>', $access, $output);
				$output = str_replace('<pin>', $pin, $output);
				$output = str_replace('<console>', $console, $output);
			} else if ($file == 'memo-9.txt') {
				$memo = Settings::getByTerm('memo');
				$output = str_replace('<memo>', $memo, $output);
			}

			return nl2br(str_replace(' ', '&nbsp;', $output));
		} else {
			return 'error';
		}
	}

	// returns the winning console command
	protected function getcommand(Request $request) {
		if ($request->ajax()) {
			return Settings::getByTerm('console-command');
		} else {
			$request->session->flush();
		}
	}

	// Poll for win/loss
	protected function poll(Request $request) { return Control::poll(); }

	// Handle user win
	protected function win(Request $request) { Control::win(); }
}
