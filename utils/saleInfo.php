﻿<?$domain = $_GET['domain'];include("config.php");$sql = "SELECT worth, sccCost FROM worth WHERE domain = '$domain' LIMIT 1";$result = mysql_query ($sql);while ($row = mysql_fetch_assoc($result)) {	$worth = $row[worth];	$cost = $row[sccCost];}function curPageURL() { $pageURL = 'http'; if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";} $pageURL .= "://"; if ($_SERVER["SERVER_PORT"] != "80") {  $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"]; } else {  $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"]; } return $pageURL;}preg_match("/^(http:\/\/)?([^\/]+)/i", curPageURL(), $matches);$host = $matches[2];preg_match("/[^\.\/]+\.[^\.\/]+$/", $host, $matches);$mainDomain = "{$matches[0]}";$newRu = str_replace ($mainDomain, "sitecostcalculator.ru", curPageURL());$newEn = str_replace ($mainDomain, "sitecostcalculator.com", curPageURL());$mainTitle1 = "";$mainTitle2 = "";if ($mainDomain == 'sitecostcalculator.com') {	$mainTitle1 = 'Site Cost Calculator';	$mainTitle1_ = 'Site Cost Calculator v2.0';	$mainTitle2 = 'SiteCostCalculator.com';	$customKey = 'site cost calculator';	$homePage = "http://sitecostcalculator.com";	$logo = "<div id=\"logo\"><a href=\"".$homePage."\"><font style=\"font-family: georgia, serif; font-size:24pt;\">".$mainTitle1_."</font></a><br></div>";} if ($mainDomain == 'websitepricecalculator.net') {	$mainTitle1 = 'Website Price Calculator';	$mainTitle2 = 'WebsitePriceCalculator.net';	$customKey = 'website price calculator';	$homePage = "http://websitepricecalculator.net";	$logo = "<div id=\"logo\"><a href=\"".$homePage."\"><font style=\"font-family: georgia, serif; font-size:24pt;\">".$mainTitle1."</font></a><br></div>";} if ($mainDomain == 'websitecostcalculator.com') {	$mainTitle1 = 'Website Cost Calculator';	$mainTitle2 = 'WebsiteCostCalculator.com';	$customKey = 'website cost calculator';	$homePage = "http://websitecostcalculator.com";	$logo = "<div id=\"logo\"><a href=\"".$homePage."\"><font style=\"font-family: georgia, serif; font-size:24pt;\">".$mainTitle1."</font></a><br></div>";} if ($mainDomain == 'websitetrafficcalculator.com') {	$mainTitle1 = 'Website Traffic Calculator';	$mainTitle2 = 'WebsiteTrafficCalculator.com';	$customKey = 'website traffic calculator';	$homePage = "http://websitetrafficcalculator.com";	$logo = "<div id=\"logo\"><a href=\"".$homePage."\"><font style=\"font-family: georgia, serif; font-size:24pt;\">".$mainTitle1."</font></a><br></div>";} if ($mainDomain == 'websiteworthcalculator.net') {	$mainTitle1 = 'Website Worth Calculator';	$mainTitle2 = 'WebsiteWorthCalculator.net';	$customKey = 'website worth calculator';	$homePage = "http://websiteworthcalculator.net";	$logo = "<div id=\"logo\"><a href=\"".$homePage."\"><font style=\"font-family: georgia, serif; font-size:24pt;\">".$mainTitle1."</font></a><br></div>";} if ($mainDomain == 'websitecost.info') {	$mainTitle1 = 'Website Cost';	$mainTitle2 = 'WebsiteCost.net';	$customKey = 'website cost';	$homePage = "http://websitecost.info";	$logo = "<div id=\"logo\"><a href=\"".$homePage."\"><font style=\"font-family: georgia, serif; font-size:24pt;\">".$mainTitle1."</font></a><br></div>";}if ($mainDomain == 'costofwebsite.net') {	$mainTitle1 = 'Cost Of Website';	$mainTitle2 = 'CostOfWebsite.net';	$customKey = 'cost of website';	$homePage = "http://costofwebsite.net";	$logo = "<div id=\"logo\"><a href=\"".$homePage."\"><font style=\"font-family: georgia, serif; font-size:24pt;\">".$mainTitle1."</font></a><br><br></div>";}if ($mainDomain == 'sitecostcalculator.ru') {	$mainTitle1 = 'Калькулятор стоимости сайта';	$mainTitle2 = 'SiteCostCalculator.ru';	$customKey = 'калькулятор стоимости сайта, сколько стоит мой сайт, цена сайта';	$homePage = "http://sitecostcalculator.ru";	$logo = "<div id=\"logo\"><a href=\"".$homePage."\"><font style=\"font-family: georgia, serif; font-size:24pt;\">".$mainTitle1."</font></a><br><br></div>";}$lang = $_GET['lang'];if ($mainTitle2 == 'SiteCostCalculator.ru') {	$lang = 'ru';}if ($lang) {include($lang.".php");} else {include("en.php");}$domain = $_GET['domain'];$sql = "SELECT worth, sccCost FROM worth WHERE domain = '$domain' LIMIT 1";$rs_result = mysql_query ($sql);while ($row = mysql_fetch_assoc($rs_result)) {	$w = $row[worth];	$sccCost = $row[sccCost];	$worthInt = intval($w);	if ($worthInt == 0) {	 	$worthInt = 100;	}}	$customTitle =  $n100." ".$mainTitle2.": ";	$customTitle2 = $n101;mysql_close($con);$title= $domain." ".$saleTitle_." $".number_format($sccCost, 0, ',', ',')."; ".$saleTitle2_." $".number_format($worthInt, 0, ',', ',');$keys = $domain." ".$saleTitle_2.", ".$domain." ".$saleKeys1.", ".$saleKeys2." ".$domain;echo "<b>".$saleKeys3.":</b> ".$title."<br><b>".$saleKeys4.":</b> ".$keys;?>