<?include ("config.php");$lang = $_GET['lang'];if ($lang) {include("../".$lang.".php");} else {include("../en.php");}class Website {	var $worth;	var $domain;	var $keyword;	var $pagerank;	var $title;	var $description;	var $years;	var $days;	var $age;	var $daysCount;}function endings($n, $form1, $form2, $form5) {$n = abs($n) % 100;$n1 = $n % 10;if ($n > 10 && $n < 20) return $form5;if ($n1 > 1 && $n1 < 5) return $form2;if ($n1 == 1) return $form1;return $form5;}function curPageURL() { $pageURL = 'http'; if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";} $pageURL .= "://"; if ($_SERVER["SERVER_PORT"] != "80") {  $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"]; } else {  $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"]; } return $pageURL;}preg_match("/^(http:\/\/)?([^\/]+)/i", curPageURL(), $matches);$host = $matches[2];preg_match("/[^\.\/]+\.[^\.\/]+$/", $host, $matches);$mainDomain = "{$matches[0]}";if ($mainDomain == 'sitecostcalculator.com') {	$mainTitle2 = 'SiteCostCalculator.com';	$mailTo = "support@sitecostcalculator.com";} if ($mainDomain == 'websitepricecalculator.net') {	$mainTitle2 = 'WebsitePriceCalculator.net';	$mailTo = "support@websitepricecalculator.net";} if ($mainDomain == 'websitecostcalculator.com') {	$mainTitle2 = 'WebsiteCostCalculator.com';	$mailTo = "support@websitecostcalculator.com";} if ($mainDomain == 'websitetrafficcalculator.com') {	$mainTitle2 = 'WebsiteTrafficCalculator.com';	$mailTo = "support@websitetrafficcalculator.com";} if ($mainDomain == 'websiteworthcalculator.net') {	$mainTitle2 = 'WebsiteWorthCalculator.net';	$mailTo = "support@websiteworthcalculator.net";}if ($mainDomain == 'websitecost.info') {	$mainTitle2 = 'WebsiteCost.info';	$mailTo = "support@websitecost.info";}if ($mainDomain == 'costofwebsite.net') {	$mainTitle2 = 'costofwebsite.net';	$mailTo = "support@websitecost.info";}function ageSort($s1, $s2) {	if ($s1->daysCount < $s2->daysCount) return 1;	elseif($s1->daysCount > $s2->daysCount) return -1;	else return 0;}function prSort($s1, $s2) {	if ($s1->pagerank < $s2->pagerank) return 1;	elseif($s1->pagerank > $s2->pagerank) return -1;	else return 0;}function worthSort($s1, $s2) {	if ($s1->worth < $s2->worth) return 1;	elseif($s1->worth > $s2->worth) return -1;	else return 0;}function domainSort($s1, $s2) {	if ($s1->domain < $s2->domain) return -1;	elseif($s1->domain > $s2->domain) return 1;	else return 0;}function titleSort($s1, $s2) {	if ($s1->title < $s2->daysCtitleount) return -1;	elseif($s1->title > $s2->title) return 1;	else return 0;}function descriptionSort($s1, $s2) {	if ($s1->description < $s2->description) return -1;	elseif($s1->description > $s2->description) return 1;	else return 0;}$action = $_GET['action'];$limit = $_GET['limit'];if (!$limit) {	$limit = 100;}	$key = $_GET['key'];	$findType = $_GET['findType'];	$sortBy = $_GET['sortBy'];	$sortByStr = "";	$whatToSelect = "domain, keyword, pagerank, title, description, age, worth";	if ($findType == 'keyword') {		$basicSQL = "SELECT $whatToSelect FROM worth WHERE keyword like '%$key%'";		$sqlnum = "SELECT COUNT(*) as num FROM worth WHERE keyword like '%$key%'";		$findStr = $findKey;	}	if ($findType == 'title') {		$basicSQL = "SELECT $whatToSelect FROM worth WHERE title like '%$key%'";		$sqlnum = "SELECT COUNT(*) as num FROM worth WHERE title like '%$key%'";		$findStr = $findTitle;	}	if ($findType == 'desc') {		$basicSQL = "SELECT $whatToSelect FROM worth WHERE description like '%$key%'";		$sqlnum = "SELECT COUNT(*) as num FROM worth WHERE description like '%$key%'";		$findStr = $findDesc;	}	if ($findType == 'domain') {		$basicSQL = "SELECT $whatToSelect FROM worth WHERE domain like '%$key%'";		$sqlnum = "SELECT COUNT(*) as num FROM worth WHERE domain like '%$key%'";		$findStr = $findDomain;	}	if ($findType == 'any') {		$basicSQL = "SELECT $whatToSelect FROM worth WHERE keyword like '%$key%' OR title like'%$key%' OR description like'%$key%'";		$sqlnum = "SELECT COUNT(*) as num FROM worth WHERE keyword like '%$key%' OR title like'%$key%' OR description like'%$key%'";		$findStr = $findAny;	}	$rs_result = mysql_query($sql);$num_result = mysql_query($sqlnum);while ($row = mysql_fetch_assoc($num_result)) {	$initCount = $row[num];}require_once("my_pagina_class.php");$test = new MyPagina($initCount);$test->number_links = 5;$test->sql = $basicSQL;$result = $test->get_page_result();$num_rows = $test->get_page_num_rows();$nav_info = $test->page_info("Shown %d - %d of %d sites");$nav_links = $test->navigation(" | ", "currentStyle", false, false, false, true);$numbers_only = $test->navigation("", "current", true);$simple_nav_links = $test->back_forward_link(true);$test->forw = "&#9658;";$test->back = "&#9668;";$simple_nav_txt_links = $test->back_forward_link();$arr = array();for ($i = 0; $i < $num_rows; $i++) {	$website = new Website();	$website->domain = mysql_result($result, $i, "domain");	$website->keyword = mysql_result($result, $i, "keyword");	$website->worth = mysql_result($result, $i, "worth");	$website->pagerank = mysql_result($result, $i, "pagerank");	$website->title = mysql_result($result, $i, "title");	$website->description = mysql_result($result, $i, "description");	if ($row[age] != 'Unknown') {		list($website->years, $bebebe1, $website->days, $bebebe2) = explode(" ", $row[age]);		$website->age = mysql_result($result, $i, "age");		$website->daysCount = ($website->years * 365) + $website->days;	}	$arr[] = $website;}	if ($sortBy == 'worth') {		uasort($arr,"worthSort");		$sortStr = $sortWorth;	}	if ($sortBy == 'age') {		uasort($arr,"ageSort");		$sortStr = $sortAge;	}	if ($sortBy == 'pr') {		uasort($arr,"prSort");		$sortStr = $sortPr;	}	if ($sortBy == 'title') {		uasort($arr,"titleSort");		$sortStr = $sortTitle;	}	if ($sortBy == 'domain') {		uasort($arr,"domainSort");		$sortStr = $sortDomain;	}	$out = $nav_info."<br>".$srfor." <b>".$key."</b>  ".$findStr.$sortStr."<br>		<br><br><table style=\"float:left;\">";	foreach($arr as $site) {		$domainKeys = $site->keyword;		$testCommas = array_map('trim',explode(",",$domainKeys));		$testSpaces = array_map('trim',explode(" ",$domainKeys));		$splitted = (count($testCommas) <= 1 ? $testSpaces : $testCommas);		if ($site->years) {			$siteAge = $site->years." ".endings($site->years, $ageYears1, $ageYears2, $ageYears5)." ".$site->days." ".endings($site->days, $ageDays1, $ageDays2, $ageDays5);		} else {			$siteAge = $ageNot;		}		 $worth=$site->worth;		 $worthInt = intval($worth);		 $worthInt = $worthInt * 3;		 if ($worthInt == 0) {		 	$worthInt = 375;		 }		 $worthInt2 = $worthInt * 5;		$out .= "<translate><td><a href=\"go.php?to=http://".$site->domain."\" target=\"_blank\">			 <img height=\"90\" style=\"border:solid 1px gray; float:left; margin-right:10px;\" width=\"120\" src=\"http://open.thumbshots.org/image.pxf?url=".$site->domain."\" title=\"".$site->domain."\" alt=\"".$site->domain."\"></a>		         <font style=\"font-family: georgia, serif; font-size:11pt;\">			 <b><a href=\"www.".$site->domain."\">".$site->domain."</a></b>			 </font>&nbsp;&nbsp;&nbsp;&nbsp;<img src=\"pr".$site->pagerank.".gif\" style=\"margin-bottom:-4px;\">&nbsp;&nbsp;&nbsp;&nbsp;			<font style=\"font-family: georgia, serif; font-size:9pt;\">			<i>".$siteAge."</i>&nbsp;&nbsp;&nbsp;&nbsp;			<i>$".number_format($worthInt, 0, ',', ',')." - $".number_format($worthInt2, 0, ',', ',')."</i>			</font>			<br>		         <font style=\"font-family: georgia, serif; font-size:10pt;\">			 <b>".$site->title."</b>			 </font>			 <br>		         <font style=\"font-family: georgia, serif; font-size:10pt;\">			 ".$site->description."			 </font><br>";		$sCount = 1;		foreach($splitted as $key) {			if ($sCount % 12 == 0) {				$out .= "<br>";			} else {				$out .= "<a style=\"text-decoration:none; color:green; cursor:pointer;background-color:#EDF8FC;font-family: georgia, serif; font-size:11pt;\" onclick=\"loadKeys('".$key."', 'keyword')\">".$key."</a>&nbsp;&nbsp;&nbsp;";			}			$sCount++;		}		$out .= "</td></translate><translate><td>&nbsp;</td></translate>";	}	$out .= "</table>";unset($arr);echo $out;echo "<p id=\"numbers\">".$numbers_only."</p>\n";$test->free_page_result();mysql_close($con);?>