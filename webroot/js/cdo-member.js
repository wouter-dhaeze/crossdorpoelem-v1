(function() {
	var modParticipant = angular.module('cdo.participant', []);
	
	modParticipant.controller('participantCtrl', function($scope, $log, $http) {
		$scope.debugHelp = "test";
		
		$scope.errorMessage = null;
		$scope.result = null;
		
		$scope.search = function() {
			$('#modalSearching').foundation('open');
			
			var res = $http.get('../api/participant.json');
			res.success(function(data, status, headers, config) {
				$('#modalSearching').foundation('close');
				$scope.result = data;
			});
			res.error(function(data, status, headers, config) {
				$('#modalSearching').foundation('close');
				$scope.errorMessage = data.message;
				
				$log.debug(data);
			});
		};
 			
	});
})();