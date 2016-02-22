(function() {
	var modManage = angular.module('cdo.manage', []);
	
	modManage.controller('manageCtrl', function($scope, $log, $http) {
		$scope.debugHelp = "test";
		$scope.showTable = true;
		$scope.searchTerm = '';
		$scope.new_number1 = null;
		$scope.new_number2 = null;
		$scope.result = null;
		
		$scope.waveOptions = waveOptions;
		$scope.filterOptions = filterOptions;
		$scope.waveFilterOptions = waveFilterOptions;
		$scope.filter = {
				wave: 'undefined',
				validated: 'undefined',
				payed: 'FALSE',
				sponsor: 'undefined'
			};
		
		$scope.subscription = emptySubscription;
		//$scope.subscription = dummySubscription;
		
		$scope.errorMessage = null;
		$scope.saveErrorMessage = null;
		$scope.infoMessage = null;
		
		$scope.subscriptionSuccess = false;
		
		$scope.waveSelected = function() {
			$log.debug('wave selected');
			$scope.waveOptions[0].notAnOption = true;
		};
		
		$scope.searchByFilter = function() {
			$scope.searchTerm = '';
			var queryParams = 'wave=' + $scope.filter.wave + '&validated=' + $scope.filter.validated + '&payed=' + $scope.filter.payed + '&sponsor=' + $scope.filter.sponsor;
			$scope.search(queryParams);
		};
		
		$scope.searchByTerm = function(term) {
			var queryParams = 'term=' + term; 
			$scope.search(queryParams);	
		};
		
		$scope.search = function(queryParams) {
			$('#modalSearching').foundation('open');
			
			$scope.infoMessage = null;
			
			//var res = $http.get('../api/subscription.json?wave=' + $scope.filter.wave + '&validated=' + $scope.filter.validated + '&payed=' + $scope.filter.payed + '&sponsor=' + $scope.filter.sponsor);
			var res = $http.get('../api/subscription.json?' + queryParams);
			res.success(function(data, status, headers, config) {
				$('#modalSearching').foundation('close');
				
				//$log.debug(data);
				$scope.result = data;
				
				//alert(angular.toJson(data));
				//populateSubscription(data)
			});
			res.error(function(data, status, headers, config) {
				$('#modalSearching').foundation('close');
				$scope.errorMessage = data.message;
				
				$log.debug(data);
			});
		};
 		
		$scope.openDetails = function(code) {
			$('#modalError').foundation('close');
			$('#modalSearching').foundation('open');
			
			$scope.infoMessage = null;
			$scope.errorMessage = null;
			$scope.saveErrorMessage = null;
			
			var res = $http.get('../api/subscription.json?code=' + code);
			res.success(function(data, status, headers, config) {
				$('#modalSearching').foundation('close');
				$log.debug(data);
				
				//alert(angular.toJson(data));
				populateSubscription(data)
				$scope.showTable = false;
				
				$scope.getNumber('new_number1', 1);
				if ($scope.subscription.wave == 'YOUTH') {
					$scope.getNumber('new_number2', 2);
				}
			});
			res.error(function(data, status, headers, config) {
				$('#modalSearching').foundation('close');
				$scope.errorMessage = data.message;
				
				$log.debug(data);
			});
		};
		
		$scope.sendMail = function(code, type) {
			$('#modalSendingMail').foundation('open');
			$scope.infoMessage = null;
			
			var res = $http.post('/api/email.json?code=' + code + '&type=reminder');
			res.success(function(data, status, headers, config) {
				
				$scope.infoMessage = data;
				$('#modalSendingMail').foundation('close');
				
			});
			res.error(function(data, status, headers, config) {
				$scope.errorMessage = data.message;
				
				$log.debug(data);
				$('#modalSendingMail').foundation('close');
			});
		};
		
		$scope.getNumber = function(field, plus) {
			$scope[field] = 'Vrij nummer zoeken...';
			var res = $http.get('/api/number.json?plus=' + plus);
			res.success(function(data, status, headers, config) {
				$scope[field] = data;
			});
			res.error(function(data, status, headers, config) {
				$scope[field] = null;
			});
		};
		
		$scope.initiatepayed = function() {
			$scope.infoMessage = null;
			$scope.errorMessage = null;
			$('#modalPayed').foundation('open');
		};
		
		$scope.payed = function() {
			try {
				$('#modalPayed').foundation('close');
				$('#modalSaving').foundation('open');
				
				$scope.infoMessage = null;
				$scope.errorMessage = null;
				
				$scope.subscription.participant1.number = $scope.new_number1;
				$scope.subscription.participant2.number = $scope.new_number2;
				$scope.subscription.payed = true;
				var res = $http.put('../api/subscription/' + $scope.subscription.id + '.json', $scope.subscription);
				res.success(function(data, status, headers, config) {
					$scope.new_number1 = null;
					$scope.new_number2 = null;
					$scope.errorMessage = null;
					$scope.subscriptionSuccess = true;

					populateSubscription(data);
										
					$('#modalSaving').foundation('close');
				});
				res.error(function(data, status, headers, config) {
					$scope.new_number1 = null;
					$scope.new_number2 = null;
					//$scope.subscription.payed = false;
					
					//alert("failure message: " + status);
					//alert( "failure message: " + JSON.stringify({data: data}));
					//$scope.errorMessage = data.message;
					$scope.subscriptionSuccess = false;
					
					$('#modalSaving').foundation('close');
					//$('#modalSaveFail').foundation('open');
					$log.debug(data);
					
					$scope.saveErrorMessage = data.message;
					$('#modalError').foundation('open');
					
					//$scope.lookup($scope.subscription.code);
				});	
			} catch (e) {
				$scope.subscription.payed = false;
				$scope.errorMessage = e.message;
			}
		};
		
		$scope.initiatedelete = function() {
			$scope.infoMessage = null;
			$scope.errorMessage = null;
			$('#modalDelete').foundation('open');
		};
		
		$scope.deleted = function(id) {
			$scope.infoMessage = null;
			$scope.errorMessage = null;
			$('#modalDelete').foundation('close');
			$('#modalDeleting').foundation('open');
			
			try {
				var res = $http.delete('../api/subscription/' + $scope.subscription.id + '.json');
				
				res.success(function(data, status, headers, config) {
					$scope.errorMessage = null;
					$scope.infoMessage = data;
					
					$('#modalDeleting').foundation('close');
					$scope.closeDetails();
				});
				res.error(function(data, status, headers, config) {
					$('#modalDeleting').foundation('close');
					
					$scope.errorMessage = data.message;
				});	
			} catch (e) {
				$scope.errorMessage = e.message;
				$('#modalDeleting').foundation('close');
			}

		};
		
		$scope.closeDetails = function() {
			$scope.showTable = true;
			if ($scope.searchTerm != null && $scope.searchTerm != '') {
				//alert("serach by term");
				$scope.searchByTerm($scope.searchTerm);
			} else {
				//alert("search by filter");
				$scope.searchByFilter();
			}
		}
		
		function populateSubscription(data) {
			$scope.subscription.id = data.id;
			$scope.subscription.created = data.created;
			$scope.subscription.code = data.code;
			$scope.subscription.wave = data.wave;
			$scope.subscription.payed = data.payed;
			$scope.subscription.validated = data.validated;
			$scope.subscription.consent = data.consent;
			
			$scope.subscription.participant1.id = data.participant[0].id;
			$scope.subscription.participant1.gender = data.participant[0].gender;
			$scope.subscription.participant1.fname = data.participant[0].fname;
			$scope.subscription.participant1.lname = data.participant[0].lname;
			$scope.subscription.participant1.email = data.participant[0].email;
			$scope.subscription.participant1.dob = data.participant[0].dob;
			$scope.subscription.participant1.number = data.participant[0].number;
			$scope.subscription.participant1.start_order = data.participant[0].start_order;
			
			if ($scope.subscription.wave == 'YOUTH') {
				$scope.subscription.participant2.id = data.participant[1].id;
				$scope.subscription.participant2.gender = data.participant[1].gender;
				$scope.subscription.participant2.fname = data.participant[1].fname;
				$scope.subscription.participant2.lname = data.participant[1].lname;
				$scope.subscription.participant2.email = data.participant[1].email;
				$scope.subscription.participant2.dob = data.participant[1].dob;
				$scope.subscription.participant2.number = data.participant[1].number;
				$scope.subscription.participant2.start_order = data.participant[1].start_order;
			} else {
				$scope.subscription.participant2.id = '';
				$scope.subscription.participant2.gender = '';
				$scope.subscription.participant2.fname = '';
				$scope.subscription.participant2.lname = '';
				$scope.subscription.participant2.email = '';
				$scope.subscription.participant2.dob = '';
				$scope.subscription.participant2.number = '';
				$scope.subscription.participant2.start_order = '';
			}
		};
		
	});
	
	var waveOptions = [
	                   {id: 'CHOOSE', label: '--- Kies je wave ---', notAnOption: false}, 
	                   {id: 'ADULT', label: 'Big run (6 km)', notAnOption: false},
	                   {id: 'YOUTH', label: 'Duo run (2,5 km)', notAnOption: false},
	                   ];
	
	var filterOptions = [
	                   {id: 'undefined', label: 'Undefined'}, 
	                   {id: 'FALSE', label: 'False'},
	                   {id: 'TRUE', label: 'True'}
	                   ];
	
	var waveFilterOptions = [
	  	                   {id: 'undefined', label: 'Undefined'}, 
		                   {id: 'ADULT', label: 'ADULT'},
		                   {id: 'YOUTH', label: 'YOUTH'}
		                   ];
	
	var emptyParticipant1 = {
		id: '',
		gender: '',
		fname: '',
		lname: '',
		email: '',
		dob: '',
		number: '',
		start_order: ''	
	};
	
	var emptyParticipant2 = {
		id: '',
		gender: '',
		fname: '',
		lname: '',
		email: '',
		dob: '',
		number: '',
		start_order: ''	
	};
	
	var emptySubscription = {
		id: '',
		created: '',
		wave: 'CHOOSE',
		code: '',
		payed: false,
		validated: false,
		consent: false,
		participant1: emptyParticipant1,
		participant2: emptyParticipant2
	};
	
})();