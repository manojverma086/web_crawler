<?php
include('connection.php');
// $sql = "SELECT keyword from crawl_data";
// $result = mysql_query($sql);
// $rows = mysql_num_rows($result);
// $keyword_arr = array();

// // $keyword_json = json_encode($keyword_arr);
// //file_put_contents('keyword.json', $keyword_json);

// // for($i=0; $i < $rows; $i++)
// // {
// //   $res = mysql_fetch_array($result);
// //   $keyword_arr[$i] = $res['keyword'];
// // }

// if($rows > 0){
//   while($res = mysql_fetch_array($result)){
//     $keyword_arr[] = $res['keyword'];
//   }
// }

// exit();

// //for loop for all data............

// for($i=0; $i<$rows; $i++)
// {
//  $keyword = $keyword_arr[$i];
//  getData($keyword);
// }


$keyword = $_REQUEST['keyword'];

$update_time = '';
$placed  = '';
$rank = '';
$found_url = '';
$comp = array();
$title = array();
$domain = array();
$url = array();


$sql = "SELECT * FROM crawl_data WHERE keyword = '$keyword'";
$result = mysql_query($sql);
$res = mysql_fetch_array($result);

$update_time = $res['update_time'];
$placed = $res['placed'];
$rank = $res['rank'];
$found_url = $res['found_url'];

$comp[0] = $res['comp1'];
$comp[1] = $res['comp2'];
$comp[2] = $res['comp3'];
$comp[3] = $res['comp4'];
$comp[4] = $res['comp5'];

$title[0] = $res['title1'];
$title[1] = $res['title1'];
$title[2] = $res['title1'];
$title[3] = $res['title1'];
$title[4] = $res['title1'];

$domain[0] = $res['domain1'];
$domain[1] = $res['domain2'];
$domain[2] = $res['domain3'];
$domain[3] = $res['domain4'];
$domain[4] = $res['domain5'];

$url[0] = $res['url1'];
$url[1] = $res['url2'];
$url[2] = $res['url3'];
$url[3] = $res['url4'];
$url[4] = $res['url5'];

// $mainResult = "<tr><td>".$keyword."</td><td>".$placed."</td><td>".$rank."</td><td>".$found_url."</td></tr>";

// $googleResult = "<tr><td>".$comp[0]."</td><td>".$title[0]."</td><td>".$domain[0]."</td><td>".$url[0]."</td><td></tr>"
// 				."<tr><td>".$comp[1]."</td><td>".$title[1]."</td><td>".$domain[1]."</td><td>".$url[1]."</td><td></tr>"
// 				."<tr><td>".$comp[2]."</td><td>".$title[2]."</td><td>".$domain[2]."</td><td>".$url[2]."</td><td></tr>"
// 				."<tr><td>".$comp[3]."</td><td>".$title[3]."</td><td>".$domain[3]."</td><td>".$url[3]."</td><td></tr>"
// 				."<tr><td>".$comp[4]."</td><td>".$title[4]."</td><td>".$domain[4]."</td><td>".$url[4]."</td><td></tr>";


// echo "<table style='border:1px solid black; ''>".$mainResult."</table>";
//  echo "<table style='border:1px solid black;'>".$googleResult."</table><br>";
 
echo 
 "<table style='border:1px solid black;'>
 <tr style='border:1px solid black;'>
 	<td>"
 	.$keyword."</td>
 	<td>"
 	.$placed."</td>
 	<td>"
 	.$rank."</td>
 	<td>"
 	.$found_url."</td>
 	<td>"
 	.$comp[0]."<br>".$comp[1]."<br>".$comp[2]."<br>".$comp[3]."<br>".$comp[4]."</td>
 	<td>"
 	.$title[0]."<br>".$title[1]."<br>".$title[2]."<br>".$title[3]."<br>".$title[4]."</td>
 	<td>"
 	.$domain[0]."<br>".$domain[1]."<br>".$domain[2]."<br>".$domain[3]."<br>".$domain[4]."</td>
 	<td>"
 	.$url[0]."<br>".$url[1]."<br>".$url[2]."<br>".$url[3]."<br>".$url[4]."
 	</td>
 </tr>
 </table>";
