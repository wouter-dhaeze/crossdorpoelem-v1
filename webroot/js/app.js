$(document).foundation();

(function() {
	angular.module('cdo.menu', []);
	angular.module('cdo.subscription', ['ui.mask']);
	angular.module('cdo.manageSubscription', []);
        angular.module('cdo.member', []);

	var cdoApp = angular.module('cdo.app', ['cdo.menu', 'cdo.subscription', 'cdo.manageSubscription', 'cdo.member']);
	
})();