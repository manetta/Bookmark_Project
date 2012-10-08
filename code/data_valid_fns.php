<?php


/******************************************************************************
* auth h sunarthsh afairei ton keno xwro apo tin  arxi kai to telos tis 
* sumvoloseiras kai elegxei an mia metavlhth uparxei kai einai gemismenh me 
* dedomena kai epistrefei katallhlh boolean metavlhth
****************************************************************************/
function filled_out($var)
{	
	//afaroume ton keno xwro apo tin arxi kai to telos tis sumvoloseiras
	$var=trim($var);
	//elegxos gia to an mia metavliti periexei mia timi
	if(!isset($var)||$var=='')
		return false;
	else	return true;
}

 
/*****************************************************************************
* sunartisi gia tin egkurotita tou email
******************************************************************************/
function valid_email($email)
{

//var re=/^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/;
	//diko mou arxiko
	$email_re="^[a-zA-Z0-9_\-\.]+@([a-zA-Z0-9][a-zA-Z0-9\-]*\.)+[a-zA-Z]+$";
	
	//$email_re="^[a-zA-Z0-9_\.\-]+@[a-zA-Z0-9\-]+\.[a-zA-Z0-9\-\.]+$";
	
	if(@ereg($email_re,$email))
		return true;
	else	return false;
}


function check_url($url)
{
	//arxiko
	//$url_re="^[(http://www\.)|(www\.)]+[a-zA-Z0-9]+\.[a-zA-Z0-9]*[\/[a-zA-Z0-9]|\/]$";
	$url_re="^[(http://www\.)|(www\.)]+[a-zA-Z0-9]+\.[a-zA-Z0-9]*[\/[a-zA-Z0-9]|\/]$";
	
	//$url_re='@^(?:http://)?([^/]+)@i';
	if(@ereg($url_re,$url))
		return true;
	else	return false;
}
?>