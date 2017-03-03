<?php
$this->layout = false;
?>
<!DOCTYPE html>
<html lang="nl">
<head>
<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="viewport" content="width=device-width, initial-scale=1" />

<meta property="og:url" content="https://www.crossdorpoelem.be/" />
<meta property="og:type" content="article" />
<meta property="og:title" content="Crossdorp Oelem" />
<meta property="og:image" content="http://www.crossdorpoelem.be/img/fb-banner.jpg" />
<meta property="og:image:secure_url" content="https://www.crossdorpoelem.be/img/fb-banner.jpg" />
<meta property="og:image:type" content="image/jpeg" />
<meta property="og:description" content="Crossdorp Oelem is een loopevenement naar het 'Urban Trail' concept. Het evenement gaat door op zaterdag 15 april 2017 en start aan sportcomplex Den Akker te Oedelem." />

<meta name="description" content="crossdorp oelem een loopwedstrijd door de dorpskern van Oedelem." />

<title>Crossdorp Oelem</title>

<link href="css/foundation.css" rel="stylesheet" />
<link href="css/uikit.min.css" rel="stylesheet" />
<link href="css/app.css" rel="stylesheet" type="text/css" />
<link href="css/crossdorpoelem.css" rel="stylesheet" type="text/css" />

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
	      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	    <![endif]-->

</head>
<body ng-app="cdo.app">
	
	<?= $this->element('menu_bar'); ?>
	<div id="header-main">
		<div class="row">
			<!-- <img src="../img/crossdorp_logo_02_med.png"></img>-->
			<img src="../img/crossdorp_logo-02_low.png"></img>
		</div>
		<div class="row">
			<div class="small-10 small-offset-1 medium-8 medium-offset-2 large-6 large-offset-3 column title">
				Oelem gets "Urban Trailed" <br/>Part II <br/>
				Zaterdag 15 april 2017
			</div>
		</div>
		<div class="buttons">
			<a href="#pnlSubscription" class="button large" role="button" data-uk-smooth-scroll>Inschrijven</a>
		</div>
	</div>
	
	<section id="pnlSubscription">
		<div class="row">
			<div class="small-12 column">
				<div class="row">
					<div class="text-center title">
					    <h2>Drie formules</h2>
						<div class="line"></div>
					</div>
					<div class="callout">
						<h5>In tegenstelling tot vorig jaar, waar we een korte jeugrun van 2KM en een volwassen run van 5KM organiseerden,
						hebben we voor dit jaar 3 formules uitgewerkt. Het parcours baant zich nog steeds een weg door diverse gebouwen binnen de Oelemse dorpskern, 
						maar dit jaar kunt u kiezen tussen een parcours van 5KM of 10KM. </h5>
					</div>
				</div>
				<div class="row">
					<div class="small-12 medium-4 column">
						<h3>5KM voor de leute</h3>
						<p>
							Bent u een recreatieve loper en heeft u zin in een leuk parcours, dan is "Crossdorp 5KM" iets voor jou. U loopt door gebouwen waar u anders nooit komt, 
							en u geniet nadien van de Oelemse gezelligheid. 
							Het parcours is wat aangepast ten opzichte van vorig jaar, maar zeker niet minder verrassend.
							Deelname kost u amper 6 eurootjes.
						<p>
						<div>
							<a href="/subscription" class="button large">Ik schrijf in!</a>
						</div>
					</div>
					<div class="small-12 medium-4 column">
						<h3>10KM voor de d'echte</h3>
						<p>
							Voor 5KM staat u niet op, maar een origineel parcours onder het lentezonnetje ziet u wel zitten? Op ons parcours bezoekt u dezelfde gebouwen,
							maar u geeft een extra zetje door de landelijke rand van Oelem. Voor 10 euro trakteert u zichzelf op een namiddag plezier.
						<p>
						<div>
							<a href="/subscription" class="button large">Ik schrijf in!</a>
						</div>
					</div>
					<div class="small-12 medium-4 column">
						<h3>PartyRun voor de ravers</h3>
						<p>
							Om dat we zelf graag het aangename aan het nog leukere koppelen, organiseren we dit jaar ook een PartyRun. 
							U haspelt het parcours van 5 KM af maar onderweg houdt u halt aan een aantal mini-fuifkes! Daar verhogen we 
							de hartslag op de beat en genieten van wat hydratatie. Na 15 minuten raven vat u het vervolg van het parcours aan, op zoek naar de volgende mini-fuif. 
							Voor slechts 15 euro heeft u een namiddag gesport, gefuift en van vette ambiance genoten.
						<p>
						<div>
							<a href="/subscription" class="button large">Ik schrijf in!</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	
	<section id="pnlSponsors" >
		<div class="row">
			<div class="column">
				<div class="row">
				  <div class="text-center title">
				    <h1>Onze sponsors</h1>
				    <div class="subtitle">En zonder hen kunnen wij niet le-even..., allie..., alloo..., niet le-even</div>
				    <div class="line"></div>
				  </div>
				</div>
			  	<div class="row">
			  		<div class="small-6 medium-3 column">
						<a href="https://nl-nl.facebook.com/The-Crocodile-217830311574780/" target="_blank">
							<img class="img-responsive" src="sponsors/crocodile.jpg" />
						</a>
					</div>
					<div class="small-6 medium-3 column">
						<a href="http://www.tetard.be/" target="_blank">
							<img class="img-responsive" src="sponsors/tetard.jpg" />
						</a>
					</div>
					<div class="small-6 medium-3 column">
						<a href="http://www.alphamservice.be/" target="_blank">
							<img class="img-responsive" src="sponsors/alphamservice.jpg" />
						</a>
					</div>
			  		<div class="small-6 medium-3 column">
			  			<a href="http://www.artifexevents.be/" target="_blank">
							<img class="img-responsive" src="sponsors/artifex.jpg" />
						</a>
					</div>
				</div>
			  	<div class="row">
			  		<div class="small-6 medium-3 column">
				  		<a href="http://www.houthandeldriekoningen.be/" target="_blank">
							<img class="img-responsive" src="sponsors/driekoningen.jpg" />
						</a>
					</div>
			  		<div class="small-12 medium-3 column">
				  		<a href="http://mobilefoodbar.be/" target="_blank">
							<img class="img-responsive" src="sponsors/mobilefoodbar.jpg" />
						</a>
					</div>
					<div class="small-12 medium-3 column">
						<a href="http://www.frietamientje.be/" target="_blank">
							<img class="img-responsive" src="sponsors/frietamientje.jpg" />
						</a>
					</div>
					<div class="small-6 medium-3 column">
						<img class="img-responsive" src="sponsors/coucke.jpg" />
					</div>
			  	</div>
			  	<div class="row">
					<div class="small-6 medium-3 column">
						<img class="img-responsive" src="sponsors/frituurgeert.jpg" />
					</div>
					<div class="small-6 medium-3 column">				
						<a href="http://www.demess.be/" target="_blank">
							<img class="img-responsive" src="sponsors/demess.jpg" />
						</a>
					</div>
					<div class="small-6 medium-3 column">			
						<a href="http://vloerenfranssens.be/" target="_blank">
							<img class="img-responsive" src="sponsors/vloerenfranssens.jpg" />
						</a>
					</div>
					<div class="small-6 medium-3 column">
						<a href="http://www.debokke.be/" target="_blank">
							<img class="img-responsive" src="sponsors/debokke.jpg" />
						</a>
					</div>
			  	</div>
			  	<div class="row">
			  		<div class="small-6 medium-3 column">
				  		<a href="http://rikbeuselinck.be/" target="_blank">
							<img class="img-responsive" src="sponsors/rikbeuselinck.jpg" />
						</a>
					</div>
					<div class="small-6 medium-3 column">					
						<a href="http://www.pjp-autoverhuur.be/" target="_blank">
							<img class="img-responsive" src="sponsors/LogoPJP.gif" />
						</a>
					</div>
					<div class="small-6 medium-3 column">				
						<a href="http://www.maximsfashion.be/" target="_blank">
							<img class="img-responsive" src="sponsors/maxims.jpg" />
						</a>
					</div>
					<div class="small-6 medium-3 column">
						<img class="img-responsive" src="sponsors/delanghe.jpg" />
					</div>
			  	</div>
			  	<div class="row">
			  		<div class="small-6 medium-3 column">		  		
				  		<a href="http://www.garagedebaene.be/" target="_blank">
							<img class="img-responsive" src="sponsors/debaene.jpg" />
						</a>
					</div>
					<div class="small-6 medium-3 column">
						<img class="img-responsive" src="sponsors/jomar.jpg" />
					</div>
					<div class="small-6 medium-3 column">
						<a href="https://nl-nl.facebook.com/Caf%C3%A9-Mitra-341235192573657/" target="_blank">
							<img class="img-responsive" src="sponsors/mitra.jpg" />
						</a>
					</div>
					<div class="small-6 medium-3 column">
						<a href="http://www.baristas.be/" target="_blank">
							<img class="img-responsive" src="sponsors/patscoffee.jpg" />
						</a>
					</div>
			  	</div>
			  	<div class="row">
			  		<div class="small-6 medium-3 column">
				  		<a href="http://www.schepens-partners.be/" target="_blank">
							<img class="img-responsive" src="sponsors/schepens_advocaten.jpg" />
						</a>
					</div>
					<div class="small-6 medium-3 column">
						<img class="img-responsive" src="sponsors/mens.jpg" />
					</div>
					<div class="small-6 medium-3 column">
						<img class="img-responsive" src="sponsors/harlekijn.jpg" />
					</div>
					<div class="small-6 medium-3 column">
						
					</div>
			  	</div>
			</div>
		</div>
	</section>
	
	<?= $this->element('footer', ["class" => ""]); ?>

	<script src="js/jquery/jquery-2.1.4.min.js"></script>
	<script src="js/jquery/jquery-ui.min.js"></script>
	<script src="js/angularjs/angular.min.js"></script>
	<script src="js/angularjs/mask.min.js"></script>
	<script src="js/uikit/uikit.min.js"></script>
	<script src="js/foundation/foundation.min.js"></script>
	<script src="js/app.js"></script>
	<script src="js/cdo-menu-bar.js"></script>
	<script src="js/cdo-youtube.js"></script>


</body>
</html>