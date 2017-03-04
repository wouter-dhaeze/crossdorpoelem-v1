<div class="row">
	<h1>Inschrijvingen</h1>
</div>
<div ng-controller="manageSubscriptionCtrl" ng-init="loadSubscriptions()">
	<table border="1">
			<tr>
				<th>Aangemaakt op</th>
				<th>Code</th>
				<th>Prijs</th>
				<th>Inschrijver</th>
				<th>E-mail</th>
				<th>Gevalideerd</th>
				<th>Betaald</th>
				<th>Details</th>
			</tr>
			<tr ng-repeat="s in subscriptions">
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

<?php 
$this->start('script');
?>

	<script src="/js/cdo-models.js"></script>
	<script src="/js/cdo-manage-subscription.js"></script>

<?php 
$this->end();