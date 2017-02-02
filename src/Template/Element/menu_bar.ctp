<div ng-controller="menuCtrl">
	<div class="title-bar" data-responsive-toggle="cdo-menu"
		data-hide-for="medium">
		<button class="menu-icon" type="button" data-toggle></button>
		<div class="title-bar-title">Menu</div>
	</div>
	
	<div class="hide-for-medium">
		<div class="top-bar" id="cdo-menu">
			<div class="top-bar-left">
				<ul class="vertical dropdown menu" data-dropdown-menu>
					<?= $this->element('menu_link'); ?>
				</ul>
			</div>
		</div>
	</div>
	
	<div class="show-for-medium">
		<div class="top-bar">
			<div class="top-bar-left">
				<ul class="menu">
					<?= $this->element('menu_link'); ?>
				</ul>
			</div>
			<div class="hide top-bar-right">
				<ul class="menu">
					<li><button type="button" class="button">Admin</button></li>
				</ul>
			</div>
		</div>
	</div>
</div>