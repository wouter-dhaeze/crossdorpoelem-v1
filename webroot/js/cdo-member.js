(function() {
	var modMember = angular.module('cdo.member', []);
	
	modMember.controller('memberCtrl', function($scope, $log, $http) {
		$scope.errorMessage = null;
		$scope.result = null;
		
		$scope.loadMembers = function() {
			$('#modalSearching').foundation('open');
			
			$http.get('../api/member.json').then(function(response) {
				//alert(angular.toJson(response, true));
				$('#modalSearching').foundation('close');
				$scope.result = response.data;
			}, 
			function(response) {
				//alert(angular.toJson(response, true));
				$('#modalSearching').foundation('close');
				$scope.errorMessage = response.data.message;
				
				$log.debug(response.data);
			});
		};
 			
	});
})();