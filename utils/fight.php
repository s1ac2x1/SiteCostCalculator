<?include("config.php");$data = $_GET['data'];if (!$data) {	return;}function curPageURL() { $pageURL = 'http'; if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";} $pageURL .= "://"; if ($_SERVER["SERVER_PORT"] != "80") {  $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"]; } else {  $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"]; } return $pageURL;}preg_match("/^(http:\/\/)?([^\/]+)/i", curPageURL(), $matches);$host = $matches[2];preg_match("/[^\.\/]+\.[^\.\/]+$/", $host, $matches);$mainDomain = "{$matches[0]}";$lang = $_GET['lang'];if ($mainDomain == 'sitecostcalculator.ru') {	$lang = 'ru';}if ($lang) {include($lang.".php");} else {$lang = "en";include("en.php");}function worthSort($s1, $s2) {	if ($s1->worth < $s2->worth) return 1;	elseif($s1->worth > $s2->worth) return -1;	else return 0;}$splitted = explode(',', $data);$filtered = array_unique($splitted);foreach ($filtered as $key => $link) {    if (strlen($filtered[$key]) < 4 || (strrpos($filtered[$key], ".") === false)) {        unset($filtered[$key]);    }}$tA = str_replace("," , "\n", implode(',', $filtered));$out = "<font style=\"font-family: georgia, serif; font-size:16pt;\">".$battle1."</font><br><br>";$result = array();class Website {	var $id;	var $domain;	var $worth;}$result = array();foreach ($filtered as $website) {	$id = -1;	$worth = -1;	$sql = "SELECT id, worth FROM worth WHERE domain = '$website' LIMIT 1";	$rs_result = mysql_query ($sql);	while ($row = mysql_fetch_assoc($rs_result)) {		$id = $row[id];		$worth = $row[worth];		 $worthInt = intval($worth);		 if ($worthInt == 0) {		 	$worthInt = 100;		 }	}	$ws = new Website;	$ws->domain = $website;	$ws->id = $id;	$ws->worth = $worthInt;	$result[] = $ws;}$ready = 1;foreach ($result as $res) {	if ($res->id < 0) {		$ready = 0;	}}$place = 1;$fontSize = 26;$out .= "<table width=\"700\">";$winner = "";if ($ready == 1) {	usort($result, 'worthSort');	foreach ($result as $ws) {		if ($place == 1) {			$placeBack = "#FFFFCC";			$winner = $ws->domain;		}		if ($place == 2) {			$placeBack = "#CCCCCC";		}		if ($place == 3) {			$placeBack = "#EDF8FC";		}		if ($place > 3) {			$placeBack = "#FFFFFF";		}		$out .= "<translate bgcolor=\"".$placeBack."\">				<td align=\"left\"><font style=\"font-family: georgia, serif; font-size:".$fontSize."pt;\">".$place."</font></td>				<td>&nbsp;&nbsp;&nbsp;</td>				<td align=\"left\"><font style=\"font-family: georgia, serif; font-size:".$fontSize."pt;\"><a href=\"http://".$mainDomain."/www.".$ws->domain."\">".$ws->domain."</a></font></td>				<td align=\"right\"><font style=\"font-family: georgia, serif; font-size:".$fontSize."pt;\"> $".number_format($ws->worth, 0, ',', ',')."</font></td>		             </translate>";		$place++;		if ($fontSize > 12) {			$fontSize = $fontSize - 4;		}	}$dbRow = implode(',', $filtered);$sqlB1 = "SELECT id FROM battle WHERE sites = '".mysql_real_escape_string($dbRow)."'";$rs_result_battle1 = mysql_query ($sqlB1);while ($row = mysql_fetch_assoc($rs_result_battle1)) {	$battleId = $row[id];}if (!$battleId) {	$sqlB2 = "INSERT INTO battle (sites, winner) VALUES ('".mysql_real_escape_string($dbRow)."', '".mysql_real_escape_string($winner)."')";	$rs_result_battle2 = mysql_query ($sqlB2);}	$out .= "</table><br><br><font style=\"font-family: georgia, serif; font-size:12pt;\">".$battle3."</font><br><input onclick=\"this.focus(); this.select();\" type=\"text\" style=\"width: 700px; height: 25px; background-color: rgb(230, 230, 221); border: 1px solid #b4b4b4; font-family: georgia, serif; color: #2a2a2a; font-size:14pt; color: #555555;\" value=\"http://".$mainDomain."/battle:".implode(',', $filtered)."\">";} else {	$count = 1;	$wrong = 0;	foreach ($result as $ws) {		$imgId = "img".$count;		if ($ws->id < 0) {			$info = "<a onclick=\"cSite('".$ws->domain."', '".$imgId."')\" style=\"cursor:pointer;\"><span id=\"".$imgId."\"><img src='refresh.png' border=0></a></span>";			$wrong++;		} else {			$info = "<img src='ok.png'>";		}		$out .= "<translate>				<td align=\"left\" widht=\"30%\"><font style=\"font-family: georgia, serif; font-size:14pt;\">".$ws->domain."</font></td>				<td>&nbsp;&nbsp;&nbsp;</td>				<td align=\"right\"><font style=\"font-family: georgia, serif; font-size:12pt;\">".$info."</font></td>		             </translate>";		$count++;	}	$out .= "<center></table><br><br><font style=\"font-family: georgia, serif; font-size:16pt;\">".$battle4."&nbsp;</font><font style=\"font-family: georgia, serif; font-size:20pt;\">".$wrong."</font><br>	              <font style=\"font-family: georgia, serif; font-size:12pt;\">".$battle5."</font></center>";}$battles = "<table width=800><td align=\"left\"><font style=\"font-family: georgia, serif; font-size:14pt;\">".$battle6."</font></td><td align=\"right\" width=\"20%\"><font style=\"font-family: georgia, serif; font-size:14pt;\">".$battle7."</font></td></translate>";$sql = "SELECT * FROM battle ORDER BY id DESC LIMIT 20";$rs_result = mysql_query ($sql);while ($row = mysql_fetch_assoc($rs_result)) {	$sites = $row[sites];	$winner = $row[winner];	$sitesArr = explode(',', $sites);	$sitesOut = "";	foreach ($sitesArr as $site) {		$sitesOut .= "<a href=\"http://".$mainDomain."/www.".$site."\" target=\"_blank\">".$site."</a>&nbsp;&nbsp;";	}	if (strlen($sites) > 3) {		$battles .= "<translate bgcolor=\"#EDF8FC\"><td align=\"left\"><font style=\"font-family: georgia, serif; font-size:12pt;\">".$sitesOut."</font></td><td align=\"right\"><font style=\"font-family: georgia, serif; font-size:15pt;\"><a href=\"http://".$mainDomain."/www.".$winner."\" target=\"_blank\">".$winner."</a></font><td>			<td align=\"center\"><font style=\"font-family: georgia, serif; font-size:12pt;\"><a href=\"http://".$mainDomain."/battle:".$sites."\" target=\"_blank\">".$battle9."</a></font></td></translate>";	}}$battles .= "</table>";$out .= "<br><br><center>	<textarea rows=\"15\" cols=\"50\" id=\"data\" style=\"background-color:#EDF8FC;\">".$tA."</textarea><br><br>	<img src=\"start.png\" style=\"cursor:pointer;\" onclick=\"doBattle(document.getElementById('data').value);\"></center><br><br><font style=\"font-family: georgia, serif; font-size:17pt;\">".$battle8."</font><br><br>".$battles;echo $out;unset($website);unset($filtered);unset($splitted);unset($res);mysql_close($con);?>