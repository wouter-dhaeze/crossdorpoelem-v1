(function() {
	var modManageSubscription = angular.module('cdo.manageSubscription', ['ui.mask']);
	
	modManageSubscription.controller('manageSubscriptionCtrl', function($scope, $log, $http) {
		$scope.subscriptions = [];
		$scope.subscription = null;
		
		$scope.showOverview = true;
		$scope.showDetail = false;
		
		$scope.waveOptions = waveOptions;
		
		$scope.loadSubscriptions = function() {
			$('#modalWait').foundation('open');
			
			$http.get('../api/manage/subscription.json').then(function(response) {
				$scope.subscriptions = models.populateSubscriptions(response.data);
				
				$('#modalWait').foundation('close');
			}, 
			function(result) {
				alert(angular.toJson(result, true));
				
				$('#modalWait').foundation('close');
			});
		};
		
		$scope.openDetails = function(code) {
			$('#modalWait').foundation('open');
			
			$http.get('../api/manage/subscription.json?code=' + code).then(function(response) {
				$scope.subscription = models.populateSubscription(response.data[0]);
				
				$scope.showOverview = false;
				$scope.showDetail = true;
				
				$('#modalWait').foundation('close');
				//alert(angular.toJson(response, true));
			}, 
			function(response) {
				alert(angular.toJson(response, true));
				
				$('#modalWait').foundation('close');
			});
		};
		
		$scope.payedAction = function() {
			$('#modalWait').foundation('open');
			
			$http.post('../api/manage/subscription.json?action=payed', $scope.subscription).then(function(response) {
				$scope.subscription = models.populateSubscription(response.data);
				
				$scope.showOverview = false;
				$scope.showDetail = true;
				
				$('#modalWait').foundation('close');
				//alert(angular.toJson(response, true));
			}, 
			function(response) {
				alert(angular.toJson(response.data.message, true));
				
				$('#modalWait').foundation('close');
			});
		}
		
	});
	
	var waveOptions = [
	                   {id: '5KM', label: 'Crossdorp 5 KM', notAnOption: false, cost: 8},
	                   {id: '10KM', label: 'Crossdorp 10 KM', notAnOption: false, cost: 10},
	                   {id: 'PARTY', label: 'Crossdorp Party Run', notAnOption: false, cost: 15}
	               ];
	
})();