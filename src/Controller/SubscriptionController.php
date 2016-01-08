<?php
namespace App\Controller;

use App\Controller\AppController;

use Cake\Event\Event;
use Cake\Log\Log;

use PDOException;

use Cake\Network\Exception\InternalErrorException;

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
		//$this->loadComponent('RequestHandler');
		
		$this->Auth->allow(['create']);
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
    	try {
    		//Log::debug("Subscription: " . implode($this->request->data));
	    	$subscription = $this->Subscription->newEntity();
	    	
	    	$wave = $this->request->data['wave']['id'];
	    	$subscription->wave = $wave;
	    	$subscription->code = $this->generateCode();
	    	
	    	if ($wave == 'ADULT') {
	    		
	    	} else if ($wave == 'YOUTH') {
	    		$firstName = $this->request->data['aFirstName'];
	    		Log::debug("Subscription: " . $firstName);
	    	} else {
	    		//throw unknown wave
	    	}
	    	
	    	
	    	if ($this->Subscription->save($subscription)) {
	    		Log::debug("Subscription saved for code: " . $subscription.code);
	    	}
	    
	    	$this->response->body(json_encode($subscription));
	    	return $this->response;
    	} catch (PDOException $e) {
    		throw new InternalErrorException('Er is een fout op de database gebeurd. Onze IT is alvast op de hoogte. Gelieve later opnieuw te proberen.');
    		//send email
    	}
    }
    
    private function validateSubscription() {
    	//1. email address max 2 occurrances
    	
    	//2. DOB of Youth Wave
    	
    	//3. Validate Sponsor code exists
    	
    	//4. Validate Sponsor code not used
    }
    
    private function generateCode() {
    	$length = 6;
    	$randomString = substr(str_shuffle("0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);
    	
    	$query = $this->Subscription->findByCode($randomString);
		$count = $query->count();
		
		if ($count != 0) {
			return generateCode();
		}
			
    	return $randomString;
    }
    
}
