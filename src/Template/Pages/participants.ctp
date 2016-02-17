<?php 

use Cake\I18n\Time;
Time::setToStringFormat('dd/MM/yyyy');

$this->layout = 'cdo-detail';
$this->assign('title', 'Deelnemers');
$this->assign('ogmetadata', 'fb_participants');

?>

<div ng-controller="participantCtrl" ng-init="showMessage = true; search()">
	<div class="row">
		<div class="alert alert-danger" ng-show="errorMessage">{{errorMessage}}</div>
	</div>
	<div class="row" ng-show="showMessage">
		<div class="callout">
	        <button class="close-button" aria-label="Close alert" type="button" ng-click="showMessage = false">
	          <span aria-hidden="true">&times;</span>
	        </button>
	        <div class="alert alert-warning lead">Indien u uw naam niet in de lijst terug vindt, hebben we uw storing nog niet onvangen. OPGELET!
	        U kunt pas aan de wedstrijd deelnemen nadat we uw storting hebben ontvangen. Nadien krijgt u een borstnummer toegekend.<br/>
	        Het kan evenwel enkele dagen duren om uw betaling te registreren.</div>
	    </div>
	</div>
	<div class="row" ng-show="result">
		<h4>Aantal ingeschreven deelnemers: {{result.count}}</h4>
		<table border="1">
			<tr>
				<th>Borstnummer</th>
				<th>Wave</th>
				<th>Naam</th>
				<th>Geboortedatum</th>
			</tr>
			<tr ng-repeat="p in result.participants">
				<td>{{p.number}}</td>
				<td>{{p.s.wave}}</td>
				<td>{{p.fname + ' ' + p.lname}}</td>
				<td>{{p.dob | date:'dd/MM/yyyy'}}</td>
			</tr>
		</table>
	</div>
	<div id="modalSearching" class="reveal" data-reveal aria-labelledby="modalSearchingTitle" aria-hidden="true" role="dialog">
  		<h3 id="modalSearchingTitle">Deelnemers opzoeken</h3>
  		<p class="lead">Even geduld...</p>
	</div>
</div>
