<?php
	$addressing = $member->fname;
?>

<p>Beste <?= $addressing ?>,</p>
<br/>
<div>
	Nu zaterdag is De Grote Dag aangebroken en gaat Crossdorp Oelem Editie 2 van start.</div>
	<br/>
<?php if (!$subscription->payed && $subscription->validated) { ?>
	<div>
	We hebben echter opgemerkt dat we uw betaling nog niet hebben ontvangen. Mocht je nog niet betaald hebben, kun je dat de dag zelf
	nog doen aan de inschrijvingsstand. Mocht je wel al betaald hebben, laat het ons dan zeker weten door op deze mail te antwoorden.
	</div>
	<br/>
<?php } else if (!$subscription->payed && !$subscription->validated) { ?>
	<div>
	Op <?= $subscription->created ?> heb je je geregistreerd als deelnemer voor Crossdorp Oelem. Je hebt je inschrijving echter nooit afgerond.
	Maar geen nood, het goeie nieuws is dat je de dag zelf nog kunt inschrijven voor de 5 KM of de 10 KM. Dus kom zeker af!
	</div>
	<br/> 
<?php }?>

<div>
	Hieronder vind je nog een aantal praktische zaken ivm. je deelname aan Crossdorp Oelem. (Andere info vind je op de website.)
</div>
<div>
	<ul>
		<?php if ($subscription->payed) {?>
		<li>Uw borstnummer is <b><?= $member->number?></b>. Met dit nummer kunt u zich aanmelden aan de inschrijvingsstand.
			<?php if ($member->wave == '5KM') {?>
				<br/><i>Een aantal personen hebben het verkeerde nummer toegekend gekregen. Bovenstaand borstnummer kan
				verschillen van het nummer die je initïeel gekregen hebt.</i>
			<?php }?>
		</li>
		<?php } ?>
		<?php if ($member->wave == 'PARTY') {?>
			<li>
				De PartyRun start <b>om 14u30 stipt</b>. We raden je aan ruimschoots op tijd te komen om je borstnummer op te pikken. 
			</li>
		<?php } else { ?>
			<li>
				Het startschot voor de 5 KM en de 10 KM wordt <b>om 15u</b> gegeven. We raden je aan ruimschoots op tijd te komen om je borstnummer op te pikken.
			</li>
		<?php } ?>
			<li>
				De inschrijvingsstand is <b>open vanaf 13u30 en sluit uiterlijk om 14u45</b>.
			</li>
		<?php if ($member->wave == '10KM') {?>
			<li>
				Het parcours van de 10 KM gaat over een aantal <b>onverharde wegen</b> en zelfs door een wei. De weersvoorspellingen geven vrij droog weer uit. Maar we laten
				je toch graag weten dat de <b>kans op vuile schoenen</b> bestaat.
			</li>
		<?php } else { ?>
			<li>
				Het parcours gaat een klein stukje over <b>onverharde wegen</b>. De weersvoorspellingen geven vrij droog weer uit. Maar we laten
				je toch graag weten dat de <b>kans op vuile schoenen</b> bestaat.
			</li>
		<?php }?>
			<li>
				Zijn er nog familieleden, vrienden, collega's of heel verre kennissen die nog aarzelen om deel te nemen, geef ze dan een kleine por.
				De inschrijvingsstand is open vanaf 13u30 tot 14u45. <b>Iedereen kan zich nog inschrijven voor de 5 KM of de 10 KM.</b>
			</li>
	</ul>
	
</div>
<br/>
<br/>
<div>
	Alvast hartelijk dank voor uw deelname.<br/>
	<br/>
	<br/>
	Tot gauw
	<br/>
	VZW Feles<br/>
	<a href="https://www.crossdorpoelem.be">https://www.crossdorpoelem.be</a>
</div>
