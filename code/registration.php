<?php

/************************************************************
*auto to arxeio periexei olous tous aparaititous elegxous *
*kata tin eggrafi enos xristi kai an ola einai swsta ginetai*
*kataxwrisi tou xristi sti vasi dedomenwn*
************************************************************/

require_once('include.php');
dispHeader();

//dimiourgia suntomwn onomatwn metavlitwn
$username=$_POST['username'];
$password=$_POST['password'];
$password2=$_POST['password2'];
$email=$_POST['email'];



/////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////
/////session_start();////////////////////////////////////
////mporei kai na min xreiazetai/////////////////////////
/////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////


try
{
	
	//elegxos gia to an exoun sypmlirwthei ola ta pedia
	if(!filled_out($username))
	{
		throw new Exception('Δεν έχετε σμπληρώσει το όνομα χρήστη!');
	}	
	
	if(!filled_out($password) )
	{
		throw new Exception('Δεν έχετε σμπληρώσει τον κωδικό πρόσβασης!');
	}
	
	if(!filled_out($password2))
	{
		throw new Exception('Δεν έχετε σμπληρώσει την επαλήθευση του κωδικκού πρόσβασης!');
	}
	
	if(!filled_out($email))
	{
		throw new Exception('Δεν έχετε σμπληρώσει τη διεύθυνση ηλςκτρονικού ταχυδρομείου σας!');
	}
	
	//elegxos gia egkyro email
	if(!valid_email($email))
	{
		throw new Exception('Δεν έχετε δώσει μια σωστή διεύθυνση ηλεκτρονικού ταχυδρομειου');
	}
	
	if($password!=$password2)
	{
		throw new Exception('Οι κωδικοί που έχετε δώσει δεν ταιρίαζουν μεταξύ τους');
	}

	if(strlen($password)<4)
	{
		throw new Exception('Ο κωδικός πρέπει να έχει μήκος τουλάχιστον 4 χαρακτήρες');
	}
	

	//eggrafi tou xristi sti basi dedomenwn efoson den symbei kapoio lathos
	register($username,$password,$email);



/////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////
/////eggrafi metavlitis sunodou ////////////////////////
/////$_SESSION['valid_user']=$username;/////////////////
/////mporei kai na min xreiazetai ////////////////////
/////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////

	echo "Επιτυχής εγγραφή!</br>Μπορείται να συνδεθείται στο συστημά μας απο τη σελίδα σύνδεσης";
	//sunartisi emfansis enos link
	dispLink('login.php',"Σελίδα σύνδεσης");
	
	
}

/////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////
/////prosthiki footer kai kefalidas sto error/////////////
/////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////
catch (Exception $e)
{
	echo $e->getMessage();
	exit();
}

dispFooter();

?>