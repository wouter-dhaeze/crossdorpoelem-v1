<?php 

use Cake\I18n\Time;
Time::setToStringFormat('dd/MM/yyyy');

$this->layout = 'cdo-detail';
$this->assign('title', 'Praktische info');

?>

<div>
	<div class="row">
		<p class="lead">Hier vindt u later alle practische info voor deelnemers terug.</p>
	</div>
</div>
