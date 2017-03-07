<?php
	$subscriber = $subscription->member[0];
	$addressing = $subscriber->fname;
	
	$subscriptionUrl = $baseUrl . '/subscription/' . $subscription->code;
	
?>

<p>Beste <?= $addressing ?>,</p>
<br/>
<div>
	<h2>Stap 3 is voltooid!</h2>
	<p>We hebben uw betaling goed ontvangen! U bent bij deze <b>officieel</b> ingeschreven voor de tweede editie van <b>Crossdorp Oelem</b>!</p>
</div>
<br/>
<div>
	<?php if ($subscriber->participant) {?>
		<p>Binnenkort ontvangt u een laatste mail met uw borstnummer en alle praktische info over de dag zelf.</p>
		<?php if (count($subscription->member) > 1) {?>
			<p>Ook de andere deelnemers die u heeft ingeschreven ontvangen hun borstnummer per mail.</p>
		<?php } ?>
	<?php } else { ?>
		<p>Binnenkort ontvangen de personen die u heeft ingeschreven een mail met daarin hun borstnummer en praktische info over de dag zelf.</p>
	<?php }?>
</div>
<br/>
<div>
	<h2>Uw inschrijving</h2>
	Klik op volgende link om uw inschrijving te bekijken: <a href="<?= $subscriptionUrl?>"><?= $subscriptionUrl?></a>
</div>
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

