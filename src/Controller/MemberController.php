<?php
namespace App\Controller;

use App\Controller\AppController;

use Cake\Event\Event;
use Cake\Log\Log;

use Cake\Error\FatalErrorException;

/**
 * Member Controller
 *
 */
class MemberController extends AppController
{

	public function initialize()
	{
		parent::initialize();
		
		$this->loadModel('Subscription');
		$this->loadModel('Member');
	}
	
	public function beforeFilter(Event $event)
	{
		$this->Auth->allow(['view', 'get']);
	}
	
	/**
	 * View method
	 *
	 * @return void
	 */
	public function view($code = null)
	{
		if (!is_null($code)) {
			$member = $this->getMemberByCode($code, false);
			
			$this->set('member', $member);
			$this->set('_serialize', ['member']);
		}
			
		$this->viewBuilder()->layout('cdo-detail');
	}
	
	public function get() {
		try {
			$code = $this->request->query('code');
	
			if (!empty($code)) {
				$member = $this->getMemberByCode($code, false);
		   
				$this->response->type('json');
				$this->response->body($this->json_encode($member));
				return $this->response;
			} 
		} catch (PDOException $e) {
			$this->log('PDOException occurred: ' . $e->getMessage() . '\n' . $e->getTraceAsString() , 'error');
			throw new InternalErrorException('Er is een fout op de database gebeurd.');
			//send email
		}
	}
	
	private function json_encode($member) {
		return json_encode($member);
	}
	
	private function getMemberByCode($code, $throw) {
		$memberq = $this->Member->findByCode($code);
		$count = $memberq->count();
		if ($count == 0) {
			Log::warning('Member with code ' . $code . ' not found' , 'error');
			if ($throw) {
				throw new InternalErrorException("De gezochte code '" . $code . "' werd niet gevonden.");
			} else {
				return null;
			}
		}
		if ($count > 1) {
			Log::warning('Multiple members with code ' . $code . 'found.' , 'error');
			if ($throw) {
				throw new InternalErrorException("Er werden meerdere deelnemers met code '" . $code . "' gevonden.");
			} else {
				return null;
			}
		}
		 
		return $memberq->first();
	}
	
}
