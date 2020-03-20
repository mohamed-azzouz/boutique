<?php
	session_start();

?>


<!DOCTYPE html>
<html>
<head>
	<title>Page Inscription</title>
	<link rel="stylesheet" type="text/css" href="boutique.css">
</head>
<body>

	HEADER

	<main>

		<form action="inscription.php" method="post">
			Login : <input type="text" name="login" required> <br />
			Password : <input type="password" name="password" required> <br />
			Confirm Password : <input type="password" name="confirmPass" required> <br />
			Mail : <input type="email" name="mail"> <br />
			Adresse : <input type="text" name="adresse"> <br />
			Rank : <select name="rank"><option>MEMBRE</option>></select> <br />

			<input type="submit" name="inscription">
		</form>

		<?php

			include('user.php');
			inscription();
		?>
	</main>

	FOOTER


</body>
</html>