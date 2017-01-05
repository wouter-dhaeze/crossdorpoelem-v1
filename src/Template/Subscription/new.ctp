<?php 

$this->layout = 'cdo-detail';
$this->assign('title', 'Inschrijving');
$this->assign('ogmetadata', 'fb_subscription');

?>

<div ng-controller="subscriptionCtrl">
	<div class="row">
		<div class="alert alert-danger">De Big Run (voor volwassenen) is volledig uitverkocht. U kunt enkel nog inschrijven voor de Duo Run (van 10 tot 14 jaar).</div>
	</div>
	<div id="pnlInfo" class="row animate-show" ng-show="showInfo">
		<h2>Instructies</h2>
		<p class="lead">Om in te schrijven voor Crossdorp Oelem volgt u onderstaande instructies.</p>
		<p>Gelieve deze aandachtig te lezen. De inschrijving gebeurt in 4 stappen:</p>
		<ol>
			<li><b><i>Vul uw gegevens in</i></b><br/>Vul het inschrijvingsformulier in. (Het komt tevoorschijn wanneer u op onderstaande knop klikt.)</li>
			<li><b><i>Valideer uw inschrijving</i></b><br/>Wanneer we uw gegevens uit stap 1 ontvangen hebben, zal u een eerste e-mail ontvangen. Volg de  instructies in de e-mail om uw inschrijving te valideren. Het is dus van uiterst belang dat u een e-mailadres waar u toegang toe heeft, gebruikt.</li>
			<li><b><i>Uw inschrijving betalen</i></b><br/>Wanneer uw inschrijving correct gevalideerd werd, zal u een tweede e-mail ontvangen met daarin de betaalgegevens. Volg opnieuw de instructies in de e-mail. (Sponsors krijgen ook deze mail maar hoeven niet te betalen.)</li>
			<li><b><i>Uw inschrijving is voltooid</i></b><br/>Wanneer we uw betaling ontvangen hebben sturen we u een derde e-mail (dit kan evenwel enkele dagen duren). Daarin vindt u de bevestiging van uw betaling en uw borstnummer.</li>
		</ol>
		<p><b><i>Let op: U bent pas officieel ingeschreven nadat we uw betaling per storting ontvangen hebben! Wanneer u wacht om te betalen tot de dag zelf bestaat de kans dat de wedstrijd reeds volzet is.</i></b></p>
		<button class="button" role="button" ng-click="showInfo = false">Ik begrijp de instructies en wens me in te schrijven.</button>
	</div>
	<div ng-hide="showInfo" class="animate-show">
		<div id="pnlSubscriptionInput" ng-hide="subscriptionSuccess">
			<div class="row">
				<h2>Uw gegevens</h2>
				<p class="lead">Vul hieronder uw gegevens in. Eerst kiest u de wave waarvoor u wenst in te schrijven. Daarna komt het formulier tevoorschijn.</p>
				<h3>Kies je wave</h3>
				<div>
					<p>Voor meer info over het verschil tussen "Big Run" en "Duo run" <a ng-click="openMoreInfo()">klik hier</a>.</p>
				</div>
				<select class="large-6" ng-model="subscription.wave"
					ng-options="wave.id as wave.label disable when wave.notAnOption for wave in waveOptions"
					ng-change="waveSelected()">
				</select>
			</div>
			<div ng-hide="subscription.wave == 'CHOOSE'">
				<!-- <div class="alert alert-warning" ng-show="aSubscriptionForm.$invalid && ySubscriptionForm.$invalid">Formulier nog niet volledig correct ingevuld.</div> -->
				<form name="aSubscriptionForm" novalidate>
					<div id="pnl-adult" class="row" ng-show="subscription.wave == 'ADULT'">
						<h3>Deelnemer - 6 KM</h3>
						<?= $this->element('create_participant', 
								["formName" => 'aSubscriptionForm',
								"idPrefix" => 'a',
								"ngmodelId" => "subscription.participant1.id",
								"maleLabel" => "Ik ben een man",
								"femaleLabel" => "Ik ben een vrouw",
								"ngmodelGender" => "subscription.participant1.gender",
								"ngmodelFirstName" => "subscription.participant1.fname",
								"ngmodelLastName" => "subscription.participant1.lname",
								"ngmodelEmail" => "subscription.participant1.email",
								"ngmodelDob" => "subscription.participant1.dob",
								"ngmodelNumber" => "subscription.participant1.number",
								"ngHideNumber" => true,
								"ngmodelOrder" => "subscription.participant1.start_order",
								"ngHideOrder" => true]); ?>
					</div>
				</form>
				<form name="ySubscriptionForm" novalidate>
					<div id="pnl-youth" class="row" ng-show="subscription.wave == 'YOUTH'">
						<h3>Deelnemer 1 - 1,5 KM</h3>
						<div>
							<?= $this->element('create_participant', 
								["formName" => 'ySubscriptionForm',
								"idPrefix" => 'y1',
								"ngmodelId" => "subscription.participant1.id",
								"maleLabel" => "Ik ben een jongen",
								"femaleLabel" => "Ik ben een meiske",
								"ngmodelGender" => "subscription.participant1.gender",
								"ngmodelFirstName" => "subscription.participant1.fname",
								"ngmodelLastName" => "subscription.participant1.lname",
								"ngmodelEmail" => "subscription.participant1.email",
								"ngmodelDob" => "subscription.participant1.dob",
								"ngmodelNumber" => "subscription.participant1.number",
								"ngHideNumber" => true,
								"ngmodelOrder" => "subscription.participant1.start_order",
								"ngHideOrder" => true]); ?>
						</div>
						<h3>Deelnemer 2 - 1 KM</h3>
						<div>
							<?= $this->element('create_participant', 
								["formName" => 'ySubscriptionForm',
								"idPrefix" => 'y2',
								"ngmodelId" => "subscription.participant2.id",
								"maleLabel" => "Ik ben een jongen",
								"femaleLabel" => "Ik ben een meiske",
								"ngmodelGender" => "subscription.participant2.gender",
								"ngmodelFirstName" => "subscription.participant2.fname",
								"ngmodelLastName" => "subscription.participant2.lname",
								"ngmodelEmail" => "subscription.participant2.email",
								"ngmodelDob" => "subscription.participant2.dob",
								"ngmodelNumber" => "subscription.participant2.number",
								"ngHideNumber" => true,
								"ngmodelOrder" => "subscription.participant2.start_order",
								"ngHideOrder" => true]); ?>
						</div>
					</div>
				</form>
				
				<form name="consentForm" novalidate>
					<input style="float: left" id="consent" type="checkbox" name="consent" ng-model="subscription.consent"><label for="consent">Door dit aan te vinken verklaart u dat u of de loper(s) waarvoor u inschrijft, fit en gezond zijn om aan de wedstrijd deel te nemen.</label>
					<div style="clear: both"></div>
				</form>
				<form name="sponsorForm" novalidate
					ng-submit="subscribe()">
					<div id="pnl-sponsor" class="row">
						<h3>Sponsor code</h3>
						<div>Heeft u een code, gelieve dan de code hieronder in te
							vullen. Let wel, een code kan slechts &eacute;&eacute;nmaal
							gebruikt worden.</div>
						<input type="text" placeholder="Code" style="text-transform: uppercase" maxlength="6"
							ng-model="subscription.code"/>
					</div>
					<button class="button large" role="button" ng-disabled="aSubscriptionForm.$invalid || (subscription.wave == 'YOUTH' && ySubscriptionForm.$invalid) || !subscription.consent">Inschrijven</button>
				</form>
			</div>
		</div>
		<div id="pnlSubscriptionSuccess" class="row" style="text-align: center;" ng-show="subscriptionSuccess">
			<p><b><i>Hoera! We hebben uw inschrijvingsgegevens goed ontvangen!</i></b></p>
			<img src="../img/haas-blij.png"></img>
			<p class="lead">Binnen enkele ogenblikken ontvangt u een e-mail op het adres <a href="mailto:{{subscription.participant1.email}}">{{subscription.participant1.email}}</a>. Gelieve de instructies in deze e-mail goed op te volgen. Nog drie stappen en u bent ingeschreven!</p>
			<p style="text-align: left;">Mocht u de e-mail na enkele uren niet ontvangen hebben, gelieve dan eerst even uw spam-box te bekijken en daarna eventueel opnieuw te proberen met een ander e-mail adres. Mocht dit niet lukken, kunt u een e-mail sturen naar <a href="mailto:inschrijving@crossdorpoelem.be">inschrijving@crossdorpoelem.be</a>. We proberen die zo snel mogelijk te beantwoorden.</p>
		</div>
		<div id="modalSaving" class="reveal" data-reveal aria-labelledby="modalTitle" aria-hidden="true" role="dialog">
  			<h2 id="modalTitle">Inschrijving opslaan</h2>
  			<p class="lead">Even geduld... Uw gegevens worden opgeslaan.</p>
		</div>
		<div id="modalSaveFail" class="reveal" data-reveal aria-labelledby="modalTitle" aria-hidden="true" role="dialog">
  			<h2 id="modalTitle">Inschrijving mislukt</h2>
  			<p class="lead">Er is een fout opgetreden bij het bewaren van uw inschrijving:</p>
  			<div class="alert alert-danger">{{errorMessage}}</div>
  			<button class="alert button large" data-close role="button">Sluit bericht</button>
		</div>
		<div id="modalMoreInfo" class="reveal" data-reveal aria-labelledby="modalTitle" aria-hidden="true" role="dialog">
  			<h2 id="modalTitle">Extra info</h2>
  			<p class="lead">Wat is het verschil tussen de "Big Run" en de "Duo Run"</p>
  			<div><h4>Big Run</h4>
  				<ul>
  					<li><b>Voor (jong)volwassenen</b>: Bent u 14 of ouder (geboren in jaar 2002 of vroeger) dan neemt u deel aan de "Big Run".</li>
  					<li>Het parcours is om en bij de <b>6 km lang</b>.</li>
  					<li>U legt het volledige parcours <b>alleen</b> af.</li>
  					<li>Uw inschrijving kost <b>6 euro</b>.</li>
  				</ul>
  			</div>
			<div><h4>Duo Run</h4>
  				<ul>
  					<li><b>Voor jongeren</b>: Bent u tussen de 10 en 13 jaar oud (geboren tussen 01/01/2003 en 31/12/2006) dan neemt u deel aan de "Duo Run".</li>
  					<li>Het parcours is om en bij de <b>2,5 km lang</b>.</li>
  					<li>Jullie schrijven in <b>in duo</b> en lopen om beurt een stuk van het parcours. Na ongeveer 1,5 km is er een aflossing en gaat je teamgenoot verder met de rest van het parcours.</li>
  					<li>Uw inschrijving kost <b>6 euro per duo</b>. (Dus voor alle duidelijkheid, jullie betalen &eacute;&eacute;nmalig 6 euro.)</li>
  				</ul>
  			</div>
  			<button class="button large" data-close role="button">Sluit venster</button>
		</div>
	</div>
</div>