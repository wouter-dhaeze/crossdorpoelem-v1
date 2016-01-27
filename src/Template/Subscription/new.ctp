<div ng-app="subscriptionApp" ng-controller="subscriptionCtrl">
	<div id="pnlInfo" class="row animate-show" ng-show="showInfo">
		<p>Om in te schrijven voor Crossdorp Oelem volgt u onderstaande procedure.</p>
		<p>Gelieve de instructies aandachtig te lezen om uw inschrijving tot een goed einde te brengen.</p>
		<ol>
			<li><b><i>Vul uw gegevens in:</i></b> Vul het inschrijvingsformulier in. (Het komt tevoorschijn wanneer u op onderstaande knop klikt.)</li>
			<li><b><i>Valideer uw inschrijving:</i></b> Wanneer we uw gegevens uit stap 1 ontvangen hebben, zal u een eerste email ontvangen. Volg de eenvoudige instructies in de mail om uw inschrijving te valideren.</li>
			<li><b><i>Uw inschrijving betalen:</i></b> Wanneer uw inschrijving correct gevalideerd werd, zal u een tweede mail ontvangen met daarin de betaalgegevens. Volg opnieuw de instructies in de email. (Sponsors krijgen ook deze mail maar hoeven niet opnieuw te betalen.)</li>
			<li><b><i>Uw inschrijving is voltooid:</i></b> Wanneer we uw betaling ontvangen hebben sturen we u een derde mail. Daarin vindt u de bevestiging van uw betaling en uw borstnummer.</li>
		</ol>
		<p>Let op: U bent pas officieel ingeschreven nadat we uw betaling hebben ontvangen!</p>
		<button class="button" role="button" ng-click="showInfo = false">Ik begrijp de instructies en wens me in te schrijven.</button>
	</div>
	<div ng-hide="showInfo" class="animate-show">
		<div id="pnlSubscriptionInput" ng-hide="subscriptionSuccess">
			<div class="row">
				<h3>Kies je wave</h3>
				<div ng-show="subscription.wave.id == 'CHOOSE'">
					<span>Kies hieronder de wave waarvoor u wenst voor in te schrijven:</span>
					Hier nog popup met extra info toevoegen
				</div>
				<select class="large-6" ng-model="subscription.wave"
					ng-options="wave.label disable when wave.notAnOption for wave in waveOptions"
					ng-change="waveSelected()">
				</select>
			</div>
			<div class="alert alert-warning" ng-show="aSubscriptionForm.$invalid && ySubscriptionForm.$invalid">Formulier nog niet volledig correct ingevuld.</div>
			<div ng-hide="subscription.wave.id == 'CHOOSE'">
				<form name="aSubscriptionForm" novalidate>
					<div id="pnl-adult" class="row" ng-show="subscription.wave.id == 'ADULT'">
						<h3>Deelnemer - 5 KM</h3>
						<?= $this->element('participant', 
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
					<div id="pnl-youth" class="row" ng-show="subscription.wave.id == 'YOUTH'">
						<h3>Deelnemer 1 - 1,5 KM</h3>
						<div>
							<?= $this->element('participant', 
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
							<?= $this->element('participant', 
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
				<form name="subscriptionForm" novalidate
					ng-submit="subscribe()">
					<div id="pnl-sponsor" class="row">
						<h3>Sponsor code</h3>
						<div>Heeft u een code, gelieve dan de code hieronder in te
							vullen. Let wel, een code kan slechts &eacute;&eacute;nmaal
							gebruikt worden.</div>
						<input type="text" placeholder="Code" 
							ng-model="subscription.code"/>
					</div>
					<button class="button large" role="button" ng-disabled="aSubscriptionForm.$invalid && ySubscriptionForm.$invalid">Inschrijven</button>
				</form>
			</div>
		</div>
		<div id="pnlSubscriptionSuccess" ng-show="subscriptionSuccess">
			<p>We hebben uw inschrijvingsaanvraag goed ontvangen.</p>
			<p>Binnen enkele ogenblikken ontvangt u een mail op het email adres: {{subscription.participant1.email}}. Gelieve de instructie in deze mail goed op te volgen. Nog twee stappen en u bent ingeschreven!</p>
			<p>Mocht u de email na enkele uren niet ontvangen, gelieve dan een mail te sturen naar <a href="mailto:inschrijving@crossdorpoelem.be">inschrijving@crossdorpoelem.be</a>.</p>
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
	</div>
</div>