<html>
<head>
</head>

<style>

table, tr, td, th {
	border: 1px solid black;
};
</style>

<body>


 <?php
 //echo "!!!";
	$path = "libraries";
	$file = fopen($path, "r");
	$library = trim(fgets($file)).".txt";
	$library="algorithm.txt";
	while (!feof($file)) {
	 echo "<table>";
		$library_open = fopen($library,"r");
		//if (file_exists($library)||$library_open) echo "true, ".$library_open."<br>"; else echo "false, <br>";
		$string = fgets($library_open);
		echo "<tr><th colspan=5>".$string."</th></tr>\n";
		$string = fscanf($library_open, "%s %s %s %s %s"); for ($i=0; $i<5; $i++) $string[$i] = str_replace("_", " ", $string[$i]);
		echo "<tr>\n<td>".$string[0]."</td>\n<td>".$string[1]."</td>\n<td>".$string[2]."</td>\n<td>".$string[3]."</td>\n<td>".$string[4]."</td></tr>\n";
		$string = fgets($library_open);
		while (!feof($library_open)&&$string!="") { $string = trim($string);
			echo "<tr><td>".$string."</td>\n";
			$function = fopen($string.".txt", "r");
			$string = fgets($function); $string = trim($string);
			echo "<td>".$string."</td>\n";
			$string = fgets($function); $string = trim($string);
			echo "<td>".$string."</td>\n";
			$string = fgets($function); $string = trim($string);
			echo "<td>".$string."</td>\n";
			$string = fgets($function); $string = trim($string);
			echo "<td class=\"hide_code\">";
			while (!feof($functon)&&$string!="") {
				$string = str_replace ("<", "&lt", $string);
				echo $string."<br>\n";
				$string = fgets($function);
			};
			echo "</td></tr>\n";
			$string = fgets($library_open);
		};
		$library = trim(fgets($file)).".txt";
		echo "</table>";
	};
 ?>

 </body>
 </html>