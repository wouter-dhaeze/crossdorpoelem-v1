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
	
	angular.element(document).ready(function () {
		$('.menu a').each(function(index) {
			if(this.href.trim() == window.location)
                $(this).parent("li").addClass("menu-text selected");
            });
	});

})();

