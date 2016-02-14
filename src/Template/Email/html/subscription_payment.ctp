<?php
	use Cake\Core\Configure;

	$addressing = $subscription->participant[0]->fname;
	if ($subscription->wave == 'YOUTH') {
		$addressing .= ' en ' . $subscription->participant[1]->fname;
	}
	
	//$validationUrl = $baseUrl . '/validatesubscription/' . $subscription->code;
?>

<p>Beste <?= $addressing ?>,</p>
<br/>
<div>
	<h2>Stap 2 is voltooid!</h2>
	<p>Uw inschrijving is gevalideerd.</p>
</div>
<br/>
<div>
	<h2>Op naar stap 3!</h2>
	<p>Mogen wij u vragen het bedrag van <b><?= Configure::read('CDO.cost')?> euro</b> te storten. (Duo's hoeven slechts eenmaal te betalen.)</p>
	<h3>LET OP! Vergeet uw inschrijvingscode niet in de vrije mededeling te zetten. Zo kunnen we uw inschrijving aan uw storting koppelen.</h3>
	<h4>Bedrag: <?= Configure::read('CDO.cost')?> euro<br/>
	Rekening: <?= Configure::read('CDO.bank_account')?><br/>
	Naam: <?= Configure::read('CDO.bank_name')?><br/>
	Mededeling: <?= $subscription->code?><br/></h4>
</div>
<br/>
<div>
	Nadat we uw storting hebben ontvangen, sturen we u een derde en laatste e-mail met daarin uw borstnummer. Op de dag van de wedstrijd kunt u zich aanmelden aan de inschrijvingsstand waar u een enveloppe met uw borstnummer en spelden ontvangt. 
</div>
<br/>
<br/>
<div>
	Alvast hartelijk dank voor uw inschrijving.<br/>
	<br/>
	<br/>
	Tot gauw
	<br/>
	VZW Feles<br/>
	<a href="https://www.crossdorpoelem.be">https://www.crossdorpoelem.be</a>
</div>
