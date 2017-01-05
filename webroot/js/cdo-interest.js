/*(function() {
	var cdoApp = angular.module('cdoApp', []);

	cdoApp.controller('InterestCtrl', function($scope, $log, $http) {
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
				$scope.showError = false;
				$scope.showSuccess = true;
				$scope.showInProgress = false;
				modal.hide();
			});
			res.error(function(data, status, headers, config) {
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
	
})();*/