<meta charset="utf-8">
<?php

require_once "stat.php";

//$tab4=FetchVideo::getInfoYoutubeChanel('UCqyku6Kdofy1nV86yh9R8n8A');
//$tab3=FetchVideo::getInfVimeoChanel('delicioussandwich');
//$tab1=FetchVideo::getInfoYoutube('89ScoHpaZaw');
$tab2=FetchVideo::getInfoVimeo('7811489');

foreach ($tab2 as $key => $value) {
	if(is_array($value))
	{
		foreach ($value as $k => $v) {
			# code...
			echo $k.' : '.$v.'<br />';
		}
	}
	else {
	echo $key.' : '.$value.'<br />';
	}
}
echo "<hr/>";

 ?>
