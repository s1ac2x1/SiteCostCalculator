<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>
<?
include ("config.php");
$lang = $_GET['lang'];

function countryCityFromIP($ipAddr)
{
   //function to find country and city name from IP address
   //Developed by Roshan Bhattarai 
   //Visit http://roshanbh.com.np for this script and more.
  
  //verify the IP address for the  
  ip2long($ipAddr)== -1 || ip2long($ipAddr) === false ? trigger_error("Invalid IP", E_USER_ERROR) : "";
  // This notice MUST stay intact for legal use
  $ipDetail=array(); //initialize a blank array
  //get the XML result from hostip.info
  $xml = file_get_contents("http://api.hostip.info/?ip=".$ipAddr);
  //get the city name inside the node <gml:name> and </gml:name>
  preg_match("@<Hostip>(\s)*<gml:name>(.*?)</gml:name>@si",$xml,$match);
  //assing the city name to the array
  $ipDetail['city']=$match[2]; 
  //get the country name inside the node <countryName> and </countryName>
  preg_match("@<countryName>(.*?)</countryName>@si",$xml,$matches);
  //assign the country name to the $ipDetail array 
  $ipDetail['country']=$matches[1];
  //get the country name inside the node <countryName> and </countryName>
  preg_match("@<countryAbbrev>(.*?)</countryAbbrev>@si",$xml,$cc_match);
  $ipDetail['country_code']=$cc_match[1]; //assing the country code to array
  //return the array containing city, country and country code
  return $ipDetail;
} 
  
if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
 {
 $ip=$_SERVER['HTTP_CLIENT_IP'];
 }
 elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
 {
 $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
 }
 else
 {
 $ip=$_SERVER['REMOTE_ADDR'];
 }
 
$IPDetail=countryCityFromIP($ip); 
$country =  $IPDetail['country'];
$f = substr($country, 0, 1);
$r = strtolower(substr($country, 1, strlen($country)));
$ready = $f.$r;
mysql_close($con);

$contactUs = 'Contact us';
$country = $ready;
$rights = "All rights reserved.";

require "translate.php";
$tr = new Google_Translate_API;

	$country_ = $tr->translate($country, 'en', $lang);
	$rights_ = $tr->translate($rights, 'en', $lang);
	$contactUs_ = $tr->translate($contactUs, 'en', $lang);
	
if ($contactUs_) {
	$contactUs  = $contactUs_;
}
if ($country_) {
	$country  = $country_;
}
if ($rights_) {
	$rights  = $rights_;
}

echo "<center>&copy; 2011 SiteCostCalculator.com ".$rights."<br><a href=\"mailto:vovka.sitecost@gmail.com\" target=\"_blank\">".$contactUs."</a></center>";
?>
</body>
<html>