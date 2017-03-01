<?php 

$this->layout = 'cdo-detail';
$this->assign('title', 'Inschrijving');
$this->assign('ogmetadata', 'fb_subscription');

?>

<div ng-controller="subscriptionCtrl">
	<div id="pnlInfo" class="row animate-show" ng-show="step == 1">
		<h2>Instructies</h2>
		<p class="lead">Om in te schrijven voor Crossdorp Oelem volgt u onderstaande instructies.</p>
		<p>Gelieve deze aandachtig te lezen. De inschrijving gebeurt in 4 stappen:</p>
		<ol>
			<li><b><i>Vul uw gegevens in</i></b><br/>Vul het inschrijvingsformulier in. U kunt uzelf en/of anderen inschrijven.
				<div class="callout warning">Let op: de inschrijver stort het volledige bedrag, ook indien die meerdere deelnemers inschrijft.</div>
			</li>
			<li><b><i>Valideer uw inschrijving</i></b><br/>Na het versturen van uw inschrijvingsformulier zal u een eerste e-mail ontvangen. Volg de  instructies in de e-mail om uw inschrijving te valideren. Het is dus van uiterst belang dat u een e-mailadres gebruikt waar u toegang toe heeft.
				<div class="callout warning">Inschrijvingen die niet binnen 7 dagen worden gevalideerd, worden verwijderd.</div>
			</li>
			<li><b><i>Uw inschrijving betalen</i></b><br/>Na validatie zal u een tweede e-mail ontvangen met daarin de betaalgegevens. Volg opnieuw de instructies in de e-mail.
				<div class="callout primary">Indien u van een sponsorkorting gebruik maakt hoeft u enkel het restbedrag over te schrijven.</div>
			</li>
			<li><b><i>Uw inschrijving is voltooid</i></b><br/>Na ontvangst van de betaling ontvangt u een betaalbevestiging per e-mail (dit kan enkele dagen duren). De ingeschreven deelnemers krijgen hun borstnummer per e-mail toegestuurd.</li>
		</ol>
		<div class="callout alert">Let op: u bent pas officieel ingeschreven nadat we uw betaling per bankverrichting ontvangen hebben! Wanneer u wacht om te betalen tot de dag zelf bestaat de kans dat de wedstrijd reeds volzet is.</div>
		<button class="button large" role="button" ng-click="start()">Ik begrijp de instructies, start de inschijving!</button>
	</div>
	<div ng-show="step == 2" class="row animate-show">
		<h2>
			<span>Inschrijving</span>
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
	<div class="row" ng-show="step == 3">
		<div class="small-8 small-centered column">
			<h3>Inschrijving ontvangen</h3>
			<p>Er wordt momenteel een e-mail naar <b>{{subscriberMail}}</b> gestuurd. Gelieve de instructies in de e-mail goed  te volgen om uw inschrijving verder af te handelen.</p>
			<p ng-show="isSponsored">U maakte gebruik van &#233;&#233;n of meerdere <b>geldige sponsorcodes</b>. Het restbedrag bedraagt <b>{{subscription.price}} euro</b>. Ook u, lieve sponsor, verzoeken we vriendelijk uw inschrijving te valideren via de mail die u ontvangt op <b>{{subscriberMail}}</b>.</p>
			<div class="callout secondary warning">
				Let op: inschrijvingen die niet binnen 7 dagen worden gevalideerd, worden verwijderd.
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
		<div>
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
		<p class="lead">Weet u zeker dat alle gegevens correct zijn?</p>
		<div>
			<button class="button success" role="button" ng-click="submitSubscription()">Ja, bevestig mijn inschrijving</button>
			<a ng-click="cancelFinalize()">Nee, gegevens aanpassen</a>
		</div>  
	</div>
	<div id="modalErrorSubscription" class="reveal" data-reveal>
		<div ng-show="isSystemError" class="callout alert">
			<h2>Systeemfout opgetreden</h2>
			<p>{{errorMessages[0]}}</p>
		</div>
		<div ng-show="!isSystemError" class="callout warning">
			<h2>Fout opgetreden</h2>
			<p>Uw inschrijving bevat ongeldige gegevens:</p>
			<ul ng-repeat="m in errorMessages">
				<li>{{m}}</li>
			</ul>
		</div>
		<button class="close-button" data-close aria-label="Close reveal" type="button">
			<span aria-hidden="true">&times;</span>
		</button>
	</div>
	<div id="modalSaving" class="reveal" data-reveal aria-labelledby="modalTitle" aria-hidden="true" role="dialog">
  		<h2 id="modalTitle">Inschrijving versturen naar Zork</h2>
  		<p class="lead">Even geduld... Uw gegevens worden gecontroleerd.</p>
	</div>
</div>

<?php 
$this->start('script');
?>

	<script src="/js/cdo-subscription.js"></script>

<?php 
$this->end();
?>