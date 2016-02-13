(function() {

	angular.module('cdo.menu', [])
		.controller('menuCtrl', function($scope) {
			$scope.m = "test";
			$scope.code = "";
			$scope.loading = false;
			
			$scope.lookup = function() {
				$scope.loading = true;
				if ($scope.code) {
					location.href = "/subscription/" + $scope.code;
				}
			};
		
	});

})();