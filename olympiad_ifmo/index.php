<html>
<head>
	<meta http-equiv="content-type" charset="UTF-8">
	<script src="http://code.jquery.com/jquery.min.js" type="text/javascript"></script>
	<script type="text/javascript" src="script/test_get_Script.js"></script>
</head>


<?php
	
	$get[1] = trim($_GET["name"]);
	$get[2] = trim($_GET["school"]);
	$get[3] = trim($_GET["city"]);
	$get[4] = trim($_GET["result"]);	
?>
<body>
	<form method="GET" action = "/olympiad_ifmo/index.php">
		<table>
			<tr>
				<th>Имя</th>
				<th>Школа</th>
				<th>Город</th>
				<th>Балл</th>
				<th></th>
			</tr>
			<tr>
				<td> <input type = "text" name="name" value=<?php echo $get[1]; ?>></td>
				<td> <input type = "text" name="school" value=<?php echo $get[2]; ?>></td>
				<td> <input type = "text" name="city" value=<?php echo $get[3]; ?>></td>
				<td> <input type = "text" name="result" value=<?php echo $get[4]; ?>></td>
				<td><button ><!--onclick = "return false"--> Поиск</button></td>
			</tr>
		</table>
	</form><br>
	<h2>Результаты олимпиады</h2>
    <h3>Открытая олимпиада школьников «Информационные технологии» — ИТ. 11 Класс. Очный тур</h3>
    <table cellpadding="5" cellspacing="0" border="1" width="100%">
        <tr>
            <th>№</th>
            <th>ФИО</th>
            <th>Школа</th>
            <th>Город</th>
            <th>Сумма баллов</th>
        </tr>
	
	<?php
			$path = "http://olymp.ifmo.ru/icms/shared/results/round-340/results.html";
			//$path = "results.html";
			$file = fopen($path, "r");
			function true_filter($get, $file) {
				$read[0] = fgets($file);
				for ($i=1; $i<5; $i++) {
					$read[$i] = fgets($file);
					//echo "<td>".$get[$i]."</td>";//<td>".$read[&i]."</td><td>".stripos($read[$i], $get[$i])."</td>\n";
					if ($get[$i]!=""&&stripos($read[$i], $get[$i])===false) return;
				};
				echo "<tr>\n";
				for ($i=0; $i<5; $i++) echo $read[$i]."\n";
				echo "</tr> \n";
			}
			
			
			$string = fgets($file);
			$first = true;
			while(!feof($file)){
				$string = trim($string);
				//echo "<!--".$string."-->";
				if ($string=="<tr>") if (!$first) true_filter($get, $file);  else $first = false;				
				$string = fgets($file);
			};
		?>
		
	</table>
</body>
</html>