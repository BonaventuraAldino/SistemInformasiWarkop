<?php require_once('../../Connections/koneksiku.php'); ?>

<!DOCTYPE html>
<html>
<head>
	<title>LOGIN</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="../../css/style1.css">
	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600&display=swap" rel="stylesheet">
	<script src="https://kit.fontawesome.com/a81368914c.js"></script>	
</head>
<body>
	<?php 
	if(isset($_GET['pesan'])){
		if($_GET['pesan']=="gagal"){
			echo "<div class='alert'>Username dan Password tidak sesuai !</div>";
		}
	}
	?>
	<img class="wave" src="../../images/wave.png">
	<div class="container">
		<div class="img">
			<img src="../../images/monitor.svg">
		</div>
		<div class="login-container">

			<form METHOD="POST" action="cek_login.php">
				<img class="avatar" src="../../images/user.svg">
				<h2> Welcome </h2>
				<div class="input-div one">
					<div class="i">
						<i class="fas fa-user"></i>
					</div>
					<div>
						<h5> Username </h5>
						<input required type="text" class="input" name="username">
					</div>
				</div>

				<div class="input-div two">
					<div class="i">
						<i class="fas fa-lock"></i>
					</div>
					<div>
						<h5> Password </h5>
						<input class="input" required type="password" name="password">
					</div>
				</div>
					<input type="submit" class="btn" value="LOGIN">
					<a href="../../index.php"> BACK TO HOME </a>
		  </form>
		</div>
	</div>
	<script type="text/javascript" src="../../js/main1.js"></script>
</body>
</html>