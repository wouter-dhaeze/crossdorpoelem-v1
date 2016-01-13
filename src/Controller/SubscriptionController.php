<?php
namespace App\Controller;

use App\Controller\AppController;
use App\Util\ModelUtils;

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
		
		$this->loadModel('Sponsor');
		$this->loadModel('Participant');
		
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
    		$this->validateSubscription($this->request->data);
    		
    		//Log::debug("Subscription: " . implode($this->request->data));
	    	$subscription = $this->Subscription->newEntity();
	    	$participant1 = null;
	    	$participant2 = null;
	    	
	    	$wave = $this->request->data['wave']['id'];
	    	$subscription->wave = $wave;

	    	$sponsorCode = $this->request->data['sponsorCode'];
	    	if (!empty($sponsorCode)) {
	    		$subscription->code = $sponsorCode;
	    		$subscription->number = ModelUtils::generateChestNumber();
	    		$subscription->payed = 1;
	    	} else {
	    		$subscription->code = ModelUtils::generateSubscriptionCode();
	    		$subscription->payed = 0;
	    	}
	    	
	    	if ($wave == 'ADULT') {
	    		Log::debug('aGender: ' . $data['aGender']);
	    		
	    		$participant1 = $this->createParticipant($this->request->data['aGender'], $this->request->data['aFirstName'], $this->request->data['aLastName'], $this->request->data['aEmail'], $this->request->data['aDob'], 1);
	    		$participant1->subscription = $subscription;
	    	} else if ($wave == 'YOUTH') {
	    		$firstName = $this->request->data['aFirstName'];
	    		Log::debug("Subscription: " . $firstName);
	    	}
	    	
	    	
	    	
	    	if ($this->Subscription->save($subscription)) {
	    		$this->Participant->save($participant1);
	    		
	    		Log::debug("Subscription saved for code: " . $subscription->code);
	    	}
	    
	    	$subscription = $this->Subscription->get($subscription->id, [
	            'contain' => ['Participant']
	        ]);
	    	
	    	$this->response->body(json_encode($subscription));
	    	return $this->response;
    	} catch (PDOException $e) {
    		
    		$this->log('PDOException occurred: ' . $e->getMessage() . '\n' . $e->getTraceAsString() , 'error');
    		throw new InternalErrorException('Er is een fout op de database gebeurd. Onze IT is alvast op de hoogte. Gelieve later opnieuw te proberen.');
    		//send email
    	}
    }
    
    private function validateSubscription($data) {
    	//Validate data
    	$wave = $data['wave']['id'];
    	if ($wave == 'ADULT') {
    		$this->validateParticipant($data['aGender'], $data['aFirstName'], $data['aLastName'], $data['aEmail'], $data['aDob']);
    	} else if ($wave == 'YOUTH') {
    		//DOB of Youth Wave
    	} else {
    		Log::warning('Wrong wave code ' . $wave , 'warn');
    		throw new InternalErrorException("Er werd een verkeerde wave-code doorgegeven: " . $wave);
    	}
    	
    	$sponsorCode = $data['sponsorCode'];
    	if (!empty($sponsorCode)) {
    		//3. Validate Sponsor code exists
    		$sponsorq1 = $this->Sponsor->findByCode1($sponsorCode);
    		$sponsorq2 = $this->Sponsor->findByCode2($sponsorCode);
			$sponsorc = $sponsorq1->count() + $sponsorq2->count();
			if ($sponsorc == 0) {
				Log::warning('SponsorCode ' . $sponsorCode . ' does not exist' , 'warn');
				throw new InternalErrorException("De gebruikte sponsorcode '" . $sponsorCode . "' is niet gekend. Weet u zeker dat die correct is?");
			}
			
			//4. Validate Sponsor code not used
			$subscriptionq = $this->Subscription->findByCode($sponsorCode);
			if ($subscriptionq->count() > 0) {
				Log::warning('SponsorCode ' . $sponsorCode . ' already in use' , 'warn');
				throw new InternalErrorException("De sponsorcode '" . $sponsorCode . "' wordt al gebruikt. Gelieve uw andere code te gebruiken.");
			}
    	}
	
    }
    
    private function validateParticipant($gender, $firstName, $lastName, $email, $dob) {
    	if (empty($gender)) {
    		Log::warning('Gender is empty' , 'warn');
    		throw new InternalErrorException("Het geslacht-veld is leeg.");
    	}
    	
    	if (!($gender == 'F' || $gender == 'M')) {
    		Log::warning('Gender is empty' , 'warn');
    		throw new InternalErrorException("Het geslacht-veld heeft een verkeerde waarde (M of F): " . $gender);
    	}
    	
    	if (empty($firstName)) {
    		Log::warning('First name is empty' , 'warn');
    		throw new InternalErrorException("Het voornaam-veld is leeg.");
    	}
    	
    	if (empty($lastName)) {
    		Log::warning('Last name is empty' , 'warn');
    		throw new InternalErrorException("Het familienaam-veld is leeg.");
    	}
    	
    	if (empty($email)) {
    		Log::warning('Email is empty' , 'warn');
    		throw new InternalErrorException("Het email-veld is leeg.");
    	}
    	
    	//email address unique over Subscription
    	$participantq = $this->Participant->findByEmail($email);
    	if ($participantq->count() > 0) {
    		Log::warning('Email already exists: ' . $email, 'warn');
    		throw new InternalErrorException("Er bestaat al een inschrijving met dit emailadres. Gelieve een ander (geldig) adres te kiezen.");
    	}
    	
    	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    		Log::warning('Email wrong format: ' . $email, 'warn');
    		throw new InternalErrorException("Het emailadres heeft een verkeerd formaat.");
    	}
    	
    	if (empty($dob)) {
    		Log::warning('DOB is empty' , 'warn');
    		throw new InternalErrorException("Het geboortedatum-veld is leeg.");
    	}
    }
    
    private function createParticipant($gender, $firstName, $lastName, $email, $dob, $order) {
    	$participant = $this->Participant->newEntity();
    	
    	$participant->gender = $gender;
    	$participant->fname = $firstName;
    	$participant->lname = $lastName;
    	$participant->email = $email;
    	$participant->dob = $dob;
    	$participant->run_order = $order;
    	
    	return $participant;
    }
    
    /*private function validateDate($date, $format = 'Y-m-d H:i:s')
    {
    	$d = DateTime::createFromFormat($format, $date);
    	return $d && $d->format($format) == $date;
    }*/
    
}
