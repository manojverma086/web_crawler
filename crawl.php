<?php
require_once('../dom/simple_html_dom.php');
include('connection.php');




 $sql = "SELECT * FROM `crawl_data` WHERE `comp1` = ''";

 $result = mysql_query($sql);
 $rows = mysql_num_rows($result);
 $keyword_arr = array();


// // $keyword_json = json_encode($keyword_arr);
// //file_put_contents('keyword.json', $keyword_json);

// // for($i=0; $i < $rows; $i++)
// // {
// //   $res = mysql_fetch_array($result);
// //   $keyword_arr[$i] = $res['keyword'];
// // }

if($rows > 0){
   while($res = mysql_fetch_array($result)){
     $keyword_arr[] = $res['keyword'];
     getData($res['keyword']);
   }
 }

// exit();

// //for loop for all data............

// for($i=0; $i<$rows; $i++)
// {
//  $keyword = $keyword_arr[$i];
//  getData($keyword);
// }
//$keyword = 'send flowers to bangalore'; 
//getData($keyword);





function getData($keyword){

  //echo $keyword;
  //exit();
//$keyword = 'send flower to pune';
$url = 'http://www.seocentro.com/tools/search-engines/keyword-position.html';


$fields = array(
            'q'=>$keyword,
            'd'=>'www.flaberry.com',
            'd2'=>'',
            'dkey'=>'56361255715e3e710ed1b1a808d680d4',
            'rkey'=>'2767',
            'Submit'=>'submit'
        );

//url-ify the data for the POST
foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
rtrim($fields_string, '&');

//open connection
$ch = curl_init();
//$proxy = "119.6.144.74:82";
//set the url, number of POST vars, POST data
curl_setopt($ch,CURLOPT_URL, $url);
//curl_setopt($ch, CURLOPT_PROXY, $proxy);
//curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
//curl_setopt($ch, CURLOPT_HEADER, 1);
curl_setopt($ch,CURLOPT_POST, count($fields));
curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//execute post
$result = curl_exec($ch);
//echo $result;
//close connection
curl_close($ch);


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
                if($key2->plaintext == 'Search&nbsp;Engine'){
                  $main_res[0] = $key2->parent()->parent();
                  $main_res[1] = $main_res[0]->next_sibling();
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

//show data as html..................

echo "Searched Keyword - ".$keyword."<br><br><big>Main Results </big><table><tr><td>".$main_res[0].'</td><td>'
     .$main_res[1].'</td></tr></table><br>'
     ."<big>Google Result </big><table><tr><td>".$google_res[0].'</td></tr><tr><td>'.$google_res[1].'</td></tr><tr><td>'.$google_res[2].'</td></tr><tr><td>'.$google_res[3].'</td></tr><tr><td>'.$google_res[4].'</td></tr><tr><td>'.$google_res[5].'</td></tr></table>';


//...............parsing data for database

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


//$sql = "SELECT keyword from crawl_data";

// $sql = "INSERT INTO crawl_data values('', '$keyword', '$placed','$rank','$f_url',
//   '$comp[1]','$title[1]','$domain[1]', '$url[1]',
//   '$comp[2]','$title[2]','$domain[2]', '$url[2]',
//   '$comp[3]','$title[3]','$domain[3]', '$url[3]',
//   '$comp[4]','$title[4]','$domain[4]', '$url[4]',
//   '$comp[5]','$title[5]','$domain[5]', '$url[5]')";



$sql = "UPDATE crawl_data set placed = '$placed', rank = '$rank', found_url = '$found_url',
  comp1 = '$comp[1]', title1 = '$title[1]', domain1 = '$domain[1]', url1 = '$url[1]',
  comp2 = '$comp[2]', title2 = '$title[2]', domain2 = '$domain[2]', url2 = '$url[2]',
  comp3 = '$comp[3]', title3 = '$title[3]', domain3 = '$domain[3]', url3 = '$url[3]',
  comp4 = '$comp[4]', title4 = '$title[4]', domain4 = '$domain[4]', url4 = '$url[4]',
  comp5 = '$comp[5]', title5 = '$title[5]', domain5 = '$domain[5]', url5 = '$url[5]' where keyword = '$keyword'";

if(mysql_query($sql)){
  echo "Data updated Successfully !";
}
else{
  echo mysql_error();
}

}