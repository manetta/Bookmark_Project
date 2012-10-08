<?php

include('functions.php');

//kataxwroume ta stoixeia tis formas signup se metablites
$username=$_GET['username'];
$password=$_GET['password'];
$password2=$_GET['password2'];
$email=$_GET['email'];

//afairoume ton keno xwro apo tin arxi kai to telso tis symvoloseiras
$username=trim($username);
$password=trim($password);
$email=trim($email);


//elegxoume an o xristis exei eisagei ola ta stoixeia tis formas
if(!$username)
{
	echo 'Εισάγετε ένα μη κενό username!';
	exit;
}


if(!$password)
{
	echo 'Εισάγετε ένα μη κενό password!';
	exit;
}


if(!$email)
{
	echo 'Εισάγετε ένα μη κενό e-mail!';
	exit;
}

//elegxos gia to an o xristis eisigage mia egkyri dieuthinsi e-mail
if(!valid_email($email))
{
	echo 'Μη έγκυρο e-mail!</br>';
	echo 'Εισάγετε μια έγκυρη διεύθυνση e-mail στη φόρμα εγγραφής.';
	exit;
}


//elegxos gia to mikos tou kwdikou
//egkyros thewreitai o kwdikos pou einai apo 4-8 xaraktires
$len=strlen($password);
if(($len<4)||($len>8))
{
	echo 'Δεν έχετε δώσει σωστό μήκος κωδικού.</br>';
	echo 'Ο κωδικός σας πρέπει να έχει μήκος 4 εως 8 χαρακτήρες.';
	exit;
}


//elegxos gia to an oi dyo kwdikoi symfwnoyn metaxy tous
if(strcmp($password,$password2)!=0)
{
	echo 'Οι δύο κωδικοί που δώσατε δεν συμφωνουν μεταξύ τους.</br>';
	echo 'Εισάγετε τον ίδιο κωδικό και στα δύο πεδία!';
	exit;	
}


//elegxoume an mpainoun aytomata ta eisagwgika alliws ta prosthetome emeis
if(!get_magic_quotes_gpc())
{
	$username=addslashes($username);
	$password=addslashes($password);
	$email=addslashes($email);
}



echo '</br>';
echo 'ok';




?>