<?php

require_once('include.php');
dispHeader();


$tag=$_POST['new_tag'];

if (isset($_GET['var'])) {$id = $_GET['var'];}

//echo $title;
//echo '<br/>';
//echo $id;

try
{
	//elegxos gia to an exei sypmlirwthei to username
	if(!filled_out($tag))
	{
		echo '<br/>';
		throw new Exception('Δεν έχετε συμπληρώσει την ετικέτα που θέλετε να προσθέσετε');
	}
	
	modifyAddTag($id,$tag);
}

catch (Exception $e)
{
	echo $e->getMessage();
	exit();
}


dispFooter();
?>
