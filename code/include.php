<?php


//xekiname ena session
session_start();

//elegxoume an exei tethei i session metavliti user_type kai an exei tethei
//tin ekxwroume stin topiki metavliti type
if(isset($_SESSION['user_type'])) 
	$type=$_SESSION['user_type'];


//elegxoume an exei tethei i session metavliti valid_user kai an exei tethei
//tin ekxwroume stin topiki metavliti tval_user
if(isset($_SESSION['valid_user']))
	$val_user=$_SESSION['valid_user'];




require_once('data_valid_fns.php');
require_once('db_fns.php');
require_once('presentation_fns.php');


?>