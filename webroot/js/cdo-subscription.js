(function() {
	var modSubscription = angular.module('cdo.subscription', ['ui.mask']);
	
	modSubscription.controller('subscriptionCtrl', function($scope, $log, $http) {
		//$scope.showInfo = true;
		$scope.showInfo = false;

		$scope.subscription = emptySubscription;
		$scope.member = emptyMember;
		//$scope.subscription = dummySubscription;	
		
		$scope.step = 1;
		
		$scope.start = function(participant) {
			$scope.member.subscriber = true;
			$scope.member.participant = participant;
			$scope.step = 2;
			
			$('#modalAddMember').foundation('open');
		}
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
	
	var emptyMember = {
		id: '',
		fname: '',
		lname: '',
		gender: '',
		dob: '',
		email: '',
		pcode: '',
		code: '',
		subscriber: false,
		participant: false,
		validated: false,
		consent: false,
		public_profile: false,
		sponsor: false,
		number: ''	
	};
	
	var emptySubscription = {
		id: '',
		created: '',
		price: 0,
		payed: false,
		validated: false,
		participants: []
	};
	
	var dummyMember = {
		id: '',
		gender: 'M',
		fname: 'wouter',
		lname: 'dhaeze',
		email: 'wouter.dhaeze@gmail.com',
		dob: "09/03/2005",
		number: 'N/A',
		start_order: 1	
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
		consent: false
		//participant2: emptyParticipant1
	};
	
	
	
})();