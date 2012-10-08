<?php

require_once('include.php');
dispHeader();


if(isset($_GET['var'])) $tag=strval($_GET['var']); else $tag=NULL;

echo '<br/>';
//echo '<h1>Αποτελέσματα αναζήτησης</h1>';

//anazitisi twn selidodeiktwm me vasi to epilegmeno tag
find_with_tag($tag);

dispFooter();

?>