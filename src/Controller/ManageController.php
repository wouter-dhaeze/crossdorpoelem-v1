<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Manage Controller
 *
 * @property \App\Model\Table\ManageTable $Manage
 */
class ManageController extends AppController
{

	public function initialize()
	{
		parent::initialize();
		
		$this->Auth->deny(['index']);
	}
	
	public function beforeFilter(Event $event)
	{
		parent::beforeFilter($event);
		
		$this->Auth->deny();
	}
	
    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
    	$this->layout = 'cdo-manage';
    }

}
