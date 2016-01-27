<input type="hidden" name="id" ng-model="<?= $ngmodelId ?>" />
<div class="row">
	<div class="large-2 columns">
		<label for="<?= $idPrefix?>gender" class="right inline">Geslacht</label>
	</div>
	<div class="large-10 columns">
		<input style="float: left" id="<?= $idPrefix?>genderMale" type="radio" name="<?= $idPrefix?>gender" value="M" ng-model="<?= $ngmodelGender ?>" required></input><label style="float: left; padding-right: 10px" for="<?= $idPrefix?>genderMale"><?= $maleLabel ?></label>
  		<div style="clear: both"></div>
  		<input style="float: left" id="<?= $idPrefix?>genderFemale" type="radio" name="<?= $idPrefix?>gender" value="F" ng-model="<?= $ngmodelGender ?>" required></input><label style="float: left; padding-right: 10px" for="<?= $idPrefix?>genderFemale"><?= $femaleLabel ?></label>
  		<div style="clear: both"></div>
	</div>
</div>
<div class="row">
	<div class="large-2 columns">
		<label for="<?= $idPrefix?>fname" class="right inline">Voornaam</label>
	</div>
	<div class="large-10 columns">
		<input type="text" id="<?= $idPrefix?>fname" name="<?= $idPrefix?>fname" placeholder="Voornaam"
			ng-model="<?= $ngmodelFirstName ?>" required></input>
		<div class="alert alert-danger" role="alert" ng-show="<?= $formName?>.<?= $idPrefix?>fname.$dirty && <?= $formName?>.<?= $idPrefix?>fname.$error.required">Voornaam verplicht</div>
	</div>
</div>
<div class="row">
	<div class="large-2 columns">
		<label for="<?= $idPrefix?>lname" class="right inline">Familienaam</label>
	</div>
	<div class="large-10 columns">
		<input type="text" id="<?= $idPrefix?>lname" name="<?= $idPrefix?>lname" placeholder="Familienaam"
			ng-model="<?= $ngmodelLastName ?>" required></input>
		<div class="alert alert-danger" role="alert" ng-show="<?= $formName?>.<?= $idPrefix?>lname.$dirty && <?= $formName?>.<?= $idPrefix?>lname.$error.required">Familienaam verplicht</div>
	</div>
</div>
<div class="row">
	<div class="large-2 columns">
		<label for="<?= $idPrefix?>email" class="right inline">Email</label>
	</div>
	<div class="large-10 columns">
		<input type="email" id="<?= $idPrefix?>email" name="<?= $idPrefix?>email" placeholder="Email" type="email"
			ng-model="<?= $ngmodelEmail ?>" required></input>
		<div class="alert alert-warning" role="alert" ng-show="<?= $formName?>.<?= $idPrefix?>email.$error.email">Ongeldig emailadres</div>
		<div class="alert alert-danger" role="alert" ng-show="<?= $formName?>.<?= $idPrefix?>email.$dirty && <?= $formName?>.<?= $idPrefix?>email.$error.required">Emailadres verplicht</div>
	</div>
</div>
<div class="row">
	<div class="large-2 columns">
		<label for="<?= $idPrefix?>dob" class="right inline">Geboortedatum</label>
	</div>
	<div class="large-10 columns">
		<input type="text" id="<?= $idPrefix?>dob" name="<?= $idPrefix?>dob" placeholder="dd/MM/yyyy"
			ng-model="<?= $ngmodelDob ?>" required dob></input>
		<div class="alert alert-danger" role="alert" ng-show="<?= $formName?>.<?= $idPrefix?>dob.$dirty && <?= $formName?>.<?= $idPrefix?>dob.$error.dob">Ongeldige geboortedatum</div>
	</div>
</div>
<div class="row" ng-hide="<?= $ngHideNumber ?>">
	<div class="large-2 columns">
		<label for="<?= $idPrefix?>number" class="right inline">Borstnummer</label>
	</div>
	<div class="large-10 columns">
		<input type="text" id="<?= $idPrefix?>number" name="<?= $idPrefix?>number"
			ng-model="<?= $ngmodelNumber ?>"></input>
	</div>
</div>
<div class="row" ng-hide="<?= $ngHideOrder ?>">
	<div class="large-2 columns">
		<label for="<?= $idPrefix?>order" class="right inline">Volgorde</label>
	</div>
	<div class="large-10 columns">
		<input type="text" id="<?= $idPrefix?>order" name="<?= $idPrefix?>order"
			ng-model="<?= $ngmodelOrder ?>"></input>
	</div>
</div>