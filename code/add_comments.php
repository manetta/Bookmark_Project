<?php

require_once('include.php');
dispHeader();

//pairnoume to sxolio tou xristi
$comment=$_POST['comment'];
//kratame to username tou xristi
$val_user=$_SESSION['valid_user'];
//pairnoume to id tis aggelias gia tin opoia egine to sxolio
if (isset($_GET['var'])) {$id = $_GET['var'];}

echo '<h2>Προσθήκη σχολίου!</h2>';

try
{
	if(!filled_out($comment))
	{
		throw new Exception('Δεν έχετε συμπληρώσει κάποιο σχόλιο προς αποθήκευση');
	}
	
	add_comment($comment,$val_user,$id);
	
	echo '<br/>';
		
	echo "<h2><a href='bookmark.php?var=$id'>Επιστροφή</a></h2>";
}


catch (Exception $e)
{
	echo $e->getMessage();
	echo '<br>';
	echo "<h2><a href='bookmark.php?var=$id'>Επιστροφή</a></h2>";
	exit();
}

dispFooter();
?>
