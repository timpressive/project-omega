<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Session;

class Control extends Model
{
    protected function hasAccess() {
    	if (Session::has('access') && Session::get('access') === 1) {
    		return true;
    	} else {
    		return false;
    	}
    }

    protected function hasPin() {
    	if (Session::has('pin-code') && Session::get('pin-code') === 1) {
    		return true;
    	} else {
    		return false;
    	}
    }

    protected function active() { return shell_exec('sudo python /var/www/project-omega/resources/assets/python/controls.py started'); }

    protected function paused() { return shell_exec('sudo python /var/www/project-omega/resources/assets/python/controls.py paused'); }

    protected function penalty() { shell_exec('sudo python /var/www/project-omega/resources/assets/python/controls.py penalty'); }

    protected function pause() { shell_exec('sudo python /var/www/project-omega/resources/assets/python/controls.py pause'); }

    protected function start() {
        $duration = Settings::getByTerm('time');
        shell_exec('sudo python /var/www/project-omega/resources/assets/python/timer.py '.$duration);
    }
    protected function stop() { shell_exec('sudo python /var/www/project-omega/resources/assets/python/controls.py stop'); }

    protected function poll() { return shell_exec('sudo python /var/www/project-omega/resources/assets/python/controls.py poll'); }

    protected function win() { shell_exec('sudo python /var/www/project-omega/resources/assets/python/controls.py win'); }
}
