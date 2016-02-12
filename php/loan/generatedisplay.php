<?php
	
	//header
	include_once('top.php');

	//                      input checking section
	//----------------------------------------------------------------------//
	
	//check if any of fields are empty
	if (!$_POST['principal'] || !$_POST['rate'] || !$_POST['term']){
		echo "<p class=errortext> You did not enter all the loan information</p>";
			include_once('loaninfo.php');
			include_once('bottom.php');
			exit;
		}
	//check that only numbers were entered
	if (!is_numeric($_POST['principal']) || !is_numeric($_POST['rate']) || !is_numeric($_POST['term'])){
		echo "<p class=errortext> Please enter only numbers</p>";
			include_once('loaninfo.php');
			include_once('bottom.php');
			exit;
		}	
		
	//limit term to 30 years
		if ($_POST['term'] > 30){
		echo "<p class=errortext> Sorry the max term is 30 years.</p>";
			include_once('loaninfo.php');
			include_once('bottom.php');
			exit;
		}
		
	//limit rate to 30%
		if ($_POST['rate'] > 30){
		echo "<p class=errortext> Sorry the max interest rate is 30%.</p>";
			include_once('loaninfo.php');
			include_once('bottom.php');
			exit;
		}
	
	//limit principal to 100 million
		if ($_POST['principal'] > 100000000){
			echo  " <p class=errortext> Sorry your principal is too high. </p>";
			include_once('loaninfo.php');
			include_once('bottom.php');
			exit;
		}
	
	//processing section
	//-----------------------------------------------------------------------------------------//
	
	
	// change percent to decimal
	$rate = $_POST['rate'] / 100.0;
	require('LoanBreakdown.php');

	//create new loan with rate as decimal
	$a = new LoanBreakdown($_POST['principal'], $rate, $_POST['term']);
	$a-> getInfo();

	$rate = $a-> rate;
	$balance = $a-> principal;
	$monthlyPmt = $a-> monthlyPmt;
	$monthlyInterest = ($balance * $rate) / 12;
	$months = $a-> years * 12;
	
	//echo summary directly to page
	echo "<p class=loaninfo>Loan Information: <br /> Princial: $".number_format($_POST['principal'],0).
		" Rate: ".$_POST['rate']."%, Term: ".$_POST['term']." years (" . $_POST['term'] * 12 ." months)</p>"; 
		
	echo "<p class=loaninfo>Over the life of the loan you would have paid: "
	.number_format($a->getTotalInterest(),2)." in interest. </p>";
	echo "<a href=\"#code\">Click here for source code.</a>";
	
	//table headings
?>

<table>
	<tr>
		<th>Month</th>
		<th>Monthly Interest</th>
		<th>Payment</th>
		<th>Balance</th>
	</tr>
	<tr>
<?php
	//dynamically create rows and update values as loop iterates
	for ($i= 0; $i < $months; $i++){
		echo "<tr><td>".($i+1)."</td>";
		echo "<td> $".number_format((($balance * $rate) / 12),2) ."</td>";
		echo "<td> $".number_format($monthlyPmt,2)."</td>";
		$balance = ($balance - $monthlyPmt + $monthlyInterest);
		echo "<td> $".number_format($balance,2)."</td>";
		echo "</tr>";
		$monthlyInterest = ($balance * $rate) / 12;
	}
	echo "</table>";
	
	//footer
	include_once('bottom.php');
?>
