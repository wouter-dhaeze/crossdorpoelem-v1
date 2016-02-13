<?php

?>
<!DOCTYPE html>
<html lang="nl">
<head>
<meta charset="utf-8"/>
<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
<meta name="viewport" content="width=device-width, initial-scale=1"/>
<meta name="description" content="crossdorp oelem"/>

<title>Crossdorp Oelem - Beheer</title>

<link href="../css/bootstrap.min.css" rel="stylesheet" />
<link href="../css/uikit.min.css" rel="stylesheet" />
<link href="../css/app.css" rel="stylesheet" type="text/css" />
<link href="../css/crossdorpoelem.css" rel="stylesheet" type="text/css" />

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
	      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	    <![endif]-->

</head>
<body ng-app="cdo.app">
	<?= $this->fetch('content') ?></div>

	
	
	<?= $this->element('footer'); ?>
	
	<script src="../js/jquery/jquery-2.1.4.min.js"></script>
	<script src="../js/angularjs/angular.min.js"></script>
	<script src="../js/angularjs/mask.min.js"></script>
	<script src="../js/uikit/uikit.min.js"></script>
	<script src="../js/foundation/foundation.min.js"></script>
	<script src="../js/app.js"></script>
	<script src="../js/cdo-subscription.js"></script>
</body>

</html>