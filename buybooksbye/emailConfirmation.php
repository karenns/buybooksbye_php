<html>
<head>
	<title>BuyBooksBye</title>
</head>
	
<body>
	<a href="index.php">Go back</a>
	<br><br>
	<h1 align="center">Email Confirmation</h1>
	<br><br>
	<form action="emailConfirmation.php" method="POST">
		Userid: <input type="" name="usrId" required="required"/> <br>
		Email: <input type="text" name="usrEmail" required="required" /> <br>
		CODE: <input type="text" name="code" required="required"/> <br>
		<input type ="submit" value ="OK"/>
		
	</form>
	<?php
		if($_SERVER['REQUEST_METHOD'] == "POST"){
			$usrId = mysql_real_escape_string($_POST['usrId']);
			$usrEmail = mysql_real_escape_string($_POST['usrEmail']);
			$code = mysql_real_escape_string($_POST['code']);
			$today = date("Y-m-d H:i:s");
			
			mysql_connect("localhost","root","") or die(mysql_error());
			mysql_select_db("bbb_tst") or die(mysql_error());
			$query = mysql_query("select * from person_email where userid='$usrId' and email ='$usrEmail'");			
			
			if ($query == true){
				while($row = mysql_fetch_array($query)){
					
						if (($row['date_time_confirmation'] != '') or ($row['date_time_confirmation'] != null)){
							if ($row['confirmation_code'] == $code){
								mysql_query("UPDATE person_email set date_time_confirmation ='$today' WHERE userid ='$usrId'" );
								print '<script>alert("Email Confirmed");</script>';
								print '<script>window.location.assign("login.php?usrId=$usrId");</script>';
								
							}
							else{
								print '<script>alert("Confirmation CODE is incorrect!");</script>';
								print '<script>window.location.assign("emailConfirmation.php");</script>';
							}
						}
						else{
							print '<script>alert("Email has been already confirmed!");</script>';
							print '<script>window.location.assign("emailConfirmation.php");</script>';
						}
				}
				
			}
			print '<script>alert("Userid/ Email not registred!");</script>';
			print '<script>window.location.assign("emailConfirmation.php");</script>';	
			
		}
	
	
	?>
	
	
	
</body>

</html>