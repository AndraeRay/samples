		<?php
				
		require ('page.php');
			
			$listing = new Page;
			
			$listing->title = 'Listings';
			
			//store content in array
			$content = array();
		
			//if no category selected return default cateogry. (all)
			if (!isset($_GET['category'])){
				$category = "";
			}
			else{
				$category = $_GET['category'];
			}
			
			require('config/db_connect.php');
	
			//connect to db
			@ $db = new mysqli('localhost', $db_user, $db_pass, $db_database);
			
			if (mysqli_connect_errno()){
				$content[] .= "Error: Could not connect to the databse. please try again later.";
				exit;			
			}
			
			//use prepared statement for security
			$query = "SELECT books.id, author, title, isbn, picture, category, shortdesc FROM books, descriptions WHERE 
				(category like ?) and (books.id = bookID);";
			
			//include wild card
			$category = "%".$category."%";
			
			$stmt = $db->prepare($query);
			$stmt->bind_param("s", $category);
			
			
			$stmt -> execute();
			
			$stmt-> store_result();
			
			$num_results = $stmt->num_rows;
			
			// bind results to new variables
			$stmt->bind_result($rid, $rauthor, $rtitle, $risbn, $rpicture, $rcategory, $rshortdesc);
			
			$content[] .=  "<div class=\"list\">".$num_results. ($num_results == 1 ? " book matches" : " books match") ." your criteria.</div>";
						
			for ($i=0; $i < $num_results; $i++){
			
				$stmt->fetch();
				$content[] .=  "<div class=\"list\"><p>Title: <a href=\"book.php?id=".$rid."\">".htmlspecialchars(stripslashes($rtitle))."</a>";
				$content[] .=   '<div class="listbook"><a href="book.php?id='.$rid.'"><img src="images/'.$rpicture.'" /></a></div><br />';
				$content[] .=   "Author: ".htmlspecialchars(stripslashes($rauthor))."<br />";
				$content[] .=   "ISBN: ".htmlspecialchars(stripslashes($risbn))."<br />";
				$content[] .=   "Category: ".htmlspecialchars(stripslashes($rcategory))."<br />";
				$content[] .=   "Description: ".stripslashes($rshortdesc)."</p></div>";
			}
			
			$stmt->close();
			
			$db->close();		


			
			$listing->content = $content;
			
			$listing->Display();
			
		?>