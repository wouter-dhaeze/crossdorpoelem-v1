<input type="hidden" name="id" ng-model="<?= $ngmodelId ?>" />
<div class="row" ng-hide="<?= $ngReadonly ?>">
	<div class="callout small primary">
		<p>Velden met een * zijn verplicht.</p>
		<p>Vul de gegevens correct in. Dit is van belang voor uw verzekering.</p>
	</div>
</div>
<div class="row">
	<div class="large-2 columns">
		<label for="wave<?= $ngMemberIndex?>" class="right inline">Wave <span ng-hide="<?= $ngReadonly ?>">*</span></label>
	</div>
	<div class="large-10 columns">
		<select class="large-6" ng-model="<?= $ngmodelWave ?>"
					ng-options="wave.id as wave.label disable when wave.notAnOption for wave in waveOptions" ng-disabled="<?= $ngReadonly ?>">
		</select>
	</div>
</div>


<div class="row">
	<div class="large-2 columns">
		<label for="fname<?= $ngMemberIndex?>" class="right inline">Voornaam <span ng-hide="<?= $ngReadonly ?>">*</span></label>
	</div>
	<div class="large-10 columns">
		<input type="text" id="fname<?= $ngMemberIndex?>" name="fname<?= $ngMemberIndex?>" placeholder="Voornaam"
			ng-model="<?= $ngmodelFirstName ?>" ng-readonly="<?= $ngReadonly ?>" required></input>
		<div class="callout alert small" role="alert" ng-show="<?= $formName?>.fname<?= $ngMemberIndex?>.$dirty && <?= $formName?>.fname<?= $ngMemberIndex?>.$error.required">Voornaam verplicht</div>
	</div>
</div>
<div class="row">
	<div class="large-2 columns">
		<label for="lname<?= $ngMemberIndex?>" class="right inline">Familienaam <span ng-hide="<?= $ngReadonly ?>">*</span></label>
	</div>
	<div class="large-10 columns">
		<input type="text" id="lname<?= $ngMemberIndex?>" name="lname<?= $ngMemberIndex?>" placeholder="Familienaam"
			ng-model="<?= $ngmodelLastName ?>" ng-readonly="<?= $ngReadonly ?>" required></input>
		<div class="callout alert small" role="alert" ng-show="<?= $formName?>.lname<?= $ngMemberIndex?>.$dirty && <?= $formName?>.lname<?= $ngMemberIndex?>.$error.required">Familienaam verplicht</div>
	</div>
</div>
<div class="row">
	<div class="large-2 columns">
		<label for="gender<?= $ngMemberIndex?>" class="right inline">Geslacht <span ng-hide="<?= $ngReadonly ?>">*</span></label>
	</div>
	<div class="large-10 columns">
		<input style="float: left" id="genderMale<?= $ngMemberIndex?>" type="radio" name="gender<?= $ngMemberIndex?>" value="M" ng-model="<?= $ngmodelGender ?>" ng-disabled="<?= $ngReadonly ?>" required></input><label style="float: left; padding-right: 10px" for="genderMale<?= $ngMemberIndex?>"><?= $maleLabel ?></label>
  		<div style="clear: both"></div>
  		<input style="float: left" id="genderFemale<?= $ngMemberIndex?>" type="radio" name="gender<?= $ngMemberIndex?>" value="F" ng-model="<?= $ngmodelGender ?>" ng-disabled="<?= $ngReadonly ?>" required></input><label style="float: left; padding-right: 10px" for="genderFemale<?= $ngMemberIndex?>"><?= $femaleLabel ?></label>
  		<div style="clear: both"></div>
	</div>
</div>
<div class="row">
	<div class="large-2 columns">
		<label for="dob<?= $ngMemberIndex?>" class="right inline">Geboortedatum <span ng-hide="<?= $ngReadonly ?>">*</span></label>
	</div>
	<div class="large-10 columns">
		<input type="text" id="dob<?= $ngMemberIndex?>" name="dob<?= $ngMemberIndex?>" 
			placeholder="dd/MM/yyyy" ui-mask="99/99/9999" ui-mask-placeholder ui-mask-placeholder-char="_" model-view-value="true"
			ng-model="<?= $ngmodelDob ?>" ng-readonly="<?= $ngReadonly ?>" required></input>

		<!-- <div class="callout alert small" role="alert" ng-show="<?= $formName?>.dob<?= $ngMemberIndex?>.$dirty && <?= $formName?>.dob<?= $ngMemberIndex?>.$error.dob">Ongeldige geboortedatum</div> -->
		<div class="callout alert small" role="alert" ng-show="<?= $formName?>.dob<?= $ngMemberIndex?>.$dirty && <?= $formName?>.dob<?= $ngMemberIndex?>.$error.required">Geboortedatum verplicht</div>
	</div>
</div>
<div class="row">
	<div class="large-2 columns">
		<label for="email<?= $ngMemberIndex?>" class="right inline">E-mail <span ng-hide="<?= $ngReadonly ?>">*</span></label>
	</div>
	<div class="large-10 columns">
		<input type="email" id="email<?= $ngMemberIndex?>" name="email<?= $ngMemberIndex?>" placeholder="E-mail" type="email"
			ng-model="<?= $ngmodelEmail ?>" ng-readonly="<?= $ngReadonly ?>" required></input>
		<div class="callout alert small" role="alert" ng-show="<?= $formName?>.email<?= $ngMemberIndex?>.$error.email">Ongeldig e-mailadres</div>
		<div class="callout alert small" role="alert" ng-show="<?= $formName?>.email<?= $ngMemberIndex?>.$dirty && <?= $formName?>.email<?= $ngMemberIndex?>.$error.required">E-mailadres verplicht</div>
	</div>
</div>
<div class="row">
	<div class="large-2 columns">
		<label for="pcode<?= $ngMemberIndex?>" class="right inline">Postcode <span ng-hide="<?= $ngReadonly ?>">*</span></label>
	</div>
	<div class="large-10 columns">
		<input type="text" id="pcode<?= $ngMemberIndex?>" name="pcode<?= $ngMemberIndex?>" 
			placeholder="9999" ui-mask="9999" ui-mask-placeholder ui-mask-placeholder-char="_" model-view-value="true"
			ng-model="<?= $ngmodelPcode ?>" ng-readonly="<?= $ngReadonly ?>" required></input>
			
		<div class="callout alert small" role="alert" ng-show="<?= $formName?>.pcode<?= $ngMemberIndex?>.$dirty && <?= $formName?>.pcode<?= $ngMemberIndex?>.$error.pcode">Ongeldige postcode</div>
	</div>
</div>
<div class="row" ng-hide="<?= $ngHideCode ?>">
	<div ng-hide="<?= $ngmodelWave ?> == 'PARTY'">
		<div class="large-2 columns">
			<label for="code<?= $ngMemberIndex?>" class="right inline">Code</label>
		</div>
		<div class="large-10 columns">
			<input type="text" id="code<?= $ngMemberIndex?>" name="code<?= $ngMemberIndex?>"
				placeholder="Sponsorcode"
				ng-model="<?= $ngmodelCode ?>" ng-readonly="<?= $ngReadonly ?>"></input>
			<small ng-hide="<?= $ngReadonly ?>">Indien u een sponsor bent, vul dan hier uw code in. (Enkel geldig voor 5 en 10 km.)</small>
		</div>
	</div>
</div>
<div class="row" ng-hide="<?= $ngHideNumber ?>">
	<div class="large-2 columns">
		<label for="number<?= $ngMemberIndex?>" class="right inline">Borstnummer</label>
	</div>
	<div class="large-10 columns">
		<input type="text" id="number<?= $ngMemberIndex?>" name="number<?= $ngMemberIndex?>"
			ng-model="<?= $ngmodelNumber ?>" ng-readonly="<?= $ngReadonly ?>"></input>
	</div>
</div>
<div class="row" ng-hide="<?= $ngHideParticipant ?>">
	<div class="large-2 columns">
		<label for="participant<?= $ngMemberIndex?>" class="right inline">Deelnemer?</label>
	</div>
	<div class="large-10 columns">
		<input type="checkbox" id="participant<?= $ngMemberIndex?>" name="participant<?= $ngMemberIndex?>"
				ng-model="<?= $ngmodelParticipant ?>" ng-disabled="<?= $ngReadonly ?>"></input>
	</div>
</div>
<div class="row" ng-hide="<?= $ngHideValidated ?>">
	<div class="large-2 columns">
		<label for="validated<?= $ngMemberIndex?>" class="right inline">Gevalideerd?</label>
	</div>
	<div class="large-10 columns">
		<input type="checkbox" id="validated<?= $ngMemberIndex?>" name="validated<?= $ngMemberIndex?>"
				ng-model="<?= $ngmodelValidated ?>" ng-disabled="<?= $ngReadonly ?>"></input>
	</div>
</div>
<div class="row" ng-hide="<?= $ngHideConsent ?>">
	<div class="large-2 columns">
		<label for="consent<?= $ngMemberIndex?>" class="right inline">Consent?</label>
	</div>
	<div class="large-10 columns">
		<input type="checkbox" id="consent<?= $ngMemberIndex?>" name="consent<?= $ngMemberIndex?>"
				ng-model="<?= $ngmodelConsent ?>" ng-disabled="<?= $ngReadonly ?>"></input>
	</div>
</div>
<div class="row" ng-hide="<?= $ngHidePublicProfile ?>">
	<div class="large-2 columns">
		<label for="public_profile<?= $ngMemberIndex?>" class="right inline">Publiek profiel?</label>
	</div>
	<div class="large-10 columns">
		<input type="checkbox" id="public_profile<?= $ngMemberIndex?>" name="public_profile<?= $ngMemberIndex?>"
				ng-model="<?= $ngmodelPublicProfile ?>" ng-disabled="<?= $ngReadonly ?>"></input>
	</div>
</div>
