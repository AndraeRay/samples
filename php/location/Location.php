<?php

/* Author - Andrae Raymond
Last modified: 2/19/13

This creates a location class. Location objections have x and y coordinates. Distance can be calculated
 based on straight line between two points, or an arch distance.

*/

class Location
{
	protected $pos;
	private $straightdistance;
	private $archdistance;
	
	function __construct($xpos, $ypos){
		$this->pos[0] = $xpos;
		$this->pos[1] = $ypos;
	}
	
	function __get($pos){
		return $this->$pos;
	}
	function __set($name, $pos){
		$this->$name= $pos;
	}
	
	// Calculates straight line distance between two points.
	function CalculateSDistance($b){
		$xdistsq = ($this->pos[0] - $b->pos[0]) * ($this->pos[0] - $b->pos[0]);
		$ydistsq = ($this->pos[1] - $b->pos[1]) * ($this->pos[1] - $b->pos[1]);
		$this->straightdistance = sqrt($xdistsq + $ydistsq);
		return $this->straightdistance;
	}
	
		//arch distance is straight line distance mutliplied by Pi, to get Circumference
	function CalculateADistance($b){
		return $this-> CalculateSDistance($b) * Pi();
	}


}	

?>