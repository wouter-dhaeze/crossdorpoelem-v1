<div id="<?= $idprefix ?>" class="member col-md-4">
	<div class="member-image">
		<a data-uk-toggle="<?= "{target:'#" . $idprefix . "-info', animation:'uk-animation-slide-bottom'}" ?>">
			<img class="ui-responsive uk-border-rounded" src="<?= $image?>"/>
    	</a>
    </div>
    <div id="<?= $idprefix . '-info'?>" class="member-info uk-hidden">
    	<div class="header">
    		<h1><?= $name?></h1>
    	</div>
    	<div class="content">
    		<div class="row">
    			<div class="col-xs-6 key">AKA</div>
    			<div class="col-xs-6 value"><?= $aka?></div>
    		</div>
    		<div class="row">
    			<div class="col-xs-6 key">Titel</div>
    			<div class="col-xs-6 value"><?= $title?></div>
    		</div>
    		<div class="row">
    			<div class="col-xs-6 key">Functie</div>
    			<div class="col-xs-6 value"><?= $function?></div>
    		</div>
    	</div>
    	<div>
    		<a class="btn btn-primary btn-lg" role="button" data-uk-toggle="<?= "{target:'#" . $idprefix . "-info', animation:'uk-animation-slide-left'}" ?>">Info sluiten</a>
    	</div>
    </div>
</div>