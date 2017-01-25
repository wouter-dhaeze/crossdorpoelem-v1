<?php
namespace App\Controller;

use App\Controller\AppController;

use App\Util\ModelUtils;

/**
 * Media Controller
 *
 * @property \App\Model\Table\MediaTable $Media
 */
class MediaController extends AppController
{

	public function initialize()
	{
		parent::initialize();
		//$this->loadComponent('RequestHandler');
		
		$this->loadModel('Album');
	}
    
	public function index() {
		$albums = $this->Album->find('all')->all();
		
		$this->set('albums', $albums);
		$this->set('_serialize', ['albums']);
	}
	
	/**
	 * View method
	 *
	 * @return void
	 */
	public function view($id = null)
	{
		$albumId = 1;
		
		if (!is_null($id)) {
			$albumId = $id;
		}
		
		$album = $this->Album->get($id, [
				'contain' => []
		]);
		ModelUtils::loadAlbumFromDisk($album);
		
		$this->set('album', $album);
		$this->set('_serialize', ['album']);
		 
		$this->viewBuilder()->layout('cdo-detail');
	}
    
}
