<?php

require_once('include.php');
dispHeader();
echo '<br/>';


$url=$_POST['new_url'];

if (isset($_GET['var'])) {$id = $_GET['var'];}

echo '<h2>Αλλαγή url</h2>';

try
{
	//elegxos gia to an exei sypmlirwthei to username
	if(!filled_out($url))
	{
		echo '<br/>';
		throw new Exception('Δεν έχετε σμπληρώσει το url που θέλετε να αλλάξετε!');
	}
	
	//elengos gia ti morfi tou url
	if(!check_url($url))	
	{
		throw new Exception('Δεν έχετε δώσει σωστό url.Πρέπει να ξεκινά με τη μορφη http://www. ή www.!');
	}
	
	modifyURL($id,$url);
}

catch (Exception $e)
{
	echo $e->getMessage();
	dispFooter();
	exit();
}

dispFooter();
?>