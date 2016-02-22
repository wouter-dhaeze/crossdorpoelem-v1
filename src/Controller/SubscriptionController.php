<?php
namespace App\Controller;

use App\Controller\AppController;
use App\Util\EmailUtils;
use App\Util\ModelUtils;

use Cake\Core\Configure;
use Cake\Event\Event;
use Cake\Log\Log;
use Cake\Mailer\Email;
use Cake\I18n\Time;

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
		
		$this->Auth->allow(['create', 'validate']);
		//$this->Auth->allow(['create', 'edit', 'validate', 'update']);
		
		Time::setJsonEncodeFormat('dd/MM/yyyy');
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
    		$subscription = $this->getSubscriptionByCode($id, false);
    		
    		$this->set('subscription', $subscription);
        	$this->set('_serialize', ['subscription']);
    	}
    	
    	$this->viewBuilder()->layout('cdo-detail');
    	$this->render($view);
    }
    
    public function validate($code) {
    	$code = strtoupper($code);
    	Log::debug("Validating subscription code " . $code);
    	
    	$subscription = $this->getSubscriptionByCode($code, false);
    	if (empty($subscription)) {
    		Log::error("No subscription found with " . $code);
    		$this->viewBuilder()->layout('cdo-detail');
    		$this->set('message', "Er is geen schrijving met code '" . $code . "' gevonden.");
    		$this->render('error');
    	} else {
    		$subscription->validated = true;
    		$subscription = $this->Subscription->save($subscription);
    		
    		if ($subscription == false) {
    			Log::error("Save returend false for subscription code " . $code);
    			$this->viewBuilder()->layout('cdo-detail');
    			$this->set('message', "Er is een fout gebeurd tijdens het valideren van uw inschrijving. Gelieve later opnieuw te proberen.");
    			$this->render('error');
    		}
    		
    		if (ModelUtils::isSponsorCode($code)) {
    			$this->sendSponsorMail($code);
    		} else {
    			$this->sendPaymentMail($code);
    		}
    		
    		Log::debug("Subscription code '" . $code . "' validated");
    		
    		return $this->redirect(['action' => 'view', $code]);
    	}
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
    		
    		if (!empty($code)) {
	    		$subscriptionq = $this->Subscription->findByCode($code);
	    		
	    		$subscription = $subscriptionq->first();
	    		
	    		if (empty($subscription)) {
	    			throw new InternalErrorException("Geen inschrijving met code '" . $code . "' gevonden.");
	    		}
	    		
	    		$subscription = $this->Subscription->get($subscription->id, [
		    			'contain' => ['Participant']
		    			]);
	    		
	    		$this->response->type('json');
	    		$this->response->body($this->json_encode($subscription));
	    		return $this->response;
    		} else {
    			$filter = [];
    			
    			$term = $this->request->query('term');
    			$wave = $this->request->query('wave');
    			$validated = $this->request->query('validated');
    			$payed = $this->request->query('payed');
    			$sponsor = $this->request->query('sponsor');
    			
    			$subscriptiona = $this->Subscription->find('all');
    			
    			$subscriptionq = null;
    			if (!empty($term)) {
    				//$filter['code'] = $term;
    				$filter['OR'] = [['code' => $term], ['email'=>$term]];
    				
    				$subscriptionq = $this->Subscription
    								->find('all', ['contain' => ['Participant']]);
    				
    				$subscriptionq->innerJoinWith('Participant', function($q) use ($term) {
						return $q->where(['OR' => [['code' => $term], ['number' => $term], ['email' => $term], ['fname LIKE' => '%' . $term . '%'], ['lname LIKE' => '%' . $term . '%']]]);
    				});
    			} else {
	    			if (!empty($wave) && $wave != 'undefined') {
	    				$filter['wave'] = $wave;
	    			}
	    			if (!empty($validated) && $validated != 'undefined') {
	    				$filter['validated'] = $validated == 'TRUE' ? true : false;
	    			}
	    			if (!empty($payed) && $payed != 'undefined') {
	    				$filter['payed'] = $payed == 'TRUE' ? true : false;
	    			}
	    			if (!empty($sponsor) && $sponsor != 'undefined') {
	    				
	    			}
	    			
	    			$subscriptionq = $this->Subscription
							    			->find('all', ['contain' => ['Participant']])
							    			->where($filter);
    			}
    			
    			$subscriptions = $subscriptionq->toArray(); 
    			$subscriptionTotal = $subscriptiona->count();
    			$subscriptionCount = $subscriptionq->count();
    			
    			$list = [];
    			if (empty($term) && !empty($sponsor) && $sponsor != 'undefined') {
    				$subscriptionCount = 0;
    				$sponsor = $sponsor == 'TRUE' ? true : false;
	    			foreach ($subscriptions as $s) {
	    				if (ModelUtils::isSponsorCode($s->code) && $sponsor) {
	    					array_push($list, $s);
	    					$subscriptionCount++;
	    				} else if (!ModelUtils::isSponsorCode($s->code) && !$sponsor) {
	    					array_push($list, $s);
	    					$subscriptionCount++;
	    				}
	    			}
	    		} else {
	    			$list = $subscriptions;
	    		}

    			$result = ["count" => $subscriptionCount, "total" => $subscriptionTotal, "subscriptions" => $list];
    			
    			$this->response->type('json');
    			$this->response->body(json_encode($result));
    			return $this->response;
    		}
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
    	$subscription = null;
    	$participant1 = null;
    	$participant2 = null;
    	
    	try {
    		//Log::debug("Subscription: " . implode($this->request->data));   		
    		
    		$subscription = $this->Subscription->patchEntity($this->Subscription->newEntity(), $this->request->data, ['validate' => false]);

    		$participant1 = $this->Participant->patchEntity($this->Participant->newEntity(), $this->request->data['participant1'], ['validate' => false]);
    		$participant1->dob = ModelUtils::parseDate($this->request->data['participant1']['dob'], 'd/m/Y', 'Y-m-d');
    		$participant1->number = "N/A";
    		$participant1->start_order = 1;
    		$participant2 = null;
    		if ($subscription->wave == 'YOUTH') {
    			$participant2 = $this->Participant->patchEntity($this->Participant->newEntity(), $this->request->data['participant2'], ['validate' => false]);
    			$participant2->dob = ModelUtils::parseDate($this->request->data['participant2']['dob'], 'd/m/Y', 'Y-m-d');
    			$participant2->number = "N/A";
    			$participant2->start_order = 2;
    		}
    		
    		$this->validateSubscription($subscription, $participant1, $participant2);
    		
    		if (empty($subscription->code)) {
    			$subscription->code = ModelUtils::generateSubscriptionCode();
    			$subscription->payed = 0;
    		}

			$subscription->validate = false;
    		
	    	$subscription = $this->saveSubscription($subscription, $participant1, $participant2);
	    	
	    	if (!$subscription == false) {
	    		$subscription = $this->Subscription->get($subscription->id, [
	    			'contain' => ['Participant']
	    			]);
	    		
	    		$code = $subscription->code;
	    		//send mail
	    		$this->sendValidationMail($code);
	    	} else {
	    		$this->log('Save returned false' , 'error');
	    		throw new InternalErrorException('De inschrijving kon niet worden bewaard. Zijn alle velden correct ingevuld?');
	    	}
	    	
	    	$this->response->type('json');
	    	$this->response->body($this->json_encode($subscription));
	    	return $this->response;
    	} catch (PDOException $e) {
    		$this->log('PDOException occurred: ' . $e->getMessage() . '\n' . $e->getTraceAsString() , 'error');
    		throw new InternalErrorException('Er is een fout op de database gebeurd. Onze IT is alvast op de hoogte. Gelieve later opnieuw te proberen.');
    		//send email
    	}
    }
    
    /**
     * API call subscribe (HTTP PUT)
     * 
     * Currenlty only implemented to send update payment
     */
    public function edit($id) {
    	try {
	    	$subscription = $this->Subscription->get($id);
	    	$participant1 = null;
	    	$participant2 = null;
	    	
	    	$subscription = $this->getSubscriptionByCode($subscription->code, true);
	    	$participant1 = $subscription->participant[0];
	    	if ($subscription->wave == 'YOUTH') {
	    		$participant2 = $subscription->participant[1];
	    	}
	    	if (empty($subscription)) {
	    		$this->log('No subscription found with id' . $id, 'error');
	    		throw new InternalErrorException('Geen beschrijving gevonden met id ' . $this->request->data['id']);
	    	}
	    	
	    	if ($subscription->payed) {
	    		$this->log('Subscription with id' . $id . ' already payed.', 'error');
	    		throw new InternalErrorException('De inschrijving met id ' . $id . ' heeft reeds betaald.');
	    	}
	    	
	    	if ($this->request->data['payed']) {
	    		$participant1->number = $this->request->data['participant1']['number'];
	    		if ($subscription->wave == 'YOUTH') {
	    			$participant2->number = $this->request->data['participant2']['number'];
	    		}
	    		
	    		$subscription->validated = true;
	    		$subscription->payed = true;
	    		
	    		$this->validateSubscription($subscription, $participant1, $participant2);
	    		
	    		$subscription = $this->updateSubscription($subscription, $participant1, $participant2);
	    		if (!$subscription == false) {
	    			$subscription = $this->Subscription->get($subscription->id, [
	    					'contain' => ['Participant']
	    					]);
	    			 
	    			$code = $subscription->code;
	    			//send mail
	    			$this->sendSubscriptionSuccessMail($code);
		    	} else {
	    				$this->log('Save returned false' , 'error');
	    				throw new InternalErrorException('De betaling kon niet worden geregistreerd. Check database.');
	    		}
	    	}
	    	
	    	$this->response->type('json');
	    	$this->response->body($this->json_encode($subscription));
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
    
    /**
     * API call subscribe (HTTP DELETE)
     *
     * Currenlty only implemented to send update payment
     */
    public function remove($id) {
    	Log::info("Deleting " . $id);
    	
    	$message = "";
    	$subscription = $this->Subscription->get($id, [
    			'contain' => ['Participant']
    			]);
    	
    	if (!empty($subscription)) {
    		$code = $subscription->code;
    		$result = $this->Subscription->delete($subscription);
    		$message = 'Inschrijving met code ' . $code . ' is verwijderd.';
    	} else {
    		$message = 'Geen inschrijving met code ' . $code . ' gevonden.';
    	}
    	
    	$this->response->type('json');
    	$this->response->body($this->json_encode($message));
    	return $this->response;
    }
    
    private function sendValidationMail($code) {
    	$subscription =  $this->getSubscriptionByCode($code, true);
    	
    	EmailUtils::sendValidationMail($subscription);
    }
    
    private function sendPaymentMail($code) {
    	$subscription =  $this->getSubscriptionByCode($code, true);
    	 
    	EmailUtils::sendPaymentMail($subscription);
    }
    
    private function sendSponsorMail($code) {
    	$subscription =  $this->getSubscriptionByCode($code, true);
    
    	EmailUtils::sendSponsorMail($subscription);
    }
    
    private function sendSubscriptionSuccessMail($code) {
    	$subscription =  $this->getSubscriptionByCode($code, true);
    	
    	EmailUtils::sendSubscriptionSuccessMail($subscription);
    }
    
    private function validateSubscription($subscription, $participant1, $participant2) {
    	if (!$subscription->consent) {
    		Log::warning('Subscriber did not consent', 'warn');
    		throw new InternalErrorException("U dient akkoord te gaan met de gezondheidsvoorwaarde.");
    	}
    	
    	$this->validateParticipant($participant1);
    	if ($subscription->wave == 'ADULT') {
    		$year = ModelUtils::getYear($participant1->dob, 'Y-m-d');
    		
    		$age1 = 2016 - $year;
    		if ($age1 < 14) {
    			Log::warning('Participant is to young ' . $year, 'warn');
    			throw new InternalErrorException("Om deel te nemen aan de 'Big run' moet u geboren zijn in 2002 of vroeger.");
    		}
    	} else if ($subscription->wave == 'YOUTH') {
    		$this->validateParticipant($participant2);
    		
    		$year1 = ModelUtils::getYear($participant1->dob, 'Y-m-d');
    		$year2 = ModelUtils::getYear($participant2->dob, 'Y-m-d');
    		
    		$age1 = 2016 - $year1;
    		$age2 = 2016 - $year2;
    		if ($age1 > 13 || $age1 < 10 || 
    				$age2 > 13 || $age2 < 10) {
    			Log::warning('Participant is to old or to young', 'warn');
    			throw new InternalErrorException("Om deel te nemen aan de 'Duo run' moet u geboren zijn tussen 01/01/2003 en 31/12/2006.");
    		}
    	} else {
    		Log::warning('Wrong wave code ' . $wave , 'warn');
    		throw new InternalErrorException("Er werd een verkeerde wave-code doorgegeven: " . $wave);
    	}
    	
    	$code = $subscription->code;
    	if (!empty($code)) {
    		//3. Validate Sponsor code exists
    		if (empty($subscription->id) && !ModelUtils::isSponsorCode($code)) {
				Log::warning('SponsorCode ' . $code . ' does not exist' , 'warn');
				throw new InternalErrorException("De gebruikte sponsorcode '" . $code . "' is niet gekend. Weet u zeker dat die correct is?");
			}
			
			//4. Validate Sponsor code not used
			$subscriptionq = $this->Subscription->findByCode($code);
			if (empty($subscription->id) && $subscriptionq->count() > 0) {
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
    		throw new InternalErrorException("Het e-mailveld is leeg of ongeldig");
    	}
    	
    	//email address unique over Subscription
    	if (Configure::read('CDO.email_unique')) {
    	$participantq = $this->Participant->findByEmail($participant->email);
	    	if ($participantq->count() > 0) {
	    		Log::warning('Email already exists: ' . $participant->email, 'warn');
	    		throw new InternalErrorException("Er bestaat al een inschrijving met dit e-mailadres. Gelieve een ander (geldig) adres te kiezen.");
	    	}
    	}
    	
    	if (!filter_var($participant->email, FILTER_VALIDATE_EMAIL)) {
    		Log::warning('Email wrong format: ' . $email, 'warn');
    		throw new InternalErrorException("Het e-mailadres is ongeldig.");
    	}
    	
    	if (empty($participant->dob)) {
    		Log::warning('DOB is empty' , 'warn');
    		throw new InternalErrorException("Het geboortedatum-veld is leeg.");
    	}
    	
    	//chest number unique for each participant
    	if (!empty($participant->number) && $participant->number != 'N/A') {
    		$participantq = $this->Participant->findByNumber($participant->number);
    		if ($participantq->count() > 0) {
    			Log::warning('Number already exists: ' . $participant->number, 'warn');
    			throw new InternalErrorException("Er bestaat al een inschrijving met dit borstnummer.");
    		}
    	}
    }
    
    private function json_encode($subscription) {
    	//$subscription->participant[0]->dob = ModelUtils::parseDate($subscription->participant[0]->dob, 'Y-m-d', 'd/m/Y');
    	return json_encode($subscription);
    }
    
    private function getSubscriptionByCode($code, $throw) {
   		$subscriptionq = $this->Subscription->findByCode($code);
	    $count = $subscriptionq->count();
	    if ($count == 0) {
	    	Log::warning('Code ' . $code . ' not found' , 'error');
	    	if ($throw) {
	    		throw new InternalErrorException("De gezochte code '" . $code . "' werd niet gevonden.");
	    	} else {
	    		return null;
	    	}
	    }
	    if ($count > 1) {
	    	Log::warning('Multiple subscriptions with code ' . $code . 'found.' , 'error');
	    	if ($throw) {
	    		throw new InternalErrorException("Er werden meerdere inschrijvingen met code '" . $code . "' gevonden.");
	    	} else {
	    		return null;
	    	}
	    }
	    
	    $subscription = $subscriptionq->first();
	    
	    return $this->Subscription->get($subscription->id, [
	    		'contain' => ['Participant']
	    		]);
    }
    
    private function saveSubscription($subscription, $participant1, $participant2) {
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
	    				//Log::debug($this->Participant->validationErrors);
	    				Log::debug("Participant2 saved: false");
		    			return false;
		    		}
	    		}
    		} else {
    			Log::debug("Persisting subscription resulted in false.");
    		}
    		
    		return $subscription;
    	});	
    	
    	return $subscription;
    }
    
    private function updateSubscription($subscription, $participant1, $participant2) {
    	$subscription = $this->Subscription->connection()->transactional(function () use ($subscription, $participant1, $participant2) {
    		$subscription = $this->Subscription->save($subscription);
    
    		if ($subscription != false) {
    			$saveSuccess = $this->Participant->save($participant1);
    	   
    			if ($saveSuccess == false) {
    				Log::debug("Participant1 updated: false");
    				return false;
    			}
    	   
    			if ($participant2 != null) {
    				$saveSuccess = $this->Participant->save($participant2);
    
    				if ($saveSuccess == false) {
    					Log::debug($this->Participant->validationErrors);
    					Log::debug("Participant2 updated: false");
    					return false;
    				}
    			}
    		} else {
    			Log::debug("Persisting subscription resulted in false.");
    		}
    
    		return $subscription;
    	});
    		 
    	return $subscription;
    }
    
    /*
     * public function create2()
    {
    	//$code = 'W9VLU6';
    	$code = 'MRTGKC';
    	$this->sendValidationMail($code);
    	$this->sendPaymentMail($code);
    	$this->sendSubscriptionSuccessMail($code);
    	
    	throw new InternalErrorException('Mail gestuurd');
    }
     */
    
}
