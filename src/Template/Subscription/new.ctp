<?php 

$this->layout = 'cdo-detail';
$this->assign('title', 'Inschrijving');
$this->assign('ogmetadata', 'fb_subscription');

?>

<div ng-controller="subscriptionCtrl">
	<div id="pnlInfo" class="row animate-show" ng-show="showInfo">
		<h2>Instructies</h2>
		<p class="lead">Om in te schrijven voor Crossdorp Oelem volgt u onderstaande instructies.</p>
		<p>Gelieve deze aandachtig te lezen. De inschrijving gebeurt in 4 stappen:</p>
		<ol>
			<li><b><i>Vul uw gegevens in</i></b><br/>Vul het inschrijvingsformulier in. U schrijft uzelf en eventueel meerder kompanen in, ofwel vult u het inschrijvingsformulier voor een ander in. Let wel: <b>De inschrijver betaald!</b>(Het komt tevoorschijn wanneer u op onderstaande knop klikt.)</li>
			<li><b><i>Valideer uw inschrijving</i></b><br/>Wanneer we uw gegevens uit stap 1 ontvangen hebben, zal u een eerste e-mail ontvangen. Volg de  instructies in de e-mail om uw inschrijving te valideren. Het is dus van uiterst belang dat u een e-mailadres gebruit waar u toegang toe heeft. Inschrijvingen die niet binnen 7 dagen werden gevalideerd, worden verwijderd uit ons bestand.</li>
			<li><b><i>Uw inschrijving betalen</i></b><br/>Wanneer uw inschrijving correct gevalideerd werd, zal u een tweede e-mail ontvangen met daarin de betaalgegevens. Volg opnieuw de instructies in de e-mail. (Sponsors krijgen ook deze mail maar hoeven niet te betalen.)</li>
			<li><b><i>Uw inschrijving is voltooid</i></b><br/>Wanneer we uw betaling ontvangen hebben sturen we u een derde e-mail (dit kan evenwel enkele dagen duren). Daarin vindt u de bevestiging van uw betaling. Uw ingeschreven deelnemers krijgen per e-mail hun borstnummer toegestuurd.</li>
		</ol>
		<p><b><i>Let op: U bent pas officieel ingeschreven nadat we uw betaling per bankverrichting ontvangen hebben! Wanneer u wacht om te betalen tot de dag zelf bestaat de kans dat de wedstrijd reeds volzet is.</i></b></p>
		<button class="button" role="button" ng-click="showInfo = false">Ik begrijp de instructies en de inschrijving te starten.</button>
	</div>
</div>

<?php 
$this->start('script');
?>

	<script src="/js/cdo-subscription.js"></script>

<?php 
$this->end();
?>