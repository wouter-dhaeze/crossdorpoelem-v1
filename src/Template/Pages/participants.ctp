<?php 

$this->layout = 'cdo-detail';
$this->assign('title', 'Deelnemers');
$this->assign('ogmetadata', 'fb_participants');

?>

<div ng-controller="memberCtrl" ng-init="loadMembers()">
	<div class="row">
		<div class="callout warning" ng-show="errorMessage">{{errorMessage}}</div>
	</div>
	<div class="row" ng-show="result">
		<h4>Aantal ingeschreven deelnemers: {{result.count}}</h4>
		<table border="1">
			<tr>
				<th>Naam</th>
				<th>Wave</th>
				<th>Borstnummer</th>
			</tr>
			<tr ng-repeat="m in result.members">
				<td>{{m.fname + ' ' + m.lname}}</td>
				<td>{{m.wave}}</td>
				<td>{{m.number}}</td>
			</tr>
		</table>
	</div>
	<div id="modalSearching" class="reveal" data-reveal aria-labelledby="modalSearchingTitle" aria-hidden="true" role="dialog">
  		<h3 id="modalSearchingTitle">Deelnemers opzoeken</h3>
  		<p class="lead">Even geduld...</p>
	</div>
</div>

<?php 
$this->start('script');
?>

	<script src="/js/cdo-member.js"></script>

<?php 
$this->end();
?>