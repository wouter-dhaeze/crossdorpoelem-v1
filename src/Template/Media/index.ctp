<?php 

use Cake\I18n\Time;
Time::setToStringFormat('dd/MM/yyyy');

$this->assign('title', 'Media');

?>

<div>
	media<br/>
	<div>
		<?php if ($albums->isEmpty()) {?>
    		Er werden geen albums gevonden.<br/>
		<?php } else {
			foreach ($albums as $album): ?>
            	<?= h($album->name) ?><br/>
            	<?= h($album->path) ?><br/>
            	<?= h($album->photo) ?><br/>
            	<?= $this->Html->link(__('View'), ['action' => 'view', $album->id]) ?>
            	
            	<?= $this->Html->image("../../album/1/photo?file=" . $album->photo, [
				    "alt" => $album->name,
				    'url' => ['action' => 'view', $album->id]
				]); ?>
            	
        	<?php endforeach; } ?>
	</div>
</div>


