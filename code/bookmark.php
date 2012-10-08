<?php

require_once('include.php');

dispHeader();


if(isset($_GET['var'])) $id=strval($_GET['var']); else $id=NULL;
//$id=$_GET['var'];

//echo $id;

//$y=0;

try
{
	find_url_id($id);
}

catch (Exception $e)
{
	echo $e->getMessage();


	exit();
}

dispFooter();
?>