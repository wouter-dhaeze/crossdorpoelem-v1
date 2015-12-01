(function() {
	var app = angular.module('cdoApp', []);

	app.controller('InterestCtrl', function($scope, $log, $http) {
		$scope.email = '';
		
		$scope.showInProgress = false;
		$scope.showSuccess = false;
		$scope.showError = false;
		
		$scope.submitInterest = function() {
			$scope.showInProgress = true;
			
			var i = {};
			i.email = this.email;
			
			var res = $http.post('/api/interest.json', angular.toJson(i));
			res.success(function(data, status, headers, config) {
				alert("save success: " + data);
				//$scope.subscription = data;
				//$scope.debugHelp = data;
				$scope.showSuccess = true;
				$scope.showInProgress = false;
			});
			res.error(function(data, status, headers, config) {
				alert("failure message: " + status);
				//alert( "failure message: " + JSON.stringify({data: data}));
				$log.debug(data);
				$scope.showError = false;
				$scope.showInProgress = false;
			});	
			
			$scope.email = '';
			$scope.interestForm.$setPristine();
			
		}
		
	});
	
})();