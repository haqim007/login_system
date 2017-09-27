<?php 


require_once 'app/init.php';

$auth->build();


?>

<!DOCTYPE html>
<html>
<head>
	<title>home</title>
</head>
<body>
	<?php if ($auth->check()) :  ?>
<p>you are signed in. <a href="sign_out.php">sign out</a></p>
<?php else: ?>
<p>you are not signed in. <a href="sign_up.php">sign up</a> or <a href="sign_in.php">sign in</a></p>
<?php endif; ?>
</body>
</html>