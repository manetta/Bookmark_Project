<?php

require_once('include.php');
dispHeader();

$cmnt=$_POST['new_cmnt'];

if (isset($_GET['var'])) {$id = $_GET['var'];}
if (isset($_GET['var1'])) {$id_bk = $_GET['var1'];}

echo '<h2>Αλλαγή σχολίου</h2>';
try
{
	if(!filled_out($cmnt))
	{
		echo '<br/>';
		throw new Exception('Δεν έχετε σμπληρώσει τον νέο σχόλιο που θέλετε να αποθηκεύσετε');
	}
	modifyComment($id,$cmnt,$id_bk);
}


catch (Exception $e)
{
	echo $e->getMessage();
	exit();
}
dispFooter();
?>