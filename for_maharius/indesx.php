<html>
<head>
	<meta http-equiv="content-type" charset="UTF-8">
	<script src="http://code.jquery.com/jquery.min.js" type="text/javascript"></script>
	<script type="text/javascript" src="/script/form_post.js"></script>
</head>


<?php
	$tagsDir = fopen("tags.txt", "r");
	$str = fgets($tagsDir);
	while (!feof($tagsDir)) {
		$str = trim($str);
		$link = substr($str, 0, strpos(" "));
		$str = strreplace($str, "", 0, strpos(" "));
		while(strlen($str)>0) {$tag = substr($str, 0, strpos(" ")); $tags[$tag][count($tags[$tag]]=$link; $str = strreplace($str, "", 0, strpos(" ")); };
		$str = fgets($tagsDir);
		};
?>

<body>
<form method="POST" action = "/diary/read.php">
Введите тег:<input type = "text" name="date">
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
	if ($tag == "") $tag = $_POST["tag"];
	if ($tag != "") {
			
			
		}	
		foreach ($tags as $en => $rus) fprintf($dir, "%s %s \n", $rus, $en);
	?>
	123
</body>
</html>
