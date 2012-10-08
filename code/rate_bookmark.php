<?php

require_once('include.php');
dispHeader();

//pairnoume ti vathmologia tou xristi
$rate=$_POST['rate'];
//kratame to username tou xristi
$val_user=$_SESSION['valid_user'];
//pairnoume to id tou selidodeikti sto opoio dothike h vathmologia
if (isset($_GET['var'])) {$id = $_GET['var'];}

try
{

	if(!filled_out($rate))
	{
		throw new Exception('Δεν έχετε επιλέξει βαθμολογία');
	}
	
	rate_bkm($rate,$val_user,$id);
	
	echo '<br/>';
		
	echo "<a href='bookmark.php?var=$id'>Επιστροφή</a>";
}


catch (Exception $e)
{
	echo $e->getMessage();
	exit();
}
dispFooter();
?>
