<?php 

use Cake\I18n\Time;
Time::setToStringFormat('dd/MM/yyyy');

?>

<div ng-app="subscriptionApp" ng-controller="subscriptionCtrl">
	<div class="row">
		<h1>Mijn inschrijving</h1>
		<div class="alert alert-warning" ng-show="<?= !$subscription->validated ?>">Uw inschrijving werd nog niet gevalideerd. Klik op de link in de mail die u ontving om de validatie af te ronden.</div>
		<div class="alert alert-info" ng-show="<?= $subscription->validated ?>">Uw inschrijving is correct gevalideerd.</div>
		<div class="alert alert-warning" ng-show="<?= !$subscription->payed ?>">We hebben uw storting nog niet ontvangen. Indien u reeds heeft betaald zal u binnenkort een bevestigingsmail ontvangen.
		Indien u nog niet heeft betaald, bent u nog niet officieel ingeschreven. Gelieve de betalingsgegevens terug te vinden in de mail die u ontving.</div>
		<div class="alert alert-info" ng-show="<?= $subscription->payed ?>">We hebben uw betaling correct ontvangen. U mag zich officieel deelnemer van Crossdorp Oelem noemen. Succes!</div>
		<?php if ($subscription->wave == 'ADULT'): ?>
			<h2>Uw gegevens</h2>
			<?= $this->element('view_participant', 
								["participant" => $subscription->participant[0]]); ?>
		<?php endif; ?>
		<?php if ($subscription->wave == 'YOUTH'): ?>
			<h2>Gegevens eerste loper</h2>
			<?= $this->element('view_participant', 
								["participant" => $subscription->participant[0]]); ?>
			<h2>Gegevens tweede loper</h2>
			<?= $this->element('view_participant', 
								["participant" => $subscription->participant[1]]); ?>
		<?php endif; ?>
			<h2>Uw resultaat</h2>
			<div class="row">
				<div class="large-2 columns">
					<label class="right inline">Plaats</label>
				</div>
				<div class="large-10 columns">
					<span>Nog niet gekend</span>
				</div>
			</div>
			<div class="row">
				<div class="large-2 columns">
					<label class="right inline">Tijd</label>
				</div>
				<div class="large-10 columns">
					<span>Nog niet gekend</span>
				</div>
			</div>
	</div>
</div>
