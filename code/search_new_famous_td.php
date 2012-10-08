<?php

require_once('include.php');
dispHeader();

if(isset($_GET['var'])) $title=$_GET['var']; else $title=NULL;
if(isset($_GET['var1'])) $desc=$_GET['var1']; else $desc=NULL;
if(isset($_GET['var2'])) $y=$_GET['var2']; else $y=NULL;


searchURL_by_title_desc($title,$desc,$y);

dispFooter();
?>