<?php
$list = [
  'https://youtu.be/xA8jrrX3cjs',
  'https://youtu.be/xA8jrrX3cjs',
  'https://youtu.be/xA8jrrX3cjs'
];
$data =  json_encode($list);
$arr = json_decode($data);
foreach($arr as $row):
	$arr2 = explode("/",$row);
	echo end($arr2).'<br/>';
endforeach;
?>