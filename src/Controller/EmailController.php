<?php
namespace App\Controller;

use App\Controller\AppController;

use Cake\Event\Event;
use Cake\Log\Log;

/**
 * Email Controller
 *
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
	 * API call email (HTTP PUT)
	 */
	public function create()
	{
		Log::info('resend validation mail');
	}
	

}
