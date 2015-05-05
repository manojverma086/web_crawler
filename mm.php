
<?php
require_once('../dom/simple_html_dom.php');
include('connection.php');

$url = 'http://localhost/manoj/SeoCentro-RankChecker.html';

$keyword = 'flaberry';
//url-ify the data for the POST
//open connection
$ch = curl_init();

//set the url, number of POST vars, POST data
curl_setopt($ch,CURLOPT_URL, $url);
 curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

//execute post
$result = curl_exec($ch);
//echo file_get_html($result)->plaintext;
//close connection
curl_close($ch);

//change data to html
$html = str_get_html($result);
//echo $html;
//exit();
$main_res =  array();
$google_res = array();

   foreach($html->find('table td[class=contentTDMain]') as $element) {
   //count for restrict for loop till our requirement
   	$count=0;
          foreach ($element->find('table') as $element2) {
          	if($count >3){
          		break;
          	}
          	else{ 
          		$count++;
          		$j=1;
          	foreach ($element2->find('tr') as $element3) {
          		# code...
					          	
          		foreach ($element3->find('td') as $element4) {
          			# code...
          			$key1 = $element4;
          			foreach ($key1->find('small') as $key2) {
          				# code...
          			
          			if($key2->plaintext == 'Search&nbsp;Engine'){
          				//echo "in";
          				//echo $key2;
          				$main_res[0] = $key2->parent()->parent();
          				$main_res[1] = $main_res[0]->next_sibling();
          				//echo $k."kkkk";
          				$main_res[2] = $main_res[1]->innertext;

          				//echo $mr;
          				// $main_res[0] ='Google';
          				// $main_res[1] = $element4->next_sibling();
          				// $main_res[2] = $main_res[1]->next_sibling();
          				// $main_res[3] = $main_res[2]->next_sibling();
          			}
          		}
          			$g_key1 = $element4;
          			foreach($g_key1->find('big') as $g_key2){
          				if($g_key2->plaintext == 'Google Result'){
          			 	$google_res[0] =  $g_key2->parent()->parent()->next_sibling();
          			 	$google_res[1] = $google_res[0]->next_sibling();
          			 	$google_res[2] = $google_res[1]->next_sibling();
          			 	$google_res[3] = $google_res[2]->next_sibling();
          			 	$google_res[4] = $google_res[3]->next_sibling();
          			 	$google_res[5] = $google_res[4]->next_sibling();
          				}
          			}
          		}
          	}
        	}
    	}
	}

	// foreach ($google_res[1] as $key) {
	// 	# code...
	// 	echo $key->plaintext;
	// }
// echo "<h1>Main Results</h1><table><tr><td>".$main_res[0].'</td><td>'
//      .$main_res[1].'</td></tr></table><br>'
//      ."<h1>Google Result<h1><table><tr><td>".$google_res[0].'</td></tr><tr><td>'.$google_res[1].'</td></tr><tr><td>'.$google_res[2].'</td></tr><tr><td>'.$google_res[3].'</td></tr><tr><td>'.$google_res[4].'</td></tr><tr><td>'.$google_res[5].'</td></tr></table>';
$i =0;
$temp = array();
$temp1 = array();

foreach ($main_res[1]->find('td') as $key) {
	# code...
	$temp[$i++] = $key->plaintext;
}

//Main Result Data.......................................

$placed = str_replace('&nbsp;', '',$temp[1]);
$rank = str_replace('&nbsp;', '',$temp[2]);
$found_url = str_replace('&nbsp;', '',$temp[3]);

//.......................................................

$i=0;

$serial = array();
$comp = array();
$title = array();
$domain = array();
$url = array();


for($i=1; $i<=5; $i++){
	$j = 0;
foreach ($google_res[$i]->find('td') as $key) {
	# code...
	$temp1[$j++] = $key->plaintext;
}

//Google Result Data..............................................

$temp_str1 = str_replace('&nbsp;', '',$temp1[0]);
$serial[$i] = trim($temp_str1, ' ');

$temp_str2 = str_replace('&nbsp;', '',$temp1[1]);
$comp[$i] = trim($temp_str2, ' ');

$temp_str3 = str_replace('&nbsp;', '',$temp1[2]);
$title[$i] = trim($temp_str3, ' ');

$temp_str4 = str_replace('&nbsp;', '',$temp1[3]);
$domain[$i] = trim($temp_str4, ' ');

$temp_str5 = str_replace('&nbsp;', '',$temp1[4]);
$url[$i] = trim($temp_str5, ' ');
}

//.................................................................

// var_dump($serial);
// echo "<br>";
// var_dump($comp);
// echo "<br>";
// var_dump($title);
// echo "<br>";
// var_dump($domain);
// echo "<br>";
// var_dump($url);

// $sql = "SELECT keyword from crawl_data";
// $avail_flag = 0;
// if(mysql_query($sql)){
// 	$result = mysql_query($sql);
// 	$res = mysql_fetch_array($result);
// 	var
// 		echo $res1['keyword'];
// 		if($keyword == $res1['keyword']){
// 			$avail_flag = 1;
// 		}
	
// }

	$sql = "UPDATE crawl_data set placed = '$placed', rank = '$rank', found_url = '$found_url',
	comp1 = '$comp[1]', title1 = '$title[1]', domain1 = '$domain[1]', url1 = '$url[1]',
	comp2 = '$comp[2]', title2 = '$title[2]', domain2 = '$domain[2]', url2 = '$url[2]',
	comp3 = '$comp[3]', title3 = '$title[3]', domain3 = '$domain[3]', url3 = '$url[3]',
	comp4 = '$comp[4]', title4 = '$title[4]', domain4 = '$domain[4]', url4 = '$url[4]',
	comp5 = '$comp[5]', title5 = '$title[5]', domain5 = '$domain[5]', url5 = '$url[5]' where keyword = '$keyword'";

// else{
// 	$sql = "INSERT INTO crawl_data values('', '$keyword', '$placed','$rank','$found_url',
// 		'$comp[1]','$title[1]','$domain[1]', '$url[1]',
// 		'$comp[2]','$title[2]','$domain[2]', '$url[2]',
// 		'$comp[3]','$title[3]','$domain[3]', '$url[3]',
// 		'$comp[4]','$title[4]','$domain[4]', '$url[4]',
// 		'$comp[5]','$title[5]','$domain[5]', '$url[5]')";
// }
if(mysql_query($sql)){
	echo "Success";
}
else{
	echo mysql_error();
}

