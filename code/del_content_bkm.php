<?php

require_once('include.php');
dispHeader();

if(isset($_GET['var'])) $id=strval($_GET['var']); else $id=NULL;

//echo $id;

make_bkm_clean($id);

dispFooter();
?>