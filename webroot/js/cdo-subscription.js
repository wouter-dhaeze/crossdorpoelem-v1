(function() {
	var subscriptionApp = angular.module('subscriptionApp', []);

	subscriptionApp.controller('subscriptionCtrl', function($scope, $log, $http) {
		$scope.debugHelp = "test";
		
		$scope.waveOptions = waveOptions;
		//$scope.selectedWave = $scope.waveOptions[0];
		//$scope.selectedWave = $scope.waveOptions[2];
		
		//$scope.subscription = emptySubscription;
		$scope.subscription = dummySubscription;
		
		$log.debug("gender" + $scope.subscription.participant1.gender);
		
		$scope.errorMessage = null;
		
		$scope.subscriptionSuccess = false;
		
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
				$scope.subscriptionSuccess = true;
			});
			res.error(function(data, status, headers, config) {
				//alert("failure message: " + status);
				//alert( "failure message: " + JSON.stringify({data: data}));
				$scope.errorMessage = data.message;
				$scope.subscriptionSuccess = false;
				
				$log.debug(data);
			});		
		}
		
		$scope.lookup = function() {
			$scope.errorMessage = null;
			
			var res = $http.get('../api/subscription.json?code=' + $scope.subscription.code);
			res.success(function(data, status, headers, config) {
				
				
				alert(angular.toJson(data));
			});
			res.error(function(data, status, headers, config) {
				$scope.errorMessage = data.message;
				
				$log.debug(data);
			});	
		}
	});
	
	var waveOptions = [
	                   {id: 'CHOOSE', label: '--- Kies je wave ---', notAnOption: false}, 
	                   {id: 'YOUTH', label: 'Duo run (2,5 km)', notAnOption: false}, 
	                   {id: 'ADULT', label: 'Big run (5,5 km)', notAnOption: false}];
	
	var emptyParticipant = {
		id: '',
		gender: '',
		fname: '',
		lname: '',
		email: '',
		dob: '',
		number: '',
		order: ''	
	};
	
	var emptySubscription = {
		id: '',
		//wave: waveOptions[0],
		wave: waveOptions[2],
		code: '',
		payed: false,
		validated: false,
		participant1: emptyParticipant,
		participant2: emptyParticipant
	};
	
	var dummyParticipant = {
		id: '',
		gender: 'M',
		fname: 'qsdf',
		lname: 'qsdf',
		email: 'qsdf@qsdf111.com',
		dob: new Date(2013, 9, 22),
		number: 'N/A',
		start_order: 1	
	};
	
	var dummyParticipant2 = {
		id: '',
		gender: 'F',
		fname: 'qsdf',
		lname: 'qsdf',
		email: 'qsdf@qsdf111.com',
		dob: new Date(1986, 9, 22),
		number: 'N/A',
		start_order: 2	
	};
	
	var dummySubscription = {
		id: '',
		//wave: waveOptions[0],
		wave: waveOptions[1],
		//wave: waveOptions[2],
		code: '',
		payed: false,
		validated: false,
		participant1: dummyParticipant,
		participant2: dummyParticipant2
	};
	
	
	
})();