<?php 

use Cake\I18n\Time;
Time::setToStringFormat('dd/MM/yyyy');

$this->assign('title', 'Media');

$this->start('css');
?>

	<link href="/vendor/blueimp-gallery/css/blueimp-gallery.min.css" rel="stylesheet" type="text/css"/>

<?php 
$this->end();
?>
<div class="row">
	<h1><?= h($album->name) ?></h1>
	<p><?= h($album->description) ?></p>
</div>
<div class="row">
	<div id="blueimp-gallery" class="blueimp-gallery">
	    <div class="slides"></div>
	    <h3 class="title"></h3>
	    <a class="prev">‹</a>
	    <a class="next">›</a>
	    <a class="close">×</a>
	    <a class="play-pause"></a>
	    <ol class="indicator"></ol>
	</div>
	<div id="links">
		<?php foreach ($album->photos as $photo) { ?>
			<a href="../../album/1/photo?file=<?= $photo ?>">
		        <img src="../../album/1/photo?file=<?= $photo ?>&thumb=true">
		    </a>
		<?php } ?>
	</div>
</div>

<?php 
$this->start('script');
?>

	<script src="/vendor/blueimp-gallery/js/blueimp-gallery.min.js"></script>

	<script>
		document.getElementById('links').onclick = function (event) {
		    event = event || window.event;
		    var target = event.target || event.srcElement,
		        link = target.src ? target.parentNode : target,
		        options = {index: link, event: event},
		        links = this.getElementsByTagName('a');
		    blueimp.Gallery(links, options);
		};
	</script>
<?php 
$this->end();
?>

