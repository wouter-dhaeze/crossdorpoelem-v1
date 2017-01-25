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
            	<?= h($album->path) ?>
            	<?= $this->Html->link(__('View'), ['action' => 'view', $album->id]) ?>
        	<?php endforeach; } ?>
	</div>
</div>


