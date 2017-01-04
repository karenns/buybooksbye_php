<html>
<head>
	<title>BuyBooksBye</title>
</head>
	
<body>
	<a href="index.php">Go back</a>
	<br><br>
	<h1 align="center">Sign-up</h1>
	<form action="signup.php" method="POST" align="center">
		First Name: <input type="text" name="usrFirstName" required="required"/> <br>
		Last Name: <input type="text" name="usrLastName" required="required" /> <br>
		Userid: <input type="text" name="usrUserid" required="required" /> <br>
		Email*: <input type="email" name="usrEmail" required="required" /> <br>
		Create a Password: <input type="password" name="usrPassword" required="required"/> <br>
		<h6>*It must be a valid HCC e-mail.</h6> <br>
		<input type="submit" value="Register" />
	</form>
	<?php
		if($_SERVER['REQUEST_METHOD'] == "POST"){
			$usrFirstName = mysql_real_escape_string($_POST['usrFirstName']);
			$usrLastName = mysql_real_escape_string($_POST['usrLastName']);
			$usrEmail = mysql_real_escape_string($_POST['usrEmail']);
			$usrUserid = mysql_real_escape_string($_POST['usrUserid']);
			$usrPassword = mysql_real_escape_string($_POST['usrPassword']);
			$student_yes_no = 'yes';
			$bool = true;
			$time = strftime("%X"); //time
			
			
			mysql_connect("localhost","root","") or die(mysql_error());
			mysql_select_db("bbb_tst") or die(mysql_error());
			$query = mysql_query("select email,user_id from person");
			
			if ($query == true){
			
			while($row = mysql_fetch_array($query)){
				$table_emails = $row['email'];
				$table_user_ids = $row['userid'];
					if(($usrEmail == $table_emails) or ($usrUserid == $table_user_ids )){
						$bool = false;
						
						if($usrEmail == $table_emails){
							print '<script>alert("Email already registred!");</script>';
							print '<script>window.location.assign("signup.php");</script>';
						}
						if($usrUserid == $table_user_ids){
							print '<script>alert("User_id already registred!");</script>';
							print '<script>window.location.assign("signup.php");</script>';
						}
					}	
			}	
			}
				
			if($bool){
				//Code for email confirmation
				$code = rand_code(8);
				$universityIdFromEmail = getUniversityFromEmail($usrEmail);
				$validUniversityEmail = verifyValidUniversityID($universityIdFromEmail);
				
				if ($validUniversityEmail){
				
					mysql_query("INSERT INTO person(userid, first_name, last_name, student_yes_no, date_time_created) 
								VALUES ('$usrUserid','$usrFirstName','$usrLastName','$student_yes_no','$time')");	
					mysql_query("INSERT INTO authentication (userid, password) VALUES ('$usrUserid','$usrPassword') ");	
					mysql_query("INSERT INTO person_email (userid, email, university_id, confirmation_code) 
								VALUES ('$usrUserid','$usrEmail','$universityIdFromEmail','$code') ");	
					
					print '<script>alert("Successfully Registered!");</script>';
					print '<script>window.location.assign("signup.php");</script>';
				}
			}
		}
		
		function rand_code($len)
		{
			//https://www.phpans.com/random-code-generator-in-php/
		 $min_lenght= 0;
		 $max_lenght = 100;
		 $bigL = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
		 $smallL = "abcdefghijklmnopqrstuvwxyz";
		 $number = "0123456789";
		 $bigB = str_shuffle($bigL);
		 $smallS = str_shuffle($smallL);
		 $numberS = str_shuffle($number);
		 $subA = substr($bigB,0,5);
		 $subB = substr($bigB,6,5);
		 $subC = substr($bigB,10,5);
		 $subD = substr($smallS,0,5);
		 $subE = substr($smallS,6,5);
		 $subF = substr($smallS,10,5);
		 $subG = substr($numberS,0,5);
		 $subH = substr($numberS,6,5);
		 $subI = substr($numberS,10,5);
		 $RandCode1 = str_shuffle($subA.$subD.$subB.$subF.$subC.$subE);
		 $RandCode2 = str_shuffle($RandCode1);
		 $RandCode = $RandCode1.$RandCode2;
		 if ($len>$min_lenght && $len<$max_lenght)
		 {
		 $CodeEX = substr($RandCode,0,$len);
		 }
		 else
		 {
		 $CodeEX = $RandCode;
		 }
		 return $CodeEX;
		}
		
		function getUniversityFromEmail($usrEmail){
			return "HCC";
		}
		
		function verifyValidUniversityID($universityIdFromEmail){
			/*
			$correct = false;
			//FIX IT later
			$emailPattern = split(universityIdFromEmail,"@");
			
			
			$queryVerifyUniversity = mysql_query("select university_id, email_default from university");
			
			while($row = mysql_fetch_array($queryVerifyUniversity)){
				$table_university_id = $row['university_id'];
				$table_email_default = $row['email_default'];
					if($emailPattern == $table_email_default){
						$correct = true;
						
						if(($usrEmail == $table_emails){
							print '<script>alert("Email already registred!");</script>';
							print '<script>window.location.assign("signup.php");</script>';
						}
						if(($usrUserid == $table_user_ids){
							print '<script>alert("User_id already registred!");</script>';
							print '<script>window.location.assign("signup.php");</script>';
						}
					}	
			}
			return $correct;	
			*/
			return true;
		}
		
		function (){
			
		}
	
	?>
	
<script>

function random_code(){
    var code = "";
    var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

    for( var i=0; i < 8; i++ )
        code += possible.charAt(Math.floor(Math.random() * possible.length));
	alert(code);
	return code;
	
}


</script>

</body>
</html>
