<?php
include_once('top.php');
?>

	<p> Three friends have a great love for checkers. Every weekend, one friend drives to another friend to play a game at 12pm Sunday.
		The friends are constantly moving but hate spending money on gas. They always want the cheapest way for 2 of them to meet up
		<br /> Enter their names, gas prices, and locations below.</p> 

<form action="testroadtrip.php" method="post">
	<fieldset>
		<legend> Checkers game </legend>
		<p class="bold"> All fields are required. Do not enter dollar Signs ($)</p>	
			
		<p> <label for="name1">Friend 1</label>
			Name:
			<input type="text" name="friend1" size ="10" id="name" value="larry"> 
			Xposition:
			<input type="text" name="x1" size="2" value="23">
			Yposition:
			<input type="text" name="y1" size="2" value="100">
			Gas price:
			<input type="text" name="gas1" size="2" value="3.5">
			MPG:
			<input type="text" name="mpg1" size="2" value="25"></p>
			
		<p> <label for="name2">Friend 2</label>
			Name:
			<input type="text" name="friend2" size ="10" id="name" value="Curly"> 
			Xposition:
			<input type="text" name="x2" size="2" value="-4">
			Yposition:
			<input type="text" name="y2" value="10"size="2">
			Gas price:
			<input type="text" name="gas2" size="2" value="2.6">
			MPG:
			<input type="text" name="mpg2" size="2" value="25"></p>
			
		<p> <label for="name1">Friend 3</label>
			Name:
			<input type="text" name="friend3" size ="10" id="name" value="Moe" > 
			Xposition:
			<input type="text" name="x3" size="2" value="30">
			Yposition:
			<input type="text" name="y3" size="2" value="500">
			Gas price:
			<input type="text" name="gas3" size="2" value="4">
			MPG:
			<input type="text" name="mpg3" size="2" value="25"></p>
			
		
		</fieldset>
		<input type="submit" value="See possible games" tabindex="7"/>
	</form>
<?php
include_once('bottom.php');
?>
