<?php 

use Cake\I18n\Time;
Time::setToStringFormat('dd/MM/yyyy');

$this->layout = 'cdo-detail';
$this->assign('title', 'Media');

?>

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
				  	<?= $this->Html->image("../../album/1/photo?file=" . $album->photo, [
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


