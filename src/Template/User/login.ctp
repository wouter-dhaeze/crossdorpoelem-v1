<?php 
$this->layout = 'cdo-manage';
	
?>
<div class="row users form">
<?= $this->Flash->render('auth') ?>
<form method="post" accept-charset="utf-8" action="/user/login">
	<div style="display:none;">
		<input type="hidden" name="_method" value="POST">
	</div>
	<fieldset>
		<legend>Please enter your username and password</legend>
		<div class="input text">
			<label for="username">Username</label>
			<input type="text" name="username" id="username">
		</div>
		<div class="input password">
			<label for="password">Password</label>
			<input type="password" name="password" id="password">
		</div>
	</fieldset>
	<button class="button large" type="submit">Login</button>
</form>
</div>