<?php
	$addressing = $member->fname;
?>

<p>Beste <?= $addressing ?>,</p>
<br/>
<div>
	<h2>Uw borstnummer</h2>
	<p>Hieronder vind je je borstnummer. Met dit nummer kun je je aanmelden aan de inschrijvingsstand.</p>
	<h2>Jouw borstnummer: </h2>
	<h1><?= $member->number ?></h1>
</div>
<br/>
<div>
	<h2>Praktische Info</h2>
	<h4>De wedstrijd</h4>
	<p>De wedstrijd start om <b>15u in sporthal Den Akker te Oedelem.</b> We raden echter aan om ruimschoots op tijd te komen 
	zodat we iedereen tijdig hun borstnummer kunnen geven. <b>De inschrijvingsstand wordt om 13u30 geopend.</b></p>
	<h4>Parking</h4>
	<p>We laten u ook weten dat de parking aan de sporthal beperkt ter beschikking is. Deze wordt deels ingenomen door de woonwagens van de kermis en deels door de organisatie zelf.
	We raden daarom aan zoveel mogelijk te voet, per fiets of met het openbaar vervoer te komen.
	Mocht u toch de wagen nemen, kunt u parkeren in de wijk Den Akker of op de parking van TC Smash in de Wagenweg. Gelieve uw wagen regelmentair te parkeren.</p>
</div>
<?php if ($subscriber->wave == 'PARTY') {?>
<div>
    <h4>De PartyRun</h4>
	<p>Voor de <b>PARTYRUNNERS</b>: jullie wedstrijd start om <b>14u30</b>. Na het afhalen van je nummer mag je je naar de 
	<b>kantine in de sporthal</b> begeven, alwaar onze <b>huisplaatjesdraaier DJ Smegma</b> jullie warm zal verwelkomen. Hij staat ook
	in voor de opwarming (wink wink). 
        </p>
</div>
<?php }?>
<br/>
<div>
	<h2>Ay, Caramba!</h2>
	<p>Stel dat je in het ongelukkige geval, om welke reden ook, niet kunt deelnemen, dan kun je je borstnummer doorgeven.
	De persoon in kwestie kan zich dan de dag zelf met uw nummer aanmelden en deelnemen. Gelieve de financi&euml;n evenwel onder elkaar te regelen.</p>
	<p><i>Indien mogelijk, stuur ons dan een mailtje aan wie je je borstnummer doorgeeft: <a HREF="mailto:inschrijving@crossdorpoelem.be">inschrijving@crossdorpoelem.be</a>.
	Zo zijn we er zeker van dat er geen malafide figuur met je nummer ervan onder muist.</i></p>
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
