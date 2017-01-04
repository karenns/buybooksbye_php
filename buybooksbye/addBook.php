<?php
	session_start();
    if($_SESSION['user']){
    }
    else{ 
       header("location:index.php");
    }
	$user = $_SESSION['user'];
	
	if($_SERVER['REQUEST_METHOD'] == "GET"){
		$book_id = $_GET['book_id'];
		$today = date("Y-m-d H:i:s");
		$status = 'available';
		
		mysql_connect("localhost","root","") or die(mysql_error());
		mysql_select_db("bbb_tst") or die("Cannot connect to database");
			
		mysql_query("INSERT INTO mybook (userid, book_id, date_add, status) VALUES ('$user','$book_id','$today','$status')");
		header("location: myBooks.php");
	
	}
?>