<?php
$this->layout = false;
?>
<!DOCTYPE html>
<html lang="nl">
<head>
<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<meta name="description" content="crossdorp oelem" />

<title>Crossdorp Oelem</title>

<link href="css/foundation.css" rel="stylesheet" />
<link href="css/uikit.min.css" rel="stylesheet" />
<link href="css/app.css" rel="stylesheet" type="text/css" />
<link href="css/crossdorpoelem2.css" rel="stylesheet" type="text/css" />

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
	      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	    <![endif]-->

</head>
<body ng-app="cdoApp">
	
	<?= $this->element('menu_bar'); ?>
	<div id="header">
		<div class="row">
			<!-- <img src="../img/crossdorp_logo_02_med.png"></img>-->
			<img src="../img/crossdorp_logo-02_low.png"></img>
		</div>
		<div class="row">
			<div class="small-10 small-offset-1 medium-8 medium-offset-2 large-6 large-offset-3 column title">Oelem gets "Urban Trailed"</div>
		</div>
		<div class="buttons">
			<a href="#pnlInfo" class="button large" role="button" data-uk-smooth-scroll>Meer info</a>
			<!-- <a href="#pnlSubscribe" class="button large" role="button" data-uk-smooth-scroll>Inschrijven</a>-->
		</div>
	</div>
	
	<section id="pnlInfo" >
		<div class="row">
			<div class="small-12 medium-4 column">
				<div class="text-center title">
				    <h2>Urban wadde?</h2>
				    <div class="line"></div>
				</div>
				<article class="uk-article">
				    <p class="uk-article-lead">Een loopwedstrijd door gebouwen</p>
				    <p>Het "Urban Trail" concept wint de laatste jaren aan populariteit. Het decor van deze wedstrijden is een stads- of in ons geval 
				    onze Oedelemse dorpskern.</p>
				</article>
			</div>
			<div class="small-12 medium-8 column">
				<div class="text-center title">
				    <h2>Info</h2>
				    <div class="line"></div>
				</div>
				<div>
					<img src="../img/calendar70.png"><span>De wedstrijd gaat door op zaterdag 26 maart.</span>
				</div>
				<div>
					<img src="../img/bird58.png"><span>Voor (jong-)volwassenen ligt een parcours van 6 km te wachten.</span>
				</div>
				<div>
					<img src="../img/crawling.png"><span>Voor de jeugd (geboren tussen 2003 en 2006) hebben we een parcours van 2,5 km. Jeugd schrijft in als duo. In de helft van het parcours wordt de eerste loper afgelost.</span>
				</div>
				<div>
					<img src="../img/alarm54.png"><span>De jeugd run start om 15u, de volwassenen om 16u.</span>
				</div>
				<div>
					<img src="../img/money390.png"><span>Voorafschrijven kost u 6 euro, aan de deur betaalt u 8 euro (enkel indien er nog plaats is).</span>
				</div>
				<div>
					<img src="../img/location76.png"><span>De start en de aankomst ligt in sportcomplex Den Akker te Oedelem.</span>
				</div>
			</div>	
		</div>
	</section>
	
	<section id="pnlStory" >
		<div class="row">
			<div class="column">
			  <div class="text-center title">
			    <h1>Ons verhaal</h1>
			    <div class="subtitle">Over waarom, waarom niet, en voor wie?</div>
			    <div class="line"></div>
			  </div>
			  <div data-uk-scrollspy="{cls:'uk-animation-slide-right', delay:200, repeat: false}">
				  <div class="row">
				  	<div class="small-12 medium-6 column">
				  		<img src="img/ak.jpg" class="img-responsive">
				  	</div>
				  	<div class="small-12 medium-6 column">
				  		<article class="uk-article">
					    <h1 class="uk-article-title">Onze opzet</h1>
					    <p class="uk-article-lead">VZW Feles zet in op een mix van sport en plezier.</p>
					    <p>Omdat we graag wat leven in de brouwerij hebben, en omdat we toch niks anders te doen hadden, kwam het idee om
					    een sportwedstrijd te organiseren. Eerst dachten we aan een rugbytornooi maar daar zijn ze in Beernem al aan bezig. 
					    Ide&euml;en stelen doet VZW Feles niet. Na wat breinstormen kwam onze boekhouder met het voorstel om het idee van "Urban trail" te stelen
					    en te implementeren in ons dorp. En zo geschiede. Onze loopwedstrijd werd gedoopt in de keuken van onze secretaris: Crossdorp Oelem.</p>
				  	</div>
				  </div>
			  	<div class="divider"></div>
			  </div>
			  <div data-uk-scrollspy="{cls:'uk-animation-slide-left', delay:200, repeat: false}">
				  <div class="row">
				  	<div class="small-12 medium-6 column">
				  		<article class="uk-article">
					    <h1 class="uk-article-title">Voor jong en oud</h1>
					    <p class="uk-article-lead">Iedereen mag meedoen (of toch bijna iedereen)</p>
					    <p>De wedstrijd bestaat uit twee waves: jeugd ("kids" vinden we te bekakt) en volwassenen. De jeugd legt een parcours van 2,5 km af, maar wel in duo.
					    Dus iedereen die denkt dat hij ongeveer 1,5 km kan lopen mag meedoen. Voor ons stopt de jeugd op 13 jaar. Dus als je geboren bent in het jaar 2003 of later mag je nog als duo inschrijven.</p>
					    <p>Vanaf 14 jaar hoor je bij de grote kindjes, in de volksmond "volwassenen" genoemd. De volwassenen leggen een parcours van 5 &agrave; 6 km af. Dus ben je sportief
					    en heb je eens zin in een ander parcours, of zoek je een goed voornemen voor 2016 om wat meer te sporten, stip dan zaterdag 26 maart 2016 met rood in je agenda aan.</p>
				  	</div>
				  	<div class="small-12 medium-6 column">
				  		<img src="img/old-athletes.jpg" class="img-responsive">
				  	</div>
				  </div>
				  <div class="divider"></div>
			  </div>
			  <div data-uk-scrollspy="{cls:'uk-animation-slide-right', delay:200, repeat: false}">
				  <div class="row">
				  	<div class="small-12 medium-6 column">
				  		<img src="img/kerk-oedelem.jpg" class="img-responsive">
				  	</div>
				  	<div class="small-12 medium-6 column">
				  		<article class="uk-article">
					    <h1 class="uk-article-title">Ik loop mee</h1>
					    <p class="uk-article-lead">Een moedige beslissing, waarmee je je omgeving kan aansporen ook de asics aan te binden.</p>
					    <p>Heb je na een aantal slapeloze nachten toch beslist deel te nemen, dan zullen we je binnenkort vragen vooraf in te schrijven.
					    De inschrijving kost u 6 euro (ook voor duo's) in voorverkoop. Zijn er nog wat plaatsen over dan kunt u zich ter plaatse inschrijven voor 8 euro.
						Een eerste stap richting een succesvolle inschrijving is klikken op onderstaande blauwe knop: 
					    Ga met uw muisaanwijzer op de knop staan en druk de linkertoets van uw muis korstondig in.</p>
					    <a href="#pnlSubscribe" class="button large" role="button" data-uk-smooth-scroll>Eerste stap naar een succesvolle inschrijving...</a>
				  	</div>
				  </div>
				  <div class="divider"></div>
			  </div>
			  <div data-uk-scrollspy="{cls:'uk-animation-slide-left', delay:200, repeat: false}">
				  <div class="row">
				  	<div class="small-12 medium-6 column">
				  		<article class="uk-article">
					    <h1 class="uk-article-title">De supportersbus</h1>
					    <p class="uk-article-lead">De minder sportieve mens doet ook mee</p>
					    <p>Is het lichaam na een lange sportcarri&egrave;re wat uitgeblust? Geen nood, van ons mag je ook meekomen. Vrienden en familie 
					    rekenen op je om hen vooruit te schreeuwen.</p>
					    <p>
					    Her en der op het parcours
					    zorgen we ook voor wat randanimatie. Meer nog, iedereen die iets wil doen om centrum Oelem eens goed op stelten te zetten (binnen 
					    het wettelijke kader), nodigen we uit. Speel je blokfluit, spuw je vuur of verkleed je je stiekem graag als middeleeuwse jonkvrouw, laat je maar gaan.</p>
					    <p style="font-size: 8px; font-style: italic;">Mogelijks wordt er hier en daar ook wel eens een biertje geproefd.</p>				    
				  	</div>
				  	<div class="small-12 medium-6 column">
				  		<img src="img/supporters.jpeg" class="img-responsive">
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
						<img class="img-responsive" src="sponsors/deformatie.jpg" />
					</div>
					<div class="small-6 medium-3 column">
						<img class="img-responsive" src="sponsors/crocodile.jpg" />
					</div>
					<div class="small-6 medium-3 column">
						<img class="img-responsive" src="sponsors/tetard.jpg" />
					</div>
					<div class="small-6 medium-3 column">
						<img class="img-responsive" src="sponsors/alphamservice.jpg" />
					</div>
			  	</div>
			  	<div class="row">
			  		<div class="small-6 medium-3 column">
						<img class="img-responsive" src="sponsors/gulf.jpg" />
					</div>
			  		<div class="small-12 medium-3 column">
						<img class="img-responsive" src="sponsors/vanhulle.jpg" />
					</div>
					<div class="small-12 medium-3 column">
						<img class="img-responsive" src="sponsors/frietamientje.jpg" />
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
						<img class="img-responsive" src="sponsors/demess.jpg" />
					</div>
					<div class="small-6 medium-3 column">
						<img class="img-responsive" src="sponsors/vloerenfranssens.jpg" />
					</div>
					<div class="small-6 medium-3 column">
						<img class="img-responsive" src="sponsors/debokke.jpg" />
					</div>
			  	</div>
			  	<div class="row">
			  		<div class="small-6 medium-3 column">
						<img class="img-responsive" src="sponsors/rikbeuselinck.jpg" />
					</div>
					<div class="small-6 medium-3 column">
						<img class="img-responsive" src="sponsors/sanderbellen.jpg" />
					</div>
					<div class="small-6 medium-3 column">
						<img class="img-responsive" src="sponsors/maxims.jpg" />
					</div>
					<div class="small-6 medium-3 column">
						<img class="img-responsive" src="sponsors/delanghe.jpg" />
					</div>
			  	</div>
			  	<div class="row">
			  		<div class="small-6 medium-3 column">
						<img class="img-responsive" src="sponsors/debaene.jpg" />
					</div>
					<div class="small-6 medium-3 column">
						<img class="img-responsive" src="sponsors/jomar.jpg" />
					</div>
					<div class="small-6 medium-3 column">
						<img class="img-responsive" src="sponsors/mitra.jpg" />
					</div>
					<div class="small-6 medium-3 column">
						<img class="img-responsive" src="sponsors/patscoffee.jpg" />
					</div>
			  	</div>
			  	<div class="row">
			  		<div class="small-6 medium-3 column">
						<img class="img-responsive" src="sponsors/schepens_advocaten.jpg" />
					</div>
					<div class="small-6 medium-3 column">
						<img class="img-responsive" src="sponsors/mens.jpg" />
					</div>
					<div class="small-6 medium-3 column">
						
					</div>
					<div class="small-6 medium-3 column">
						
					</div>
			  	</div>
			</div>
		</div>
	</section>
	
	<section id="pnlFeles" class="hide-for-small bg-image">
		<div class="row">
			<div class="columns">
				<div class="text-center title">
				    <h1>VZW Feles</h1>
				    <div class="subtitle">Forged from a common interest in "tzweun utangn"</div>
				    <div class="line"></div>
				</div>
			</div>
		</div>
		<div id="crlContainer">
			<div class="container">
			  	<div class="row">
			  		<div id="crlFeles" class="carousel active" data-ride="carousel" data-interval="false">
					  <!-- Indicators -->
					  <!-- <ol class="carousel-indicators">
					    <li data-target="#crlFeles" data-slide-to="0" class="active"></li>
					    <li data-target="#crlFeles" data-slide-to="1"></li>
					    <li data-target="#crlFeles" data-slide-to="2"></li>
					  </ol>-->
	
					  <!-- Wrapper for slides -->
					  <div class="carousel-inner" role="listbox">
					    <div class="item active member-group">
					    	<?= $this->element('member', [
									"idprefix" => "member-matti",
						    		"image" => "member/matti.png",
						    		"name" => "Matti",
					    			"aka" => "Mattias De Jaegher",
					    			"title" => "Voorzitter",
					    			"function" => "Lead Logistics"
					    	]); ?>
					    	
					    	<?= $this->element('member', [
									"idprefix" => "member-niebie",
						    		"image" => "member/niebie.png",
						    		"name" => "Niebie",
					    			"aka" => "Kobe Beuselinck",
					    			"title" => "Secretaris",
					    			"function" => "Lead engineering"
					    	]); ?>
					    	
					    	<?= $this->element('member', [
									"idprefix" => "member-haas",
						    		"image" => "member/haas.png",
						    		"name" => "Haas",
					    			"aka" => "Wouter Dhaeze",
					    			"title" => "Penningmeester",
					    			"function" => "Lead IT"
					    	]); ?>
					    	
					    </div>
					    <div class="item member-group">
					    	<?= $this->element('member', [
									"idprefix" => "member-bram",
						    		"image" => "member/bram.png",
						    		"name" => "Brammetje",
					    			"aka" => "Bram Decuyper",
					    			"title" => "Bestuurder",
					    			"function" => "Lead AS-400 & .NET"
					    	]); ?>
					    	
					    	<?= $this->element('member', [
									"idprefix" => "member-copain",
						    		"image" => "member/copain.png",
						    		"name" => "De Copain",
					    			"aka" => "Pieter Coucke",
					    			"title" => "Bestuurder",
					    			"function" => "Legal advisor"
					    	]); ?>
					    	
					    	<?= $this->element('member', [
									"idprefix" => "member-fredde",
						    		"image" => "member/fredde2.png",
						    		"name" => "Fredde",
					    			"aka" => "Fredde Lambrecht",
					    			"title" => "Bestuurder",
					    			"function" => "Quality Assurance Liquids"
					    	]); ?>
					    	
					    </div>
					    <div class="item member-group">
					    	<?= $this->element('member', [
									"idprefix" => "member-mozes",
						    		"image" => "member/mozes.png",
						    		"name" => "Mozes",
					    			"aka" => "Johannes Mortier",
					    			"title" => "Bestuurder",
					    			"function" => "Graphical Design & Communications"
					    	]); ?>
					    	
					    	<?= $this->element('member', [
									"idprefix" => "member-soa",
						    		"image" => "member/soa.png",
						    		"name" => "Soa",
					    			"aka" => "Joachim Keereman",
					    			"title" => "Bestuurder",
					    			"function" => "Financial Advisor"
					    	]); ?>
					    	
					    	<?= $this->element('member', [
									"idprefix" => "member-wille",
						    		"image" => "member/wille.png",
						    		"name" => "Wille",
					    			"aka" => "Ken Wille",
					    			"title" => "Bestuurder",
					    			"function" => "Light & Sound"
					    	]); ?>
					    	
					    </div>
					  </div>
	
					  <!-- Left and right controls -->
					  <a class="left carousel-control" href="#crlFeles" role="button" data-slide="prev">
					    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
					    <span class="sr-only">Previous</span>
					  </a>
					  <a class="right carousel-control" href="#crlFeles" role="button" data-slide="next">
					    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
					    <span class="sr-only">Next</span>
					  </a>
					</div>
			  	</div>
			</div>
		</div>
	</section>
	
	<?= $this->element('footer'); ?>

	<script src="js/jquery/jquery-2.1.4.min.js"></script>
	<script src="js/angularjs/angular.min.js"></script>
	<script src="js/uikit/uikit.min.js"></script>
	<script src="js/foundation/foundation.min.js"></script>
	<script src="js/bootstrap/bootstrap.min.js"></script>
	<script src="js/app.js"></script>
	<script src="js/cdo-interest.js"></script>
</body>



</html>