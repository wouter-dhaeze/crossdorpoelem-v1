<?php
namespace App\Util;

use Cake\Core\Configure;
use Cake\Mailer\Email;

class EmailUtils
{
    
    public static function sendValidationMail($subscription) {
    	EmailUtils::sendMail('subscription_validation', 'Crossdorp Oelem - Inschrijvingsaanvraag ontvangen', $subscription);
    }
    
    public static function sendPaymentMail($subscription) {
    	EmailUtils::sendMail('subscription_payment', 'Crossdorp Oelem - Inschrijving gevalideerd', $subscription);
    }
    
    public static function sendSponsorMail($subscription) {
    	EmailUtils::sendMail('subscription_sponsor', 'Crossdorp Oelem - Inschrijving gevalideerd', $subscription);
    }
    
    public static function sendSubscriptionSuccessMail($subscription) {
    	EmailUtils::sendMail('subscription_number', 'Crossdorp Oelem - Inschrijving voltooid', $subscription);
    }
    
    public static function sendSponsorInvite($sponsor) {
    	$wwwRoot = Configure::read('App.fullBaseUrl');
    	
    	$viewVars = ['sponsor' => $sponsor,
    	'baseUrl' => $wwwRoot];
    	 
    	$email = new Email('default');
    	$email->template('sponsor_invite', 'cdo')
		    	->emailFormat('html')
		    	->to($sponsor->email)
		    	->subject('Crossdorp Oelem - Inschrijvingscodes')
		    	->viewVars($viewVars);
    	$email->send();
    }
    
    public static function sendPublicInvite($interest) {
    	$wwwRoot = Configure::read('App.fullBaseUrl');
    	 
    	$viewVars = ['interest' => $interest,
    	'baseUrl' => $wwwRoot];
    
    	$email = new Email('default');
    	$email->template('public_invite', 'cdo')
    	->emailFormat('html')
    	->to($interest->email)
    	->subject('Crossdorp Oelem - Inschrijvingen geopend')
    	->viewVars($viewVars);
    	$email->send();
    }
    
    private static function sendMail($template, $subject, $subscription) {
    	$wwwRoot = Configure::read('App.fullBaseUrl');
    	
    	$viewVars = ['subscription' => $subscription,
    	'baseUrl' => $wwwRoot];
    	 
    	$email = new Email('default');
    	$email->template($template, 'cdo')
		    	->emailFormat('html')
		    	->to($subscription->participant[0]->email)
		    	->subject($subject)
		    	->viewVars($viewVars);
    	$email->send();
    }
    

}