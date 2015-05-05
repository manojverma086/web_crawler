<?php
require_once('../../dom/simple_html_dom.php');
// if(isset($_REQUEST['keyword'])){
//   $keyword = explode('|',$_REQUEST['keyword']);
//   $flag1 =1;
//   if(count($keyword)>1)
//     $flag2 = 1;
// }
// else{
// $keyword = 'send flower to pune';
// $flag1 = 0;
// $flag2 = 0;
// }
//$keyword = $_REQUEST['keyword'];
$keyword = 'send flower to pune';
$url = 'http://www.seocentro.com/tools/search-engines/keyword-position.html';


$fields = array(
            'q'=>'send flower to pune',
            'd'=>'www.flaberry.com',
            'd2'=>'',
            'dkey'=>'9e9f693d00b47308c2e6b6d08ebe663b',
            'rkey'=>'2458',
            'Submit'=>'submit'
        );

//url-ify the data for the POST
foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
rtrim($fields_string, '&');

//open connection
$ch = curl_init();

//set the url, number of POST vars, POST data
curl_setopt($ch,CURLOPT_URL, $url);
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

  // foreach ($google_res[1] as $key) {
  //  # code...
  //  echo $key->plaintext;
  // }
echo "Searched Keyword - ".$keyword."<br><br><big>Main Results </big><table><tr><td>".$main_res[0].'</td><td>'
     .$main_res[1].'</td></tr></table><br>'
     ."<big>Google Result </big><table><tr><td>".$google_res[0].'</td></tr><tr><td>'.$google_res[1].'</td></tr><tr><td>'.$google_res[2].'</td></tr><tr><td>'.$google_res[3].'</td></tr><tr><td>'.$google_res[4].'</td></tr><tr><td>'.$google_res[5].'</td></tr></table>';
