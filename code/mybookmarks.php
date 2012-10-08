<?php

require_once('include.php');
dispHeader();


$url_array=find_mybkm();

/*
for($i=0; $i<count($url_array); $i++)
{
	echo $url_array[$i];
	echo '<br/>';
}*/

dispUrls($url_array);
dispFooter();
?>