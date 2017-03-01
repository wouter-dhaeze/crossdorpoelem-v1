<?php
	use Cake\Core\Configure;

	$addressing = $subscription->member[0]->fname;
?>

<p>Beste <?= $addressing ?>,</p>
<br/>
<div>
	<h4>Stap 2 is voltooid!</h4>
	<p>Uw inschrijving is gevalideerd.</p>
</div>
<br/>
<?php if ($subscription->price > 0) {?>
<div>
	<h4>Op naar stap 3!</h4>
	<p>Mogen wij u vragen het bedrag van <b><?= $subscription->price ?> euro</b> te storten.</p>
	<h4>LET OP! Vergeet uw inschrijvingscode niet in de vrije mededeling te zetten. Zo kunnen we uw inschrijving aan uw storting koppelen.</h4>
	<h4>Bedrag: <?= $subscription->price ?> euro<br/>
	Rekening: <?= Configure::read('CDO.bank_account')?><br/>
	Naam: <?= Configure::read('CDO.bank_name')?><br/>
	Mededeling: <?= $subscription->code?><br/></h4>
</div>
<br/>
<div>
	Nadat we uw storting hebben ontvangen, sturen we u een derde en laatste e-mail met daarin uw borstnummer. Op de dag van de wedstrijd kunt u zich aanmelden aan de inschrijvingsstand waar u een enveloppe met uw borstnummer en spelden ontvangt. 
</div>
<?php } else { ?>
<div>
	Door gebruik te maken van de sponsorkorting hoeft u niet te betalen. Binnenkort worden de borstnummers toegekend. Op de dag van de wedstrijd kunt u zich aanmelden aan de inschrijvingsstand waar u een enveloppe met uw borstnummer en spelden ontvangt.
</div>
<?php }?>
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
