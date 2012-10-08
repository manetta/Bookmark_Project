<?php
require_once('include.php');
dispHeader();


$val_user=$_SESSION['valid_user'];


//sunartisi emfanisis twn stoixeiwn syndesis
UserData($val_user);


dispModifyDataForm();
dispFooter();
?>