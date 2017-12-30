<?php
	$addressing = $subscription->member[0]->fname;
?>

<p>Beste <?= $addressing ?>,</p>
<br/>
<div>
	<p>Zopas hebben we de deelnemers die u heeft ingeschreven een borstnummer toegekend. Met dit borstnummer kan elke 
	deelnemer zich aanmelden aan de inschrijvingsstand.</p>
	<p>Hieronder vind je een overzicht van de toegekende borstnummers. Indien u uw deelnemers onder eenzelfde borstnummer inschreef,
	gelieve dit nummer dan door te geven aan de desbetreffende persoon.</p>
	<table>
		<?php foreach ($subscription->member as $m) { 
			if ($m->participant) { ?>
		<tr>
			<td><b><?= $m->fname . ' ' . $m->lname ?></b></td>
			<td><b><?= $m->number ?></b></td>
		</tr>
		
		<?php }}?>
		<tr>
		</tr>
	</table>
</div>

<br/>
<br/>
<div>
	Alvast hartelijk dank.<br/>
	<br/>
	<br/>
	Tot gauw
	<br/>
	VZW Feles<br/>
	<a href="https://www.crossdorpoelem.be">https://www.crossdorpoelem.be</a>
</div>
