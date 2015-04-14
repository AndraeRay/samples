		<?php
		
	
		
			require ('page.php');
			
			$suggestions = new Page;
			
			$suggestions->title = 'Suggestions';
			
			$content = array();
			
			//check to see what message should be displayed
			if (isset($_GET['m'])){
				
				switch ($_GET['m']){
					case 1:	$content[] .= '<span class="error list">Error: Could not add your suggestion at this time. Please try again later</span>';
					break;
					
					case 2: $content[] .='<span class="list"> Thanks! Your suggestion has successfully been added </span>';
					break;
					
					default: break;
				}
			}
			
			include('config/db_connect.php');
	
			//connect to db
			@ $db = new mysqli('localhost', $db_user, $db_pass, $db_database);
			
			if (mysqli_connect_errno()){
				$content[] .=  "<span class=\"list error\"> Error: Could not connect to the databse. please try again later.</span>";
				exit;			
			}
			
			$query = "SELECT requester,title,author,isbn FROM suggestions ORDER BY suggid DESC;";
			$result = $db->query($query);
			
			$db->close();
			
			
			//print each result
			$num_results = $result->num_rows;
			
			if ($num_results > 0)
			{
				$content[] .= "<h3 class=\"list\">Most Recent suggestions</h3> \n <div class=\"list\">";
				
				for ($i=0; $i < $num_results; $i++)
					{
					$row = $result->fetch_assoc();
					$content[].= "<div class=\"inlinesugg\"> Title: ".htmlspecialchars(stripslashes($row['title']))."<br />";
					$content[].=  "Author: ".htmlspecialchars(stripslashes($row['author']))."<br />";
					$content[].=  "ISBN: ".htmlspecialchars(stripslashes($row['isbn']))."<br />\n</div>";
					}
				$content[] .= "</div>";
				
			}
			else{
				$content[].= '<h3 class="list">No Suggestions have been made yet. Please make one by using the form on the left.</h3>';
			
			}
			

							
			$suggestions->content = $content;
			
			$suggestions->Display();
		
		
		
		?>