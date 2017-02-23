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
		<button class="button" role="button" ng-click="start()">Ik begrijp de instructies en de inschrijving te starten.</button>
	</div>
	<div ng-hide="showInfo" class="row animate-show">
		<h2>
			<span class="float-left">Inschrijving</span>&nbsp;
		</h2>
		<div class="clearfix">
			<div class="float-left">
				<h3>Aantal deelnemers: {{subscription.members.length}}</h3>
				<h3>Totaal kost: &euro;{{cost}}</h3>
			</div>
			<div class="float-left"  style="padding-left: .5em">
				<button class="button success large" role="button" 
					ng-show="subscription.members.length > 0 && (subscription.members[0].participant || subscription.members.length > 1)"
					ng-click="initFinalize()">Inschrijven!</button>
			</div>
		</div>
		<div>
			<button class="button" role="button" ng-click="newMember(false, true)">Deelnemer toevoegen</button>
		</div>
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
						"ngHideNumber" => true,
						"ngmodelNumber" => "member.number",
						"ngmodelWave" => "member.wave",
						"ngHideParticipant" => false,
						"ngmodelParticipant" => "member.participant",
						"ngHideValidated" => true,
						"ngmodelValidated" => "member.validated",
						"ngHideConsent" => true,
						"ngmodelConsent" => "member.consent",
						"ngHidePublicProfile" => true,
						"ngmodelPublicProfile" => "member.public_profile"]); ?>	
					</form>
					</div>
					<div>
						<button class="button" role="button" ng-click="editMember($index)">Wijzigen</button>
						<button ng-show="$index > 0" class="button alert" role="button" ng-click="initRemoveMember($index)">Verwijderen</button>
					</div>				
			</div>
		</div>		
	</div>
	<div id="modalStartSubscription" class="reveal" data-reveal aria-hidden="true" role="dialog">
		<div ng-show="step == 1">
			<p class="lead">Kies een optie</p>
			<button class="button" role="button" ng-click="createSubscriber(true)">Ik schrijf mezelf en eventueel ook anderen in</button> of 
			<button class="button" role="button" ng-click="createSubscriber(false)">Ik schrijf enkel anderen in</button>
		</div>
	</div>
	<div id="modalEditMember" class="full reveal" data-reveal>
		<div ng-show="step == 2">
			<h2 id="modalTitle">Vul uw gegevens in</h2>
			<form name="memberForm" novalidate>
				<div class="row">
					<?= $this->element('member_details', 
						["formName" => 'memberForm',
						"ngMemberIndex" => "edit",
						"ngReadonly" => false,
						"ngmodelId" => "currentMember.id",
						"maleLabel" => "Man",
						"femaleLabel" => "Vrouw",
						"ngmodelFirstName" => "currentMember.fname",
						"ngmodelLastName" => "currentMember.lname",
						"ngmodelGender" => "currentMember.gender",
						"ngmodelDob" => "currentMember.dob",
						"ngmodelEmail" => "currentMember.email",
						"ngmodelPcode" => "currentMember.pcode",
						"ngHideCode" => false,
						"ngmodelCode" => "currentMember.code",
						"ngHideNumber" => true,
						"ngmodelNumber" => "currentMember.number",
						"ngmodelWave" => "currentMember.wave",
						"ngHideParticipant" => true,
						"ngmodelParticipant" => "currentMember.participant",
						"ngHideValidated" => true,
						"ngmodelValidated" => "currentMember.validated",
						"ngHideConsent" => true,
						"ngmodelConsent" => "currentMember.consent",
						"ngHidePublicProfile" => true,
						"ngmodelPublicProfile" => "currentMember.public_profile"]); ?>
				</div>
				<div class="row">
					<button ng-show="currentMemberIndex == -1" ng-disabled="!memberForm.$valid" class="button" role="button" ng-click="addEditMember()">Toevoegen</button>
					<button ng-show="currentMemberIndex > -1" class="button" role="button" ng-click="updateEditMember()">Aanpassen</button>
					<a ng-show="subscription.members.length > 0" ng-click="cancelEditMember()">Annuleren</a>
				</div>
			</form>
		</div>
  		
	</div>
	<div id="modalRemoveMember" class="reveal" data-reveal>
		<h1>Deelnemer verwijderen</h1>
		<p class="lead">Weet je zeker dat je deze deelnemer wil verwijderen?</p>
		<div>
			<button class="button alert" role="button" ng-click="removeMember()">Verwijderen</button>
			<a ng-click="cancelRemoveMember()">Annuleren</a>
		</div>  
	</div>
	<div id="modalFinalize" class="reveal" data-reveal>
		<h1>Bevestig uw inschrijving.</h1>
		<p class="lead">Onderstaande personen worden ingeschreven:</p>
		<div>
			<button class="button success" role="button" ng-click="submitSubscription()">Bevestigen</button>
			<a ng-click="cancelFinalize()">Gegevens aanpassen</a>
		</div>  
	</div>
</div>

<?php 
$this->start('script');
?>

	<script src="/js/cdo-subscription.js"></script>

<?php 
$this->end();
?>