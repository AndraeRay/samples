<?php
class Page
{
	//class Page's attribute
	public $content;
	public $title;
	public $keywords = "Developer's essential library";
	public $stylesheet = "css/style.css";

	
	//class Page's operations
	public function __set($name, $value)
	{
	$this->$name = $value;
	}
	
	public function Display()
	{
		echo "<!DOCTYPE HTML>\n<html>\n<head>\n";
		$this -> DisplayTitle();
		$this -> DisplayKeywords();
		$this -> DisplayStyles();
		?>
		</head>
			<body>
				<div id="wrappertop"> test </div>
				<div id="container">
		
		<?php
		$this -> DisplayHeader();
		$this-> DisplaySideBar();
		$this-> DisplayContent();
		$this -> DisplayFooter();
		?>
			</div>
		</body>
		</html>
		<?php
	}
	
	public function DisplayTitle()
	{
		echo "<title> Developer's Library - ".$this->title."</title>";
	}
	
	public function DisplayStyles()
	{
		echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"".$this->stylesheet."\" />";
		echo '<link rel="stylesheet" type="text/css" href="css/buttons.css" />';
	}
	
	public function DisplayKeywords()
	{
		echo "<meta name=\"keywords\" content=\"".$this->keywords."\"/>";
	}
	
	// determine if content is string or array, and print to screen
	public function DisplayContent()
	{	echo '<div id="content">';
		if (is_string($this->content)) echo $this->content;
		elseif (is_array($this->content)) foreach ($this->content as $current) echo $current;
		else echo "undefined data type in page.tpl"; 
		echo "\n</div>";
			}
		
	
	public function DisplayHeader()
	{
	?>		
			<div id="header">
			<h1><a href="index.php" id="homelink">Developer's Library</a></h1>
			
			<form method="get" action="search.php">
				<input type="text" name="searchterm" id="search" />
				<input type="submit" value="search" class="button"/>
			</form>
			<ul>
			
			</ul>
			</div>
			
<?php }
	public function DisplaySidebar()
		{
		?>
		<div id="sidebar">
			<div class="sideitem">
			<h2> Categories </h2>
			<ul id ="menu">
				<li><a href="listing.php?category=">ALL</a></li>
				<li><a href="listing.php?category=algorithm">Algorithms</a></li>
				<li><a href="listing.php?category=c programming ">C Programming</a></li>
				<li><a href="listing.php?category=CSS">CSS</a></li>
				<li><a href="listing.php?category=design">Design</a></li>
				<li><a href="listing.php?category=java">Java</a></li>
				<li><a href="listing.php?category=javascript">JavaScript</a></li>
				<li><a href="listing.php?category=PHP">PHP</a></li>
				<li><a href="listing.php?category=python">Python</a></li>
				<li><a href="listing.php?category=MYSQL">MYSQL</a></li>
			</ul>
			</div>
			<div class="sideitem">
			<?php include('suggest.block.php'); ?>
			</div>

		</div>
		<?php
		
		}
	
	public function DisplayFooter()
	{
	?>
			
			<div id="footer">
			</div>
			<!--is this still needed? -->
			<div class="spacer"></div>
			<?php 
			}
			}
			
			?>