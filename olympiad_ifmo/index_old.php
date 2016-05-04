<html>
<head>
	<meta http-equiv="content-type" charset="UTF-8">
	<script src="http://code.jquery.com/jquery.min.js" type="text/javascript"></script>
	<script type="text/javascript" src="script/test_post_Script.js"></script>
</head>


<?php
	
	$post[1] = trim($_POST["name"]);
	$post[2] = trim($_POST["school"]);
	$post[3] = trim($_POST["city"]);
	$post[4] = trim($_POST["result"]);	
?>
<body>
	<form method="POST" action = "/olympiad_ifmo/index.php">
		<table>
			<tr>
				<th>Имя</th>
				<th>Школа</th>
				<th>Город</th>
				<th>Балл</th>
				<th></th>
			</tr>
			<tr>
				<td> <input type = "text" name="name" value=<?php echo $post[1]; ?>></td>
				<td> <input type = "text" name="school" value=<?php echo $post[2]; ?>></td>
				<td> <input type = "text" name="city" value=<?php echo $post[3]; ?>></td>
				<td> <input type = "text" name="result" value=<?php echo $post[4]; ?>></td>
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
			function true_filter($post, $file) {
				$read[0] = fgets($file);
				for ($i=1; $i<5; $i++) {
					$read[$i] = fgets($file);
					//echo "<td>".$post[$i]."</td>";//<td>".$read[&i]."</td><td>".stripos($read[$i], $post[$i])."</td>\n";
					if ($post[$i]!=""&&stripos($read[$i], $post[$i])===false) return;
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
				if ($string=="<tr>") if (!$first) true_filter($post, $file);  else $first = false;				
				$string = fgets($file);
			};
		?>
		
	</table>
</body>
</html>