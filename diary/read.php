<html>
<head>
	<meta http-equiv="content-type" charset="UTF-8">
	<link rel="stylesheet" type="html/css" href="stylesheet.css">
	<script type="text/javascript"
src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.
js"></script>
	<script type="text/javascript" src="/script/form_post.js"></script>
</head>
<body>
<form method="POST" action = "/diary/read.php">
Введите дату:<input type = "text" name="date">
<button onclick = "return false">Открыть</button>
 <br>
Дата вводится в формате dd.mm.yyyy . Пример: <?php echo (date("d")+1).".".date("m").".".date("o"); ?> .<br>
Введите today, чтобы узнать последнее домашнее задание, имеющееся в дневнике.
</form>
<?php
	error_reporting(0);
	echo "<table class=\"rasp\">";
	if ($date == "") $date = $_POST["date"];
	if ($date != "") {
		if ($day = fopen($date, "r")) {
		if ($date == today) {
			$tmtable = fgets($day);
			echo "<th colspan = \"3\" class=\"rasp\">Последние известные домашние задания:</th>"; } 
		else echo "<th colspan = \"2\" class=\"rasp\">Текущая дата:</th><th>".$date."</th>";
		$i = 0; 
		do {
			$i ++;
			$tmtable = fgets($day);
			if ($tmtable != "†") {
				$less = explode("‡",$tmtable);
				echo "<tr><td class = \"one\">".$i."</td><td class = \"two\">".$less[0]."</td><td class = \"three\">".$less[1]."</td></tr>";
				} } while ($tmtable != "†"); 
		} else echo "Либо вы ввели дату не в необходимом формате, либо вообще ввели не дату. Если же все сделано правильно, то данные об этой дате отсутствуют.";
		} else {
			$day = fopen("today", "r");
			$date = fgets($day);
				do {
				$tmtable = fgets($day);
				if ($tmtable != "†") {
					$less = explode("‡",$tmtable);
					$hw[$less[0]] = $less[1];
				} } while ($tmtable != "†");
			fclose($day);
			$date = $date[0].$date[1].$date[2].$date[3].$date[4].$date[5].$date[6].$date[7].$date[8].$date[9];
			$day = fopen($date, "r");
			echo "<th colspan = \"2\">Последнее имеющееся расписание:</th><th>".$date."</th>";
			for ($i = 0; $i <=10; $i++) {
				$tmtable = fgets($day);
				$less = explode("‡",$tmtable);
				echo "<tr><td class = \"one\">".$i."</td><td class = \"two\">".$less[0]."</td><td class = \"three\">".$hw[$less[0]]."</td></tr>";
				
			};
		}
		fclose($day);
		echo "</table>";
	
	
	?>
</body>
</html>
