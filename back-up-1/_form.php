<?php
if(isset($_REQUEST['keyword'])){
$keyword = $_REQUEST['keyword'];
}
else{
	echo "please enter Keyword";
}
if($_REQUEST['website']){
	$website = $_REQUEST['website'];
}
else{
	$website = 'www.flaberry.com';
}

if(isset($_REQUEST['competitor'])){
$competitor = $_REQUEST['competitor'];
}
else{
	$_REQUEST['competitor']="";
}

$captcha = '7331';
echo 
"<form id='myform' action='http://www.seocentro.com/tools/search-engines/keyword-position.html' method='POST'>
<input type='text' name='q' id='q' size='32' maxlength='255' value=".$keyword."> Keyword<br><br>
<input type='text' name='d' size='32' maxlength='255' value=".$website."> Domain (www.example.com)<br>
<input type='text' name='d2' size='32' maxlength='255' value=".$competitor."> Competitor Domain (optional)<br><br>
<img src='http://www.seocentro.com/cgi-bin/key/imageIM.pl?7%3D%02%EB%5B%D3%5D%20%0A%94%83%AF%F1%85' alt='' border='0'><input type='hidden' name='dkey' value='2380dfa18da60a84789dc9099ea76ba9'><br>
<input type='text' name='rkey' size='8' maxlength='5' value=".$captcha."> Access code<br>
<input type='submit' value='Submit'>
</form>";
?>
<script type="text/javascript" src="../../scripts/jquery.min.js"></script>
<script type='text/javascript'>
$(document).ready(function(){
	$('#myform').submit();
})
</script>";

