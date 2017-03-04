<?php
namespace App\Controller;

use App\Controller\AppController;

use Cake\Event\Event;

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
		
		$this->loadComponent('RequestHandler');		
		$this->loadModel('Subscription');
		
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
    	$this->viewBuilder()->layout('cdo-manage');
    }
    
    public function getSubscription() {
    	
    }

}
