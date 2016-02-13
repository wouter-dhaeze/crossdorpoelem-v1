<?php 

use Cake\I18n\Time;
Time::setToStringFormat('dd/MM/yyyy');

$this->layout = 'cdo-detail';
$this->assign('title', 'Inschrijving');

?>

<div>
	<div class="row">
		<p class="lead">De publieke inschrijvingen zijn nog niet geopend.</p>
		<p>Hou onze website goed in de gaten. We openen de publieke inschrijvingen in het weekend van 20 februari.</p>
	</div>
</div>
