<?php
namespace App\Shell;

use Cake\Auth\DefaultPasswordHasher;
use Cake\Console\Shell;

use App\Util\ModelUtils;

class ManageShell extends Shell
{
	
	/**
	 * bin\cake manage hash_password changeit
	 * @param unknown $password
	 */
	public function hashPassword($password)
	{
		$this->out('Hashing password ' . $password);
		$hash = (new DefaultPasswordHasher)->hash($password);
		$this->out($hash);
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
	
}