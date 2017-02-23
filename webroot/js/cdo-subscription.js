(function() {
	var modSubscription = angular.module('cdo.subscription', ['ui.mask']);
	
	modSubscription.controller('subscriptionCtrl', function($scope, $log, $http) {
		$scope.showInfo = true;
		//$scope.showInfo = false;
		
		$scope.subscription = emptySubscription;
		$scope.currentMember;
		$scope.currentMemberIndex = -1;
		
		$scope.cost = 0;
		
		$scope.step = 1;
		
		$scope.waveOptions = waveOptions;
		
		$scope.start = function() {
			$("html, body").animate({ scrollTop: 0 }, "slow", function() {
				$('#modalStartSubscription').foundation('open');
			});
		};
		
		$scope.createSubscriber = function(isParticipant) {
			$scope.step++;
			
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
			
			//TODO set sponsorcode to empty if partyrun
			
			alert('submit');
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