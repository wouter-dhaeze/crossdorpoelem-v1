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
class SubscriptionController extends AppController
{

	public function initialize()
	{
		parent::initialize();
		$this->loadComponent('RequestHandler');
	}
	
	/**
     * View method
     *
     * @param string|null $id Subscription id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
    	$view = 'view';
    	if (is_null($id)) {
    		$view = 'new';
    	} else {
    		$this->set('code', $id);
    	}
    	
    	$this->layout = 'cdo-detail';
    	$this->render($view);
    	 
    	/*$subscription = $this->Subscriptions->get($id, [
            'contain' => ['Participants']
        ]);
        $this->set('subscription', $subscription);
        $this->set('_serialize', ['subscription']);*/
    }
    
    /**
     * API call get all
     */
    public function all()
    {
    	$subscriptions = $this->Subscriptions;
    	$query = $subscriptions->find();
    	$this->response->body(json_encode($query->all()));
    	return $this->response;
    }
    
    /**
     * API call subscribe
     */
    public function create()
    {
    	//$subscription = $this->Subscriptions->newEntity($this->request->data);
    	Log::debug("Subscription: " . implode($this->request->data));
    	
    	$firstName = $this->request->data['aFirstName'];
    	Log::debug("Subscription: " . $firstName);
    	
    	/*if ($this->Subscriptions->save($subscription)) {
    		Log::debug("Subscription saved for email " . $subscription.email);
    	}*/
    
    	$this->response->body($this->request->data);
    	return $this->response;
    }
    
}
