<?php
namespace App\Util;

use Cake\ORM\TableRegistry;
use Cake\I18n\Time;

use DateTime;


class ModelUtils
{

	public static function generateSubscriptionCode() {
		$length = 6;
    	$randomString = substr(str_shuffle("0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);
    	
    	$subquery = TableRegistry::get('Subscription')->findByCode($randomString);
		$subcount = $subquery->count();
		
		$spoquery1 = TableRegistry::get('Sponsor')->findByCode1($randomString);
		$spoquery2 = TableRegistry::get('Sponsor')->findByCode2($randomString);
		$spocount = $spoquery1->count() + $spoquery2->count();
		
		if ($subcount != 0 || ModelUtils::isSponsorCode($randomString)) {
			return generateSubscriptionCode();
		}
			
    	return $randomString;
    }
    
    public static function generateChestNumber() {
    	return '001';
    }
    
    public static function isSponsorCode($code) {
    	$spoquery1 = TableRegistry::get('Sponsor')->findByCode1($code);
		$spoquery2 = TableRegistry::get('Sponsor')->findByCode2($code);
		$spocount = $spoquery1->count() + $spoquery2->count();
		
		return ($spocount > 0);
    }
    
    public static function parseDate($date, $fromFormat, $toFormat) {
    	return $formatted->format($toFormat);
    }
    
    public static function getYear($date, $format) {
    	$year = null;
    	
    	if ($date instanceof Time) {
    		$year = $date->year;
    	} else {
	    	$formatted = Time::createFromFormat($format, $date);
	    	$year = $formatted->year;
    	}
    	
    	return $year;
    }

}