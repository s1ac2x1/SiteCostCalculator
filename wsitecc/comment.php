<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>
<?php
require "translate.php";
$lang = $_GET['lang'];

$says = "says";
$rating = "Rating";
$votesCast = "votes";
$addComment = "Add comment";
$newComment = "New comment";
$name = "Your name";
$email = "Email";
$comment = "Comment";

$tr = new Google_Translate_API;

	$says_ = $tr->translate($says, 'en', $lang);
	$rating_ = $tr->translate($rating, 'en', $lang);
	$votesCast_ = $tr->translate($votesCast, 'en', $lang);
	$addComment_ = $tr->translate($addComment, 'en', $lang);
	$newComment_ = $tr->translate($newComment, 'en', $lang);
	$name_ = $tr->translate($name, 'en', $lang);
	$email_ = $tr->translate($email, 'en', $lang);
	$comment_ = $tr->translate($comment, 'en', $lang);


if ($says_) {
	$says  = $says_;
}
if ($rating_) {
	$rating  = $rating_;
}
if ($votesCast_) {
	$votesCast  = $votesCast_;
}
if ($addComment_) {
	$addComment  = $addComment_;
}
if ($newComment_) {
	$newComment  = $newComment_;
}
if ($name_) {
	$name  = $name_;
}
if ($email_) {
	$email  = $email_;
}
if ($comment_) {
	$comment  = $comment_;
}

include("config_comment.php");
                      
//$id = $_GET['id'];
$title = '';

$result = mysql_query("SELECT domain FROM worth WHERE id=$id")
or die(mysql_error());  

while($row = mysql_fetch_array( $result )) {
            $title = $row['domain'];
                     
}

//$res = $db->query( 'SELECT domain FROM worth WHERE id=?', array( $id ) );
//while( $res->fetchInto( $row ) ) { $title = $row['id']; }
?>
<script src="prototype.js"></script>
<script>
function rate( value ) {
	new Ajax.Updater( 'rating', 'webrate.php?id=<?php echo($id)?>&url=<?php echo($ip)?>&v='+value );
}
</script>
<link href="style.css" rel="stylesheet" type="text/css">
<div id="rating">

<?php
 $result = mysql_query("SELECT count( rating ), sum(rating ) FROM ratings WHERE id=$id")
or die(mysql_error());  

while($row = mysql_fetch_array( $result )) {
          @$rate=@$row[1]/@$row[0];
    $vote=$row[0];                 
}
?>
<?php 
if($rate==0) {
		echo '<ul class="rating nostar"> 
	<li class="one"><a href="#" title="1 Star" onClick="rate(1)">1</a></li> 
	<li class="two"><a href="#" title="2 Stars" onClick="rate(2)">2</a></li> 
	<li class="three"><a href="#" title="3 Stars" onClick="rate(3)">3</a></li> 
	<li class="four"><a href="#" title="4 Stars" onClick="rate(4)">4</a></li> 
	<li class="five"><a href="#" title="5 Stars" onClick="rate(5)">5</a></li> 
</ul> 
	';
}
elseif ($rate<=1 or $rate==1) {
	echo '<ul class="rating onestar"> 
	<li class="one"><a href="#" title="1 Star" onClick="rate(1)">1</a></li> 
	<li class="two"><a href="#" title="2 Stars" onClick="rate(2)">2</a></li> 
	<li class="three"><a href="#" title="3 Stars" onClick="rate(3)">3</a></li> 
	<li class="four"><a href="#" title="4 Stars" onClick="rate(4)">4</a></li> 
	<li class="five"><a href="#" title="5 Stars" onClick="rate(5)">5</a></li> 
</ul> 	
	';
} elseif ($rate<=2.5 or $rate==2.5) {
	echo '<ul class="rating twostar"> 
	<li class="one"><a href="#" title="1 Star" onClick="rate(1)">1</a></li> 
	<li class="two"><a href="#" title="2 Stars" onClick="rate(2)">2</a></li> 
	<li class="three"><a href="#" title="3 Stars" onClick="rate(3)">3</a></li> 
	<li class="four"><a href="#" title="4 Stars" onClick="rate(4)">4</a></li> 
	<li class="five"><a href="#" title="5 Stars" onClick="rate(5)">5</a></li> 
</ul> 	
	';
} 
elseif($rate<=3.5 or $rate==3.5) {
	echo '<ul class="rating threestar"> 
	<li class="one"><a href="#" title="1 Star" onClick="rate(1)">1</a></li> 
	<li class="two"><a href="#" title="2 Stars" onClick="rate(2)">2</a></li> 
	<li class="three"><a href="#" title="3 Stars" onClick="rate(3)">3</a></li> 
	<li class="four"><a href="#" title="4 Stars" onClick="rate(4)">4</a></li> 
	<li class="five"><a href="#" title="5 Stars" onClick="rate(5)">5</a></li> 
</ul> 
	';
} 
elseif($rate<=4.5 or $rate==4.5) {
	echo '<ul class="rating fourstar"> 
	<li class="one"><a href="#" title="1 Star" onClick="rate(1)">1</a></li> 
	<li class="two"><a href="#" title="2 Stars" onClick="rate(2)">2</a></li> 
	<li class="three"><a href="#" title="3 Stars" onClick="rate(3)">3</a></li> 
	<li class="four"><a href="#" title="4 Stars" onClick="rate(4)">4</a></li> 
	<li class="five"><a href="#" title="5 Stars" onClick="rate(5)">5</a></li> 
</ul> 	
	';
} 
elseif($rate<=5) {
	echo '<ul class="rating fivestar"> 
	<li class="one"><a href="#" title="1 Star" onClick="rate(1)">1</a></li> 
	<li class="two"><a href="#" title="2 Stars" onClick="rate(2)">2</a></li> 
	<li class="three"><a href="#" title="3 Stars" onClick="rate(3)">3</a></li> 
	<li class="four"><a href="#" title="4 Stars" onClick="rate(4)">4</a></li> 
	<li class="five"><a href="#" title="5 Stars" onClick="rate(5)">5</a></li> 
</ul> 
	';
} 
?>
<? echo $rating; ?>: <strong><?php echo(@round($rate,2)); ?></strong> (<strong><?php echo(@$vote); ?></strong> <? echo $votesCast; ?>)
</div>
<div id="comments">
<?php
 $result = mysql_query("SELECT * FROM comments WHERE id=$id")
or die(mysql_error());  

while($row = mysql_fetch_array( $result )) {
                        ?>
                        
<? $dateStr = $tr->translate('Date:', 'en', $lang); ?>

<div class="roundedcornr_box_327512">
   <div class="roundedcornr_top_327512"><div></div></div>
      <div class="roundedcornr_content_327512">
         <h2><?php echo $row['name']." ".$says; ?> :</h2>
         		<blockquote>
		  <p><?php echo($row['comment']) ?></p>
	    </blockquote>
         <p align="right"><?php echo($tr->translate($row['time'], 'en', $lang)) ?></p>
      </div>
   <div class="roundedcornr_bottom_327512"><div></div></div>
</div>
<br>
<?php
}
?>
</div>

<div style="margin-top:20px;"><b><? echo $newComment; ?></b><br></div>

<form id="cform">
<input type="hidden" name="id" value="<?php echo($id)?>">
<input type="hidden" name="url" value="<?php echo($ip)?>">
<input type="hidden" name="lang" value="<?php echo($lang)?>">
<table>
<tr><td><? echo $name; ?>:</td><td><input type="text" name="name" size="60"></td></tr>
<tr><td><? echo $email; ?>:</td><td><input type="text" name="email" size="60"></td></tr>
<tr><td></td><td><textarea name="comment" id="comment_text" cols="50" rows="10"></textarea></td></tr>
</table>
</form>
<button onClick="addcomment()"><? echo $addComment; ?></button>

<script>
function addcomment()
{
  new Ajax.Updater( 'comments', 'addcomment.php',
	{
		method: 'post',
		parameters: $('cform').serialize(),
		onSuccess: function() {
			$('comment_text').value = '';
		}
	} );
}
</script>
</body>
<html>