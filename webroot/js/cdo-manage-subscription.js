(function() {
	var modManageSubscription = angular.module('cdo.manageSubscription', ['ui.mask']);
	
	modManageSubscription.controller('manageSubscriptionCtrl', function($scope, $log, $http) {
		$scope.subscriptions = [];	
		
		$scope.loadSubscriptions = function() {
			$http.get('../api/manage/subscription.json').then(function(response) {
				$scope.subscriptions = models.populateSubscriptions(response.data);
			}, 
			function(data) {
				alert(angular.toJson(data, true));
			});
		}
		
	});
	
})();