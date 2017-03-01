<?php
namespace App\Controller;

use App\Controller\AppController;
use App\Util\EmailUtils;
use App\Util\ModelUtils;

use Cake\Log\Log;
use Cake\Mailer\Email;
use Cake\I18n\Time;

use PDOException;

use Cake\Datasource\Exception\RecordNotFoundException;
use Cake\Network\Exception\InternalErrorException;
use Cake\Network\Exception\BadRequestException;

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
		$this->loadModel('Member');
		
		$this->Auth->allow(['create', 'validate', 'get']);
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
    		$code = $this->request->query('code');
    		
    		if (!empty($code)) {
    			return $this->redirect(['action' => 'view', $code]);
    		}
    	}
    	
    	if (is_null($id) || empty($id)) {
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
    		if (!$subscription->validated) {
	    		$subscription->validated = true;
	    		
	    		if ($subscription->price == 0) {
	    			$subscription->payed = true;
	    		}
	    		
	    		$subscription = $this->Subscription->save($subscription);
	    		
	    		if ($subscription == false) {
	    			Log::error("Save returend false for subscription code " . $code);
	    			$this->viewBuilder()->layout('cdo-detail');
	    			$this->set('message', "Er is een fout gebeurd tijdens het valideren van uw inschrijving. Gelieve later opnieuw te proberen.");
	    			$this->render('error');
	    		}
	    		
	    		$this->sendPaymentMail($code);
	    		
	    		Log::debug("Subscription code '" . $code . "' validated");
	    	}
	    	
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
		    			'contain' => ['Member']
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
    	
    	try {
    		//Log::debug("Subscription: " . implode($this->request->data));  		
    		
    		$subscription = $this->request->data;
    		$subscription['code'] = ModelUtils::generateSubscriptionCode();
    		
    		foreach ($subscription['members'] as $index => $m) {
    			Log::debug("Member " . implode($m));
    			
    			$code = $m['code'];
    			if (empty($code)) {
    				$subscription['members'][$index]['code'] = ModelUtils::generateSubscriptionCode();
    			} else {
    				$subscription['members'][$index]['sponsor'] = true;
    				
    				if ($m['wave'] == '5KM') {
    					$subscription['price'] -= 6;
    				} else if ($m['wave'] == '10KM') {
    					$subscription['price'] -= 10;
    				}
    			}	
    		}
    		
    		//data validation
    		$errorMessages = $this->validateNewSubscription($subscription);
    		
    		if (count($errorMessages) > 0) {
    			throw new BadRequestException(implode(";", $errorMessages));
    		}
    		
    		$subscription = $this->saveSubscription($subscription);
    		
    		if (!$subscription == false) {
	    		$subscription = $this->Subscription->get($subscription->id, [
	    			'contain' => ['Member']
	    			]);
	    		
	    		$code = $subscription->code;
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
    		throw new InternalErrorException('Er is een fout op de database opgetreden. Onze IT is alvast op de hoogte. Gelieve later opnieuw te proberen.');
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
    		Log::debug('Deleting subscription: ' . json_encode($subscription));
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
    
    private function validateNewSubscription($subscription) {
    	/*
    	 * Validations:
    	 * - Sponsor: 
    	 * -- code not for PARTY
    	 * -- code does not exist
    	 * -- code does not exist in current data
    	 * -- code exists in sponsors
    	 */
    	
    	$errorMessages = array();
    	
    	$usedSCodes = array();
    	foreach ($subscription['members'] as $index => $m) {
    		$errorMessages = $this->validateNewMember($index, $m, $errorMessages);
    		if ($m['sponsor']) {
    			if (in_array($m['code'], $usedSCodes)) {
    				array_push($errorMessages, "Deelnemer " . $index . ": De sponsorcode '" . $m['code'] . "' wordt al gebruikt in je inschrijving.");
    			}
    			
    			array_push($usedSCodes, $m['code']);
    		}
    	}
    	
    	return $errorMessages;
    }
    
    private function validateNewMember($index, $member, $errorMessages) {
    	
    	
    	/*- fname exists
    	* - lname exists
    	* - gender exists
    	* - dob:
    	* -- exists
    	* -- not in future
    	* -- not before 1900
    	* - pcode exists
    	* - wave exists if particiapnt
    	*/
    	
    	if (empty($member['fname'])) {
    		Log::warning('First name is empty' , 'warn');
    		array_push($errorMessages, "Deelnemer " . ($index + 1) . ": Voornaam is verplicht.");
    	}
    	
    	if (empty($member['lname'])) {
    		Log::warning('Lastname is empty' , 'warn');
    		array_push($errorMessages, "Deelnemer " . ($index + 1) . ": Familienaam is verplicht.");
    	}
    	
    	if (empty($member['gender'])) {
    		Log::warning('Gender is empty' , 'warn');
    		array_push($errorMessages, "Deelnemer " . ($index + 1) . ": Geslacht is verplicht.");
    	}
    	
    	if (!($member['gender'] == 'F' || $member['gender'] == 'M')) {
    		Log::warning('Gender is not F or M' , 'warn');
    		array_push($errorMessages, "Deelnemer " . ($index + 1) . ": Geslacht moet de waarde 'M' of 'F' hebben.");
    	}
    	
    	if (empty($member['email'])) {
    		Log::warning('Email is empty' , 'warn');
    		array_push($errorMessages, "Deelnemer " . ($index + 1) . ": E-mail is verplicht.");
    	}
    	
    	if (!filter_var($member['email'], FILTER_VALIDATE_EMAIL)) {
    		Log::warning('Email wrong format: ' . $member['email'], 'warn');
    		array_push($errorMessages, "Deelnemer " . ($index + 1) . ": E-mail is in verkeerd formaat.");
    	}
    	
    	if (empty($member['dob'])) {
    		Log::warning('DOB is empty' , 'warn');
    		array_push($errorMessages, "Deelnemer " . ($index + 1) . ": Geboortedatum is verplicht.");
    	}
    	
    	if(strtotime($member['dob']) > time()) {
    		Log::warning('DOB is in the future' , 'warn');
    		array_push($errorMessages, "Deelnemer " . ($index + 1) . ": Geboortedatum mag niet in de toekomst liggen.");
    	}
    	
    	if (empty($member['pcode'])) {
    		Log::warning('Postal code is empty' , 'warn');
    		array_push($errorMessages, "Deelnemer " . ($index + 1) . ": Postcode is verplicht.");
    	}
    	
    	if (empty($member['code'])) {
    		Log::warning('Code is empty' , 'warn');
    		array_push($errorMessages, "Deelnemer " . ($index + 1) . ": Code is verplicht.");
    	}
    	
    	$code = $member['code'];
    	//3. Validate Sponsor code exists
    	if (empty($subscription['id']) && $member['sponsor']) {
    		if (!ModelUtils::isSponsorCode($code)) {
	    		Log::warning('SponsorCode ' . $code . ' does not exist' , 'warn');
	    		array_push($errorMessages, "Deelnemer " . ($index + 1) . ": De gebruikte sponsorcode '" . $code . "' is niet gekend. Weet u zeker dat die correct is?");
    		}
    		
    		if ($member['participant'] && !empty($member['wave']) && $member['wave'] == 'PARTY') {
    			Log::warning('SponsorCode ' . $code . ' cannot be used for PARTY wave.' , 'warn');
    			array_push($errorMessages, "Deelnemer " . ($index + 1) . ": De gebruikte sponsorcode '" . $code . "' mag niet gebruikt worden voor de PARTY wave.");
    		}
    	}
    		
    	//4. Validate Sponsor code not used
    	$memberq = $this->Member->findByCode($code);
    	if (empty($subscription['id']) && $memberq->count() > 0) {
    		Log::warning('SponsorCode ' . $code . ' already in use' , 'warn');
    		array_push($errorMessages, "Deelnemer " . ($index + 1) . ": De sponsorcode '" . $code . "' wordt al gebruikt. Gelieve uw andere code te gebruiken.");
    	}
    	
    	if ($member['participant'] && empty($member['wave'])) {
    		Log::warning('Wave is empty' , 'warn');
    		array_push($errorMessages, "Deelnemer " . ($index + 1) . ": Wave is verplicht.");
    	}
    	
    	$waves = array("5KM", "10KM", "PARTY");
    	if (!in_array($member['wave'], $waves)) {
    		Log::warning('Wave is invalid' , 'warn');
    		array_push($errorMessages, "Deelnemer " . ($index + 1) . ": Ongeldige wave.");
    	}
    	
    	//chest number unique for each participant
    	/*if (!empty($participant->number) && $participant->number != 'N/A') {
    		$participantq = $this->Participant->findByNumber($participant->number);
    		if ($participantq->count() > 0) {
    			Log::warning('Number already exists: ' . $participant->number, 'warn');
    			throw new InternalErrorException("Er bestaat al een inschrijving met dit borstnummer.");
    		}
    		if ($participant->number > 500 || $participant->number < 233) {
    			Log::warning('Wrong number: ' . $participant->number, 'warn');
    			throw new InternalErrorException("Het toegewezen nummer mag niet hoger zijn 500 of lager dan 233.");
    		}
    	}*/
    	
    	return $errorMessages;
    }
    
    private function json_encode($subscription) {
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
	    		'contain' => ['Member']
	    		]);
    }
    
    private function saveSubscription($sdata) {
    	$subscription = $this->Subscription->patchEntity($this->Subscription->newEntity(), $sdata, ['validate' => true]);
    	$members = array();
    	
    	foreach ($sdata['members'] as $mdata) {
    		$member = $this->Member->patchEntity($this->Member->newEntity(), $mdata, ['validate' => true]);
    		$member->dob = ModelUtils::parseDate($mdata['dob'], 'd/m/Y', 'Y-m-d');
    		array_push($members, $member);
    	}
    	
    	return $this->Subscription->connection()->transactional(function () use ($subscription, $members) {
    		$subscription = $this->Subscription->save($subscription);	    		
    		
    		if ($subscription != false) {
    			foreach ($members as $member) {
    				$member->subscription = $subscription;
    				$saveSuccess = $this->Member->save($member);
    				
    				if ($saveSuccess == false) {
    					Log::debug("Member saved: false");
    					return false;
    				}
    			}
    		} else {
    			Log::debug("Persisting subscription resulted in false.");
    		}
    		
    		return $subscription;
    	});	
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
