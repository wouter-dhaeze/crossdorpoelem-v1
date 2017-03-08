<?php 

use Cake\I18n\Time;
Time::setToStringFormat('dd/MM/yyyy');

$this->layout = 'cdo-detail';
$this->assign('title', 'Media');

?>

<div>
<div class="row">
	<h1>Foto's</h1>
	<?php if ($albums->isEmpty()) {?>
	<div class="callout alert">
    	<p>Er werden geen albums gevonden.</p>
    </div>
    <div>
	<?php } else { ?>
		<div class="row small-up-1 medium-up-2 large-up-4">
		<?php foreach ($albums as $album): ?>
        	<div class="column column-block">
            	<div class="card">
					<h2>
				    	<?= h($album->name) ?>
				  	</h2>
				  	<?= $this->Html->image("../../album/" . $album->id . "/photo?file=" . $album->photo, [
					    "alt" => $album->name,
					    'url' => ['action' => 'view', $album->id]
					]); ?>
				    <p><?= h($album->description) ?></p>
				</div>
            </div>
        <?php endforeach; } ?>
        </div>
	</div>
</div>

<div class="row">
	<div class="small-12 column">
		<div class="text-center title">
		    <h2>Crossdorp Oelem - The movie</h2>
		    <div class="line"></div>
		</div>
		<article>
		    <p>
				Na het succes van vorig jaar, kon een tweede editie niet uitblijven. 
				Bekijk het filmpje van vorig jaar en begin maar al goeste te krijgen om je in te schrijven.<br/>
				Stijns hoofd deed dienst als statief, zijn twee vriendjes als figuranten, waarvoor dank. Enjoy!
		    </p>
		</article>
		<div class="flex-video widescreen">
			<div id="player"></div>
		</div>
	</div>
</div>
</div>
<?php 
$this->start('script');
?>

	<script src="/js/cdo-youtube.js"></script>

<?php 
$this->end();
?>
