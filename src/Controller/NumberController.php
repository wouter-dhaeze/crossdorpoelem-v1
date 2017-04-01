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
		
		$this->loadModel('Member');
		
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
		$result = null;
		try {
			$result = [
				"PARTY" => $this->getNumber('PARTY', 1),
				"5KM" => $this->getNumber('5KM', 100),
				"10KM" => $this->getNumber('10KM', 200),
			];
			
			$this->response->type('json');
			$this->response->body(json_encode($result));
			return $this->response;
		} catch (PDOException $e) {
			$this->log('PDOException occurred: ' . $e->getMessage() . '\n' . $e->getTraceAsString() , 'error');
			debug($this->Participant->lastQuery());
			
    		throw new InternalErrorException('Kon geen borstnummer ophalen.');
    	} catch (FatalErrorException $e) {
    		$this->log('FatalErrorException occurred: ' . $e->getMessage() . '\n' . $e->getTraceAsString() , 'error');
    		debug($this->Participant->lastQuery());
    			
    		throw new InternalErrorException('Kon geen borstnummer ophalen.');
    	}
	}
	
	function getLastQuery()
	{
		$dbo = $this->Participant->getDatasource();
		$logs = $dbo->getLog();
		$lastLog = end($logs['log']);
		return $lastLog['query'];
	}
	
	private function getNumber($wave, $defaultValue) {
		$where = ['number <>' => "", 'wave =' => $wave];
		
		if ($wave == 'PARTY') {
			$where['number >'] = '10';
		}
		
		$query = $this->Member
			->find()
			->where($where)
			->order(['number' => 'DESC'])
			->limit(1);
		$max = $query->toArray();
			
		if (empty($max)) {
			return $defaultValue;
		} else {
			return $max[0]->number + 1;
		}
	}
	
}
