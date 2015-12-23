(function() {
	var app = angular.module('cdoApp', []);

	app.controller('InterestCtrl', function($scope, $log, $http) {
		$scope.email = '';
		
		$scope.showInProgress = false;
		$scope.showSuccess = false;
		$scope.showError = false;
		
		$scope.submitInterest = function() {
			$scope.showInProgress = true;
			
			var modal = UIkit.modal("#mdlSaveEmail");
			modal.show();
			
			var i = {};
			i.email = this.email;
			
			var res = $http.post('/api/interest.json', angular.toJson(i));
			res.success(function(data, status, headers, config) {
				//alert("save success: " + data);
				//$scope.subscription = data;
				//$scope.debugHelp = data;
				$scope.showError = false;
				$scope.showSuccess = true;
				$scope.showInProgress = false;
				modal.hide();
			});
			res.error(function(data, status, headers, config) {
				//alert("failure message: " + status);
				//alert( "failure message: " + JSON.stringify({data: data}));
				$log.debug(data);
				$scope.showError = true;
				$scope.showSuccess = false;
				$scope.showInProgress = false;
				modal.hide();
			});	
			
			$scope.email = '';
			$scope.interestForm.$setPristine();
			
		}
		
	});
	
})();