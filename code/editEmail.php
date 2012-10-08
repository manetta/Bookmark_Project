<?php

require_once('include.php');
dispHeader();

$email=$_POST['new_mail'];
$val_user=$_SESSION['valid_user'];


try
{
	
	//elegxos gia to an exei sypmlirwthei to username
	if(!filled_out($email))
	{
		throw new Exception('Δεν έχετε σμπληρώσει το νέο e-mail');
	}
	
	if(!valid_email($email))
	{
		throw new Exception('Δεν έχετε δώσει μια σωστή διεύθυνση ηλεκτρονικού ταχυδρομειου');
	}
	
	modifyEmail($val_user,$email);
	
	
		
}
catch (Exception $e)
{
	echo $e->getMessage();
	exit();
}

dispFooter();

?>