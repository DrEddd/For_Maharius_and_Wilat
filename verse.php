<html>
<head>
</script>
	<meta http-equiv="content-type" charset="UTF-8">
	<link rel="stylesheet" href="/style/stylesheet.css" type="html/css">
	<!--<script type="text/javascript"
src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js"></script>
-->
<script src="http://code.jquery.com/jquery.min.js" type="text/javascript"></script>

</head>	

<body>
	<table style="width: 100%; height: auto;" id="block">
	<tr>
	
	<td id="content"><?php
	$name = $_GET["name"];
	//echo $name;
	/*if ($name==8)*/ //include ("verses/loli");
	switch ($name) {
	case "adl": include("verses/adel"); break;
	case "arn": include("verses/arin"); break;
	case "igl": include("verses/igul"); break;
	case "dna": include("verses/dani"); break;
	case "dan": include("verses/dian"); break;
	case "dlr": include("verses/dila"); break;
	case "irn": include("verses/irin"); break;
	case "llt": include("verses/loli"); break;
	case "lda": include("verses/luda"); break;
	case "nst": include("verses/nast"); break;
	case "nth": include("verses/nata"); break;
	default: break;
	}; ?></td>
	<td><div id="rightmenu"><?php include("rightmenu"); ?></div></td>
	</tr>
	<tr><td colspan="3" id="bottom"><?php include("bottom");?></td></tr>
	</table>
	<script type="text/javascript" src = "/script/main_page.js">	</script>
	<script type="text/javascript" src="/script/test_script_menu.js"></script>
	<script type="text/javascript" src="/script/rightmenu.js"></script>
</body>
</html>	
