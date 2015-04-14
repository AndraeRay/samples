<?php
/* Author: Andrae Raymond
Last modified: 2/20/13

This creates a loan object with parameters principal, rate, and term. It calculates monthly
payment.

*/

class Loan{

	private $principal;
	private $rate;
	private $years;
	private $monthlyPmt;

	//calculate monthly payment directly after new loan object is created
	function __construct($princial, $rate, $years){
		$this->principal = $princial;
		$this->rate = $rate;
		$this->years = $years;
		
		$this-> calculateMonthly();	
	}
	//update monthly payment after any changes and prevent the altering of monthly payment
	function __set($name, $value){
		if ($name == 'monthlyPmt') return 'error cannot alter monthly';
		else $this->$name = $value;
		
		$this-> calculateMonthly();		
		}

	//use of formala for interest componded monthly
	function calculateMonthly(){
		$R = ($this->rate / 12);
		$Y = $this->years * 12;
		$P = $this -> principal;
		
		$W = pow(1.0 +$R ,$Y);
		
		$this->monthlyPmt = ( $R * $P * $W ) / ($W - 1.0);
		
	}
	
	function __get($value){
		return $this->$value;
		}

}

?>