<?php
	$ogmetadata = $this->fetch('ogmetadata');
	if (empty($ogmetadata)) {
		$ogmetadata = 'fb_default';
	}
?>
<!DOCTYPE html>
<html lang="nl">
<head>
<meta charset="utf-8"/>
<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
<meta name="viewport" content="width=device-width, initial-scale=1"/>

<?= $this->element($ogmetadata); ?>

<meta name="description" content="crossdorp oelem"/>

<title>Crossdorp Oelem - <?= h($this->fetch('title')) ?></title>

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
	<?= $this->element('menu_bar'); ?>
	<div id="header-detail">
		<div class="row">
			<!-- <img src="../img/crossdorp_logo_02_med.png"></img>-->
			<img src="../img/crossdorp_logo-02_low.png"></img>
		</div>
		<div class="row">
			<div class="small-10 small-offset-1 medium-8 medium-offset-2 large-6 large-offset-3 column title"><?= h($this->fetch('title')) ?></div>
		</div>
	</div>
	
	<div class="page-wrapper">
		<div class="expanded row">
			<div class="small-1 medium-2 large-3 column"><?= $this->element('sponsors-left'); ?></div>
			<div class="small-10 medium-8 large-6 column"><?= $this->fetch('content') ?></div>
			<div class="small-1 medium-2 large-3 column"><?= $this->element('sponsors-right'); ?></div>
		</div>
	</div>
	
	
	<?= $this->element('footer', ["class" => "fixed"]); ?>
	
	<script src="/js/jquery/jquery-2.1.4.min.js"></script>
	<script src="/js/jquery/jquery-ui.min.js"></script>
	<script src="/js/angularjs/angular.min.js"></script>
	<script src="/js/angularjs/mask.min.js"></script>
	<script src="/js/uikit/uikit.min.js"></script>
	<script src="/js/foundation/foundation.min.js"></script>
	<script src="/js/app.js"></script>
	<script src="/js/cdo-menu-bar.js"></script>
	<script src="/js/cdo-subscription.js"></script>
	<script src="/js/cdo-participant.js"></script>
</body>

</html>