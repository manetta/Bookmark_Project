<?php

require_once('include.php');
dispHeader();

if(isset($_GET['var'])) $tag=$_GET['var']; else $tag=NULL;
if(isset($_GET['var1'])) $y=$_GET['var1']; else $y=NULL;

searchURL_by_tags($tag,$y);

dispFooter();

?>