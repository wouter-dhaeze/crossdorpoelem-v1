(function() {
	var modManageSubscription = angular.module('cdo.manageSubscription', ['ui.mask']);
	
	modManageSubscription.controller('manageSubscriptionCtrl', function($scope, $log, $http) {
		$scope.subscriptions = [];
		$scope.subscription = null;
		
		$scope.totalSubscriptions = 0;
		
		$scope.showOverview = true;
		$scope.showDetail = false;
		
		$scope.waveOptions = waveOptions;
		
		$scope.filter = {
				code: '',
				wave: 'undefined',
				validated: 'undefined',
				payed: 'undefined',
				sponsor: 'undefined'
			};
		
		$scope.jsonResult = null;
		
		$scope.loadSubscriptions = function() {
			$('#modalWait').foundation('open');
			
			$http.get('../api/manage/subscription.json').then(function(response) {
				parseResult(response);
				
				$('#modalWait').foundation('close');
				//alert(angular.toJson(response, true));
				$scope.jsonResult = angular.toJson(response, true);
			}, 
			function(result) {
				alert(angular.toJson(result, true));
				
				$('#modalWait').foundation('close');
			});
		};
		
		$scope.searchByCode = function(code) {
			$('#modalWait').foundation('open');
			
			$http.get('../api/manage/subscription.json?code=' + code).then(function(response) {
				parseResult(response);
				
				$('#modalWait').foundation('close');
				//alert(angular.toJson(response, true));
			}, 
			function(response) {
				alert(angular.toJson(response, true));
				
				$('#modalWait').foundation('close');
			});
		}
		
		$scope.openDetails = function(code) {
			$('#modalWait').foundation('open');
			
			$http.get('../api/manage/subscription.json?code=' + code).then(function(response) {
				$scope.subscription = models.populateSubscription(response.data.subscriptions[0]);
				
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
		};
		
		function parseResult(response) {
			$scope.subscriptions = models.populateSubscriptions(response.data.subscriptions);
			
			$scope.totalSubscriptions = response.data.totalSubscriptions;
			$scope.totalValidatedSubscriptions = response.data.totalValidatedSubscriptions;
		    $scope.totalPayedSubscriptions = response.data.totalPayedSubscriptions;
		    $scope.totalRevenue = response.data.totalRevenue;
		    $scope.totalMembers = response.data.totalMembers;
		    $scope.totalValidatedMembers = response.data.totalValidatedMembers;
		    $scope.payed5KM = response.data.payed5KM;
		    $scope.payed10KM = response.data.payed10KM;
		    $scope.payedPARTY = response.data.payedPARTY;
		    $scope.total5KM = response.data.total5KM;
		    $scope.total10KM = response.data.total10KM;
		    $scope.totalPARTY = response.data.totalPARTY;
		}
		
	});
	
	var waveOptions = [
	                   {id: '5KM', label: 'Crossdorp 5 KM', notAnOption: false, cost: 8},
	                   {id: '10KM', label: 'Crossdorp 10 KM', notAnOption: false, cost: 10},
	                   {id: 'PARTY', label: 'Crossdorp Party Run', notAnOption: false, cost: 15}
	               ];
	
})();