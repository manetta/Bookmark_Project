<?php

require_once('include.php');
dispHeader();


$val_user=$_SESSION['valid_user'];
if(isset($_GET['var'])) $id=strval($_GET['var']); else $id=NULL;

echo $id;

try
{
	bad_cmnt($val_user,$id);
	echo 'Μεταβείτε στην';
	dispLink('main.php','Αρχική Σελίσα');
}

catch (Exception $e)
{
	echo $e->getMessage();
	exit();
}

dispFooter();
?>