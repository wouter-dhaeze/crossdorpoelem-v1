(function() {
	var modManageSubscription = angular.module('cdo.manageSubscription', ['ui.mask']);
	
	modManageSubscription.controller('manageSubscriptionCtrl', function($scope, $log, $http) {
		$scope.subscriptions = [];
		$scope.filteredSubscriptions = [];
		$scope.subscription = null;
		$scope.member = null;
		
		$scope.totalSubscriptions = 0;
		
		$scope.showOverview = true;
		$scope.showSubscriptionDetail = false;
		$scope.showMemberDetail = false;
		
		$scope.isCommitNumbers = false;
		
		$scope.waveOptions = waveOptions;
		
		$scope.filterOptions = filterOptions;
		
		$scope.filter = {
				wave: 'undefined',
				validated: 'undefined',
				payed: 'undefined',
				sponsor: 'undefined'
			};
		
		$scope.jsonResult = null;
		
		$scope.loadSubscriptions = function() {
			$('#modalWait').foundation('open');
			
			$scope.showOverview = true;
			$scope.showSubscriptionDetail = false;
			$scope.showMemberDetail = false;
			
			$scope.subscriptions = [];
			$scope.filteredSubscriptions = [];
			$scope.subscription = null;
			$scope.member = null;
			
			$http.get('../api/manage/subscription.json').then(function(response) {
				parseResult(response);
				
				$scope.applyFilter();
				
				$('#modalWait').foundation('close');
				//alert(angular.toJson(response, true));
				$scope.jsonResult = angular.toJson(response, true);
			}, 
			function(result) {
				alert(angular.toJson(result, true));
				
				$('#modalWait').foundation('close');
			});
		};
		
		$scope.searchByCode = function(code) {
			$('#modalWait').foundation('open');
			
			$http.get('../api/manage/subscription.json?code=' + code).then(function(response) {
				parseResult(response);
				
				$scope.clearFilter();
				
				$('#modalWait').foundation('close');
				//alert(angular.toJson(response, true));
			}, 
			function(response) {
				alert(angular.toJson(response, true));
				
				$('#modalWait').foundation('close');
			});
		}
		
		$scope.openSubscriptionDetails = function(code) {
			$('#modalWait').foundation('open');
			
			$http.get('../api/manage/subscription.json?type=s&code=' + code).then(function(response) {
				$scope.subscription = models.populateSubscription(response.data.subscriptions[0]);
				
				$scope.showOverview = false;
				$scope.showSubscriptionDetail = true;
				$scope.showMemberDetail = false;			
				
				$('#modalWait').foundation('close');
				//alert(angular.toJson(response, true));
			}, 
			function(response) {
				alert(angular.toJson(response, true));
				
				$('#modalWait').foundation('close');
			});
		};
		
		$scope.openMemberDetails = function(code) {
			$('#modalWait').foundation('open');
			
			$scope.member = null;
			
			$http.get('../api/manage/subscription.json?type=m&code=' + code).then(function(response) {
				//alert(angular.toJson(response, true));
				$scope.member = models.populateMember(response.data.members[0]);
				
				$scope.showOverview = false;
				$scope.showSubscriptionDetail = false;
				$scope.showMemberDetail = true;
				
				$('#modalWait').foundation('close');
				//alert(angular.toJson(response, true));
			}, 
			function(response) {
				alert(angular.toJson(response, true));
				
				$('#modalWait').foundation('close');
			});
		};
		
		$scope.payedAction = function() {
			$('#modalWait').foundation('open');
			
			$http.post('../api/manage/subscription.json?action=payed', $scope.subscription).then(function(response) {
				$scope.subscription = models.populateSubscription(response.data);
				
				$scope.showOverview = false;
				$scope.showDetail = true;
				
				$('#modalWait').foundation('close');
				//alert(angular.toJson(response, true));
			}, 
			function(response) {
				alert(angular.toJson(response.data.message, true));
				
				$('#modalWait').foundation('close');
			});
		};
		
		$scope.initiateDelete = function() {
			$('#modalDelete').foundation('open');
		};
		
		$scope.deletedSelected = function() {
			$('#modalDelete').foundation('close');
			$('#modalWait').foundation('open');
			
			try {
				var res = $http.delete('../api/manage/subscription/' + $scope.subscription.id + '.json').then(
						function(response) {
							$('#modalWait').foundation('close');
							$scope.loadSubscriptions();
						},
						function(response) {
							$('#modalWait').foundation('close');
							
							alert(angular.toJson(response.data.message, true));
						}
						);	
			} catch (e) {
				alert(e.message);
				$('#modalWait').foundation('close');
			}

		};
		
		$scope.applyFilter = function() {
			$scope.filteredSubscriptions = [];
			$scope.subscriptions.forEach(function(s) {
				if (($scope.filter.validated == 'undefined' ||
						($scope.filter.validated == 'TRUE' && s.validated) ||
						($scope.filter.validated == 'FALSE' && !s.validated)) &&
					($scope.filter.payed == 'undefined' ||
							($scope.filter.payed == 'TRUE' && s.payed) ||
							($scope.filter.payed == 'FALSE' && !s.payed))) {
					$scope.filteredSubscriptions.push(s);
				}
				
			});
		}
		
		$scope.clearFilter = function() {
			$scope.filter.validated= 'undefined';
			$scope.filter.payed = 'undefined';
			
			$scope.applyFilter();
		}
		
		$scope.getStatusColor = function(s) {
			var statusCode = $scope.getStatusCode(s);
			
			if (statusCode == 1) {
				return { background: "red" };
			} else if (statusCode == 2) {
				return { background: "orange" };
			} else if (statusCode == 3) {
				return { background: "yellow" }; 
			} else if (statusCode == 4) {
				return { background: "green" }; 
			}
		}
		
		$scope.getStatusCode = function(s) {
			if (!s.validated) {
				return 1;
			}
			
			if (s.validated && !s.payed) {
				return 2;
			}
			
			var numbersAssigned = true;
			s.members.forEach(function(m) {
				numbersAssigned = (numbersAssigned && (!m.participant || !m.number.length == 0));
			});
			
			if (numbersAssigned) {
				return 4; 
			}
			
			return 3; 
		}
		
		$scope.numberButtonEnabled = function(s) {
			return s.payed && $scope.getStatusCode(s) == 3;
		}
		
		$scope.assignNumbers = function(s) {
			$http.get('../api/number').then(function(response) {
				//alert(angular.toJson(response, true));
				var nparty = response.data["PARTY"];
				var n5km = response.data["5KM"];
				var n10km = response.data["10KM"];
				
				s.members.forEach(function (m) {
					if (m.wave == "PARTY") {
						m.number = nparty;
						nparty++;
					} else if (m.wave == "5KM") {
						m.number = n5km;
						n5km++;
					} else if (m.wave == "10KM") {
						m.number = n10km;
						n10km++;
					} 
				});
				
				$scope.isCommitNumbers = true;
			}, 
			function(response) {
				$scope.isCommitNumbers = true;
				alert(angular.toJson(response, true));
				
				
				//$('#modalWait').foundation('close');
			});
		}
		
		$scope.commitNumbers = function(s) {
			$('#modalWait').foundation('open');
			
			$http.post('../api/manage/subscription.json?action=submit_numbers', $scope.subscription).then(
				function(response) {
					$scope.subscription = models.populateSubscription(response.data);
					
					alert("nummers toegekend!");
					$scope.isCommitNumbers = false;
					
					$('#modalWait').foundation('close');
					//alert(angular.toJson(response, true));
				}, 
				function(response) {
					$scope.isCommitNumbers = false;
					alert(angular.toJson(response, true));
					
					
					//$('#modalWait').foundation('close');
				});
			
			$scope.isCommitNumbers = false;
		}
		
		function parseResult(response) {
			$scope.subscriptions = models.populateSubscriptions(response.data.subscriptions);
			
			$scope.totalSubscriptions = response.data.totalSubscriptions;
			$scope.totalValidatedSubscriptions = response.data.totalValidatedSubscriptions;
		    $scope.totalPayedSubscriptions = response.data.totalPayedSubscriptions;
		    $scope.totalRevenue = response.data.totalRevenue;
		    $scope.totalMembers = response.data.totalMembers;
		    $scope.totalValidatedMembers = response.data.totalValidatedMembers;
		    $scope.payed5KM = response.data.payed5KM;
		    $scope.payed10KM = response.data.payed10KM;
		    $scope.payedPARTY = response.data.payedPARTY;
		    $scope.total5KM = response.data.total5KM;
		    $scope.total10KM = response.data.total10KM;
		    $scope.totalPARTY = response.data.totalPARTY;
		}
		
	});
	
	var waveOptions = [
	                   {id: '5KM', label: 'Crossdorp 5 KM', notAnOption: false, cost: 8},
	                   {id: '10KM', label: 'Crossdorp 10 KM', notAnOption: false, cost: 10},
	                   {id: 'PARTY', label: 'Crossdorp Party Run', notAnOption: false, cost: 15}
	               ];
	
	var filterOptions = [
		                   {id: 'undefined', label: 'Undefined'}, 
		                   {id: 'FALSE', label: 'False'},
		                   {id: 'TRUE', label: 'True'}
		                   ];
	
})();