$(document).foundation();

(function() {
	angular.module('cdo.menu', []);
	angular.module('cdo.subscription', ['ui.mask']);
	angular.module('cdo.manageSubscription', []);
	
	//var cdoApp = angular.module('cdoApp', ['cdo.menu', 'cdo.subscription']);
	var cdoApp = angular.module('cdo.app', ['cdo.menu', 'cdo.subscription', 'cdo.manageSubscription']);
	
})();