<?php

/*
Author: Andrae Raymond
Last Modified: 2/20/13
This class uses the Loan class, it calculates what total repayment, and total interest paid.

*/

	require('loanv1.php');
 
	class LoanBreakdown extends Loan{

	private $totalPaid;
	private $totalInterest;

		function getInfo(){
			$this-> totalPaid = $this->monthlyPmt * 12 * $this -> years;
			$this-> totalInterest = ($this-> totalPaid - $this-> principal);
		}
		
		function getTotalInterest(){
			return $this->totalInterest;
			}
	}

?>