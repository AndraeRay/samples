<?php 
	if (isset($_POST['submitsugg'])){
		//input is missing, no not process
		if (!$_POST['name'] || !$_POST['title'] || !$_POST['author']){
			echo "<span class=\"error\">Please enter all the required fields </span>";
			}
		
		//process page.
		else { 

			//create short variable names, and add slashes for safety
			@	$name =  addslashes(trim($_POST['name']));
			@	$title = addslashes(trim($_POST['title']));
			@	$author = addslashes(trim($_POST['author']));
			@	$isbn =  addslashes(trim($_POST['isbn']));

			@ include('config/db_connect.php');
	
			//connect to db
			@ $db = new mysqli('localhost', $db_user, $db_pass, $db_database);
					
							
			if (mysqli_connect_errno()){
				echo '<script type="text/javascript">
					window.location = "suggestions.php?m=1/"
					</script>';
			}
			
			else{
				
				
				//prepared statement for injection security
				
				$str = ""; //empty string for auto increment columnn
				$query = "INSERT into suggestions VALUES(?,?,?,?,?)";
				$stmt = $db->prepare($query);
				$stmt->bind_param("sssss",$str, $name, $title, $author, $isbn);
				$stmt->execute();
				echo $stmt->affected_rows.' suggestions added';
				$stmt->close();
				
				
				echo '<script type="text/javascript">
					window.location = "suggestions.php?m=2/"
					</script>';
				
			}
		
		}
		
	}
?>
	<h2>Suggest a book for my library</h2>
	<form method="post" action="" id="suggestform">
	<span class="error">Required * </span> <br />
	<label for="name">Your Name: <span class="error">*</span></label>
	<input type="text" name="name" size="18"/>
	
	<label for="title"> Title: <span class="error">*</span> </label>
	<input type="text" name="title" size="18"/>
	
	<label for="author">Author:  </label>
	<input type="text" name="author" size="18"/><br /> 
	
	<label for="isbn">ISBN: </label>
	<input type="text" name="isbn" size="18"/>	
	<br />
	<input type="submit" value="Submit" size="18" name="submitsugg" class="button"/>
	
	</form>
	<br />
	<form action="suggestions.php">
	<input type="submit" value="View Suggestions" size="18" class="button"/>
	</form>

	
