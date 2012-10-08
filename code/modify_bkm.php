<?php

require_once('include.php');
dispHeader();

echo '<br/>';
//echo 'hello';



if(isset($_GET['var'])) $id=strval($_GET['var']); else $id=NULL;
//if(isset($_GET['var1'])) $clean=strval($_GET['var1']); else $clean=NULL;


find_url_mod($id);
//dispModifyBkm($id);
dispFooter();

?>