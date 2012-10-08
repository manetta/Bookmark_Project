<?php

require_once('include.php');
dispHeader();

if (isset($_GET['var'])) {$id = $_GET['var'];}
if (isset($_GET['var1'])) {$id_bk = $_GET['var1'];}

try
{
	delCmnt($id);
	
	echo 'Το σχόλιο διαγράφηκε επιτυχώς!';
	echo '<br/>';
	echo "<a href='bookmark.php?var=$id_bk'>Επιστροφή</a>";
}

catch (Exception $e)
{
	echo $e->getMessage();
	exit();
}

dispFooter();
?>