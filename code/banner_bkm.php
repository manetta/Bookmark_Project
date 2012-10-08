<?php

require_once('include.php');
dispHeader();

echo '<br/>';
//echo 'hello';


$val_user=$_SESSION['valid_user'];
if(isset($_GET['var'])) $id=strval($_GET['var']); else $id=NULL;

try
{
	bad_bkm($val_user,$id);
	
?>
	<h2><a href="main.php">Αρχική Σελίδα</a></h2>
<?php
}

catch (Exception $e)
{
	echo $e->getMessage();
	exit();
}

dispFooter();
?>