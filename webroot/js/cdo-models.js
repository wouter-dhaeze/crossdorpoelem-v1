var models = new function() {
	
	var emptySubscription = {
			id: '',
			created: '',
			price: 0,
			payed: false,
			validated: false,
			members: []
		};
	
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
	
	this.populateSubscriptions = function(sarray) {
		var subscriptions = [];
		
		sarray.forEach(function(s) {
			var subscription = populateSubscription(s);
			subscriptions.push(subscription);
		});
		
		return subscriptions;
	}
	
	this.populateSubscription = function(s) {
		return populateSubscription(s);
	}
	
	this.populateMember = function(m) {
		return populateMember(m);
	}
	
	function createNewSubscription() {
		return angular.copy(emptySubscription);
	}
	
	function createNewMember() {
		return angular.copy(emptyMember);
	}
	

	function populateSubscription(s) {
		var subscription = createNewSubscription();
		
		subscription.id = s.id;
		subscription.created = s.created;
		subscription.code = s.code;
		subscription.price = s.price;
		subscription.payed = s.payed;
		subscription.validated = s.validated;
		subscription.members = [];
		
		if (s.member) {
			s.member.forEach(function(m) {
				var member = populateMember(m);
				subscription.members.push(member);
			});
		}
		
		return subscription;
	}
	
	function populateMember(m) {
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
		
		return member;
	}
	
};