<?php                 if ($ip) {// Ip Finder               //echo $cc; //debug only     //    $echolater .= "<p><table cellpadding=2 class=main><translate><td class=main>";     //echo "wwwt".$ip;        Debugmysql_close($con);//include ("main_lib_update.php");include ("config.php");include ("api/thumb.php");     $result = mysql_query("SELECT * FROM worth WHERE domain = '$ip'");while($row=mysql_fetch_array($result)){ $ipr=$row["domain"];//echo "$id $ipr $alexa2 $backlink3 $ip2 $pagerank1 $networth $dailypageview $dailyadsearn $country1"; // debug only//$echolater .= "Load Time: $totaltime seconds.</table><br>";    $goog_bak = number_format($row["google_back"]);$yaho_bak = number_format($row["yahoo_back"]);$altavi_bak =number_format($row["altavista_back"]);$alldweb_bak = number_format($row["alltheweb_back"]);if ($goog_bak == "") {    $goog_bak = "0";}if ($yaho_bak == "") {    $yaho_bak = "0";}if ($altavi_bak == "") {    $altavi_bak = "0";}if ($alldweb_bak == "") {    $alldweb_bak = "0";}//$echolater .= "<table width=1000px border=0 cellspacing=0 cellpadding=0> <translate> <td <td width=50%>";//echo $ip2;//echo $found; //echo '</table>';   //echo $tags['author'];       // name$keyword= $row['keyword'];     // php documentation          //       echo "wwww".$row["title"];     /*  $tags = @ get_meta_tags("http://".$ipr);    //   echo $tags;  //Debug Only    //or die("Could not fetch meta tags for $url2");    if ($tags == "") {$echolater .= "";    $echolater .= "";            $echolater .= "";    }else{                   foreach ($tags as $key=>$value) {                   $echolater .= "$key $value"; }     }*/    $description= $row['description'];  // a php manual$webtitle=$row["title"];       $webshot='<img src="http://images.websnapr.com/?size='.$size.'&key=' . $api . '&url='.$ipr.'" alt="' . $ipr . '" />';if ($webtitile == "blocked" or $description == "blocked" or $keyword=="blocked") {	$web_thumb ='Blocked';	} else {	$web_thumb =$webshot;    // php documentation}if ($keyword=="blocked") {	$web_thumb ='Blocked';	} else {	$web_thumb =$webshot;    // php documentation}if ($description == "blocked") {	$web_thumb ='Blocked';	} else {	$web_thumb =$webshot;    // php documentation}      	   if ($keyword == "") {		   $keyword ="-= Keyword Not Found =-";	   }	   	   if ($description == "") {		   $description ="-= Description Not Found =-";	   }	   	   if ($webtitle == "") {		   $webtitle ="-= Title Not Found =-";	   }     $webworth1=$row["worth"] * $c_value;    if ($c_symbol_placement==1) {              $webworth = number_format($webworth1) . $c_symbol;   } else {           $webworth = $c_symbol . number_format($webworth1);   }     if ($webworth == "0") {    $webworth = "10 Din";}      $dmoz=$row["dmoz"];$yahoolist=$row["yahoodir"];            $alexarank=number_format($row["alexa"]);            $dailyearn2=$row["dearn"] * $c_value;                if ($c_symbol_placement==1) {              $dailyearn = number_format($dailyearn2) . $c_symbol;   } else {           $dailyearn = $c_symbol . number_format($dailyearn2);   }              $dpviews=number_format($row["dpview"]);            $pagerank=$row["pagerank"];          $inbound=$row["inbound"];      $outbound=$row["outbound"];      //  $backlink=$goog_bak;     $alexaimg='<img src="http://traffic.alexa.com/graph?c=1&amp;u=' . $ipr . '&amp;r=6m&amp;y=r&amp;z=3&amp;h=150&amp;w=250&amp;b=FFFFFF" alt="' . $ipr . '" />';     $compete='<img src="http://home.compete.com.edgesuite.net/' . $ipr . '_uv_310.png" width="250" height="150" alt="' . $ipr . '" />';                 $ipaddress=$row["ip"];            $country=$row["country"];         $age=$row["age"];           $websiteinback='<a href="http://web.archive.org/web/*/' . $ipr . '" target="_blank">Website Look Like in Past</a>';         $loadtime=$row["loadtime"];            // echo $row["country"];                              require('template.php');      }  } ?>