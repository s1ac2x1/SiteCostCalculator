﻿<?phpinclude ("config.php");$lang = $_GET['lang'];if ($lang) {include("../".$lang.".php");} else {include("../en.php");}class Website {	var $worth;	var $domain;	var $keyword;	var $pagerank;	var $title;	var $description;	var $years;	var $days;	var $age;	var $daysCount;}function endings($n, $form1, $form2, $form5) {$n = abs($n) % 100;$n1 = $n % 10;if ($n > 10 && $n < 20) return $form5;if ($n1 > 1 && $n1 < 5) return $form2;if ($n1 == 1) return $form1;return $form5;}function curPageURL() { $pageURL = 'http'; if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";} $pageURL .= "://"; if ($_SERVER["SERVER_PORT"] != "80") {  $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"]; } else {  $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"]; } return $pageURL;}preg_match("/^(http:\/\/)?([^\/]+)/i", curPageURL(), $matches);$host = $matches[2];preg_match("/[^\.\/]+\.[^\.\/]+$/", $host, $matches);$mainDomain = "{$matches[0]}";if ($mainDomain == 'sitecostcalculator.com') {	$mainTitle2 = 'SiteCostCalculator.com';	$mailTo = "support@sitecostcalculator.com";} if ($mainDomain == 'websitepricecalculator.net') {	$mainTitle2 = 'WebsitePriceCalculator.net';	$mailTo = "support@websitepricecalculator.net";} if ($mainDomain == 'websitecostcalculator.com') {	$mainTitle2 = 'WebsiteCostCalculator.com';	$mailTo = "support@websitecostcalculator.com";} if ($mainDomain == 'websitetrafficcalculator.com') {	$mainTitle2 = 'WebsiteTrafficCalculator.com';	$mailTo = "support@websitetrafficcalculator.com";} if ($mainDomain == 'websiteworthcalculator.net') {	$mainTitle2 = 'WebsiteWorthCalculator.net';	$mailTo = "support@websiteworthcalculator.net";}if ($mainDomain == 'websitecost.info') {	$mainTitle2 = 'WebsiteCost.info';	$mailTo = "support@websitecost.info";}if ($mainDomain == 'costofwebsite.net') {	$mainTitle2 = 'costofwebsite.net';	$mailTo = "support@websitecost.info";}function ageSort($s1, $s2) {	if ($s1->daysCount < $s2->daysCount) return 1;	elseif($s1->daysCount > $s2->daysCount) return -1;	else return 0;}function prSort($s1, $s2) {	if ($s1->pagerank < $s2->pagerank) return 1;	elseif($s1->pagerank > $s2->pagerank) return -1;	else return 0;}function worthSort($s1, $s2) {	if ($s1->worth < $s2->worth) return 1;	elseif($s1->worth > $s2->worth) return -1;	else return 0;}function domainSort($s1, $s2) {	if ($s1->domain < $s2->domain) return -1;	elseif($s1->domain > $s2->domain) return 1;	else return 0;}function titleSort($s1, $s2) {	if ($s1->title < $s2->daysCtitleount) return -1;	elseif($s1->title > $s2->title) return 1;	else return 0;}function descriptionSort($s1, $s2) {	if ($s1->description < $s2->description) return -1;	elseif($s1->description > $s2->description) return 1;	else return 0;}	$key = $_GET['key'];	$findType = $_GET['findType'];	$sortBy = $_GET['sortBy'];	$whatToSelect = "domain, keyword, pagerank, title, description, age, worth";	if ($findType == 'keyword') {		$sqlnum = "SELECT COUNT(*) as num FROM worth WHERE keyword like '%".mysql_real_escape_string($key)."%'";	}	if ($findType == 'title') {		$sqlnum = "SELECT COUNT(*) as num FROM worth WHERE title like '%".mysql_real_escape_string($key)."%'";	}	if ($findType == 'desc') {		$sqlnum = "SELECT COUNT(*) as num FROM worth WHERE description like '%".mysql_real_escape_string($key)."%'";	}	if ($findType == 'domain') {		$sqlnum = "SELECT COUNT(*) as num FROM worth WHERE domain like '%".mysql_real_escape_string($key)."%'";	}	if ($findType == 'any') {		$sqlnum = "SELECT COUNT(*) as num FROM worth WHERE keyword like '%".mysql_real_escape_string($key)."%' OR title like'%".mysql_real_escape_string($key)."%' OR description like'%".mysql_real_escape_string($key)."%'";	}	$adjacents = 1;	$total_pages = mysql_fetch_array(mysql_query($sqlnum));	$total_pages = $total_pages[num];	$targetpage = "semantic3.php?key=".$key."&findType=".$findType."&sortBy=".$sortBy;	$limit = 5;	$page = $_GET['page'];	if ($page) {		$start = ($page - 1) * $limit;	} else {		$start = 0;	}	$whatToSelect = "domain, keyword, pagerank, title, description, age, worth";	if ($findType == 'keyword') {		$basicSQL = "SELECT $whatToSelect FROM worth WHERE keyword like '%".mysql_real_escape_string($key)."%' LIMIT $start, $limit";		$findStr = $findKey;	}	if ($findType == 'title') {		$basicSQL = "SELECT $whatToSelect FROM worth WHERE title like '%".mysql_real_escape_string($key)."%' LIMIT $start, $limit";		$findStr = $findTitle;	}	if ($findType == 'desc') {		$basicSQL = "SELECT $whatToSelect FROM worth WHERE description like '%".mysql_real_escape_string($key)."%' LIMIT $start, $limit";		$findStr = $findDesc;	}	if ($findType == 'domain') {		$basicSQL = "SELECT $whatToSelect FROM worth WHERE domain like '%".mysql_real_escape_string($key)."%' LIMIT $start, $limit";		$findStr = $findDomain;	}	if ($findType == 'any') {		$basicSQL = "SELECT $whatToSelect FROM worth WHERE keyword like '%".mysql_real_escape_string($key)."%' OR title like'%".mysql_real_escape_string($key)."%' OR description like'%".mysql_real_escape_string($key)."%' LIMIT $start, $limit";		$findStr = $findAny;	}	$result = mysql_query($basicSQL);		/* Setup page vars for display. */	if ($page == 0) $page = 1;	$prev = $page - 1;	$next = $page + 1;	$lastpage = ceil($total_pages/$limit);	$lpm1 = $lastpage - 1;	$pagination = "";	if($lastpage > 1)	{			$pagination .= "<div class=\"pagination\">";		if ($page > 1) 			$pagination.= "<a onclick=\"loadKeys('".$key."', '".$findType."', '".$sortBy."', '".$prev."');\" style=\"cursor:pointer;\"><</a>";		else			$pagination.= "<span class=\"disabled\"><</span>";		if ($lastpage < 7 + ($adjacents * 2))		{				for ($counter = 1; $counter <= $lastpage; $counter++)			{				if ($counter == $page)					$pagination.= "<span class=\"current\">$counter</span>";				else					$pagination.= "<a onclick=\"loadKeys('".$key."', '".$findType."', '".$sortBy."', '".$counter."');\" style=\"cursor:pointer;\">$counter</a>";								}		}		elseif($lastpage > 5 + ($adjacents * 2))	//enough pages to hide some		{			if($page < 1 + ($adjacents * 2))					{				for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)				{					if ($counter == $page)						$pagination.= "<span class=\"current\">$counter</span>";					else						$pagination.= "<a onclick=\"loadKeys('".$key."', '".$findType."', '".$sortBy."', '".$counter."');\" style=\"cursor:pointer;\">$counter</a>";									}				$pagination.= "...";				$pagination.= "<a onclick=\"loadKeys('".$key."', '".$findType."', '".$sortBy."', '".$lpm1."');\" style=\"cursor:pointer;\">$lpm1</a>";				$pagination.= "<a onclick=\"loadKeys('".$key."', '".$findType."', '".$sortBy."', '".$lastpage."');\" style=\"cursor:pointer;\">$lastpage</a>";					}			elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))			{				$pagination.= "<a onclick=\"loadKeys('".$key."', '".$findType."', '".$sortBy."', '1');\" style=\"cursor:pointer;\">1</a>";				$pagination.= "<a onclick=\"loadKeys('".$key."', '".$findType."', '".$sortBy."', '2');\" style=\"cursor:pointer;\">2</a>";				$pagination.= "...";				for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)				{					if ($counter == $page)						$pagination.= "<span class=\"current\">$counter</span>";					else						$pagination.= "<a onclick=\"loadKeys('".$key."', '".$findType."', '".$sortBy."', '".$counter."');\" style=\"cursor:pointer;\">$counter</a>";									}				$pagination.= "...";				$pagination.= "<a onclick=\"loadKeys('".$key."', '".$findType."', '".$sortBy."', '".$lpm1."');\" style=\"cursor:pointer;\">$lpm1</a>";				$pagination.= "<a onclick=\"loadKeys('".$key."', '".$findType."', '".$sortBy."', '".$lastpage."');\" style=\"cursor:pointer;\">$lastpage</a>";					}			else			{				$pagination.= "<a onclick=\"loadKeys('".$key."', '".$findType."', '".$sortBy."', '1');\" style=\"cursor:pointer;\">1</a>";				$pagination.= "<a onclick=\"loadKeys('".$key."', '".$findType."', '".$sortBy."', '2');\" style=\"cursor:pointer;\">2</a>";				$pagination.= "...";				for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)				{					if ($counter == $page)						$pagination.= "<span class=\"current\">$counter</span>";					else						$pagination.= "<a onclick=\"loadKeys('".$key."', '".$findType."', '".$sortBy."', '".$counter."');\" style=\"cursor:pointer;\">$counter</a>";				}			}		}		if ($page < $counter - 1) 			$pagination.= "<a onclick=\"loadKeys('".$key."', '".$findType."', '".$sortBy."', '".$next."');\" style=\"cursor:pointer;\">></a>";		else			$pagination.= "<span class=\"disabled\">></span>";		$pagination.= "</div>\n";	}	while ($row = mysql_fetch_assoc($result)) { 	$website = new Website();	$website->domain = $row[domain];	$website->keyword = $row[keyword];	$website->worth = $row[worth];	$website->pagerank = $row[pagerank];	$website->title = $row[title];	$website->description = $row[description];	if ($row[age] != 'Unknown') {		list($website->years, $bebebe1, $website->days, $bebebe2) = explode(" ", $row[age]);		$website->age = $row[age];		$website->daysCount = ($website->years * 365) + $website->days;	}	$arr[] = $website;};	if ($sortBy == 'worth' && count($arr) > 0) {		uasort($arr,"worthSort");		$sortStr = $sortWorth;	}	if ($sortBy == 'age' && count($arr) > 0) {		uasort($arr,"ageSort");		$sortStr = $sortAge;	}	if ($sortBy == 'pr' && count($arr) > 0) {		uasort($arr,"prSort");		$sortStr = $sortPr;	}	if ($sortBy == 'title' && count($arr) > 0) {		uasort($arr,"titleSort");		$sortStr = $sortTitle;	}	if ($sortBy == 'domain' && count($arr) > 0) {		uasort($arr,"domainSort");		$sortStr = $sortDomain;	}	$out = "<br>".$srfor." <b>".$key."</b>  ".$findStr.$sortStr."<br>		<br><table style=\"float:left;\"><translate><td>".$pagination."</td></translate><translate><td>&nbsp;</td></translate>";	if (count($arr) > 0) {	foreach($arr as $site) {		$domainKeys = $site->keyword;		$testCommas = array_map('trim',explode(",",$domainKeys));		$testSpaces = array_map('trim',explode(" ",$domainKeys));		$splitted = (count($testCommas) <= 1 ? $testSpaces : $testCommas);		if ($site->years) {			$siteAge = $site->years." ".endings($site->years, $ageYears1, $ageYears2, $ageYears5)." ".$site->days." ".endings($site->days, $ageDays1, $ageDays2, $ageDays5);		} else {			$siteAge = $ageNot;		}		 $worth=$site->worth;		 $worthInt = intval($worth);		 $worthInt = $worthInt * 3;		 if ($worthInt == 0) {		 	$worthInt = 100;		 }		$out .= "<translate><td><a href=\"go.php?to=http://".$site->domain."\" target=\"_blank\">			 <img height=\"90\" style=\"border:solid 1px gray; float:left; margin-right:10px;\" width=\"120\" src=\"http://open.thumbshots.org/image.pxf?url=".$site->domain."\" title=\"".$site->domain."\" alt=\"".$site->domain."\"></a>		         <font style=\"font-family: georgia, serif; font-size:11pt;\">			 <b><a href=\"www.".$site->domain."\">".$site->domain."</a></b>			 </font>&nbsp;&nbsp;&nbsp;&nbsp;<img src=\"pr".$site->pagerank.".gif\" style=\"margin-bottom:-4px;\">&nbsp;&nbsp;&nbsp;&nbsp;			<font style=\"font-family: georgia, serif; font-size:9pt;\">			<i>".$siteAge."</i>&nbsp;&nbsp;&nbsp;&nbsp;			<i>$".number_format($worthInt, 0, ',', ',')."</i>			</font>			<br>		         <font style=\"font-family: georgia, serif; font-size:10pt;\">			 <b>".$site->title."</b>			 </font>			 <br>		         <font style=\"font-family: georgia, serif; font-size:10pt;\">			 ".$site->description."			 </font><br>";		$sCount = 1;		foreach($splitted as $key) {			if ($sCount % 12 == 0) {				$out .= "<br>";			} else {				$out .= "<a style=\"text-decoration:none; color:green; cursor:pointer;background-color:#EDF8FC;font-family: georgia, serif; font-size:11pt;\" onclick=\"loadKeys('".$key."', 'keyword', '', '1')\">".$key."</a>&nbsp;&nbsp;&nbsp;";			}			$sCount++;		}		$out .= "</td></translate><translate><td>&nbsp</td></translate>";	}	}	$out .= "<translate><td>".$pagination."</td></translate></table>";unset($arr);mysql_close($con);echo $out;?>