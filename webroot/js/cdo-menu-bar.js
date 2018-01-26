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
	
	//Fix for IE11 and lower
	if (!String.prototype.startsWith) {
		String.prototype.startsWith = function(searchString, position) {
			position = position || 0;
			return this.indexOf(searchString, position) === position;
		};
	}
	
	angular.element(document).ready(function () {
		$('.menu a').each(function() {
			var id = $(this).attr('id');
			var loc = window.location.href;
			if(id != 'menu-home' && loc.startsWith(this.href.trim()))
				$(this).parent("li").addClass("is-active");
            });
	});

})();

