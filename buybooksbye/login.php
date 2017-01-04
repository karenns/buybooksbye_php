<html>
<head>
	<title>BuyBooksBye</title>
</head>
	
<body>
	<a href="index.php">Go back</a>
	<br><br>
	<h1 align="center">Login</h1>
	<form action="login.php" method="POST" align="center">
		Userid: <input type="text" name="usrId" required="required" /> <br>
		Password: <input type="password" name="usrPassword" required="required"/> <br><br>
		<input type="submit" value="Log-in" />
	</form>
	<?php
		
		if($_SERVER['REQUEST_METHOD'] == "POST"){
		
		$usrId = mysql_real_escape_string($_POST['usrId']);
		$usrPassword = mysql_real_escape_string($_POST['usrPassword']);
		$bool = true;

		mysql_connect("localhost", "root", "") or die (mysql_error()); //Connect to server
		mysql_select_db("bbb_tst") or die ("Cannot connect to database"); //Connect to database
		$query = mysql_query("Select * from authentication WHERE userid='$usrId'");
		$exists = mysql_num_rows($query); //Checks if username exists
		$table_userid = "";
		$table_password = "";
		if($exists > 0)
		{
		   while($row = mysql_fetch_assoc($query)) // display all rows from query
		   {
			  $table_userid = $row['userid']; // the first username row is passed on to $table_users, and so on until the query is finished
			  $table_password = $row['password'];
					
		   if(($usrId == $table_userid) && ($usrPassword == $table_password))// checks if there are any matching fields
		   {
			  if($usrPassword == $table_password)
			  {
				 session_start();
				 $_SESSION['user'] = $usrId; //set the username in a session. This serves as a global variable
				 header("location: home.php"); // redirects the user to the authenticated home page
			  }
		   }
		   else
		   {
			Print '<script>alert("Incorrect Password!");</script>'; // Prompts the user
			Print '<script>window.location.assign("login.php");</script>'; // redirects to login.php
		   }
		   
		   }
		}
		else
		{
			Print '<script>alert("Incorrect username!");</script>'; // Prompts the user
			Print '<script>window.location.assign("login.php");</script>'; // redirects to login.php
		}
		
		}
	
	?>
	
</body>

</html>