(function() {
	$("#adob").mask("99/99/9999");
	$("#y1dob").mask("99/99/9999");
	$("#y2dob").mask("99/99/9999");
	
	var subscriptionApp = angular.module('subscriptionApp', []);

	subscriptionApp.controller('subscriptionCtrl', function($scope, $log, $http) {
		$scope.debugHelp = "test";
		$scope.showInfo = true;
		
		$scope.waveOptions = waveOptions;
		
		//$scope.subscription = emptySubscription;
		$scope.showInfo = false;
		$scope.subscription = dummySubscription;
		
		$scope.errorMessage = null;
		
		$scope.subscriptionSuccess = false;
		
		$scope.waveSelected = function() {
			$log.debug('wave selected');
			$scope.waveOptions[0].notAnOption = true;	
		}
		
		$scope.subscribe = function() {			
			//alert(angular.toJson($scope.subscription));
			$('#modalSaving').foundation('open');
			
			$log.debug(angular.toJson($scope.subscription));
			var res = $http.post('../api/subscription.json', $scope.subscription);
			res.success(function(data, status, headers, config) {
				$scope.errorMessage = null;
				$scope.subscriptionSuccess = true;
				
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
		}
		
		$scope.lookup = function() {
			$scope.errorMessage = null;
			
			var res = $http.get('../api/subscription.json?code=' + $scope.subscription.code);
			res.success(function(data, status, headers, config) {
				
				
				alert(angular.toJson(data));
			});
			res.error(function(data, status, headers, config) {
				$scope.errorMessage = data.message;
				
				$log.debug(data);
			});
		}
	});
	
	subscriptionApp.directive('dob', function() {
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
	                   {id: 'ADULT', label: 'Big run (5 km)', notAnOption: false},
	                   {id: 'YOUTH', label: 'Duo run (2,5 km)', notAnOption: false},
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
		wave: waveOptions[0],
		//wave: waveOptions[2],
		code: '',
		payed: false,
		validated: false,
		participant1: emptyParticipant1,
		participant2: emptyParticipant2
	};
	
	var dummyParticipant1 = {
		id: '',
		gender: 'M',
		fname: 'qsdf',
		lname: 'qsdf',
		email: 'qsdf@qsdf111.com',
		dob: "03/03/1982",
		number: 'N/A',
		start_order: 1	
	};
	
	var dummyParticipant2 = {
		id: '',
		gender: 'F',
		fname: 'qsdf',
		lname: 'qsdf',
		email: 'qsdf@qsdf111.com',
		dob: "03/03/1982",
		number: 'N/A',
		start_order: 2	
	};
	
	var dummySubscription = {
		id: '',
		//wave: waveOptions[0],
		wave: waveOptions[1],
		//wave: waveOptions[2],
		code: '',
		payed: false,
		validated: false,
		participant1: dummyParticipant1,
		//participant2: dummyParticipant2
		participant2: emptyParticipant1
	};
	
	
	
})();