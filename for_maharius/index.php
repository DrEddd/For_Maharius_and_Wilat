<html>
<head>
	<meta http-equiv="content-type" charset="UTF-8">
	<script src="http://code.jquery.com/jquery.min.js" type="text/javascript"></script>
	<script type="text/javascript" src="/script/from_maharius.js"></script>
</head>


<script>
var tags = new Object();
  tags = {test: "test"};

<?php
	$path="tags.txt";
	$tagsDir = fopen($path, "r");
	$str = fgets($tagsDir);
	while (!feof($tagsDir)) {
		$str = trim($str)." ";
		echo "a:".$str."\n";
		$link = substr($str, 0, strpos($str, " "));
		echo "b:".strpos($str, " ")."\n";
		echo "c:".$link."\n";
		$str = substr_replace($str, "", 0, strpos($str, " ")+1);
		echo "d:".$str."\n";
		while(strlen($str)>0) {
		  $tag = substr($str, 0, strpos($str, " "));
		  echo "tags[\"".$tag."\"].push(\"".$link."\");\n"; 
		  if(isset($tags[$tag])) array_push($tags[$tag], $link); else $tags[$tag][0]=$link;
		  $str = substr_replace($str, "", 0, strpos($str, " ")+1);
		  };
		$str = fgets($tagsDir);
		};
?>
</script>
<body>
<form method="POST" action = "/for_maharius/index.php">
Введите тег:<input type = "text" name="newTag">
<button onclick = "return false">Открыть</button>
<!--
Конфепция:
Первое слово в строчке - ссылка на текст.
Остальные слова - теги.
Считываем построчно. Выделяем из каждой строки ссылку и теги. В массив[тег] добавляем ссылку (Т.е. получаем, например, массив[тег][0] - ссылка 1, массив[тег][1] - ссылка 2... ).

Пользователь вводит тег, нажимает кнопку. Производится считывание тега. Выводятся в разных строчках все ссылки, к которым относится тег (т.е. все элементы массив[тег] ).

-->
</form>
<?php
	error_reporting(0);
	if ($newTag == "") $newTag = $_POST["newTag"];
	if ($newTag != "") {
		$i=0;
		foreach ($tags[$newTag] as $link) $i++; ;
			if ($i==0) echo "<span style=\"font-size: 25px\"><b><i>ERROR! Тег не найден!</i></b></span>"; else {echo "Результаты поиска по данному тегу: <br>";
			foreach ($tags[$newTag] as $link) {  echo "<b><i>".$link."</i></b><br>"; $i++; };	};	
		}	
		//foreach ($tags as $en => $rus){ echo $en.": "; foreach ($rus as $fist) echo $fist."-"; echo "<br>";};
	?>
</body>
</html>
