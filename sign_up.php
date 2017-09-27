<?php 


require_once 'app/init.php';

if (!empty($_POST)) {
	$email = $_POST['email'];
	$username = $_POST['username'];
	$password = $_POST['password'];

	$validator = new Validator($database, $errorHandler);

	$validation = $validator->check($_POST, [
		'email' => [
			'required' => true,
			'maxlength' => 200,
			'unique' => 'users',
			'email' =>true

		],
		'username' => [
			'required' => true,
			'minlength' => 5,
			'maxlength' => 20,
			'unique' => 'users'
		],
		'password' =>[
			'required' => true,
			'minlength' => 6
		]
 	]);

 	if ($validation->fails()) {
 		echo "<pre>", print_r($validation->errors()->all(), true), "</pre>";
 	} else {
	 		 $created = $auth->create([
			'email' => $email,
			'username' =>$username,
			'password' =>$password
			]);

			if ($created) {
				header('location: index.php');
				
			}
 	}

	
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>sign up</title>
</head>
<body>
	<form method="post" action="">
		<fieldset>
			<legend>Sign Up</legend>
			<label> Email 
				<input type="email" name="email">
			</label>
			<label> Username 
				<input type="text" name="username">
			</label>
			<label> Password 
				<input type="password" name="password">
			</label>
		</fieldset>
		<input type="submit" value="sign up">
	</form>

</body>
</html>