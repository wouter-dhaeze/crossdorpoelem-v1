<?php 

use Cake\I18n\Time;
Time::setToStringFormat('dd/MM/yyyy');

?>

<?php if (empty($subscription)) : ?>
    <div class="callout alert">Er werd geen inschrijving met deze code gevonden.</div>
<?php endif; ?>

<?php if (!empty($subscription)) : ?>
<div ng-controller="subscriptionCtrl"  ng-init="loadSubscription('<?= $subscription->code ?>')">
	<div class="row">
		<h1>Mijn inschrijving</h1>
		<div class="callout warning" ng-show="!subscription.validated">Uw inschrijving werd nog niet gevalideerd. Klik op de link in de mail die u ontving om de validatie af te ronden.</div>
		<div class="callout success" ng-show="subscription.validated">Uw inschrijving is correct gevalideerd.</div>
		<div class="callout alert" ng-show="!subscription.payed">We hebben uw storting nog niet ontvangen. Indien u reeds heeft betaald zal u binnenkort een bevestigingsmail ontvangen.
		Indien u nog niet heeft betaald, bent u nog niet officieel ingeschreven. Gelieve de betalingsgegevens terug te vinden in de mail die u ontving.</div>
		<div class="callout success" ng-show="subscription.payed">We hebben uw betaling correct ontvangen. U mag zich officieel deelnemer van Crossdorp Oelem noemen. Succes!</div>
		
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
						"ngHideNumber" => false,
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
<?php endif; ?>

<?php 
$this->start('script');
?>

	<script src="/js/cdo-subscription.js"></script>

<?php 
$this->end();
?>
