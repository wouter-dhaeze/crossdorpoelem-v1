<?php
namespace App\Controller;

use App\Controller\AppController;

use Cake\Event\Event;
use Cake\Log\Log;

use Cake\Network\Exception\InternalErrorException;

use App\Util\EmailUtils;

/**
 * Email Controller
 *
 */
class EmailController extends AppController
{

	public function initialize()
	{
		parent::initialize();
		
		$this->loadModel('Subscription');
		$this->loadModel('Participant');
		
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
		$code = $this->request->query('code');
		$type = $this->request->query('type');
		
		$subscription = null;
		$query = $this->Subscription->findByCode($code);
		$c = $query->count();
		
		if ($c == 0) {
			Log::error("No subscription found with code " . $code);
			throw new InternalErrorException("Geen inschrijving met code '" . $code . "' gevonden.");
		} else {
			$subscription = $query->first();
			 
			$subscription = $this->Subscription->get($subscription->id, [
					'contain' => ['Participant']
					]);
		}
		
		if ($type == 'reminder') {
			EmailUtils::sendReminderMail($subscription);
			Log::info('Reminder sent to ' . json_encode($subscription));
		} else {
			Log::error("Wrong email type" . $type);
			throw new InternalErrorException('Verkeerd e-mailtype opgegeven.');
		}
		
		$this->response->type('json');
		$this->response->body(json_encode("Er werd een herinnering  naar " . $subscription->participant[0]->email . " gestuurd."));
		return $this->response;
	}
	
}
