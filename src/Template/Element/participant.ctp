<div class="row">
	<div class="large-2 columns">
		<label for="<?= $idPrefix?> . gender" class="right inline">Geslacht</label>
	</div>
	<div class="large-10 columns">
		<input type="radio" name="gender" value="MALE" ng-model="<?= $ngmodelGender ?>">Mannelijk</input>
  		<input type="radio" name="gender" value="FEMALE" ng-model="<?= $ngmodelGender ?>">Vrouwelijk</input>
	</div>
</div>
<div class="row">
	<div class="large-2 columns">
		<label for="<?= $idPrefix?> . fname" class="right inline">Voornaam</label>
	</div>
	<div class="large-10 columns">
		<input type="text" id="<?= $idPrefix?> . fname" placeholder="Voornaam"
			ng-model="<?= $ngmodelFirstName ?>">
	</div>
</div>
<div class="row">
	<div class="large-2 columns">
		<label for="<?= $idPrefix?> . lname" class="right inline">Familienaam</label>
	</div>
	<div class="large-10 columns">
		<input type="text" id="<?= $idPrefix?> . lname" placeholder="Familienaam"
			ng-model="<?= $ngmodelLastName ?>">
	</div>
</div>
<div class="row">
	<div class="large-2 columns">
		<label for="<?= $idPrefix?> . email" class="right inline">Email</label>
	</div>
	<div class="large-10 columns">
		<input type="text" id="<?= $idPrefix?> . email" placeholder="Email"
			ng-model="<?= $ngmodelEmail ?>">
	</div>
</div>
<div class="row">
	<div class="large-2 columns">
		<label for="<?= $idPrefix?> . dob" class="right inline">Geboortedatum</label>
	</div>
	<div class="large-4 columns">
		<input type="text" id="<?= $idPrefix?> . dob" placeholder="dd/MM/yyyy"
			ng-model="<?= $ngmodelDob ?>">
	</div>
	<div class="large-6 columns">
		<label>(Format: 09/03/1982)</label>
	</div>
</div>