
<div ng-controller="manageSubscriptionCtrl" ng-init="loadSubscriptions()">
	<div ng-show="showOverview">
	<ul class="tabs" data-tabs id="subscriptionTabls">
	  <li class="tabs-title is-active"><a href="#panelSubsciption" aria-selected="true">Inschrijvingen</a></li>
	  <li class="tabs-title"><a href="#panelParticipant">Deelnemers</a></li>
	</ul>

	<div class="tabs-content" data-tabs-content="subscriptionTabls">
	  <div class="tabs-panel is-active" id="panelSubsciption">
	    
	    
		<h1>Inschrijvingen</h1>
		<div class="">
			<div class="small-12 medium-6 large-4 column">
				<b>Totaal aantal inschrijvingen: {{totalSubscriptions}}</b>
			</div>
			<div class="small-12 medium-6 large-4 column">
				<b>Totaal gevalideerde inschrijvingen: {{totalValidatedSubscriptions}}</b>
			</div>
			<div class="small-12 medium-6 large-4 column">
				<b>Totaal betaalde inschrijvingen: {{totalPayedSubscriptions}}</b>
			</div>
		</div>
		<div class="">
			<div class="small-12 medium-6 large-4 column">
				<b>Totaal aantal deelnemers: {{totalMembers}}</b>
			</div>
			<div class="small-12 medium-6 large-4 column">
				<b>Totaal gevalideerde deelnemers: {{totalValidatedMembers}}</b>
			</div>
			<div class="small-12 medium-6 large-4 column">
			</div>
		</div>
		<div class="">
			<div class="small-12 medium-6 large-4 column">
				<b>Totaal 5KM: {{payed5KM}}/{{total5KM}}</b>
			</div>
			<div class="small-12 medium-6 large-4 column">
				<b>Totaal 10KM: {{payed10KM}}/{{total10KM}}</b>
			</div>
			<div class="small-12 medium-6 large-4 column">
				<b>Totaal PARTY: {{payedPARTY}}/{{totalPARTY}}</b>
			</div>
		</div>
		<div class="">
			<div class="small-12 column">
				<h3>Totaal inkomsten: {{totalRevenue}}</h3>
			</div>
		</div>
		<div>
			<div class="row">
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
				</div>
				<div class="small-3 column">
				</div>
			</div>
			<div class="row">
				<div class="column">
					<button class="button" role="button" ng-click="applyFilter()">Filter</button>
					<button class="button" role="button" ng-click="clearFilter()">Clear</button>
				</div>
			</div>
		</div>
		<div class="">
			<div class="small-12 column">
				<h3>Code zoeken</h3>
				<input type="text" placeholder="Code" ng-model="searchCode" maxlength="10" />
				<button class="button" role="button" ng-click="searchByCode(searchCode)">Zoeken op code</button>
			</div>
		</div>
		<table border="1">
			<tr>
				<th></th>
				<th>Aangemaakt op</th>
				<th>Code</th>
				<th>Prijs</th>
				<th>Inschrijver</th>
				<th>E-mail</th>
				<th>Gevalideerd</th>
				<th>Betaald</th>
				<th>Details</th>
			</tr>
			<tr ng-repeat="s in filteredSubscriptions track by $index">
				<td>{{$index + 1}}</td>
				<td>{{s.created}}</td>
				<td>{{s.code}}</td>
				<td>{{s.price}}</td>
				<td>{{s.members[0].fname + ' ' + s.members[0].lname}}</td>
				<td>{{s.members[0].email}}</td>
				<td>{{s.validated}}</td>
				<td>{{s.payed}}</td>
				<td><a ng-click="openSubscriptionDetails(s.code);">openen</a></td>
			</tr>
		</table>

	    
	    
	  </div>
	  <div class="tabs-panel" id="panelParticipant">
	    <h1>Deelnemers</h1>
	    <table border="1">
			<tr>
				<th>Naam</th>
				<th>Email</th>
				<th>Wave</th>
				<th>Code</th>
				<th>Borstnummer</th>
				<th>Gevalideerd</th>
				<th>Details</th>
			</tr>
			<tbody ng-repeat="s in subscriptions">
				<tr ng-repeat="m in s.members">
					<td>{{m.fname + ' ' + m.lname}}</td>
					<td>{{m.email}}</td>
					<td>{{m.wave}}</td>
					<td>{{m.code}}</td>
					<td>{{m.number}}</td>
					<td>{{m.validated}}</td>
					<!-- <td><a ng-click="alert('Knopke nie werkt niet goed maar Haas weet het.');">openen</a></td>  -->
					<td>Nog niet klaar</td>
				</tr>
			</tbody>
		</table>
	  </div>
	</div>
	</div>
	
	<div class="row"  ng-show="showSubscriptionDetail">
		<h1>Inschrijving - {{subscription.code}}</h1>
		<div class="small-12 column">
			<div class="row">
				<div class="large-2 columns">
					<label for="code">Code</label>
				</div>
				<div class="large-10 columns">
					<input type="text" id="code" name="code"
						ng-model="subscription.code" ng-readonly="true"></input>
				</div>
			</div>
			<div class="row">
				<div class="large-2 columns">
					<label for="created">Created</label>
				</div>
				<div class="large-10 columns">
					<input type="text" id="created" name="created"
						ng-model="subscription.created" ng-readonly="true"></input>
				</div>
			</div>
			<div class="row">
				<div class="large-2 columns">
					<label for="price">Price</label>
				</div>
				<div class="large-10 columns">
					<input type="text" id="price" name="price"
						ng-model="subscription.price" ng-readonly="true"></input>
				</div>
			</div>
			<div class="row">
				<div class="large-2 columns">
					<label for="validated">Validated?</label>
				</div>
				<div class="large-10 columns">
					<input type="checkbox" id="validated" name="validated"
							ng-model="subscription.validated" ng-disabled="true"></input>
				</div>
			</div>
			<div class="row">
				<div class="large-2 columns">
					<label for="payed">Payed?</label>
				</div>
				<div class="large-10 columns">
					<input type="checkbox" id="payed" name="payed"
							ng-model="subscription.payed" ng-disabled="true"></input>
				</div>
			</div>
			<div class="row">
				<div>
					<button class="button large" role="button" 
						ng-disabled="!subscription.validated || subscription.payed" ng-click="payedAction()">Betaald</button>
				</div>
				<div>
					<button class="button large alert" role="button" 
						ng-disabled="subscription.payed" ng-click="initiateDelete()">Verwijderen</button>
				</div>
				<div>
					<button class="button large" role="button" 
						ng-click="showSubscriptionDetail = false; showMemberDetail = false; showOverview = true; subscription = null; loadSubscriptions()">Sluiten</button>
				</div>
			</div>
			<div class="row">
				<div ng-repeat="member in subscription.members track by $index">
					<div class="callout">
						<div>
							<div class="callout primary" ng-show="member.subscriber">
								<p>Dit is de inschrijver.</p>
							</div>
							<form name="memberForm{{$index}}" novalidate>
							<?= $this->element('member_details', 
								["formName" => 'memberForm{{$index}}',
								"ngMemberIndex" => '{{$index}}',
								"ngReadonly" => true,
								"ngmodelId" => "member.id",
								"maleLabel" => "Man",
								"femaleLabel" => "Vrouw",
								"ngmodelFirstName" => "member.fname",
								"ngmodelLastName" => "member.lname",
								"ngmodelGender" => "member.gender",
								"ngmodelDob" => "member.dob",
								"ngmodelEmail" => "member.email",
								"ngmodelPcode" => "member.pcode",
								"ngHideCode" => false,
								"ngmodelCode" => "member.code",
								"ngHideNumber" => "!member.participant",
								"ngmodelNumber" => "member.number",
								"ngmodelWave" => "member.wave",
								"ngHideParticipant" => false,
								"ngmodelParticipant" => "member.participant",
								"ngHideValidated" => false,
								"ngmodelValidated" => "member.validated",
								"ngHideConsent" => false,
								"ngmodelConsent" => "member.consent",
								"ngHidePublicProfile" => false,
								"ngmodelPublicProfile" => "member.public_profile"]); ?>	
							</form>
							</div>				
					</div>
				</div>	
			</div>
		</div>
	</div>
	
	<div class="row"  ng-show="showMemberDetail">
		<h1>Deelnemer - {{member.code}}</h1>
		<div class="small-12 column">
			<div class="row">
				buttons
			</div>
			<div class="row">
				<div class="callout">
					<div>
						<div class="callout primary" ng-show="member.subscriber">
							<p>Dit is de inschrijver.</p>
						</div>
						<form name="memberForm{{$index}}" novalidate>
						<?= $this->element('member_details', 
							["formName" => 'memberForm{{$index}}',
							"ngMemberIndex" => '{{$index}}',
							"ngReadonly" => true,
							"ngmodelId" => "member.id",
							"maleLabel" => "Man",
							"femaleLabel" => "Vrouw",
							"ngmodelFirstName" => "member.fname",
							"ngmodelLastName" => "member.lname",
							"ngmodelGender" => "member.gender",
							"ngmodelDob" => "member.dob",
							"ngmodelEmail" => "member.email",
							"ngmodelPcode" => "member.pcode",
							"ngHideCode" => true,
							"ngmodelCode" => "member.code",
							"ngHideNumber" => "!member.participant",
							"ngmodelNumber" => "member.number",
							"ngmodelWave" => "member.wave",
							"ngHideParticipant" => true,
							"ngmodelParticipant" => "member.participant",
							"ngHideValidated" => false,
							"ngmodelValidated" => "member.validated",
							"ngHideConsent" => false,
							"ngmodelConsent" => "member.consent",
							"ngHidePublicProfile" => false,
							"ngmodelPublicProfile" => "member.public_profile"]); ?>	
						</form>
						</div>				
				</div>	
			</div>
		</div>
	</div>
	
	<div id="modalWait" class="reveal" data-reveal>
		<h1>Gegevens worden geladen</h1>
		<p class="lead">Efkes geduld...</p> 
	</div>
	
	<div id="modalDelete" class="reveal" data-reveal aria-labelledby="modalDeleteTitle" aria-hidden="true" role="dialog">
  		<h3 id="modalDeleteTitle">Inschrijving met code {{subscription.code}} verwijderen?</h3>
  		<p class="lead">Je staat op het punt de inschrijving met code {{subscription.code}} te verwijderen.</p>
  		<h2>Deze actie kan niet worden ongedaan gemaakt!</h2>
  		<button class="button large" data-close role="button" ng-click="deletedSelected()">Inschrijving definitief verwijderen</button>
  		<button class="alert button large" data-close role="button">Annuleer</button>
	</div>
</div>

<?php 
$this->start('script');
?>

	<script src="/js/cdo-models.js"></script>
	<script src="/js/cdo-manage-subscription.js"></script>

<?php 
$this->end();