<?phpinclude('config.php');$lang = $_GET['lang'];if ($lang) {include($lang.".php");} else {include("en.php");}function curPageURL() { $pageURL = 'http'; if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";} $pageURL .= "://"; if ($_SERVER["SERVER_PORT"] != "80") {  $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"]; } else {  $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"]; } return $pageURL;}preg_match("/^(http:\/\/)?([^\/]+)/i", curPageURL(), $matches);$host = $matches[2];preg_match("/[^\.\/]+\.[^\.\/]+$/", $host, $matches);$mainDomain = "{$matches[0]}";if ($mainDomain == 'sitecostcalculator.com') {	$mainTitle2 = 'SiteCostCalculator.com';	$mailTo = "support@sitecostcalculator.com";} if ($mainDomain == 'websitepricecalculator.net') {	$mainTitle2 = 'WebsitePriceCalculator.net';	$mailTo = "support@websitepricecalculator.net";} if ($mainDomain == 'websitecostcalculator.com') {	$mainTitle2 = 'WebsiteCostCalculator.com';	$mailTo = "support@websitecostcalculator.com";} if ($mainDomain == 'websitetrafficcalculator.com') {	$mainTitle2 = 'WebsiteTrafficCalculator.com';	$mailTo = "support@websitetrafficcalculator.com";} if ($mainDomain == 'websiteworthcalculator.net') {	$mainTitle2 = 'WebsiteWorthCalculator.net';	$mailTo = "support@websiteworthcalculator.net";}if ($mainDomain == 'websitecost.info') {	$mainTitle2 = 'WebsiteCost.info';	$mailTo = "support@websitecost.info";}if ($mainDomain == 'costofwebsite.net') {	$mainTitle2 = 'costofwebsite.net';	$mailTo = "support@websitecost.info";}if ($mainDomain == 'sitecostcalculator.ru') {	$mainTitle2 = 'SiteCostCalculator.ru';}	$domain = $_GET['domain'];$sql = "SELECT pagerank FROM worth WHERE domain = '$domain' LIMIT 1";$rs_result = mysql_query ($sql);while ($row = mysql_fetch_assoc($rs_result)) {		 $pagerank=$row[pagerank];}$query = "SELECT domain, pagerank FROM worth WHERE pagerank = '$pagerank' ORDER BY id LIMIT 64";$result = mysql_query ($query);while ($row = mysql_fetch_assoc($result)) {	$domain = $row[domain];	$pagerank = $row[pagerank];	if (!is_numeric($pagerank)) {		$pagerank = 0;	}$res = $res."<div class=\"panel\"><center>			   <font color=\"green\"><b>".$domain."</b></font>			   <a style=\"cursor:pointer;\" onclick=\"parent.window.location = 'http://".$mainTitle2."/www.".$domain."'\">			   <br><img height=\"90\" style=\"border:solid 1px gray;\" width=\"120\" src=\"http://open.thumbshots.org/image.pxf?url=".$domain."\" title=\"".$domain."\" alt=\"".$domain."\"></a><br>			   <font style=\"font-size:10pt;\">PR ".$pagerank."</font></centers></div>";}mysql_close($con);?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-us"><!--Make sure page contains valid doctype at the very top!--><script type="text/javascript" src="../js/jquery.min.js"></script><script type="text/javascript" src="../js/stepcarousel.js">/************************************************ Step Carousel Viewer script- (c) Dynamic Drive DHTML code library (www.dynamicdrive.com)* Visit http://www.dynamicDrive.com for hundreds of DHTML scripts* This notice must stay intact for legal use***********************************************/</script><style type="text/css">.stepcarousel{position: relative; /*leave this value alone*/overflow: scroll; /*leave this value alone*/width: 1100px; /*Width of Carousel Viewer itself*/height: 170px; /*Height should enough to fit largest content's height*/}.stepcarousel .belt{position: absolute; /*leave this value alone*/left: 0;top: 0;}.stepcarousel .panel{float: left; /*leave this value alone*/overflow: hidden; /*clip content that go outside dimensions of holding panel DIV*/margin: 15px; /*margin around each panel*/width: 120px; /*Width of each panel holding each content. If removed, widths should be individually defined on each content DIV then. */border:solid 1px gray;}</style><script type="text/javascript">stepcarousel.setup({	galleryid: 'mygallery', //id of carousel DIV	beltclass: 'belt', //class of inner "belt" DIV containing all the panel DIVs	panelclass: 'panel', //class of panel DIVs each holding content	panelbehavior: {speed:500, wraparound:false, wrapbehavior:'slide', persist:true},	defaultbuttons: {enable: true, moveby: 7, leftnav: ['leftnav.gif', -15, 65], rightnav: ['rightnav.gif', 0, 65]},	statusvars: ['statusA', 'statusB', 'statusC'], //register 3 variables that contain current panel (start), current panel (last), and total panels	contenttype: ['inline'] //content setting ['inline'] or ['ajax', 'path_to_external_file']})</script><head><body><div style="text-align: center;"><span style="font-weight: bold;"><? echo $list2; ?></span><div id="mygallery" class="stepcarousel">	<div class="belt">		<? echo $res; ?>	</div></div></div></body></html>