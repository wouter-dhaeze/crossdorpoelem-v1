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
	<p>Uw inschrijvingsgegevens zijn gevalideerd.</p>
</div>
<br/>
<div>
	<h2>Op naar stap 3!</h2>
	<p>Aangezien u met een sponsorcode ingeschreven heeft, hoeft u niet te betalen.</p>
	<p>We zullen u de komende dagen een borstnummer toekennen. U zal een bevestigingsmail ontvangen.</p>
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
