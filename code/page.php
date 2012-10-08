<?php

//http://www.dfstermole.net/PHP/workshop/passarray.html
//http://www.justskins.com/forums/passing-array-in-the-120375.html
//http://www.google.gr/#sclient=psy-ab&hl=el&source=hp&q=sending+array+php+with+href&pbx=1&oq=sending+array+php+with+href&aq=f&aqi=&aql=&gs_sm=e&gs_upl=80138l81724l1l81844l10l10l0l0l0l0l316l2080l0.3.5.1l9l0&bav=on.2,or.r_gc.r_pw.,cf.osb&fp=a207cd47062b9939&biw=1166&bih=659
//sending array php with href --> google



require_once('include.php');

dispHeader();

if(isset($_GET['var'])) $page=$_GET['var']; else $page=NULL;
if(isset($_GET['var1'])) $index_per_page=$_GET['var1']; else $index_per_page=NULL;
if(isset($_GET['var3'])) $y=$_GET['var3']; else $y=NULL;
if(isset($_GET['var4'])) $td=$_GET['var4']; else $td=NULL;

if($td==0)
{
	if(isset($_GET['var2'])) $tag=$_GET['var2']; else $tag=NULL;
}
elseif($td==1)
{
	if(isset($_GET['var2'])) $title=$_GET['var2']; else $title=NULL;
	if(isset($_GET['var5'])) $desc=$_GET['var5']; else $desc=NULL;
}

$a=$_REQUEST['final'];

if($td==0)
	url_from_paging($page,$index_per_page,$a,$tag,$y);
elseif($td==1)
{
	$td_array=array();
	array_push($td_array,$title);
	array_push($td_array,$desc);
	url_from_paging($page,$index_per_page,$a,$td_array,$y);
}
dispFooter();
?>