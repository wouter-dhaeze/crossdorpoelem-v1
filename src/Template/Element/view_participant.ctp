<input type="hidden" name="id" ng-model="<?= $ngmodelId ?>" />
<div class="row">
	<div class="large-2 columns">
		<label class="right inline">Naam</label>
	</div>
	<div class="large-10 columns">
		<span><?= $participant->fname . ' ' . $participant->lname ?></span>
	</div>
</div>
<div class="row">
	<div class="large-2 columns">
		<label class="right inline">E-mail</label>
	</div>
	<div class="large-10 columns">
		<span><?= $participant->email ?></span>
	</div>
</div>
<div class="row">
	<div class="large-2 columns">
		<label class="right inline">Geboortedatum</label>
	</div>
	<div class="large-10 columns">
		<span><?= h($participant->dob) ?></span>
	</div>
</div>
<div class="row">
	<div class="large-2 columns">
		<label class="right inline">Borstnummer</label>
	</div>
	<div class="large-10 columns">
		<span><?= $participant->number == "N/A" ? "Nog niet toegekend" : $participant->number ?></span>
	</div>
</div>