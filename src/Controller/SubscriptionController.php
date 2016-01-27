<?php
namespace App\Controller;

use App\Controller\AppController;
use App\Util\EmailUtils;
use App\Util\ModelUtils;

use Cake\Event\Event;
use Cake\Log\Log;
use Cake\Mailer\Email;

use PDOException;

use Cake\Datasource\Exception\RecordNotFoundException;
use Cake\Network\Exception\InternalErrorException;

/**
 * Subscriptions Controller
 *
 * @property \App\Model\Table\SubscriptionTable $Subscription
 */
class SubscriptionController extends AppController
{
	
	public function initialize()
	{
		parent::initialize();
		$this->loadComponent('RequestHandler');
		
		$this->loadModel('Sponsor');
		$this->loadModel('Participant');
		
		//$this->Auth->allow(['create']);
		$this->Auth->allow(['create', 'edit']);
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
    
    public function get() {
    	try {
    		$code = $this->request->query('code');
    		
    		$subscriptionq = $this->Subscription->findByCode($code);
    		
    		$subscription = $subscriptionq->first();
    		
    		if (empty($subscription)) {
    			throw new InternalErrorException("Geen inschrijving gevonden met code " . $code);
    		}
    		
    		$subscription = $this->Subscription->get($subscription->id, [
	    			'contain' => ['Participant']
	    			]);
    		
    		$this->response->type('json');
    		$this->response->body(json_encode($subscription));
    		return $this->response;
    	} catch (PDOException $e) {
    		$this->log('PDOException occurred: ' . $e->getMessage() . '\n' . $e->getTraceAsString() , 'error');
    		throw new InternalErrorException('Er is een fout op de database gebeurd.');
    		//send email
    	}
    }
    
    /**
     * API call subscribe (HTTP PUT)
     */
    public function create()
    {
    	//$code = 'W9VLU6';
    	$code = 'MRTGKC';
    	$this->sendValidationMail($code);
    	$this->sendPaymentMail($code);
    	$this->sendSubscriptionSuccessMail($code);
    	
    	throw new InternalErrorException('Mail gestuurd');
    }
    public function create2()
    {
    	$subscription = null;
    	$participant1 = null;
    	$participant2 = null;
    	
    	try {
    		//Log::debug("Subscription: " . implode($this->request->data));   		
    		
    		$subscription = $this->Subscription->patchEntity($this->Subscription->newEntity(), $this->request->data, ['validate' => false]);
    		$subscription->wave = $this->request->data['wave']['id'];

    		$participant1 = $this->Participant->patchEntity($this->Participant->newEntity(), $this->request->data['participant1'], ['validate' => false]);
    		$participant1->dob = ModelUtils::parseDate($this->request->data['participant1']['dob'], 'd/m/Y', 'Y-m-d');
    		$participant1->number = "N/A";
    		$participant1->start_order = 1;
    		$participant2 = null;
    		if ($subscription->wave == 'YOUTH') {
    			$participant2 = $this->Participant->patchEntity($this->Participant->newEntity(), $this->request->data['participant2'], ['validate' => false]);
    			$participant2->dob = date("Y-m-d", strtotime($this->request->data['participant2']['dob']));
    			$participant2->number = "N/A";
    			$participant2->start_order = 2;
    		}
    		
    		$this->validateSubscription($subscription, $participant1, $participant2);
    		
    		if (!empty($subscription->code)) {
    			$subscription->payed = 1;
    			
    		} else {
    			$subscription->code = ModelUtils::generateSubscriptionCode();
    			$subscription->payed = 0;
    		}

			$subscription->validate = false;
    		
	    	$subscription = $this->Subscription->connection()->transactional(function () use ($subscription, $participant1, $participant2) {
	    		$subscription = $this->Subscription->save($subscription);	    		
	    		
	    		if ($subscription != false) {
		    		$participant1->subscription = $subscription;
		    		$saveSuccess = $this->Participant->save($participant1);
		    		
		    		if ($saveSuccess == false) {
		    			Log::debug("Participant1 saved: false");
		    			return false;
		    		} 
		    		
		    		if ($participant2 != null) {
		    			$participant2->subscription = $subscription;
		    			$saveSuccess = $this->Participant->save($participant2);
		    			
		    			if ($saveSuccess == false) {
		    				Log::debug($this->Participant->validationErrors);
		    				Log::debug("Participant2 saved: false");
			    			return false;
			    		}
		    		}
	    		} else {
	    			Log::debug("Persisting subscription resulted in false.");
	    		}
	    		
	    		return $subscription;
	    	});	
	    	
	    	if (!$subscription == false) {
	    		$subscription = $this->Subscription->get($subscription->id, [
	    			'contain' => ['Participant']
	    			]);
	    		
	    		//send mail
	    		// if no sponsorcode
	    		
	    		// if sponsorcode 
	    		// => 1.payment ok
	    		// => 2. send mail to inschrijvingen that sponsor needs chestnumber
	    	} else {
	    		$this->log('Save returned false' , 'error');
	    		throw new InternalErrorException('De inschrijving kon niet worden bewaard. Zijn alle velden correct ingevuld?');
	    	}
	    	
	    	$this->response->type('json');
	    	$this->response->body(json_encode($subscription));
	    	return $this->response;
    	} catch (PDOException $e) {
    		$this->log('PDOException occurred: ' . $e->getMessage() . '\n' . $e->getTraceAsString() , 'error');
    		throw new InternalErrorException('Er is een fout op de database gebeurd. Onze IT is alvast op de hoogte. Gelieve later opnieuw te proberen.');
    		//send email
    	}
    }
    
    /**
     * API call subscribe (HTTP POST)
     */
    public function edit($id = null) {
    	try {
	    	$subscription = $this->Subscription->get($id);
	    	if (empty($subscription)) {
	    		$this->log('No subscription found with id' . $id, 'error');
	    		throw new InternalErrorException('Geen beschrijving gevonden met id ' . $this->request->data['id']);
	    	}
	    	
	    	$this->response->type('json');
	    	$this->response->body(json_encode($subscription));
	    	return $this->response;
    	} catch (PDOException $e) {
    		$this->log('PDOException occurred: ' . $e->getMessage() . '\n' . $e->getTraceAsString() , 'error');
    		throw new InternalErrorException('Er is een fout op de database gebeurd. Onze IT is alvast op de hoogte. Gelieve later opnieuw te proberen.');
    		//send email
    	} catch (RecordNotFoundException $e) {
    		$this->log('RecordNotFoundException occurred: ' . $e->getMessage() . '\n' . $e->getTraceAsString() , 'error');
    		throw new InternalErrorException('Geen inschrijving gevonden met id ' . $id);
    	}
    }
    
    public function sendValidationMail($code) {
    	$subscription =  $this->getSubscriptionByCode($code);
    	
    	EmailUtils::sendValidationMail($subscription);
    }
    
    public function sendPaymentMail($code) {
    	$subscription =  $this->getSubscriptionByCode($code);
    	 
    	EmailUtils::sendPaymentMail($subscription);
    }
    
    public function sendSubscriptionSuccessMail($code) {
    	$subscription =  $this->getSubscriptionByCode($code);
    	
    	EmailUtils::sendSubscriptionSuccessMail($subscription);
    }
    
    private function validateSubscription($subscription, $participant1, $participant2) {
    	if ($subscription->wave == 'ADULT') {
    		$this->validateParticipant($participant1);
    		
    		$year = ModelUtils::getYear($participant1->dob, 'Y-m-d');
    		
    		if ((2016 - $year) < 14) {
    			Log::warning('Participant is to young ' . $year, 'warn');
    			throw new InternalErrorException("Om deel te nemen aan de 'Big run' moet u geboren zijn in 2002 of later.");
    		}
    	} else if ($subscription->wave == 'YOUTH') {
    		$this->validateParticipant($participant1);
    		$this->validateParticipant($participant2);
    		
    		$year1 = ModelUtils::getYear($participant1->dob, 'Y-m-d');
    		$year2 = ModelUtils::getYear($participant2->dob, 'Y-m-d');
    		
    		if ((2016 - $year1) > 13 || (2016 - $year2) > 13) {
    			Log::warning('Participant is to old ' . $year, 'warn');
    			throw new InternalErrorException("Om deel te nemen aan de 'Duo run' moet u geboren zijn in 2003 of vroeger.");
    		}
    	} else {
    		Log::warning('Wrong wave code ' . $wave , 'warn');
    		throw new InternalErrorException("Er werd een verkeerde wave-code doorgegeven: " . $wave);
    	}
    	
    	$code = $subscription->code;
    	if (!empty($code)) {
    		//3. Validate Sponsor code exists
    		if (!ModelUtils::isSponsorCode($code)) {
				Log::warning('SponsorCode ' . $code . ' does not exist' , 'warn');
				throw new InternalErrorException("De gebruikte sponsorcode '" . $code . "' is niet gekend. Weet u zeker dat die correct is?");
			}
			
			//4. Validate Sponsor code not used
			$subscriptionq = $this->Subscription->findByCode($code);
			if ($subscriptionq->count() > 0) {
				Log::warning('SponsorCode ' . $code . ' already in use' , 'warn');
				throw new InternalErrorException("De sponsorcode '" . $code . "' wordt al gebruikt. Gelieve uw andere code te gebruiken.");
			}
    	}
	
    }
    
    private function validateParticipant($participant) {
    	if (empty($participant->gender)) {
    		Log::warning('Gender is empty' , 'warn');
    		throw new InternalErrorException("Het geslacht-veld is leeg.");
    	}
    	
    	if (!($participant->gender == 'F' || $participant->gender == 'M')) {
    		Log::warning('Gender is empty' , 'warn');
    		throw new InternalErrorException("Het geslacht-veld heeft een verkeerde waarde (M of F): " . $participant->gender);
    	}
    	
    	if (empty($participant->fname)) {
    		Log::warning('First name is empty' , 'warn');
    		throw new InternalErrorException("Het voornaam-veld is leeg.");
    	}
    	
    	if (empty($participant->lname)) {
    		Log::warning('Last name is empty' , 'warn');
    		throw new InternalErrorException("Het familienaam-veld is leeg.");
    	}
    	
    	if (empty($participant->email)) {
    		Log::warning('Email is empty' , 'warn');
    		throw new InternalErrorException("Het email-veld is leeg of ongeldig");
    	}
    	
    	//email address unique over Subscription
    	$participantq = $this->Participant->findByEmail($participant->email);
    	if ($participantq->count() > 0) {
    		Log::warning('Email already exists: ' . $participant->email, 'warn');
    		throw new InternalErrorException("Er bestaat al een inschrijving met dit emailadres. Gelieve een ander (geldig) adres te kiezen.");
    	}
    	
    	if (!filter_var($participant->email, FILTER_VALIDATE_EMAIL)) {
    		Log::warning('Email wrong format: ' . $email, 'warn');
    		throw new InternalErrorException("Het emailadres is ongeldig.");
    	}
    	
    	if (empty($participant->dob)) {
    		Log::warning('DOB is empty' , 'warn');
    		throw new InternalErrorException("Het geboortedatum-veld is leeg.");
    	}
    }
    
    private function getSubscriptionByCode($code) {
   		$subscriptionq = $this->Subscription->findByCode($code);
	    $count = $subscriptionq->count();
	    if ($count == 0) {
	    	Log::warning('Code ' . $code . ' not found' , 'error');
	    	throw new InternalErrorException("De gezochte code '" . $code . "' werd niet gevonden.");
	    }
	    if ($count > 1) {
	    	Log::warning('Multiple subscriptions with code ' . $code . 'found.' , 'error');
	    	throw new InternalErrorException("Er werden meerdere inschrijvingen met code '" . $code . "' gevonden.");
	    }
	    
	    $subscription = $subscriptionq->first();
	    
	    return $this->Subscription->get($subscription->id, [
	    		'contain' => ['Participant']
	    		]);
    }
    
}
