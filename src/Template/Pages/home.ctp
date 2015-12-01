<?php
$this->layout = false;
?>
<!DOCTYPE html>
<html lang="nl">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Crossdorp Oelem</title>

<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/crossdorp.css" rel="stylesheet">

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
	      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	    <![endif]-->
</head>
<body ng-app="cdoApp">
	<div class="container">
		<div class="page-header">
			<h1>Crossdorp Oelem</h1>
		</div>
		<div class="row">
			<div class="col-xs-12 col-md-8">
				<div class="row">
					<div class="col-xs-12 col-md-6">
						<div>
							<h3>Wat</h3>
							<p>Crossdorp Oelem is een loopwedstrijd van voor jong en oud, in maar vooral DOOR het centrum van Oedelem.</p>
						</div>
						<div>
							<h3>Wanneer</h3>
							<p>De loopwedstrijd gaat door op zaterdag 26 maart 2016 (Paasweekend)</p>
						</div>
					</div>
					<div class="col-xs-12 col-md-6">
						<div>
							<h3>Voor wie</h3>
							<p>Voor jong en minder jong: 10 tot 13 jarigen leggen een parcours van 2,5 km in duo af. Volwassenen (14+) lopen 5 &agrave; 6 km.</p>
						</div>
						<div ng-controller="InterestCtrl">
							<h3>Inschrijven</h3>
							<p>Voorlopig kan je nog niet inschrijven. Maar laat hier je emailadres na en je ontvangt een bericht van zodra de inschrijvingen geopend worden.
							Voor deze eerste editie zijn de plaatsen beperkt, dus vroegtijdig inschrijven is de boodschap!</p>
							<form name="interestForm" novalidate
									ng-submit="submitInterest()"
									ng-hide="showSuccess || showInProgress">
								<fieldset>
									<input id="email" name="email" type="email" ng-model="email" placeholder="Vul hier je email adres in..." required></input>
									<span ng-show="interestForm.email.$dirty && interestForm.email.$error.email">Ongeldig emailadres</span>
									<span ng-show="interestForm.email.$dirty && interestForm.email.$error.required">Emailadres verplicht</span>									
								</fieldset>
								<fieldset >
					                <input ng-disabled="interestForm.$invalid" type="submit" value="Hou me op de hoogte"></input>
					            </fieldset>
							</form>
							<div ng-show="showInProgress">Bewaring in progressie...</div>
							<div ng-show="showSuccess">Wij danken u voor uw enthousiasme</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-12">
						sponsors komen hier.
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-md-4">Hier komt nieuws!</div>
		</div>
	</div>
	<footer class="footer hidden-xs">
		<div class="container">
			<div class="text-muted">
				<p>U aangeboden door VZW Feles!<br /> <i>The Crossdorp Posse</i></p>
				<p>Crossdorp Oelem &copy; 2015 - version 1.0 development</p>
			</div>
		</div>
	</footer>
	<script src="js/jquery/jquery-2.1.4.min.js"></script>
	<script src="js/bootstrap/bootstrap.min.js"></script>
	<script src="js/angularjs/angular.min.js"></script>
	<script src="js/cdo.js"></script>
</body>

</html>