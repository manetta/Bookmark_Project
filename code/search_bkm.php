<?php

require_once('include.php');
dispHeader();

$search=$_POST['search'];

//echo 'hello';
//echo $search;

if($search=="by_title")
{
	search_by_title_desc();
}
else
{
	search_by_tag();
}

dispFooter();
?>