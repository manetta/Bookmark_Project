<?php

require_once('include.php');
dispHeader();


//dispHeader();

$oldUser=$_SESSION['valid_user'];


if(isset($oldUser))
{

	unset($_SESSION['valid_user']);
	session_destroy();
	
	?>
	<div class="article">
		</br>
		<h3><span>Αποσυνδεθήκατε απο το σύστημα! </span><h2></br><a href="main.php">Αρχική σελίδα</a></h2></h3>
		<div class="clr"></div>
		</br>
	</div>
	<?php
	
	

}

else
{
	echo 'Δεν είσασταν συνδεδεμένος.';
}

dispFooter();
?>