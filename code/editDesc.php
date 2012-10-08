<?php

require_once('include.php');
dispHeader();
echo '<br/>';


$desc=$_POST['new_desc'];

if (isset($_GET['var'])) { $id = $_GET['var'];}


try
{
	//elegxos gia to an exei sypmlirwthei to username
	if(!filled_out($desc))
	{
		echo '<br/>';
		throw new Exception('Δεν έχετε σμπληρώσει τη νέα περιγραφή που θέλετε να δώσετε στο σελιδοδείκτη σας!');
	}
	
	modifyDesc($desc,$id);
	
}

catch (Exception $e)
{
	echo $e->getMessage();
	exit();
}

dispFooter();

?>