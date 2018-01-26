<?php
	use Cake\Core\Configure;

	$addressing = $subscription->member[0]->fname;
?>

<p>Beste <?= $addressing ?>,</p>
<br/>
<?php if ($subscription->price > 0) {?>
<div>
    <p>Onderstaand vindt u nogmaals de betaalgegevens. Indien u al betaald heeft, hoeft u uiteraard niet nogmaals te betalen.</p>
        <h4>LET OP! Vergeet uw inschrijvingscode niet in de vrije mededeling te zetten. Zo kunnen we uw inschrijving aan uw storting koppelen.</h4>
	<h4>Bedrag: <?= $subscription->price ?> euro<br/>
	Rekening: <?= Configure::read('CDO.bank_account')?><br/>
	Naam: <?= Configure::read('CDO.bank_name')?><br/>
	Mededeling: <?= $subscription->code?><br/></h4>
</div>
<br/>
<div>
	Nadat we uw storting hebben ontvangen, sturen we u een laatste e-mail met daarin uw borstnummer(s). Op de dag van de wedstrijd kunt u zich aanmelden aan de inschrijvingsstand waar u een enveloppe met uw borstnummer en spelden ontvangt. 
</div>
<?php } else { ?>
<div>
	Door gebruik te maken van de kortingscodes hoeft u niet te betalen. Binnenkort worden de borstnummers toegekend. Op de dag van de wedstrijd kunt u zich aanmelden aan de inschrijvingsstand waar u een enveloppe met uw borstnummer en spelden ontvangt.
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
