<?php

require_once('include.php');
dispHeader();

$old_pass=$_POST['old_pass'];
$new_pass1=$_POST['new_pass1'];
$new_pass2=$_POST['new_pass2'];
$val_user=$_SESSION['valid_user'];

try
{
	
	//elegxos gia to an exei sypmlirwthei to username
	if(!filled_out($old_pass))
	{
		throw new Exception('Δεν έχετε σμπληρώσει το παλιό κωδικό σας!');
	}
	
	if(!filled_out($new_pass1))
	{
		throw new Exception('Δεν έχετε σμπληρώσει το νέο κωδικό σας!');
	}
	
	if(!filled_out($new_pass2))
	{
		throw new Exception('Δεν έχετε σμπληρώσει την επαλήθευση για τον νέο κωδικό σας!');
	}
	
	if(strlen($new_pass1)<4)
	{
		throw new Exception('Ο κωδικός πρέπει να έχει μήκος τουλάχιστον 4 χαρακτήρες');
	}
	
	if($new_pass1!=$new_pass2)
	{
		throw new Exception('Οι νέοι κωδικοί που έχετε δώσει δεν ταιρίαζουν μεταξύ τους');
	}
	
	$pass=get_pass($val_user);

	if($pass!=sha1($old_pass))
	{
		throw new Exception('Ο παλίος κωδικός που δώσατε δεν έιναι σωστός');
	}
	
	modifyPassword($val_user,$new_pass1);
}

catch (Exception $e)
{
	echo $e->getMessage();
	exit();
}

dispFooter();

?>