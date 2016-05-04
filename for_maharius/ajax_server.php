<?php
	$path=dirname(__FILE__)."\\shops\\"."tirios";
	$dir = fopen($path, "r");
	$s=fscanf($dir, "%s %d %d %d %d");
	sleep(3);
	echo $s[0]." ".$s[1]." ".$s[2]." ".$s[3]." ".$s[4];
?>