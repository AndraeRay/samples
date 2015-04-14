		<?php
		
		//what goes here? fix it
		
			require ('page.php');
			
			$index = new Page;
			
			$index->title = 'Home';
			
			//store content in array
			$content = array();
		
			//if no category selected return default cateogry. (all)
			if (!isset($_GET['category'])){
				$category ="";
			}
			else{
				$category = $_GET['category'];
			}
	
			@ require('config/db_connect.php');
	
			//connect to db
			@ $db = new mysqli('localhost', $db_user, $db_pass, $db_database);
			
			if (mysqli_connect_errno()){
				$content[] .= "Error: Could not connect to the databse. please try again later.";
				exit;
			}
			
			//use prepared statement for security
			$query = "SELECT id, author, title, isbn, category, picture FROM books WHERE 1 ORDER BY id DESC LIMIT 6";
			
			$result = $db->query($query);
						
			$db->close();		
			
			$num_results = $result->num_rows;
			
			$content[].= '<div class="list"><p>Welcome to Developers Library. Listed here are books that I have studied, mastered and a few
			books that I will be studying shortly. You may be familiar with some of these books, or have suggestions of other greats books.</p>
			<p> Please do not hestitate to make a suggestion of a good book on a computer science topic.</p> </div>';
			
			$content[] .=  "<div class=\"list\"><p> Newest additions.</p>";
						
			for ($i=0; $i < $num_results; $i++){
			
				$row = $result->fetch_assoc();
				$content[] .=  "<div class=\"inlinesugg\"><p>Title: <a href=\"book.php?id=".$row['id']."\">".htmlspecialchars(stripslashes($row['title']))."</a><br />";
				$content[] .=   "Author: ".htmlspecialchars(stripslashes($row['author']))."<br />";
				$content[] .= '<a href="book.php?id='.$row['id'].'"><img class="recentpic" src="images/'.$row['picture'].'" /></a></div>';
	
			}
			$content[] .= "</div>";
							
			$index->content = $content;
			
			$index->Display();
		
		
		
		?>