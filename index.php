<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>MS Store Management System</title>
	<?php include('header.php');?>
</head>
<body>
	<?php 
		include('route.php');
		include('navbar.php');
		if (isset($_SESSION['loggedin']) == 'loggedin') {
			header('Location: admin.php');
		} else {
			include('login.php');
		}
		include('footer.php');
	?>
</body>
</html>