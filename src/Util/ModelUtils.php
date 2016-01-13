<?php
namespace App\Util;

use Cake\ORM\TableRegistry;


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
		
		if ($subcount != 0 || $spocount != 0) {
			return generateSubscriptionCode();
		}
			
    	return $randomString;
    }
    
    public static function generateChestNumber() {
    	return '001';
    }

}