<div ng-app="subscriptionApp" ng-controller="subscriptionCtrl">
	<h1>debughelp: {{debugHelp}}</h1>
	<form>
		<div class="row">
			<h3>Kies je wave</h3>
			<div>
				<span>Kies hieronder de wave waarvoor je wil inschrijven:</span>
				<ul>
					<li>Jonge jeugd run: nog aanvullen</li>
					<li>Oude jeugd run: nog aanvullen</li>
				</ul>
			</div>

			<select class="large-6" ng-model="selectedWave"
				ng-options="wave.label disable when wave.notAnOption for wave in waveOptions"
				ng-change="waveSelected()">
			</select>

		</div>

		<div ng-hide="selectedWave.id == 'CHOOSE'">
			<div id="pnl-adult" class="row" ng-show="selectedWave.id == 'ADULT'">
				<h3>Deelnemer</h3>
				<?= $this->element('participant', 
						["idPrefix" => 'a',
						"ngmodelGender" => "subscription.aGender",
						"ngmodelFirstName" => "subscription.aFirstName",
						"ngmodelLastName" => "subscription.aLastName",
						"ngmodelEmail" => "subscription.aEmail",
						"ngmodelDob" => "subscription.aDob"]); ?>
			</div>
			<div id="pnl-youth" class="row" ng-show="selectedWave.id == 'YOUTH'">
				<div class="row">
					<div class="large-6 columns">
						<h3>Deelnemer 1 - 1,5 KM</h3>
						
						</div>
					</div>
					<div class="large-6 columns">
						<h3>Deelnemer 2 - 1 KM</h3>
						
					</div>
				</div>
			</div>
			<div id="pnl-sponsor" class="row">
				<h3>Sponsor code</h3>
				<div>Heeft u een sponsor code, gelieve dan de code hieronder in te
					vullen. Let wel, een code kan slechts &eacute;&eacute;n maal
					gebruikt worden.</div>
				<input type="text" placeholder="Sponsorcode" />
			</div>
			<button class="button large" role="button" ng-click="subscribe(subscription)">Inschrijven</button>
		</div>
		
	</form>
</div>