<?
header("Content-type: image/png"); 
$site = $_GET['site'];
$db_username = 'vokacost_root';
$db_password = 's1ac2x1voFFka';
$database = 'vokacost_sce';
$db_host = 'localhost';       
$con = mysql_connect("$db_host","$db_username","$db_password");
mysql_select_db("$database", $con);

$sql = "SELECT * FROM worth WHERE domain = '$site' LIMIT 1";
$rs_result = mysql_query ($sql); 
$w = -1;
while ($row = mysql_fetch_assoc($rs_result)) {
  $w=$row[worth];
		 $worthInt = intval($w);
		 $worthInt = $worthInt * 3;
		 if ($worthInt == 0) {
		 	$worthInt = 375;
		 }

 $dpview=$row[dpview];
		 $dpviewInt = intval($dpview);
		 $dpviewInt = $dpviewInt / 11;
		 $dpviewInt = round($dpviewInt);
		 if ($dpviewInt < 20) {
		 	$dp = '< 20';
		 } else {
		 	$dp = $dpviewInt;
		 }

 $dearn=$row[dearn];
		 $dearnInt = intval($dearn);
		 $dearnInt = $dearnInt * 11;		 
		 if ($dearnInt == 0) {
		 	$dearnInt = 1;
		 }

 $yahoo_back=$row[yahoo_back];
 $pagerank=strip_tags($row[pagerank]);
 $alexa=$row[alexa];
 $age=$row[age];
 $yahoodir=$row[yahoodir];
 $dmoz=$row[dmoz];
}
$im = imagecreatefrompng("all.png"); 
$font_site = 3;
$xpos_site = 3; 
$ypos_site = 0; 
$string_site = $site." statistics"; 

$font_worth = 3;
$xpos_worth = 62; 
$ypos_worth = 17; 
$string_worth = "$".$worthInt; 

$font_daily = 3;
$xpos_daily = 195; 
$ypos_daily = 17; 
$string_daily = "$".$dearnInt; 

$font_dpview = 3;
$xpos_dpview = 127; 
$ypos_dpview = 40; 
$string_dpview = $dp; 

$font_pagerank = 3;
$xpos_pagerank = 35; 
$ypos_pagerank = 63; 
$string_pagerank = $pagerank; 

$font_alexa = 3;
$xpos_alexa = 160; 
$ypos_alexa = 63; 
$string_alexa = $alexa; 

$font_age = 3;
$xpos_age = 47; 
$ypos_age = 86; 
$string_age = $age; 

$font_dmoz = 3;
$xpos_dmoz = 51; 
$ypos_dmoz = 129; 
$string_dmoz = $dmoz;

$font_yahoo_back = 3;
$xpos_yahoo_back = 169; 
$ypos_yahoo_back = 108; 
$string_yahoo_back = $yahoo_back;


$font_yahoodir = 3;
$xpos_yahoodir = 154; 
$ypos_yahoodir = 130; 
$string_yahoodir = $yahoodir; 

$font_author = 2; 
$xpos_author = 100; 
$ypos_author = 148; 
$string_author = "by SiteCostCalculator.com"; 

$white = imagecolorallocate($im, 0, 0, 0); 
$black = imagecolorallocate($im, 255, 255, 255); 
imagestring($im, $font_site, $xpos_site, $ypos_site, $string_site, $white); 
imagestring($im, $font_worth, $xpos_worth, $ypos_worth, $string_worth, $white); 
imagestring($im, $font_daily, $xpos_daily, $ypos_daily, $string_daily, $white); 
imagestring($im, $font_dpview , $xpos_dpview , $ypos_dpview , $string_dpview, $white); 
imagestring($im, $font_pagerank , $xpos_pagerank , $ypos_pagerank , $string_pagerank, $white); 
imagestring($im, $font_alexa , $xpos_alexa , $ypos_alexa , $string_alexa, $white); 
imagestring($im, $font_age, $xpos_age, $ypos_age, $string_age, $white);
imagestring($im, $font_yahoodir, $xpos_yahoodir, $ypos_yahoodir, $string_yahoodir, $white);
imagestring($im, $font_yahoo_back, $xpos_yahoo_back, $ypos_yahoo_back, $string_yahoo_back, $white);
imagestring($im, $font_author, $xpos_author, $ypos_author, $string_author, $white);
imagepng($im);
mysql_close($con);

?>