<?php

require_once('include.php');
dispHeader();

if(isset($_GET['var'])) $username=$_GET['var']; else $username=NULL;

deleteUser($username);

dispFooter();
?>