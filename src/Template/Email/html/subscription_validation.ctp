<?php
	$addressing = $subscription->member[0]->fname;
	
	$validationUrl = $baseUrl . '/validatesubscription/' . $subscription->code;
?>

<p>Beste <?= $addressing ?>,</p>
<br/>
<div>
	<h4>We hebben uw inschrijvingsgegevens goed ontvangen!</h4>
	<h4>Stap 1 is met succes voltooid!</h4>
	<p>Hieronder vindt u uw <b>inschrijvingscode</b> terug:</p>
	<h1><?= $subscription->code ?></h1>
	<?php if ($subscription->price > 0) {?>
	<p>Deze code is belangrijk omdat u die zal moeten meegeven in uw overschrijving. Ook kunt u later deze code gebruiken om de status van uw inschrijving te bekijken.
	</p>
	<?php } else { ?>
		<p>Doordat u gebruik maakte van de sponsorkorting hoeft u geen overschrijving te verrichten. U kunt bovenstaande code gebruiken om de status van uw inschrijving te bekijken. 
		We vragen u wel uw inschrijving te valideren via onderstaande link.</p>
	<?php }?>
</div>
<br/>
<div>
	<h4>Op naar stap 2!</h4>
	<p>Gelieve op onderstaande link te klikken om uw inschrijving te valideren.
		<?php if ($subscription->price > 0) {?>
			<span>U ontvangt een tweede e-mail na de validatie van uw inschrijving.</span>
		<?php }?>
	</p>
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
	VZW Feles<br/>
	<a href="https://www.crossdorpoelem.be">https://www.crossdorpoelem.be</a>
</div>
