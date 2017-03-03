var models = new function() {
	
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
	
	function createNewMember() {
		return angular.copy(emptyMember);
	}
	
	this.populateMember = function(m) {
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