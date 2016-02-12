<?php

	
	require('page.php');
	
	$book = new Page;
	
	$book->title = "Books";
	
	$content = array();
	
	//view book 1 by default if no id selected
	if (!isset($_GET['id'])){
		$bookid = 1;
	}
	else{
	
	$bookid = $_GET['id'];
	}
	
	@ require('config/db_connect.php');
	
	//connect to db
	@ $db = new mysqli('localhost', $db_user, $db_pass, $db_database);
	 
	 if (mysqli_connect_errno()){
		$content[] .=   "Sorry. You could not be connect to the database at this time. Please try again later." ; 
		echo "Sorry. You scould not be connect to the database at this time. Please try again later." ;
		exit;
		}

	//use prepared statements for security
	$query = "SELECT author, title, isbn, category, longdesc, picture FROM books, descriptions WHERE (books.id = ?) AND(books.id = bookID);";
	$stmt = $db->prepare($query);
	$stmt->bind_param("i", $bookid);
	$stmt->execute();
	
	$stmt->store_result();

	$num_results = $stmt->num_rows;
	
	//bind results to new variables
	$stmt->bind_result($rtitle, $rauthor, $risbn, $rcategory, $rlongdesc, $rpicture);
	
	for ($i=0; $i < $num_results; $i++){
			$stmt->fetch();
			$content[] .=   "<div class=\"list\"><p>Title: ".htmlspecialchars(stripslashes($rtitle))."<br />";
			$content[] .=   '<div class="fulllistbook"><img src="images/'.$rpicture.'" /></div><br />';
			$content[] .=   "Author: ".htmlspecialchars(stripslashes($rauthor))."<br />";
			$content[] .=   "ISBN: ".htmlspecialchars(stripslashes($risbn))."<br />";
			$content[] .=   "Category: ".htmlspecialchars(stripslashes($rcategory))."<br />";
			$content[] .=   "Description: ".stripslashes($rlongdesc)."</p></div>";
		}

	$book ->content = $content;
	
	$book -> Display();

?>