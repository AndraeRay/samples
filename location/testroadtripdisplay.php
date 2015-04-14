<?php

/*
	Author Andrae Raymond
	last modiefied: 2/19/13
	
	This page creates a roadtrip object and does extensive error checking. It outputs the cheapest route between 
	two locations based on gas prices.

*/
	//checks if there is an error
	$error = false;
	
	//create short variable names
	$friend1 = trim($_POST['friend1']);
	$friend2 = trim($_POST['friend2']);
	$friend3 = trim($_POST['friend3']);
	
	//check if any friend name is empty
	if (empty($friend1) || empty($friend2) || empty($friend3)){
		echo "Error: **You did not enter all your friends names**";
		$error = true;
		}

	//exit if there is an error
	if ($error) { exit; }
	
	//determine if numbers were entered. (possibly change to regular expression in future)
	if (!is_numeric($_POST['x1']) || !is_numeric($_POST['y1']) || !is_numeric($_POST['gas1']) || !is_numeric($_POST['mpg1']))
		{echo "Error: **You did not correctly enter all of $friend1's information <br />";
		$error = true;
		}
	
	if (!is_numeric($_POST['x2']) || !is_numeric($_POST['y2']) || !is_numeric($_POST['gas2']) || !is_numeric($_POST['mpg2']))
		{echo "Error: **You did not correctly enter all of $friend2's information <br />";
		$error = true;
		}
	
	if (!is_numeric($_POST['x3']) || !is_numeric($_POST['y3']) || !is_numeric($_POST['gas3']) || !is_numeric($_POST['mpg3']))
		{echo "Error: **You did not correctly enter all of $friend3's information <br />";
		$error = true;
		}
	
	
	//exit if there is an error. If no error, then continue
	if ($error) { exit; }
	
	//include class of objects
	include('RoadTrip.php');
	
	//create objects with data entered
	$a = new RoadTrip($_POST['x1'],$_POST['y1'], $_POST['gas1'], $_POST['mpg1'], $friend1);
	$b = new RoadTrip($_POST['x2'],$_POST['y2'], $_POST['gas2'], $_POST['mpg2'], $friend2);
	$c = new RoadTrip($_POST['x3'],$_POST['y3'], $_POST['gas3'], $_POST['mpg3'], $friend3);
	
	echo "<h2>Game Plans</h2>";
	
	Display($a,$b);
	Display($b,$c);
	Display($a,$c);
	
	//calculates trip cost and distance between two roadtripobjects	
	function Display($a, $b)
	{
		$distab = number_format($a->CalculateSDistance($b),1);
		$costab = number_format($a->TripCost($b),2);
		$costba = number_format($b->TripCost($a),2);
		$diff = number_format(abs($costab - $costba),2);
	
		echo "<p>$a->name and $b->name are $distab miles apart. According to gas prices, and individual mpg ";
	
		//check cheapest route and print to screen
		if ($costab == $costba) {echo "the cost is the same to meet at either of their of their houses. </p>";}
		elseif ($costab < $costba) {echo "it would be cheaper for  $a->name to drive to $b->name. by $$diff";}
		else echo "it would be cheaper for $b->name to drive to $a->name by $$diff</p>";
	
	}
	
	?>