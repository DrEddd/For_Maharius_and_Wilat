<!--

	!!!КОНЦЕПЦИЯ!!!
	1. Вводится/удаляется символ (key_pressed)
	2. Считывается значение из формы.
	3. Проходится по всем дивам класса eng_word
	4. Если форма пуста - всем присваивает .show('medium'), иначе присваивает его всем дивам, чье содержание начинается на символы в форме, а остальным присваивает .hide('medium')
	5. При нажатии кнопки "SHOW WORD' FORM" form.show('medium')||form.hide('medium'). (slideToggle('fast') )
	6. В форме два поля - слово и перевод. Есть кнопка "ADD WORD".
	7. При нажатии кнопки считываются данные из форм. Сделать проверку на верность введенного слова.
	8. Добавить кнопку "EDIT WORD".
	9. Сделать кнопку "SAVE CHANGES"
	10. Скрываем родительский <TR>
	11. If enter_new.... is empty and not selected --\> fill in
	12. Передача через ajax: формируем две строчки (index/value). Передаем их.
-->
<html>
<head>
<meta http-equiv="content-type" content="text/html" charset = "utf-8">
</head>
<script src="http://code.jquery.com/jquery.min.js" type="text/javascript"></script>
<style>
	td,tr, table {
		border: 1px solid black;
		margin: 0px;
		padding: 0px;
	}
</style>

<script>
$(document).ready(function(){
	var words = new Array();
	var inENW = document.getElementById("enter_new_word");
	var inENT = document.getElementById("enter_new_translate");
	var eng_word = document.getElementById("eng_word");
	var main_table = document.getElementById("main_table");
	eng_word.onkeyup = show_words;

	<?php
		$path="eng_words.txt";
		$file = fopen($path, "r");
		$words = Array();
		$countEngWords=0;
		while (!feof($file)) {
			$string=fgets($file);
			$word = trim(substr($string, 0, strpos($string, "‡")));
			$translate = trim(substr($string, strpos($string, "‡")+3, strlen($string)-1));
			$tmpwrd = str_replace(" ", "†", $word);
			$word = $tmpwrd;
			$words[$word]=$translate;
			echo "words[\"".$word."\"]=\"".$translate."\";\n";
			$countEngWords++;
			};
		ksort($words);
		fclose($file);
	?>
	
	$('#add_word').click(function(){
		words[inENW.value]=inENT.value;
		$('#head').after("<tr class=\"eng_word\"><td>"+inENW.value+"</td><td>"+inENT.value+"</td></tr>");
		inENW.value = "Enter new word";
		inENT.value = "Enter translate of word";
	});
	
	inENW.onblur = function() {
	   if (inENW.value=="") inENW.value = "Enter new word";
	};
	
	inENT.onblur = function() {
	  if (inENT.value=="") inENT.value = "Enter translate of word";
	};
	
	eng_word.onblur = function() {
	  if (eng_word.value=="") eng_word.value = "Enter word";
	};
	
	inENW.onfocus = function() {
	  if (inENW.value==="Enter new word") inENW.value= "";
	};
	
	inENT.onfocus = function() {
	  if (inENT.value=="Enter translate of word") inENT.value = "";
	};
	
	eng_word.onfocus = function() {
	  if (eng_word.value==="Enter word") eng_word.value="";
	};
	
	function show_words() { 
		var findWord = eng_word.value;
		$('.eng_word').each(function(){
			var word = $(this).children().html();
			if (findWord.length==0)  $(this).show('fast'); else
				if (word.indexOf(findWord)+1) $(this).show('fast'); else $(this).hide('fast');
		});
	};
	
	$('#show_form').click(function(){ $('#form').slideToggle('fast');});
	
	$('#form').hide('fast');
	

	function getXmlHttp(){
  var xmlhttp;
  try {
    xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
  } catch (e) {
    try {
      xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    } catch (E) {
      xmlhttp = false;
    }
  }
  if (!xmlhttp && typeof XMLHttpRequest!='undefined') {
    xmlhttp = new XMLHttpRequest();
  }
  return xmlhttp;
}

// javascript-код голосования из примера
function vote() {
	var alls='alls=';
	words.forEach(function(value, index, words) {
		alls+=index+"‡"+value+"‡";
	});
    // (1) создать объект для запроса к серверу
    var req = getXmlHttp()     
    // (2)
    // span рядом с кнопкой
    // в нем будем отображать ход выполнения
    var statusElem = document.getElementById('ajax')
     
    req.onreadystatechange = function() { 
        // onreadystatechange активируется при получении ответа сервера
        if (req.readyState == 4) {
            // если запрос закончил выполняться
 
            statusElem.innerHTML = req.statusText // показать статус (Not Found, ОК..)
 
            if(req.status == 200) {
                 // если статус 200 (ОК) - выдать ответ пользователю
                location.reload()
            }
            // тут можно добавить else с обработкой ошибок запроса
        }
 
    }
 
       // (3) задать адрес подключения
    req.open('POST', 'save_changes.php', true); 
 
    // объект запроса подготовлен: указан адрес и создана функция onreadystatechange
    // для обработки ответа сервера
      
    // (4)
    req.send(alls);  // отослать запрос
   
        // (5)
}

	
});



</script>
<body>
<table style="width:100%" id="main_table">
	<tr>
		<th colspan="2">Мой словарик (<?php echo$countEngWords; ?>)</th>
	</tr>
	<tr id="head">
		<td colspan="2" width="100%">
				<input style="width:100%; height:auto;" type="text" id="eng_word"  value="Enter word"></input><br/>
				<button id="show_form">Add words</button><br/>
				<div id="form" style="width:100%; height:auto;">
					<input type="text" id="enter_new_word"  style="width:40%; height: auto;" value="Enter new word"></input>
					<button id="add_word">Add word</button>
					<input type="text" id="enter_new_translate" style="width:40%; height: auto;" value="Enter translate of word"></input>
					<button id="save_changes">Save you changes</button>
				</div>
		</td>
	</tr>
	<?php
		
		
		foreach ($words as $word => $translate)  echo "\n <tr class=\"eng_word\">\n <td>".str_replace("†", " ", $word)."</td>\n<td>".$translate."</td>\n</tr>";
	?>
</table>
</body>
</html>