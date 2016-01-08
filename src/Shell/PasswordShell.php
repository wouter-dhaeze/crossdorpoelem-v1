<?php
namespace App\Shell;

use Cake\Auth\DefaultPasswordHasher;
use Cake\Console\Shell;

class PasswordShell extends Shell
{
	
	public function hash($password)
	{
		$this->out('Hashing password ' . $password);
		$hash = (new DefaultPasswordHasher)->hash($password);
		$this->out($hash);
	}
	
}