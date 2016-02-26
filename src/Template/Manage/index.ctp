<div class="row">
	<h1>Inschrijvingen</h1>
</div>
<div ng-controller="manageCtrl" ng-init="searchByFilter()">
	<div class="row" ng-show="showTable">
		<div class="alert alert-danger" ng-show="errorMessage">{{errorMessage}}</div>
		<div class="alert alert-info" ng-show="infoMessage">{{infoMessage}}</div>
		<div class="large-12 column">
			<div class="row">
				<div class="small-3 column">
					<label for="waveFilter">Wave</label>
					<select id="waveFilter" ng-model="filter.wave"
							ng-options="wave.id as wave.label for wave in waveFilterOptions">
					</select>
				</div>
				<div class="small-3 column">
					<label for="validatedFilter">Gevalideerd?</label>
					<select id="validatedFilter" ng-model="filter.validated"
						ng-options="validated.id as validated.label for validated in filterOptions">
					</select>
				</div>
				<div class="small-3 column">
					<label for="payedFilter">Betaald?</label>
					<select id="payedFilter" ng-model="filter.payed"
						ng-options="payed.id as payed.label for payed in filterOptions">
					</select>
				</div>
				<div class="small-3 column">
					<label for="sponsorFilter">Sponsor?</label>
					<select id="sponsorFilter" ng-model="filter.sponsor"
						ng-options="sponsor.id as sponsor.label for sponsor in filterOptions">
					</select>
				</div>
			</div>
			<div>
				<button class="button" role="button" ng-click="searchByFilter()">Zoeken op filter</button>
			</div>
			<div>
				<input type="text" placeholder="Zoekterm" ng-model="searchTerm" maxlength="80"/>
				<button class="button" role="button" ng-click="searchByTerm(searchTerm)">Zoeken op zoekterm</button>
			</div>
			<h4>Aantal inschrijvingen: {{result.count}}/{{result.total}}</h4>
			<table border="1">
				<tr>
					<th>Aangemaakt op</th>
					<th>Code</th>
					<th>Wave</th>
					<th>Naam1</th>
					<th>Naam2</th>
					<th>E-mail</th>
					<th>Gevalideerd</th>
					<th>Betaald</th>
					<th>Details</th>
				</tr>
				<tr ng-repeat="s in result.subscriptions">
					<td>{{s.created}}</td>
					<td>{{s.code}}</td>
					<td>{{s.wave}}</td>
					<td>{{s.participant[0].fname + ' ' + s.participant[0].lname}}</td>
					<td>{{s.participant[1].fname + ' ' + s.participant[1].lname}}</td>
					<td>{{s.participant[0].email}}</td>
					<td>{{s.validated}}</td>
					<td>{{s.payed}}</td>
					<td><a ng-click="openDetails(s.code);">openen</a></td>
				</tr>
			</table>
		</div>
	</div>
	<div class="row" ng-show="!showTable">
		<div class="large-12 column" >
			<div ng-show="subscription.id != ''">
				<div class="alert alert-danger" ng-show="errorMessage">{{errorMessage}}</div>
				<div class="alert alert-info" ng-show="infoMessage">{{infoMessage}}</div>
				<div ng-show="!subscription.payed">
					<label for="new_number1">Borstnummer deelnemer 1</label>
					<input id="new_number1" type="text" ng-model="new_number1"/>
					<div ng-show="subscription.wave == 'YOUTH'">
						<label for="new_number2">Borstnummer deelnemer 2</label>
						<input id="new_number2" type="text" ng-model="new_number2"/>
					</div>
					<button class="button" role="button" ng-click="initiatepayed()">Betaald</button>
				</div>
				<div>
					<div>
						<button class="button" role="button" ng-click="sendMail(subscription.code, 'reminder')" ng-disabled="subscription.payed">Herinnering sturen</button>
						<button class="button alert" role="button" ng-click="initiatedelete(subscription.code)" ng-disabled="subscription.payed">Inschrijving verwijderen</button>
						<a ng-click="closeDetails()">Sluit detail</a>
					</div>
					<table style="float: left;">
						<tr>
							<th colspan="2">Inschrijving</th>
						</tr>
						<tr>
							<td>id</td>
							<td>{{subscription.id}}</td>
						</tr>
						<tr>
							<td>created</td>
							<td>{{subscription.created}}</td>
						</tr>
						<tr>
							<td>code</td>
							<td>{{subscription.code}}</td>
						</tr>
						<tr>
							<td>wave</td>
							<td>{{subscription.wave}}</td>
						</tr>
						<tr>
							<td>payed</td>
							<td>{{subscription.payed }}</td>
						</tr>
						<tr>
							<td>validated</td>
							<td>{{subscription.validated}}</td>
						</tr>
					</table>
					<table style="float: left;">
						<tr>
							<th colspan="2">Deelnemer 1</th>
						</tr>
						<tr>
							<td>id</td>
							<td>{{subscription.participant1.id}}</td>
						</tr>
						<tr>
							<td>gender</td>
							<td>{{subscription.participant1.gender}}</td>
						</tr>
						<tr>
							<td>fname</td>
							<td>{{subscription.participant1.fname}}</td>
						</tr>
						<tr>
							<td>lname</td>
							<td>{{subscription.participant1.lname}}</td>
						</tr>
						<tr>
							<td>email</td>
							<td>{{subscription.participant1.email }}</td>
						</tr>
						<tr>
							<td>dob</td>
							<td>{{subscription.participant1.dob}}</td>
						</tr>
						<tr>
							<td>number</td>
							<td>{{subscription.participant1.number}}</td>
						</tr>
						<tr>
							<td>start_order</td>
							<td>{{subscription.participant1.start_order}}</td>
						</tr>
					</table>
					<table style="float: left;" ng-show="subscription.wave == 'YOUTH'">
						<tr>
							<th colspan="2">Deelnemer 2</th>
						</tr>
						<tr>
							<td>id</td>
							<td>{{subscription.participant2.id}}</td>
						</tr>
						<tr>
							<td>gender</td>
							<td>{{subscription.participant2.gender}}</td>
						</tr>
						<tr>
							<td>fname</td>
							<td>{{subscription.participant2.fname}}</td>
						</tr>
						<tr>
							<td>lname</td>
							<td>{{subscription.participant2.lname}}</td>
						</tr>
						<tr>
							<td>email</td>
							<td>{{subscription.participant2.email }}</td>
						</tr>
						<tr>
							<td>dob</td>
							<td>{{subscription.participant2.dob}}</td>
						</tr>
						<tr>
							<td>number</td>
							<td>{{subscription.participant2.number}}</td>
						</tr>
						<tr>
							<td>start_order</td>
							<td>{{subscription.participant2.start_order}}</td>
						</tr>
					</table>
				</div>
				<div style="clear: both;"></div>
			</div>
			<div ng-show="subscription.id == ''">
				Geen data te tonen
			</div>
		</div>
	</div>	
	<div id="modalPayed" class="reveal" data-reveal aria-labelledby="modalTitle" aria-hidden="true" role="dialog">
  		<h3 id="modalTitle">Weet je 100% zeker dat de inschrijving met code {{subscription.code}} betaald heeft?</h3>
  		<p class="lead">Je staat op het punt de lopers volgende borstnummers toe te kennen:</p>
  		<h2>{{new_number1}}<br/>
  		{{new_number2}}</h2>
  		<p>Weet je zeker dat dit correct is?
  		</p>
  		<button class="button large" data-close role="button" ng-click="payed()">Inschrijver heeft betaald!</button>
  		<button class="alert button large" data-close role="button">Annuleer</button>
	</div>
	<div id="modalDelete" class="reveal" data-reveal aria-labelledby="modalDeleteTitle" aria-hidden="true" role="dialog">
  		<h3 id="modalDeleteTitle">Inschrijving met code {{subscription.code}} verwijderen?</h3>
  		<p class="lead">Je staat op het punt de inschrijving met code {{subscription.code}} te verwijderen.</p>
  		<h2>Deze actie kan niet worden ongedaan gemaakt!</h2>
  		<button class="button large" data-close role="button" ng-click="deleted(subscription.id)">Inschrijving definitief verwijderen</button>
  		<button class="alert button large" data-close role="button">Annuleer</button>
	</div>
	<div id="modalSaving" class="reveal" data-reveal aria-labelledby="modalSavingTitle" aria-hidden="true" role="dialog">
  		<h2 id="modalSavingTitle">Inschrijving opslaan</h2>
  		<p class="lead">Even geduld...</p>
	</div>
	<div id="modalDeleting" class="reveal" data-reveal aria-labelledby="modalDeletingTitle" aria-hidden="true" role="dialog">
  		<h2 id="modalDeletingTitle">Inschrijving verwijderen</h2>
  		<p class="lead">Even geduld...</p>
	</div>
	<div id="modalSearching" class="reveal" data-reveal aria-labelledby="modalSearchingTitle" aria-hidden="true" role="dialog">
  		<h3 id="modalSearchingTitle">Inschrijvingen opzoeken</h3>
  		<p class="lead">Even geduld...</p>
	</div>
	<div id="modalSendingMail" class="reveal" data-reveal aria-labelledby="modalSendingMailTitle" aria-hidden="true" role="dialog">
  		<h3 id="modalSendingMailTitle">E-mail versturen</h3>
  		<p class="lead">Even geduld...</p>
	</div>
	<div id="modalError" class="reveal" data-reveal aria-labelledby="modalErrorTitle" aria-hidden="true" role="dialog">
  		<h3 id="modalErrorTitle">Fout gebeurd</h3>
  		<div class="alert alert-danger">{{saveErrorMessage}}</div>
  		<button class="button large" data-close role="button" ng-click="openDetails(subscription.code);">Sluit</button>
	</div>
</div>