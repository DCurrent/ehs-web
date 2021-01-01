<!--Note: PHP self is nessesary to override any link vars.-->
<form role="form" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
	<div class="input-group">
		<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
		<input type="text" class="form-control" name="account" id="account" placeholder="Link Blue Account" required>
	</div>
	<br>
	<div class="input-group">
		<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
		<input type="password" class="form-control" name="credential" id="credential" placeholder="Password" required>
	</div>

	<br>

	<button type="submit" name="access_action" value="<?php echo \dc\stoeckl\ACTION::LOGIN; ?>" class="btn btn-default"><span class="glyphicon glyphicon-log-in"></span> Login</button>
</form>