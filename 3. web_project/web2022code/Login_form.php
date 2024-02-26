<html>
	<head>
		<title>Login Form</title>
		<link rel="stylesheet" href="Style.css">
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
		<script src="sweetalert2.min.js"></script>
		<link rel="stylesheet" href="sweetalert.min.css">
		<script type="text/javascript" src="Login_check.js"></script>
	</head>
		<body>
			<p id="demo"></p>
			<div class="wrapper fadeInDown">       
				<div class="container">
					<div class="header">
						<h1>Εισοδος Χρηστη/Admin</h1>
					</div>

				<form>
					<div>
						<input type="text" name="name" class="form-control" placeholder="Username" required>
					</div>

					<div>
						<input type="password" name="pass" class="form-control" placeholder="Password" required>
					</div>
						
					<button type="submit" onclick="Login()">Login</button>
					
					<button type="submit"><a href="registration_form.php" style="color:white">Register</style></a></button>
					
					</form>

				</div>
			</div>
		</body>
</html>
