(function() {
	var modSubscription = angular.module('cdo.subscription', ['ui.mask']);
	
	modSubscription.controller('subscriptionCtrl', function($scope, $log, $http) {
		$scope.debugHelp = "test";
		$scope.showInfo = true;
		$scope.lookupcode = '';
		$scope.new_number1 = null;
		$scope.new_number2 = null;
		$scope.result = null;
		
		$scope.waveOptions = waveOptions;
		$scope.filterOptions = filterOptions;
		$scope.waveFilterOptions = waveFilterOptions;
		$scope.filter = {
				wave: 'undefined',
				validated: 'undefined',
				payed: 'undefined',
				sponsor: 'undefined'
			};
		
		$scope.subscription = emptySubscription;
		//$scope.subscription = dummySubscription;
		
		$scope.errorMessage = null;
		
		$scope.subscriptionSuccess = false;
		
		$scope.waveSelected = function() {
			$log.debug('wave selected');
			$scope.waveOptions[0].notAnOption = true;
		};
		
		$scope.openMoreInfo = function() {
			$('#modalMoreInfo').foundation('open');
		};
		
		$scope.subscribe = function() {			
			//alert(angular.toJson($scope.subscription));
			$('#modalSaving').foundation('open');
			
			$log.debug(angular.toJson($scope.subscription));
			var res = $http.post('../api/subscription.json', $scope.subscription);
			res.success(function(data, status, headers, config) {
				$scope.errorMessage = null;
				$scope.subscriptionSuccess = true;
				
				populateSubscription(data);
				
				$('#modalSaving').foundation('close');
			});
			res.error(function(data, status, headers, config) {
				//alert("failure message: " + status);
				//alert( "failure message: " + JSON.stringify({data: data}));
				$scope.errorMessage = data.message;
				$scope.subscriptionSuccess = false;
				
				$('#modalSaving').foundation('close');
				$('#modalSaveFail').foundation('open');
				$log.debug(data);
			});	
		};
		
		$scope.search = function() {
			$('#modalSearching').foundation('open');
			
			var res = $http.get('../api/subscription.json?wave=' + $scope.filter.wave + '&validated=' + $scope.filter.validated + '&payed=' + $scope.filter.payed + '&sponsor=' + $scope.filter.sponsor);
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
 		
		$scope.lookup = function(lookupcode) {
			$scope.errorMessage = null;
			
			var res = $http.get('../api/subscription.json?code=' + lookupcode);
			res.success(function(data, status, headers, config) {
				$log.debug(data);
				
				//alert(angular.toJson(data));
				populateSubscription(data)
			});
			res.error(function(data, status, headers, config) {
				$scope.errorMessage = data.message;
				
				$log.debug(data);
			});
		};
		
		$scope.initiatepayed = function() {
			$('#modalPayed').foundation('open');
		}
		
		$scope.payed = function() {
			try {
				$('#modalPayed').foundation('close');
				$('#modalSaving').foundation('open');
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
					$scope.subscription.payed = false;
					
					//alert("failure message: " + status);
					//alert( "failure message: " + JSON.stringify({data: data}));
					$scope.errorMessage = data.message;
					$scope.subscriptionSuccess = false;
					
					$('#modalSaving').foundation('close');
					//$('#modalSaveFail').foundation('open');
					$log.debug(data);
				});	
				
				$scope.search();
			} catch (e) {
				$scope.subscription.payed = false;
				$scope.errorMessage = e.message;
			}
		};
		
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
	
	modSubscription.directive('dob', function() {
		  return {
		    require: 'ngModel',
		    link: function(scope, elm, attrs, ctrl) {
		      ctrl.$validators.dob = function(modelValue, viewValue) {
		        if (ctrl.$isEmpty(modelValue)) {
		          // consider empty models to be valid
		          return true;
		        }
		        
		        var now = new Date();
		        var parsedDate = $.datepicker.parseDate('dd/mm/yy', modelValue);
		        //alert(parsedDate);
				//var date = new Date(modelValue);
		        //alert(date)
				if (parsedDate > now) {
					return false;
				}
				
				return true;
		      };
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
	
	var dummyParticipant1 = {
		id: '',
		gender: 'M',
		fname: 'wouter',
		lname: 'dhaeze',
		email: 'wouter.dhaeze@gmail.com',
		dob: "09/03/2005",
		number: 'N/A',
		start_order: 1	
	};
	
	var dummyParticipant2 = {
		id: '',
		gender: 'F',
		fname: 'qsdf',
		lname: 'qsdf',
		email: 'qsdf@qsdf111.com',
		dob: "03/03/2005",
		number: 'N/A',
		start_order: 2	
	};
	
	var dummySubscription = {
		id: '',
		created: '',
		//wave: waveOptions[0].id,
		//wave: waveOptions[1].id,
		//wave: waveOptions[2].id,
		wave: 'YOUTH',
		code: '',
		payed: false,
		validated: false,
		consent: false,
		participant1: dummyParticipant1,
		participant2: dummyParticipant2
		//participant2: emptyParticipant1
	};
	
	
	
})();