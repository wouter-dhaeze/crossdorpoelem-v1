<?php
namespace App\Controller;

use App\Controller\AppController;

use Cake\Event\Event;
use Cake\Log\Log;

use Cake\Error\FatalErrorException;

/**
 * Number Controller
 *
 */
class NumberController extends AppController
{

	public function initialize()
	{
		parent::initialize();
		
		$this->loadModel('Participant');
		
		$this->Auth->deny(['index']);
	}
	
	public function beforeFilter(Event $event)
	{
		parent::beforeFilter($event);
		
		$this->Auth->deny();
	}
	
	/**
	 * API call number (HTTP GET)
	 * 
	 * Gets the next available chest number
	 */
	public function get()
	{
		$plus = $this->request->query('plus');
		
		$result = null;
		try {
			$query = $this->Participant
						->find()
						->where(['number <>' => "N/A"])
						->order(['number' => 'DESC'])
						->limit(1);
			$max = $query->toArray();
			//$this->log($this->Participant->lastQuery(), 'debug');
			//$this->element('sql_dump');
			//$this->getLastQuery($this->getLastQuery(), 'debug');
			
			$result = $max[0]->number + $plus;
			
			if ($result > 500) {
				$query = $this->Participant
							->find()
							->where(['number <>' => "N/A", 'number <' => "351"])
							->order(['number' => 'DESC'])
							->limit(1);
				$max = $query->toArray();
				$result = $max[0]->number + $plus;
			}
			
			$result = str_pad($result, 3, "0", STR_PAD_LEFT);
		} catch (PDOException $e) {
			$this->log('PDOException occurred: ' . $e->getMessage() . '\n' . $e->getTraceAsString() , 'error');
			debug($this->Participant->lastQuery());
			
    		throw new InternalErrorException('Kon geen borstnummer ophalen.');
    	} catch (FatalErrorException $e) {
    		$this->log('FatalErrorException occurred: ' . $e->getMessage() . '\n' . $e->getTraceAsString() , 'error');
    		debug($this->Participant->lastQuery());
    			
    		throw new InternalErrorException('Kon geen borstnummer ophalen.');
    	}
		
		//$query = $this->Participant->find('all', ['number<>' => 'N/A']);
		//$max = $query->select(['number' => $query->func()->max()])->first();
		
		$this->response->type('json');
    	$this->response->body(json_encode($result));
    	return $this->response;
	}
	
	function getLastQuery()
	{
		$dbo = $this->Participant->getDatasource();
		$logs = $dbo->getLog();
		$lastLog = end($logs['log']);
		return $lastLog['query'];
	}
	
}
