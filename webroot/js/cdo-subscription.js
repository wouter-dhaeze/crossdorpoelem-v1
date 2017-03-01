(function() {
	var modSubscription = angular.module('cdo.subscription', ['ui.mask']);
	
	modSubscription.controller('subscriptionCtrl', function($scope, $log, $http) {
		$scope.subscription = emptySubscription;
		//$scope.subscription = angular.copy(dummySubscription);
		$scope.currentMember;
		$scope.currentMemberIndex = -1;
		
		$scope.cost = 0;
		
		$scope.step = 1;
		//$scope.step = 2;
		
		$scope.waveOptions = waveOptions;
		
		$scope.responseCode = "";
		$scope.errorMessages = null;
		$scope.isSystemError = false;
		$scope.isSponsored = false;
		$scope.subscriberMail = '';
		
		$scope.start = function() {
			$("html, body").animate({ scrollTop: 0 }, "slow", function() {
				$('#modalStartSubscription').foundation('open');
			});
		};
		
		$scope.createSubscriber = function(isParticipant) {
			$('#modalStartSubscription').foundation('close');
			
			$scope.newMember(true, isParticipant);						
		};
		
		$scope.newMember = function(isSubscriber, isParticipant) {
			$scope.currentMember = createNewMember();
			//$scope.currentMember = dummyMember;
			$scope.currentMember.subscriber = isSubscriber;
			$scope.currentMember.participant = isParticipant;
			
			$scope.currentMemberIndex = -1;
			
			$('#modalEditMember').foundation('open');
		}
		
		$scope.addEditMember = function() {
			$scope.showInfo = false;
			
			$scope.subscription.members.push($.extend(true, {}, $scope.currentMember));
			
			$scope.currentMember = null;
			$scope.currentMember = -1;
			
			calculateCost();
			
			$('#modalEditMember').foundation('close');
			
			$scope.step = 2;
		};
		
		$scope.updateEditMember = function() {
			$scope.subscription.members[$scope.currentMemberIndex] = $.extend(true, {}, $scope.currentMember);
			
			$scope.currentMember = null;
			$scope.currentMember = -1;
			
			calculateCost();
			
			$('#modalEditMember').foundation('close');
		};
		
		$scope.cancelEditMember = function() {
			$scope.currentMember = null;
			$scope.currentMember = -1;
			
			$('#modalEditMember').foundation('close');
		};
		
		$scope.editMember = function(index) {
			$scope.currentMember = $.extend(true, {}, $scope.subscription.members[index]);
			$scope.currentMemberIndex = index;
			
			$('#modalEditMember').foundation('open');
		};
		
		$scope.initRemoveMember = function(index) {
			$scope.currentMemberIndex = index;
			
			$('#modalRemoveMember').foundation('open');
		};
		
		$scope.cancelRemoveMember = function() {
			$scope.currentMemberIndex = -1;
			
			$('#modalRemoveMember').foundation('close');
		};
		
		$scope.removeMember = function(index) {
			$scope.subscription.members.splice($scope.currentMemberIndex, 1);
			calculateCost();
			
			$scope.currentMemberIndex = -1;
			
			$('#modalRemoveMember').foundation('close');
		};
		
		$scope.initFinalize = function(index) {
			$('#modalFinalize').foundation('open');
		};
		
		$scope.cancelFinalize = function(index) {
			$('#modalFinalize').foundation('close');
		};
		
		$scope.submitSubscription = function() {
			$('#modalFinalize').foundation('close');
			$('#modalSaving').foundation('open');
			
			//TODO set sponsorcode to empty if partyrun
			$http.post('../api/subscription.json', $scope.subscription).then(function(data) {
				$('#modalSaving').foundation('close');
				
				submitSuccess(data);
			}, 
			function(data) {
				$('#modalSaving').foundation('close');
				
				submitFail(data);
			});
		}
		
		function createNewMember() {
			return $.extend(true, {}, emptyMember);
		}
		
		function calculateCost() {
			$scope.cost = 0;
			$.each($scope.subscription.members, function( index, m ) {
				if (m.participant) {
					var c = getAmountFromWaveOptions(m.wave);
					$scope.cost += c;
				}
			});
		}
		
		function getAmountFromWaveOptions(option) {
			var o = waveOptions.filter(function(wo) { return wo.id === option; });
			return o[0].cost;
		}
		
		function submitSuccess(result) {
			$scope.step = 3;
			
			populateSubscription(result);
			
			$scope.isSponsored = false;
			$scope.subscriberMail = '';
			$scope.subscription.members.forEach(function(m) {
				$scope.isSponsored = $scope.isSponsored || m.sponsor;
				if (m.subscriber) {
					$scope.subscriberMail = m.email;
				}
			});
			
			$scope.responseCode = parseInt(result.data.code);
			$scope.errorMessages = null;
		}
		
		function submitFail(result) {
			$scope.responseCode = parseInt(result.data.code);
			$scope.errorMessages = result.data.message.split(";");
			$scope.isSystemError = $scope.responseCode >= 500;
			
			$('#modalErrorSubscription').foundation('open');
		}
		
		function populateSubscription(result) {
			$scope.subscription = angular.copy(dummySubscription);
			$scope.subscription.id = result.data.id;
			$scope.subscription.created = result.data.created;
			$scope.subscription.price = result.data.price;
			$scope.subscription.payed = result.data.payed;
			$scope.subscription.validated = result.data.validated;
			$scope.subscription.members = [];
			
			result.data.member.forEach(function (m, index) {
				var member = createNewMember();
				
				member.id = m.id;
				member.created = m.created;
				member.fname = m.fname;
				member.lname = m.lname;
				member.gender = m.gender;
				member.dob = m.dob;
				member.email = m.email;
				member.pcode = m.pcode;
				member.code = m.code;
				member.subscriber = m.subscriber;
				member.participant = m.participant;
				member.validated = m.validated;
				member.consent = m.consent;
				member.public_profile = m.public_profile;
				member.sponsor = m.sponsor;
				member.number = m.number;
				member.wave = m.wave;
					
				$scope.subscription.members.push(member);
			});	
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
	
	var waveOptions = [
               {id: '5KM', label: 'Crossdorp 5 KM', notAnOption: false, cost: 6},
               {id: '10KM', label: 'Crossdorp 10 KM', notAnOption: false, cost: 10},
               {id: 'PARTY', label: 'Crossdorp Party Run', notAnOption: false, cost: 15}
           ];
	
	var emptyMember = {
		id: '',
		created: '',
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
		number: '',
		wave: ''
	};
	
	var emptySubscription = {
		id: '',
		created: '',
		price: 0,
		payed: false,
		validated: false,
		members: []
	};
	
	var dummyMember = {
		id: '',
		created: '',
		fname: 'Wouter',
		lname: 'Dhaeze',
		gender: 'M',
		dob: '09/03/1982',
		email: 'wouter.dhaeze@gmail.com',
		pcode: '8730',
		code: '',
		subscriber: true,
		participant: true,
		validated: false,
		consent: false,
		public_profile: false,
		sponsor: false,
		number: '',
		wave: '5KM'
	};
	
	var dummySubscription = {
		id: '',
		created: '',
		price: 16,
		payed: false,
		validated: false,
		members: [
			{id: '',
				created: '',
			fname: 'Wouter',
			lname: 'Dhaeze',
			gender: 'M',
			dob: '09/03/1982',
			email: 'wouter.dhaeze@gmail.com',
			pcode: '8730',
			code: '0ULM12',
			subscriber: true,
			participant: true,
			validated: false,
			consent: false,
			public_profile: false,
			sponsor: false,
			number: '',
			wave: '5KM'},
			{
				id: '',
				created: '',
				fname: 'Stella',
				lname: 'Dhaeze',
				gender: 'F',
				dob: '26/02/2016',
				email: 'Stella.dhaeze@gmail.com',
				pcode: '8730',
				code: 'BJ1WHK',
				subscriber: false,
				participant: true,
				validated: false,
				consent: false,
				public_profile: false,
				sponsor: false,
				number: '',
				wave: '10KM'
			}
		          ]
	};
	
	
	
})();