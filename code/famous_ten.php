<?php

require_once('include.php');

if(isset($_GET['var'])) $url=strval($_GET['var']); else $url=NULL;

//echo $url;

//sunartisi me vasi tin opoia vriskoyme olouw tous selidodeiktes pou exoyn apothikeutei me to idio url
find_with_url($url);

?>