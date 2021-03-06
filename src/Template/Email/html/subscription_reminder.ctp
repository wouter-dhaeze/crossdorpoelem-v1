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
	Op <?= $subscription->created->i18nFormat('dd/MM/yyyy');?> schreef u zich in voor Crossdorp Oelem, maar tot op heden hebben we <b>nog geen betaling ontvangen</b>.<br>
	<br/>
	Mogen wij u vragen om <b>binnen de 3 dagen uw storting te volbrengen</b>? Gezien de vlotlopende inschrijvingen en het beperkt aantal beschikbare plaatsen, zien we ons genoodzaakt
	uw inschrijving te schrappen indien we uw betaling niet binnen de 3 dagen ontvangen hebben. Alvast bedankt om dit spoedig in orde te brengen. De betalingsgegevens vindt u verder in de e-mail.
</div>
<br/>
<div>
	Mocht u reeds betaald hebben, en u heeft een week na datum nog geen bevestiging ontvangen, gelieve ons dan op de hoogte te brengen op e-mailadres <a href="mailto:inschrijving@crossdorpoelem.be">inschrijving@crossdorpoelem.be</a>.<br/>
	Vermeld hierbij uw code, en de datum wanneer u uw betaling heeft verricht. We laten u zo spoedig mogelijk iets weten.
</div>
<div>
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
