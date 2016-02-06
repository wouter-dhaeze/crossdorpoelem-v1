<?php
	use Cake\Core\Configure;

	$addressing = $subscription->participant[0]->fname;
	if ($subscription->wave == 'YOUTH') {
		$addressing .= ' en ' . $subscription->participant[1]->fname;
	}
	
	$numberText = '<b>' . $subscription->participant[0]->number . '</b>';
	
	if ($subsciption->wave == 'YOUTH') {
		$numberText = $subscription->participant[0] . ' heeft borstnummer <b>' . $subscription->participant[0]->number . '</b><br/>';
		$numberText .= $subscription->participant[1] . ' heeft borstnummer <b>' . $subscription->participant[1]->number . '</b><br/>';
	}
?>

<p>Beste <?= $addressing ?>,</p>
<br/>
<div>
	<h2>Stap 3 is voltooid!</h2>
	<p>We hebben uw betaling goed ontvangen! U bent bij deze <b>officieel</b> ingeschreven voor de eerste editie van <b>Crossdorp Oelem</b>!</p>
	<p>Hoera! Hoera! Champagne en bier! Of misschien toch nog even wachten tot na de wedstrijd...</p>
</div>
<br/>
<div>
	<h2>Uw borstnummer: </h2>
	<h1><?= $numberText ?></h1>
	<p>Gelieve uw borstnummer goed bij te houden. De dag van het spektakel kunt u zich aanmelden met dit borstnummer.</p>
</div>
<br/>
<div>
	<h2>Praktische info</h2>
	Alle praktische info en veel meer vindt u op onze website <a href="<?= $baseUrl?>"><?= $baseUrl?></a>.
</div>
<br/>
<div>
	<h2>Veel plezier in uw verder training!</h2>
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

