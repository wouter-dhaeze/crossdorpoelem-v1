(function() {
	var subscriptionApp = angular.module('subscriptionApp', []);

	subscriptionApp.controller('subscriptionCtrl', function($scope, $log, $http) {
		$scope.debugHelp = "test";
		
		$scope.waveOptions = waveOptions;
		//$scope.selectedWave = $scope.waveOptions[0];
		//$scope.selectedWave = $scope.waveOptions[2];
		
		$scope.subscription = emptySubscription;
		
		$scope.errorMessage = null;
		
		$scope.waveSelected = function() {
			$log.debug('wave selected');
			$scope.waveOptions[0].notAnOption = true;	
		}
		
		$scope.subscribe = function() {
			
			//alert(angular.toJson($scope.subscription));
			
			$log.debug(angular.toJson($scope.subscription));
			var res = $http.post('../api/subscription.json', $scope.subscription);
			res.success(function(data, status, headers, config) {
				$scope.errorMessage = null;
			});
			res.error(function(data, status, headers, config) {
				//alert("failure message: " + status);
				//alert( "failure message: " + JSON.stringify({data: data}));
				$scope.errorMessage = data.message;
				
				$log.debug(data);
			});		
		}
	});
	
	var waveOptions = [
	                   {id: 'CHOOSE', label: '--- Kies je wave ---', notAnOption: false}, 
	                   {id: 'YOUTH', label: 'Duo run (2,5 km)', notAnOption: false}, 
	                   {id: 'ADULT', label: 'Big run (5,5 km)', notAnOption: false}];
	
	var emptySubscription = {
		//wave: waveOptions[0],
		wave: waveOptions[2],
		aGender: '',
		aFirstName: '',
		aLastName: '',
		aEmail: '',
		aDob: '',
		sponsorCode: ''
	};
	
})();