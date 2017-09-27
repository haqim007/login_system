<?php 


require_once 'app/init.php';

if (!empty($_POST)) {
	$username = $_POST['username'];
	$password = $_POST['password'];

	$signin = $auth->signin([
		'username' => $username,
		'password' => $password
	]);

	if ($signin) {
		header('location: index.php');
	}
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>sign in</title>
</head>
<body>
	<form method="post" action="sign_in.php">
		<fieldset>
			<legend>Sign In</legend>
			<label> Username 
				<input type="text" name="username">
			</label>
			<label> Password 
				<input type="password" name="password">
			</label>
		</fieldset>
		<input type="submit" value="sign in">
	</form>

</body>
</html>