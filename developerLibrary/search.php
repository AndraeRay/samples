		<?php
		
		//add slashes needed
		//strip slashes needed
		//add comments
		
		//make min of 3 search characters
		
			require ('page.php');
			
			$search = new Page;
			
			$search->title = 'Search Results';
			
			$content = array();
			
			$content[] .= '<div class="list">';
			
			//abort if the search term is too short
			if (!isset($_GET['searchterm']) || strlen(trim(($_GET['searchterm'])))< 3 ){
			
				$content[].= "Please enter a search term that is at least 3 characters long";
			}
			//If term is good, proceed with database connect
			else{
		
				$searchterm = $_GET['searchterm'];
				
			@ include('config/db_connect.php');
	
			//connect to db
			@ $db = new mysqli('localhost', $db_user, $db_pass, $db_database);
				
				if (mysqli_connect_errno()){
					$content[] .=  "Error: Could not connect to the databse. please try again later.";
					exit;			
				}
						

				
				//prepared statement
				$query = "SELECT DISTINCT books.id, author, title, isbn, category FROM books WHERE 
					(title like ?) OR  (author like ?) OR (isbn like ?) OR (category like ?)";
					
				//include wild card
				$searchterm = "%".$searchterm."%";
				
				$stmt = $db->prepare($query);
				$stmt-> bind_param("ssss", $searchterm, $searchterm, $searchterm, $searchterm);
				$stmt-> execute();
				
				$stmt->store_result();
				
				$num_results = $stmt->num_rows;
				
				//bind results to new variables
				$stmt->bind_result($rid, $rauthor, $rtitle, $risbn, $rcategory);
								
								
				$db->close();		

				
				$num_results = $stmt->num_rows;
				
				$content[] .=  $num_results." books have been found. </div>";
							
				for ($i=0; $i < $num_results; $i++){
				
					$stmt->fetch();
					$content[] .=  "<div class=\"list\"><p>Title: <a href=\"book.php?id=".$rid."\">".htmlspecialchars(stripslashes($rtitle))."</a><br />";
					$content[] .=   "Author: ".htmlspecialchars(stripslashes($rauthor))."<br />";
					$content[] .=   "ISBN: ".htmlspecialchars(stripslashes($risbn))."<br />";
					$content[] .=   "Category: ".htmlspecialchars(stripslashes($rcategory))."<br /></p> </div>";
				}
				$stmt->close();
			}
			
			$search->content = $content;
			
			$search->Display();
		
		
		
		?>