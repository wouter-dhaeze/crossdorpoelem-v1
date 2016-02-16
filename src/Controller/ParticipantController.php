<?php
namespace App\Controller;

use App\Controller\AppController;

use Cake\Event\Event;
use Cake\Log\Log;

use Cake\Error\FatalErrorException;

/**
 * Participant Controller
 *
 */
class ParticipantController extends AppController
{

	public function initialize()
	{
		parent::initialize();
		
		$this->loadModel('Participant');
	}
	
	public function beforeFilter(Event $event)
	{
		$this->Auth->allow(['get']);
	}
	
	/**
	 * API call Participant (HTTP GET)
	 * 
	 * Gets all participants that were assigned a number, ordered by number
	 */
	public function get()
	{
		$result = null;
		try {
			$query = $this->Participant
						->find()
						->where(['number <>' => "N/A"])
						->order(['number' => 'ASC']);
			
			$participantTotal = $query->count();
			$participants = $query->toArray();
			
			$result = ["participants" => $participants, "count" => $participantTotal];
			
			$this->response->type('json');
			$this->response->body(json_encode($result));
			return $this->response;
		} catch (PDOException $e) {
			$this->log('PDOException occurred: ' . $e->getMessage() . '\n' . $e->getTraceAsString() , 'error');
			
    		throw new InternalErrorException('Fout tijdens ophalen deelnemers.');
    	} catch (FatalErrorException $e) {
    		$this->log('FatalErrorException occurred: ' . $e->getMessage() . '\n' . $e->getTraceAsString() , 'error');
    			
    		throw new InternalErrorException('Fout tijdens ophalen deelnemers.');
    	}
	
	}
	
}
