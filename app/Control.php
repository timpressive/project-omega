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
}
