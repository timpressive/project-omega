<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Settings extends Model
{
    protected $table = 'settings';
	public $timestamps = FALSE;

    protected $fillable = [
    	'term',
    	'value'
    ];

    protected function change($term, $value) {
    	DB::table(Model::getTable())
    		->where('term', $term)
    		->update(['value' => $value]);
    }

    // protected function default() {
    //  DB::table($table)
    //      ->where('term')
    //      ->update(['value', $value]);
    // }

    protected function getByTerm($term) {
        return self::where('term', '=', $term)->firstOrFail()->value;
    }

    protected function getHours() {
        $duration = $this->getByTerm('time');

        $hours = floor($duration/3600000);
        return $hours;
    }

    protected function getMinutes() {
        $duration = $this->getByTerm('time');

        $hours = floor($duration/3600000);
        $minutes = floor(($duration - $hours*3600000) / 60000);
        return $minutes;
    }

    protected function getSeconds() {
        $duration = $this->getByTerm('time');

        $hours = floor($duration/3600000);
        $minutes = floor(($duration - $hours*3600000) / 60000);
        $seconds = floor(($duration - $hours*3600000 - $minutes*60000) / 1000);
        return $seconds;
    }

    protected function validateCode($code) {
        if ($code == $this->getByTerm('access-code')) {
            return true;
        } else {
            return false;
        }
    }

}
