<?php
namespace App\Shell;

use Cake\Auth\DefaultPasswordHasher;
use Cake\Console\Shell;
use Cake\Filesystem\File;
use Cake\I18n\Time;

use App\Util\ModelUtils;
use App\Util\EmailUtils;

class ManageShell extends Shell
{
	
	public function initialize()
	{
		parent::initialize();
		$this->loadModel('User');
		$this->loadModel('Subscription');
		$this->loadModel('Participant');
	}
	
	/**
	 * bin\cake manage create_user username changeit admin
	 * @param unknown $username
	 * @param unknown $password
	 * @param unknown $role
	 */
	public function createUser($username, $password, $role) {
		$user = $this->User->newEntity();
		$user->username = $username;
		$user->password = $password;//$this->hashPassword($password);
		$user->role = $role;
		
		if ($this->User->save($user)) {
			$this->out('User created');
		}
	}
	
	/**
	 * bin\cake manage hash_password changeit
	 * @param unknown $password
	 */
	public function hashPassword($password)
	{
		$this->out('Hashing password ' . $password);
		$hash = (new DefaultPasswordHasher)->hash($password);
		$this->out($hash);
		
		return $hash;
	}
	
	/**
	 * bin\cake manage generate_code
	 */
	public function generateCode()
	{
		$this->out('Generating code...');
		$code = ModelUtils::generateSubscriptionCode();
		$this->out($code);
	}
	
	/**
	 * bin\cake manage exportSubscriptions C:\temp\sub.json
	 * @param unknown $file
	 */
	public function exportSubscriptions($fileTo) {
		$this->out('Getting subscriptions and saving to ' . $fileTo . ' ...');
		
		$subscriptions = $this->Subscription;
		$query = $subscriptions->find('all')->contain(['Participant']);
		//$this->out(json_encode($query->all()));
		
		$file = new File($fileTo);
		$this->out('Writing result to file ' . ($file->name()));
		$file->write(json_encode($query->all()));
		$file->close();
		
		$this->out('File ' . $file->name() . ' written');
	}
	
	public function test($input) {
		$time = Time::createFromFormat('d/m/Y',$input);
		
		$this->out('Day: ' . $time->day);
		$this->out('Month: ' . $time->month);
		$this->out('Year: ' . $time->year);
		$this->out('Date: ' . $time->format('Y-m-d'));
		
		//EmailUtils::mailSubscriptionReceived();
	}
	
}