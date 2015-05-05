
<?php
require_once('../dom/simple_html_dom.php');
$url = 'http://localhost/manoj/SeoCentro-RankChecker.html';


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
//echo $key2->plaintext.'<br>';
          			
          			if($key2->plaintext == 'Search&nbsp;Engine'){
          				//echo "in";
          				$main_res[0] = $key2->parent()->parent();
          				$main_res[1] = $main_res[0]->next_sibling();
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
echo "<h1>Main Results<h1><table><tr><td>".$main_res[0].'</td><td>'
     .$main_res[1].'</td></tr></table><br>'
     ."<h1>Google Result<h1><table><tr><td>".$google_res[0].'</td></tr><tr><td>'.$google_res[1].'</td></tr><tr><td>'.$google_res[2].'</td></tr><tr><td>'.$google_res[3].'</td></tr><tr><td>'.$google_res[4].'</td></tr><tr><td>'.$google_res[5].'</td></tr></table>';
