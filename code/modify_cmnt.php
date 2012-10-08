<?php

require_once('include.php');
dispHeader();

//$val_user=$_SESSION['valid_user'];
if(isset($_GET['var'])) $id=strval($_GET['var']); else $id=NULL;
if(isset($_GET['var1'])) $id_bk=strval($_GET['var1']); else $id_bk=NULL;

//echo $id;

find_cmnt($id,$id_bk);
dispFooter();
?>