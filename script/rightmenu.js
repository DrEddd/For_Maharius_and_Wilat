	rightmenu.innerHTML = "<div id=\"rightmenu_clock\"> <span style=\"color: green; font-size: 50px;\" class=\"rightMenuBlock\" ></span></div>";
	function clock() {
	var time = new Date();
	time = time.toLocaleTimeString();
	
	var times = time[0]+time[1]+time[2]+time[3];
	if (time[4]!=":") times = times+time[4];
	
	var rightmenu = document.getElementById("rightmenu_clock");
	rightmenu.innerHTML = "<span style=\"color: green; font-size: 50px;\" class=\"rightMenuBlock\">"+times+"</span>";
	}
	clock();
	setInterval(clock, 30000);
	rightmenu.innerHTML += "<span style=\"font-size: 20px; margin-top: 5px; \" class=\"rightMenuBlock\"><b>Новости.</b></span>";
	
	
	rightmenu.innerHTML += "<span style=\"font-size: 15px;\" class=\"rightMenuBlock\"><b>12 апреля 2014</b> <br>Добавил пробную версию личного английского словаря.</span>";
	rightmenu.innerHTML += "<span style=\"font-size: 15px;\" class=\"rightMenuBlock\"><b>18 марта 2014</b> <br>Добавил <a href=\"/games/gameOfLife/\">Game of Life</a></span>";
	rightmenu.innerHTML += "<span style=\"font-size: 15px;\" class=\"rightMenuBlock\"><b>18 марта 2014</b> <br>Добавил небольшую таблицу функций, которые были мне полезны, и необходимых для них библиотек C++.</span>";
	rightmenu.innerHTML += "<span style=\"font-size: 15px;\" class=\"rightMenuBlock\"><b>17 марта 2014</b> <br>Добавил список участником олимпиады ИТМО по информатике и их результаты (Поиск, почему-то, работает не совсем так, как нужно).</span>";
	rightmenu.innerHTML += "<span style=\"font-size: 15px;\" class=\"rightMenuBlock\"><b>13 марта 2014</b> <br>По просьбе друга введена страница с пробной системой поиска по тегам (См. пункт меню \"for maharius\").</span>";
	rightmenu.innerHTML += "<span style=\"font-size: 15px;\" class=\"rightMenuBlock\"><b>07 марта 2014</b> <br> Добавлены стихи для 8 марта. Сломана игра \"пятнашки\". Оптимизировано меню. Ведется поиск проблемы с выделением пункта меню.</span>";
	rightmenu.innerHTML += "<span style=\"font-size: 20px; color=\"blue\";\" class=\"rightMenuBlock\"><a href=\"/news/\" class=\"menulink newslink\">Смотреть все новости</a></span>";