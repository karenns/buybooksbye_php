<html>
<head>
	<title>BuyBooksBye</title>
</head>
	<?php
	session_start();
	if($_SESSION['user']){
		
	}
	else{
		header("location:index.php");
	}
	$user = $_SESSION['user'];
	
	?>
	
<body>
	<a href="index.php">Go back</a>
	<br><br>
	<h1 align="center">Home</h1>
	<a href="myBooks.php">My Books</a>
	<br>
	<a href="wishList.php">Wish List</a>
	<br>
	<a href="booksExchange.php">Books Exchange</a>
	<br>
	<a href="messages.php">Messages</a>	
	<br>
	<a href="account.php">Account</a>
	<br><br>
	
</body>

</html>