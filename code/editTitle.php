<?php

require_once('include.php');
dispHeader();


$title=$_POST['new_title'];

if (isset($_GET['var'])) {$id = $_GET['var'];}


try
{
	//elegxos gia to an exei sypmlirwthei to username
	if(!filled_out($title))
	{
		echo '<br/>';
		throw new Exception('Δεν έχετε σμπληρώσει τον τίτλο που θέλετε να δώσετε στη σελίδα σας');
	}
	
	modifyTitle($id,$title);
}

catch (Exception $e)
{
	echo $e->getMessage();
	dispFooter();
	exit();
}


dispFooter();
?>