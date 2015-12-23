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

<link href="css/bootstrap.min.css" rel="stylesheet" />
<link href="css/uikit.min.css" rel="stylesheet" />
<link href="css/crossdorp.css" rel="stylesheet" type="text/css" />

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
	      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	    <![endif]-->
	    
</head>
<body ng-app="cdoApp">
	<div id="site-title">
		<div class="col-xs-1 col-sm-3 col-md-4 line"><hr></div>
	    <div class="col-xs-10 col-sm-6 col-md-4 title">Crossdorp Oelem</div>
	    <div class="col-xs-1 col-sm-3 col-md-4 line"><hr></div>
	</div>
	<div id="header">
		<div class="container">
			<div id="v-align">
				<div id="intro-panel" class="row uk-border-rounded">
					<div class="jumbotron">
						<h1>Loop eens <b>DOOR</b> Oelem</h1>
						<p>Geniet van ons historisch centrum terwijl je je maten klopt op de meet.</p>
					</div>
					<div id="intro-buttons" class="col-md-12" >
						<a href="#pnlInfo" class="btn btn-primary btn-lg" role="button" data-uk-smooth-scroll>Meer info</a>
						<a href="#pnlSubscribe" class="btn btn-primary btn-lg" role="button" data-uk-smooth-scroll>Ik doe mee</a>
					</div>
					<!--  <div id="intro-icons" class="col-lg-12">
						<div class="row">
							<div class="col-xs-2">
								<img src="img/calendar70.png" class="img-responsive">
								<h3>26 maart 2015</h3>
							</div>
							<div class="col-xs-2">
								<img src="img/alarm54.png" class="img-responsive">
								<h3>Start om 15u en 16u</h3>
							</div>
							<div class="col-xs-2">
								<img src="img/money390.png" class="img-responsive">
								<h3>6 &agrave; 8 euro</h3></div>
							<div class="col-xs-2">
								<img src="img/location76.png" class="img-responsive">
								<h3>In en door Oedelem</h3>
							</div>
							<div class="col-xs-2">
								<img src="img/bird58.png" class="img-responsive">
								<h3>Voor (bijna) volwassenen (14+)</h3>
							</div>
							<div class="col-xs-2">
								<img src="img/crawling.png" class="img-responsive">
								<h3>Voor minder volwassenen (tot 13)</h3>
							</div>
						</div>
					</div> -->
				</div>
			</div>
		</div>
	</div>
	
	<footer>
		<div class="container">
			<div class="row">
				<div class="pull-left">Email: <a href="mailto:vzwfeles@gmail.com">vzwfeles@gmail.com</a></div>
				<div class="pull-right">&copy; VZW Feles 2015 | Versie 1.0</div>
			</div>
			
			<div class="row">
				<div id="icon-creds">Icons made by <a href="http://www.flaticon.com/authors/daniel-bruce" title="Daniel Bruce">Daniel Bruce</a>, <a href="http://www.flaticon.com/authors/scott-de-jonge" title="Scott de Jonge">Scott de Jonge</a>, <a href="http://www.freepik.com" title="Freepik">Freepik</a>, <a href="http://www.flaticon.com/authors/icon-works" title="Icon Works">Icon Works</a> from <a href="http://www.flaticon.com" title="Flaticon">www.flaticon.com</a>             is licensed by <a href="http://creativecommons.org/licenses/by/3.0/" title="Creative Commons BY 3.0">CC BY 3.0</a></div>
			</div>
		</div>
	</footer>

	<script src="js/jquery/jquery-2.1.4.min.js"></script>
	<script src="js/bootstrap/bootstrap.min.js"></script>
	<script src="js/angularjs/angular.min.js"></script>
	<script src="js/uikit/uikit.min.js"></script>
	<script src="js/cdo.js"></script>

</body>



</html>