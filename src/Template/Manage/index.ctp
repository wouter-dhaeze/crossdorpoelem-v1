
<div ng-controller="manageSubscriptionCtrl" ng-init="loadSubscriptions()">
	<div  class="row" ng-show="showOverview">
		<h1>Inschrijvingen</h1>
		<div class="row">
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
		<div class="row">
			<div class="small-12 medium-6 large-4 column">
				<b>Totaal aantal deelnemers: {{totalMembers}}</b>
			</div>
			<div class="small-12 medium-6 large-4 column">
				<b>Totaal gevalideerde deelnemers: {{totalValidatedMembers}}</b>
			</div>
			<div class="small-12 medium-6 large-4 column">
			</div>
		</div>
		<div class="row">
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
		<div class="row">
			<div class="small-12 column">
				<h3>Totaal inkomsten: {{totalRevenue}}</h3>
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
			<tr ng-repeat="s in subscriptions track by $index">
				<td>{{$index}}</td>
				<td>{{s.created}}</td>
				<td>{{s.code}}</td>
				<td>{{s.price}}</td>
				<td>{{s.members[0].fname + ' ' + s.members[0].lname}}</td>
				<td>{{s.members[0].email}}</td>
				<td>{{s.validated}}</td>
				<td>{{s.payed}}</td>
				<td><a ng-click="openDetails(s.code);">openen</a></td>
			</tr>
		</table>
	</div>
	<div class="row"  ng-show="showDetail">
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
					<button class="button large" role="button" 
						ng-click="showDetail = false; showOverview = true; subscription = null; loadSubscriptions()">Sluiten</button>
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
								"ngHideCode" => true,
								"ngmodelCode" => "member.code",
								"ngHideNumber" => "!member.participant",
								"ngmodelNumber" => "member.number",
								"ngmodelWave" => "member.wave",
								"ngHideParticipant" => true,
								"ngmodelParticipant" => "member.participant",
								"ngHideValidated" => true,
								"ngmodelValidated" => "member.validated",
								"ngHideConsent" => true,
								"ngmodelConsent" => "member.consent",
								"ngHidePublicProfile" => true,
								"ngmodelPublicProfile" => "member.public_profile"]); ?>	
							</form>
							</div>				
					</div>
				</div>	
			</div>
		</div>
	</div>
	<div id="modalWait" class="reveal" data-reveal>
		<h1>Gegevens worden geladen</h1>
		<p class="lead">Efkes geduld...</p> 
	</div>
</div>

<?php 
$this->start('script');
?>

	<script src="/js/cdo-models.js"></script>
	<script src="/js/cdo-manage-subscription.js"></script>

<?php 
$this->end();