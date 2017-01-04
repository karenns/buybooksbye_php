<?php
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
			print "</tr>";
		
			while($row = mysql_fetch_array($query_isbn)){
				print "<tr>";
				print "<td align='center'>" . $row['$isbn'] . "</td>";
				print "<td align='center'>" . $row['$title'] . "</td>";
				print "<td align='center'>" . $row['$author'] . "</td>";
				print "<td align='center'>" . $row['$edition'] . "</td>";
				print "<td align='center'>" . $row['$type'] . "</td>";
				print "</tr>";
			}
			
			
			print "</table>";
		}
		else{
			print "<h3>Register not found</h3>";
		}
	
?>