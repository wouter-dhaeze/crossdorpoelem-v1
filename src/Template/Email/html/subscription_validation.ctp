<?php
	$addressing = $subscription->participant[0]->fname;
	if ($subscription->wave == 'YOUTH') {
		$addressing .= ' en ' . $subscription->participant[1]->fname;
	}
	
	$validationUrl = $baseUrl . '/validatesubscription/' . $subscription->code;
?>

<p>Beste <?= $addressing ?>,</p>
<br/>
<div>
	<h2>We hebben uw inschrijvingsgegevens goed ontvangen!</h2>
	<p>Stap 1 is met succes voltooid! Hoogtijd om uw inschrijving te valideren.</p>
	<p>Hieronder vindt u uw inschrijvingscode terug:</p>
	<h1><?= $subscription->code ?></h1>
	<p>Deze code is belangrijk omdat u die zal moeten meegeven in uw overschrijving (niet voor sponsors). Ook kunt u later deze code gebruiken om de status van uw inschrijving te bekijken.
	</p>
</div>
<br/>
<div>
	<h2>Op naar stap 2!</h2>
	<p>Voor u de betaalgegevens ontvangt, vragen wij u uw inschrijving te valideren. Dit doet u door op onderstaande link te klikken. U ontvangt spoedig een tweede e-mail met de betaalgegevens.</p>
	<h3><a href="<?= $validationUrl?>">Valideer mijn inschrijving</a></h3>
	<br/>
	<p>Mocht deze link niet werken, kopieer dan <?= $validationUrl?> naar de adresbalk van uw browser.</p>
</div>
<br/>
<br/>
<div>
	Alvast hartelijk dank voor uw inschrijving.<br/>
	<br/>
	<br/>
	Tot gauw
	<br/>
	VZW Feles
</div>
