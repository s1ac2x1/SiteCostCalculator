<?
header("Content-type: text/xml"); 
include("../config.php");
$domain = $_GET['domain'];
$sql = "SELECT * FROM worth WHERE domain = '$domain' LIMIT 1";
$rs_result = mysql_query ($sql); 
while ($row = mysql_fetch_assoc($rs_result)) { 
		 $worth=$row[worth];
		 $worthInt = intval($worth);
		 if ($worthInt < 100) {
			$worthInt = $worthInt + 100;
		 }
		 $dpview=$row[dpview];
		 $dpviewInt = intval($dpview);
if ($dpviewInt > 10000) {
		 $dpviewInt = $dpviewInt / 10;
		 $dpviewInt = round($dpviewInt);
}
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
		 $pagerank=$row[pagerank];
		 $alexa=$row[alexa];
		 $country=$row[country];
		 $ip=$row[ip];
		 $age=$row[age];
		 $yahoodir=$row[yahoodir];
		 $dmoz=$row[dmoz];
		 if (!$yahoo_back) {
		 	$yahoo_back = "without";
		 }
		 if (!$pagerank) {
		 	$pagerank = "0";
		 }
		 if (!$alexa) {
		 	$alexa = "Unknown";
		 }
		 if (!$age) {
		 	$age = "Undefined";
		 }
		 if (!$country) {
		 	$country = "undefined country";
		 }
	$googleIndexedPages = $row[googleIndexedPages];
	$yahooIndexedPagesMainDomain = $row[yahooIndexedPagesMainDomain];
	$yahooIndexedPagesSubdomains = $row[yahooIndexedPagesSubdomains];
	$bingIndexedPages = $row[bingIndexedPages];
	$yahooLinksExceptFromThisDomain = $row[yahooLinksExceptFromThisDomain];
	$yahooLinksFromAllPages = $row[yahooLinksFromAllPages];
	$bingLinks = $row[bingLinks];
	$alexaLinks = $row[alexaLinks];
}
mysql_close($con);
function curPageURL() {
 $pageURL = 'http';
 if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
 $pageURL .= "://";
 if ($_SERVER["SERVER_PORT"] != "80") {
  $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
 } else {
  $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
 }
 return $pageURL;
}
preg_match("/^(http:\/\/)?([^\/]+)/i", curPageURL(), $matches);
$host = $matches[2];
preg_match("/[^\.\/]+\.[^\.\/]+$/", $host, $matches);
$mainDomain = "{$matches[0]}";
if ($mainDomain == 'sitecostcalculator.com') {
	$mainTitle2 = 'SiteCostCalculator.com';
	$mailTo = "support@sitecostcalculator.com";
} 
if ($mainDomain == 'websitepricecalculator.net') {
	$mainTitle2 = 'WebsitePriceCalculator.net';
	$mailTo = "support@websitepricecalculator.net";
} 
if ($mainDomain == 'websitecostcalculator.com') {
	$mainTitle2 = 'WebsiteCostCalculator.com';
	$mailTo = "support@websitecostcalculator.com";
} 
if ($mainDomain == 'websitetrafficcalculator.com') {
	$mainTitle2 = 'WebsiteTrafficCalculator.com';
	$mailTo = "support@websitetrafficcalculator.com";
} 
if ($mainDomain == 'websiteworthcalculator.net') {
	$mainTitle2 = 'WebsiteWorthCalculator.net';
	$mailTo = "support@websiteworthcalculator.net";
}
if ($mainDomain == 'websitecost.info') {
	$mainTitle2 = 'WebsiteCost.info';
	$mailTo = "support@websitecost.info";
}
if ($mainDomain == 'costofwebsite.net') {
	$mainTitle2 = 'costofwebsite.net';
	$mailTo = "support@websitecost.info";
}
if ($mainDomain == 'sitecostcalculator.ru') {
	$mainTitle2 = 'SiteCostCalculator.ru';
	$mailTo = "support@sitecostcalculator.ru";
}
$xml = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>
<calculator>
	<domain>".$domain."</domain>
	<currency>$</currency>
	<worth>".$worthInt."</worth>
	<age>".$age."</age>
	<alexa>".$alexa."</alexa>
	<ip>".$ip."</ip>
	<country>".$country."</country>
	<google_indexed_pages>".$googleIndexedPages."</google_indexed_pages>
	<bing_indexed_pages>".$bingIndexedPages."</bing_indexed_pages>
	<bing_links>".$bingLinks."</bing_links>
	<alexa_links>".$alexaLinks."</alexa_links>
	<link>http://".$mainTitle2."/www.".$domain."</link>
	<comment>It will be great if you will write somewhere link above :)</comment>
</calculator>";
echo $xml;
?>