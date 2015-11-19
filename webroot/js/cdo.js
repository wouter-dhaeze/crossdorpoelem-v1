(function() {
	var app = angular.module('cdoApp', []);

	app.controller('InterestCtrl', function($scope) {
		$scope.email = '';
		
		$scope.showSuccess = false;
		$scope.showError = false;
		
		$scope.submitInterest = function() {
			alert("submitting email: " + this.email);
			$scope.email = '';
			$scope.interestForm.$setPristine();
			
			$scope.showSuccess = true;
			
			/*$log.debug(angular.toJson($scope.subscription));
			var res = $http.post('../api/subscriptions.json', $scope.subscription);
			res.success(function(data, status, headers, config) {
				//$scope.subscription = data;
				$scope.debugHelp = data;
				$scope.step = StepEnum.SUCCESS;
			});
			res.error(function(data, status, headers, config) {
				alert("failure message: " + status);
				//alert( "failure message: " + JSON.stringify({data: data}));
				$log.debug(data);
				$scope.debugHelp = data;
			});		*/		
		}
		
	});
	
})()

/*(function() {
	var app = angular.module('subscriptionApp', []);

	app.controller('subscriptionCtrl', function($scope, $log, $http) {
		$scope.debugHelp = "";
		
		$scope.steps = StepEnum;
		$scope.step = StepEnum.SUBSCRIBER;
		
		$scope.subscription = {
			participants: []
		};
		$scope.subscriber = {};
		//comment three lines below!!
		$scope.subscription = testSubscription;
		$scope.subscriber = testSubscription.subscriber;
		$scope.step = StepEnum.CAPTCHA;
		
		$scope.participant = null;
		
		$scope.subscribe = function(subscriber, participates) {
			try {
				$log.info(subscriber.email + ' participates? ' + participates);
				$scope.subscription.subscriber = subscriber;
				
				if (participates) {
					$scope.newParticipant();
					$scope.participant.firstName = subscriber.firstName;
					$scope.participant.lastName = subscriber.lastName;
					$scope.participant.email = subscriber.email;
					$scope.participant.dateOfBirth = subscriber.dateOfBirth;
					//$scope.subscription.participants.push(participant);
				}
				
				$scope.step = StepEnum.PARTICIPANTS;
				$log.debug(angular.toJson($scope.subscription));
			} catch(e) {
				$log.error("Error occured while subscribing: " + e.message);
			}
		}
		
		$scope.addParticipant = function(participant) {
			$scope.subscription.participants.push(participant);
			$scope.participant = null;
		}
		
		$scope.newParticipant = function() {
			$scope.participant = {};
		}
		
		$scope.finishSubscription = function() {
			$scope.step = StepEnum.CAPTCHA;
			//alert("saving this: " + angular.toJson($scope.subscription));
			//$log.debug("Saving subscription: " + angular.toJson($scope.subscription));
		}
		
		$scope.saveSubscription = function(subscription) {
			$log.debug(angular.toJson($scope.subscription));
			var res = $http.post('../api/subscriptions.json', $scope.subscription);
			res.success(function(data, status, headers, config) {
				//$scope.subscription = data;
				$scope.debugHelp = data;
				$scope.step = StepEnum.SUCCESS;
			});
			res.error(function(data, status, headers, config) {
				alert("failure message: " + status);
				//alert( "failure message: " + JSON.stringify({data: data}));
				$log.debug(data);
				$scope.debugHelp = data;
			});		
			
			
		}
	});
	
	var StepEnum = {
		SUBSCRIBER: 1,
		PARTICIPANTS: 2,
		CAPTCHA: 3,
		SUCCESS: 4
	};
	
	var testSubscription = {
			"participants":[
			                {
			               "fname":"qsdf",
			                "lname":"qsdf",
			                "email":"part1@test.com",
			                "dateOfBirth":"01/01/1970"
			                	}
			                ],
			"subscriber":{
				"fname":"subscriber1",
                "lname":"subscriber1",
                "email":"subscriber1@test.com"
			},
			"code":"a code"
		};
	
})();*/