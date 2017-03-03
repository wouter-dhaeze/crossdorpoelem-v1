<?php 

use Cake\I18n\Time;
Time::setToStringFormat('dd/MM/yyyy');

?>

<?php if (empty($member)) : ?>
<div class="row">
    <div class="callout alert">Er werd geen deelnemer met deze code gevonden.</div>
</div>
<?php endif; ?>

<?php if (!empty($member)) : ?>
<div ng-controller="memberCtrl"  ng-init="loadMember('<?= $member->code ?>')">
<div class="row" ng-show="errorMessage">
    <div class="callout alert">{{errorMessage}}</div>
</div>
<div class="row" ng-hide="errorMessage">
	<div ng-show="!member.validated">
		<div class="callout warning">Uw deelname werd nog niet gevalideerd. Lees onderstaande informatie en klik op valideer.</div>
	</div>
	member found
	<br/>
	memberid: {{member.id}}
</div>
</div>
<?php endif; ?>

<?php 
$this->start('script');
?>

	<script src="/js/cdo-models.js"></script>
	<script src="/js/cdo-member.js"></script>

<?php 
$this->end();
?>
