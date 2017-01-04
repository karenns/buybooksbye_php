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
	<h1 align="center">My Books</h1>
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
		<table border="1px" width="100%">
		<tr>
			<th>ISBN</th>
			<th>Title</th>
			<th>Author</th>
			<th>Edition</th>
			<th>Type</th>
			<th>Status</th>
		</tr>
		<?php
			mysql_connect("localhost","root","") or die(mysql_error());
			mysql_select_db("bbb_tst") or die(mysql_error());
			$query = mysql_query("Select * from mybook inner join book on mybook.book_id = book.book_id where userid='$user'");
			while($row = mysql_fetch_array($query)){
				print "<tr>";
				print "<td align='center'>" . $row['isbn'] . "</td>";
				print "<td align='center'>" . $row['title'] . "</td>";
				print "<td align='center'> </td>";
				print "<td align='center'>" . $row['edition'] . "</td>";
				print "<td align='center'>" . $row['type'] . "</td>";
				print "<td align='center'>" . $row['status'] . "</td>";
				print "</tr>";
			}
		
		?>
		</table>
	
	
	<h3 align="center"> Add a Book </h3>
	<form action="myBooks.php" method="POST" align="center">
		ISBN: <input type="text" name="book_isbn"/> <br>
		Title: <input type="text" name="book_title"/> <br>
		Author: <input type="text" name="book_author" /> <br>
		Edition: <input type="text" name="book_edition" /> <br>
		Type: <input type="text" name="book_type" /> <br>
		<input type="submit" value="Search" />	
	</form>
	
	<?php
		if($_SERVER['REQUEST_METHOD'] == "POST"){
		$book_isbn = mysql_real_escape_string($_POST['book_isbn']);
		$book_title = mysql_real_escape_string($_POST['book_title']);
		$book_edition = mysql_real_escape_string($_POST['book_edition']);
		$book_type = mysql_real_escape_string($_POST['book_type']);
	
		mysql_connect("localhost","root","") or die(mysql_error());
		mysql_select_db("bbb_tst") or die("Cannot connect to the database");
		
		$query_isbn  = mysql_query("select * from book where isbn= '$book_isbn'");
		//$query_title  = mysql_query("select * from book where title like %'$book_title' %");
		//$query_author  = mysql_query("select * from book where title like %'$book_author' %");
		
		$exists = mysql_num_rows($query_isbn);
		
		if ($exists > 0){
			print "<table border='1px' width='100%'>";
			print "<tr>";
			print "<th>ISBN</th>";
			print "<th>Title</th>";
			print "<th>Author</th>";
			print "<th>Edition</th>";
			print "<th>Type</th>";
			print "<th>ADD</th>";
			print "</tr>";
		
			while($row = mysql_fetch_array($query_isbn)){
				print "<tr>";
				print "<td align='center'>" . $row['isbn'] . "</td>";
				print "<td align='center'>" . $row['title'] . "</td>";
				print "<td align='center'> </td>";
				print "<td align='center'>" . $row['edition'] . "</td>";
				print "<td align='center'>" . $row['type'] . "</td>";
				print "<td align='center'> <a href ='addBook.php?book_id=". $row['book_id'] . "'>ADD</a></td>";
				print "</tr>";
			}
			
			
			print "</table>";
		}
		else{
			print "<h3>Register not found</h3>";
		}
		}
	
?>
		<form action="searchBookCourse.php" method="POST" align="center">
		Course ID: <input type="text" name="book_isbn"/> <br>
		Course Name: <input type="text" name="book_title"/> <br>
		<input type="submit" value="Search" />	
	</form>
	
</body>

</html>