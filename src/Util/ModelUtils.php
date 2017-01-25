<?php
namespace App\Util;

use Cake\ORM\TableRegistry;
use Cake\I18n\Time;

use Cake\Log\Log;

use App\Model\Entity\Album;


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
    	$formatted = Time::createFromFormat($fromFormat, $date);
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
    
    public static function getStaticAlbum() {
    	LOG::info('Getting static album');
    	$album = new Album();
    	
    	$album->name = 'testname';
    	//$album->path = WWW_ROOT . 'images';
    	$album->path = 'D:\private\projects\crossdorpoelem\albums\start2016';
    	
    	return $album;
    }
    
    public static function loadAlbumFromDisk($album) {
    	LOG::info('Loading album ' . $album->name);
    	$path = $album->path;
    	$album->photos = array_diff(scandir($path), array('..', '.', 'thumb'));  	
    }
    
    public static function loadPhoto($album, $fileName) {
    	$photoFile = $album->path . DS . $fileName;
    	LOG::info('Loading photo ' . $photoFile);
    	
    	if (file_exists($photoFile)) {
    		return file_get_contents($photoFile);
    	}
    	LOG::warning('Photo does not exist');
    	
    	return null;
    }
    
    public static function loadThumbnail($album, $fileName) {
    	$photoFile = $album->path . DS . $fileName;
    	$thumbFile = $album->path . DS . 'thumb' . DS . $fileName;
    	
    	LOG::info('Loading thumbnail ' . $thumbFile);
    	
    	if (!file_exists($thumbFile)) {
    		LOG::debug('Thumbnail does not exist');
    		$thumbnail = ModelUtils::createThumbnail($photoFile, 100, 100);
    		ModelUtils::saveThumbnail($album, $fileName, $thumbnail);
    	}
    	
    	return file_get_contents($thumbFile);
    }
    
    public static function createThumbnail($file, $w, $h, $crop=FALSE) {
    	LOG::info('Creating thumbnail from file ' . $file);
	    list($width, $height) = getimagesize($file);
	    $r = $width / $height;
	    if ($crop) {
	        if ($width > $height) {
	            $width = ceil($width-($width*abs($r-$w/$h)));
	        } else {
	            $height = ceil($height-($height*abs($r-$w/$h)));
	        }
	        $newwidth = $w;
	        $newheight = $h;
	    } else {
	        if ($w/$h > $r) {
	            $newwidth = $h*$r;
	            $newheight = $h;
	        } else {
	            $newheight = $w/$r;
	            $newwidth = $w;
	        }
	    }
	    
	    $dst = imagecreatetruecolor($newwidth, $newheight);
	    $src = null;
	    if (exif_imagetype($file) == IMAGETYPE_JPEG) {
	    	$src = imagecreatefromjpeg($file);
	    	imagecopyresampled($dst, $src, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
	    	imagejpeg($dst);
	    } else if (exif_imagetype($file) == IMAGETYPE_GIF) {
	    	$src = imagecreatefromgif($file);
	    	imagecopyresampled($dst, $src, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
	    	imagegif($dst);
	    } else if (exif_imagetype($file) == IMAGETYPE_PNG) {
	    	$src = imagecreatefrompng($file);
	    	imagecopyresampled($dst, $src, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
	    	imagepng($dst);
	    }
	
	    return $dst;	
    }
    
    public static function saveThumbnail($album, $fileName, $content) {
    	$photoFile = $album->path . DS . $fileName;
    	$thumbFile = $album->path . DS . 'thumb' . DS . $fileName;
    	
    	ModelUtils::makeDir($album->path . DS . 'thumb');
    	
    	LOG::info('Saving thumbnail ' . $thumbFile);
    	
    	if (exif_imagetype($photoFile) == IMAGETYPE_JPEG) {
    		LOG::debug('Saving as JPEG');
    		imagejpeg($content, $thumbFile);
    	} else if (exif_imagetype($photoFile) == IMAGETYPE_GIF) {
    		LOG::debug('Saving as GIF');
    		imagegif($content, $thumbFile);
    	} else if (exif_imagetype($photoFile) == IMAGETYPE_PNG) {
    		LOG::debug('Saving as PNG');
    		imagepng($content, $thumbFile);
    	}
    }
    
    public static function makeDir($path)
    {
    	return is_dir($path) || mkdir($path);
    }

}