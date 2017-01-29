<div id="header-detail">
	<div class="row">
		<div class="hide-for-small-only medium-3 columns">
			<img id="logo" src="../img/crossdorp_logo-02_low.png"></img>
		</div>
		<div class="medium-9 columns">
			<div class="hide-for-small-only row">
				<div class=" medium-9 columns"><h1 class="hide"><?= h($this->fetch('title'))?></h1></div>
				<div class=" medium-3 columns">
					<div>
						<div class="top-bar-right">
					    	<ul class="menu">
					    		<li><input type="search" placeholder="Code"></li>
					    		<li><button type="button" class="button">Zoek</button></li>
					  		</ul>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<?= $this->element('menu_bar'); ?>
			</div>
		</div>
	</div>
</div>
