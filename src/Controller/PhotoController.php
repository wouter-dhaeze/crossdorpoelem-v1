<?php
namespace App\Controller;

use App\Controller\AppController;

use App\Util\ModelUtils;

/**
 * Photo Controller
 *
 */
class PhotoController extends AppController
{

	public function initialize()
	{
		parent::initialize();
		//$this->loadComponent('RequestHandler');
	}
    
	/**
	 * View method
	 *
	 * @return void
	 */
	public function view($id = null)
	{
		$fileName = $this->getRequestParameterAsString('file');
		$isThumbnail = $this->getRequestParameterAsBoolean('thumb');
		
		$album = ModelUtils::getStaticAlbum();
		
		$body = $this->getPhotoOrThumbnail($album, $fileName, $isThumbnail);
			
		$this->response->body($body);
		return $this->response;
	}
	
	private function getRequestParameterAsString($p) {
		return $this->request->query[$p];
	}
	
	private function getRequestParameterAsBoolean($p) {
		if (isset($_REQUEST[$p]) && !empty($_REQUEST[$p])) {
			return strtolower($this->request->query[$p]) == 'true' ? true : false;
		}
		
		return false;
	}
	
	private function getPhotoOrThumbnail($album, $fileName, $isThumbnail) {
		if ($isThumbnail) {
			return ModelUtils::loadThumbnail($album, $fileName);
		} else {
			$body = ModelUtils::loadPhoto($album, $fileName);
			if ($body == null) {
				throw new NotFoundException('Photo ' . $fileName . ' does not exist on the server.');
			} else {
				return $body;
			}
		}
	}
    
}
