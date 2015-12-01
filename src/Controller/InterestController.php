<?php
namespace App\Controller;

use App\Controller\AppController;

use Cake\Event\Event;
use Cake\Log\Log;

/**
 * Subscriptions Controller
 *
 * @property \App\Model\Table\SubscriptionsTable $Subscriptions
 */
class InterestController extends AppController
{

	public function initialize()
	{
		parent::initialize();
		$this->loadComponent('RequestHandler');
	}
    
    /**
     * API call get all
     */
    public function all()
    {
    	Log::debug(">all()");
    	$interest = $this->Interest;
    	$query = $interest->find();
    	$this->response->body(json_encode($query->all()));
    	return $this->response;
    }
    
    /**
     * API call subscribe
     */
    public function create() 
    {
    	Log::debug(">create()");
    	
    	$interest = $this->Interest->newEntity($this->request->data);
    	
    	$email = $interest->email;
    	$query = $this->Interest->find()->where(['email =' => $email]);
    	if ($query->count() == 0) {
			if ($this->Interest->save($interest)) {
				Log::debug("Interest saved for email " . $interest->email);
			} else {
				Log::debug("Interest not saved saved for email " . $interest->email);
			}
    	} else {
    		Log::debug("Email already exists.");
    	}

    	$this->response->body(json_encode($interest));
    	return $this->response;
    }
    
}
