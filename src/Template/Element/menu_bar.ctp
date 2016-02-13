<div class="title-bar" data-responsive-toggle="cdo-menu"
	data-hide-for="medium">
	<button class="menu-icon" type="button" data-toggle></button>
	<div class="title-bar-title">Menu</div>
</div>

<div class="top-bar" id="cdo-menu">
	<div class="top-bar-left">
		<ul class="dropdown menu" data-dropdown-menu>
			<li class="menu-text"><a href="/">Crossdorp Oelem</a></li>
			<li><a href="/pages/info">Praktisch</a></li>
			<li><a href="/pages/media">Media</a></li>
			<li><a href="/pages/subscription">Inschrijven</a></li>
		</ul>
	</div>
	<div class="top-bar-right" ng-controller="menuCtrl">
		<ul class="menu">
			<li><input id="mycode" type="search" ng-model="code" placeholder="Uw code" maxlength="6" size="6"></li>
			<li><button type="button" class="button" ng-disabled="!(code.length == 6) || loading" ng-click="lookup()">Mijn inschrijving</button></li>
		</ul>
	</div>
</div>
