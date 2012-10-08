<?php

require_once('include.php');
dispHeader();

if(isset($_GET['var'])) $id=strval($_GET['var']); else $id=NULL;

//echo $id;

make_cmnt_clean($id);

dispFooter();

?>