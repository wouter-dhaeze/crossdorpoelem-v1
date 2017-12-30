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
			//$where['number <>'] = '1';
			//$where['number <>'] = '2';
			//$where['number <>'] = '3';
			//$where['number <>'] = '4';
			//$where['number <>'] = '5';
			//$where['number <>'] = '6';
			//$where['number <>'] = '7';
			//$where['number <>'] = '8';
			//$where['number <>'] = '9';
			//$where['number >'] = '10';
		}
		
		$query = $this->Member
			->find()
			->where($where)
			->andWhere(function ($exp, $q) {
				return $exp->notIn('number', ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10']);
			})
			->order(['number' => 'DESC'])
			->limit(1);
		$max = $query->toArray();
			
		if (empty($max)) {
			//Log::info("Returning default for wave " . $wave . ": " . $defaultValue);
			return $defaultValue;
		} else {
			$value = intval($max[0]->number) + 1;
			//Log::info("Returning value for wave " . $wave . ": " . $value);
			return $value;
		}
	}
	
}
