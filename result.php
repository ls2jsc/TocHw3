<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
//get data from previous page
$url = $_POST['url'];
$county = $_POST['county'];
$location = $_POST['location'];
$year = $_POST['year'];

$data = json_decode(file_get_contents($url), true);//read url's content into $data as a array
//$data = json_decode(file_get_contents('data.json'), true);//test the time without loading data  
$total = 0;
$divider = 0;
foreach($data as $key => $arr)
{
	if(strcmp($arr['鄉鎮市區'], $county) == 0 && strstr($arr['土地區段位置或建物區門牌'], $location) && strncmp($arr['交易年月'], $year, 3) == 0)
	{
		echo $arr['鄉鎮市區'].'  '.$arr['土地區段位置或建物區門牌'].'  '.$arr['交易年月'].'  '.$arr['總價元'].'<br>';
		$total =  $total + $arr['總價元'];
		++$divider;
	}
}
if($divider != 0)
{
	echo 'Average: '.intval($total/$divider);
}
else//no one meet the need
{
	echo 'No match!';
}	
?>