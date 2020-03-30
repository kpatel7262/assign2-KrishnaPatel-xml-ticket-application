<?php
//login will depend on if it is a user or admin
	$username="";
	$password="";
	$error="";

	if(isset($_POST['login']))
	{
		$xml = simplexml_load_file("xml/user_details.xml");
		
		$username = $_POST['uname'];
		$password = $_POST['pwd'];
		foreach($xml->user as $user){
			var_dump($user->user_id);
    			if($user->user_id == $username && $user->user_password == $password) {
    				//one more if to check whether the $user['type']=='customer' is a client or a customer
    				session_start();
    				
		        	if($user['type']=='customer'){
		        		header("Location:user.php");
		        	}
		        	else{
		        		header("Location:admin.php");
		        	}

	    		}
		    	else{
		    		var_dump('Login Unsuccessful');
		    		$error = "wrong username or password";
	    		}
    	}	

    }

   


?>
<html>
<head>
	<title>Ticket Application</title>
	<meta charset="UTF-8"/>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
	<link rel="stylesheet" type="text/css" href="styles/stylesheet.css" />
</head>
<body>
	<!--header starts here -->
	<header>
		<div class="container-fluid">
			<div class="logo col-md-2">
			<!--logo image-->
				<a href="index.php"><img src="images/logo.png" alt="Ticket managing application" /></a>
				<p>Ticket Application</p>
			</div>
		</div>
	</header>
	<main>


			<form class="form-group" name="login_form" method="post">
				<div class="login col-md-4">
				<h3>Please Login!</h3>
				<label for="uname">Username:</label>
				<input type="text" class="form-control" id="uname" name="uname" placeholder="Enter your Username" required="" autofocus="" />
				<label for="pwd">Password:</label>
				<input type="password" class="form-control" id="pwd" name="pwd" placeholder="Enter your Password" required="" autofocus="" />
				<br />
				<input class="btn btn-secondary" type="submit" name="login" value="Login" />
				</div>
				<div class="error_display text-center">
					<?= $error; ?>
				</div>
			</form>


	</main>
</body>
</html>
