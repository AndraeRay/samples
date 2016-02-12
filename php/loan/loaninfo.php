<?php
	require_once('top.php');

?>

<p>
This application breaks down loan details. It allows you to see expected monthly payments based on loan amount and term.
Further more, it tells you how much interest will be paid monthly and totally during the loan. 

For anyone trying to save money, making extra payments during the early terms of a loan is super beneficial, since interest is the highest at that point.
</p>

<form method="post" action="generate.php" id="loanform">
	<fieldset>
	<legend> Loan Details</legend>
	<label for="principal">Principal:</label>
	<input type="text" name="principal" maxlength="9" size="5" value="30000"/>$
	
	<label for ="rate" >Rate:</label>
	<input type="text" name="rate" size="2" maxlength ="5" value="9"/>%
	
	<label for="term">Term:</label>
	<input type="text" name="term" size="2" maxlength ="2" value="5"/>yrs
	
	<input type="submit" value="See Loan Breakdown"/>
	</fieldset>
	
</form>

<?php
	require_once('bottom.php');

?>