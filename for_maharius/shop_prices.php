<html>
  <head>
    <title>Shop's prices</title>
	<meta http-equiv="content-type" content="text/html" charset = "utf-8">
  </head>
  <style type="text/css">
    tr, td {
	  border: 1px solid black;
	  text-align:center;
	}
	.item, .best, .terrible {
	  min-width: 100px;
	  height: 15px;
	  text-align:center;
	}
	
	.best {
	background: red;
	font-family: tahoma;
	font-style: italic;
	}
	
	.terrible {
	background: green;
	font-style: bold;
	font-family: times;
	}
		
  </style>
  <script type="text/javascript">
  var price = new Object();
  price = {test: "test"};
    <?php
	$path="translateSEN";
		$dir = fopen($path, "r");
		$s=fscanf($dir, "%s %s");
		while ($s[0]!=""){ 
		$s[0] = strtolower($s[0]);
		$s[1] =strtolower($s[1]);
		  if ($s[0]!="") $translate[$s[0]]=$s[1];
		  $s=fscanf($dir, "%s %s");
    	};
		
	   $code="RU";
	   $shops=scandir('shops');
	   unset($shops['translateRU']);
		$count=0;
		$i=0;
		foreach ($shops as $shop) if (strlen($shop)>2) {
			//echo "shops[\"".$shop."\"]=\"yes\"";
			$count++;
			$path=dirname(__FILE__)."\\shops\\".$shop;
			$dir = fopen($path, "r");
			$s=fscanf($dir, "%s %d %d %d %d");
			while ($s[0]!="") {
			$s[0] =strtolower($s[0]);
			$s[0] = $translateSEN[$s[0]];
			  echo "price['".$s[0]."'['".$shop."'['buy'['cost']]]]=".$s[3].";\n";
			  echo "price['".$s[0]."'['".$shop."'['buy'['count']]]]=".$s[4].";\n";
			  echo "price['".$s[0]."'['".$shop."'['sell'['cost']]]]=".$s[1].";\n";
			  echo "price['".$s[0]."'['".$shop."'['sell'['count']]]]=".$s[2].";\n";
			  
			  $price[$s[0]][$shop]["sell"]["cost"]=$s[1];
			  $price[$s[0]][$shop]["sell"]["count"]=$s[2];
			  $price[$s[0]][$shop]["buy"]["cost"]=$s[3];
			  $price[$s[0]][$shop]["buy"]["count"]=$s[4];
			  $items[$s[0]]=$i++;
			  
			  	$price[$s[0]]["best"]["sell"]["count"]=1;
				$price[$s[0]]["best"]["sell"]["cost"]=9999999;
				$price[$s[0]]["best"]["buy"]["count"]=9999999;
				$price[$s[0]]["best"]["buy"]["cost"]=1;
				$price[$s[0]]["terrible"]["sell"]["count"]=9999999;
				$price[$s[0]]["terrible"]["sell"]["cost"]=1;
				$price[$s[0]]["terrible"]["buy"]["count"]=1;
				$price[$s[0]]["terrible"]["buy"]["cost"]=9999999;
			  
			  $s=fscanf($dir, "%s %d %d %d %d");
			};
		};
		
		$path="translate";
		$dir = fopen($path.$code, "r");
		$s=fscanf($dir, "%s %s");
		while ($s[0]!=""){ 
		$s[0] =strtolower($s[0]);
		$s[1] =strtolower($s[1]);
		  if ($s[0]!="") $translate[$s[0]]=$s[1];
		  $s=fscanf($dir, "%s %s");
    	};
		//$dir = fopen($path.$code, "w");
		//foreach ($translate as $en => $rus) fprintf($dir, "%s %s \n", $rus, $en);
		
		ksort($items);
		foreach ($items as $item => $id) { 
			$bestSell = "best";
			$bestBuy = "best";
			$terribleSell = "terrible";
			$terribleBuy = "terrible";
			foreach ($shops as $shop) if (strlen($shop)>2&&$shop!="tirios") {
				if (isset($price[$item][$shop]["sell"])) if ($price[$item][$shop]["sell"]["cost"]/$price[$item][$shop]["sell"]["count"]<$price[$item][$bestSell]["sell"]["cost"]/$price[$item][$bestSell]["sell"]["count"]) $bestSell = $shop;
				if (isset($price[$item][$shop]["buy"])) if ($price[$item][$shop]["buy"]["cost"]/$price[$item][$shop]["buy"]["count"]>$price[$item][$bestBuy]["buy"]["cost"]/$price[$item][$bestBuy]["buy"]["count"]) $bestBuy = $shop;
				if (isset($price[$item][$shop]["sell"])) if ($price[$item][$shop]["sell"]["cost"]/$price[$item][$shop]["sell"]["count"]>$price[$item][$terribleSell]["sell"]["cost"]/$price[$item][$terribleSell]["sell"]["count"]) $terribleSell = $shop;
				if (isset($price[$item][$shop]["buy"])) if ($price[$item][$shop]["buy"]["cost"]/$price[$item][$shop]["buy"]["count"]<$price[$item][$terribleBuy]["buy"]["cost"]/$price[$item][$terribleBuy]["buy"]["count"]) $terribleBuy = $shop;
			};
			if (isset($price[$item]["tirios"]["sell"])) if ($price[$item]["tirios"]["sell"]["cost"]/$price[$item]["tirios"]["sell"]["count"]<$price[$item][$bestSell]["sell"]["cost"]/$price[$item][$bestSell]["sell"]["count"]) $bestSell = "tirios";
			if (isset($price[$item]["tirios"]["buy"])) if ($price[$item]["tirios"]["buy"]["cost"]/$price[$item]["tirios"]["buy"]["count"]>$price[$item][$bestBuy]["buy"]["cost"]/$price[$item][$bestBuy]["buy"]["count"]) $bestBuy = "tirios";
			if (isset($price[$item]["tirios"]["sell"])) if ($price[$item]["tirios"]["sell"]["cost"]/$price[$item]["tirios"]["sell"]["count"]>$price[$item][$terribleSell]["sell"]["cost"]/$price[$item][$terribleSell]["sell"]["count"]) $terribleSell = "tirios";
			if (isset($price[$item]["tirios"]["buy"])) if ($price[$item]["tirios"]["buy"]["cost"]/$price[$item]["tirios"]["buy"]["count"]<$price[$item][$terribleBuy]["buy"]["cost"]/$price[$item][$terribleBuy]["buy"]["count"]) $terribleBuy = "tirios";
			$bestSells[$item]=$bestSell;
			$bestBuys[$item]=$bestBuy;
			$terribleSells[$item]=$terribleSell;
			$terribleBuys[$item]=$terribleBuy;
		};
		
	?>
  </script>
  <body>
    <table style="border:1px solid black; width: 100%">
	  <tr>
	  <td style="width:100%; height: 20px; text-align: center; vertical-align: top" colspan=<?php echo 3+$count*2 ?>>
	    <h1>Магазины</h1>
	  </td>
	  </tr>
	  <tr>
	  <td class="item" rowspan=2>Предметы</td>
	  <?php
		foreach ($shops as $shop) if (strlen($shop)>2) if ($shop!="tirios") echo "<td class=\"item\" colspan=2>".$translate[strtolower($shop)]."</td>";
		echo "<td class=\"item\" colspan=2>".$translate["tirios"]."</td>";
	  ?>
	  <td colspan=2>Прибыль/64</td>
	  </tr>
	  <tr>
	    <?php for ($i=0; $i<=$count; $i++) echo "<td class=\".item\">Продажа</td><td class=\".item\">Покупка</td>" ;
		?>
	  </tr>
	 	<?php 
		foreach ($items as $item => $id) { 
			print_r(strlen($item)." ");
			echo "<tr><td class=\"item\">".str_replace("_", " ", $translate[$item])."</td>";
			foreach ($shops as $shop) if (strlen($shop)>2&&$shop!="tirios") {
				echo "<td id=\"".$item."&".$shop."&sell\"";
				if (isset($price[$item][$shop]["sell"])) {
					if ($price[$item][$shop]["sell"]["cost"]/$price[$item][$shop]["sell"]["count"]===$price[$item][$bestSells[$item]]["sell"]["cost"]/$price[$item][$bestSells[$item]]["sell"]["count"]) echo "class=\"best\">"; 
					  else if ($price[$item][$shop]["sell"]["cost"]/$price[$item][$shop]["sell"]["count"]===$price[$item][$terribleSells[$item]]["sell"]["cost"]/$price[$item][$terribleSells[$item]]["sell"]["count"]) echo "class=\"terrible\">"; 
					  else echo "class=\"item\">";
					echo $price[$item][$shop]["sell"]["cost"]."/".$price[$item][$shop]["sell"]["count"]."(".round($price[$item][$shop]["sell"]["cost"]/$price[$item][$shop]["sell"]["count"], 3).")</td>"; 
				} else echo "class=\"item\">"."---"."</td>"; 
				echo "<td id=\"".$item."&".$shop."&buy\"";
				if (isset($price[$item][$shop]["buy"])) {
					if ($price[$item][$shop]["buy"]["cost"]/$price[$item][$shop]["buy"]["count"]===$price[$item][$bestBuys[$item]]["buy"]["cost"]/$price[$item][$bestBuys[$item]]["buy"]["count"]) echo "class=\"best\">"; 
					else if ($price[$item][$shop]["buy"]["cost"]/$price[$item][$shop]["buy"]["count"]===$price[$item][$terribleBuys[$item]]["buy"]["cost"]/$price[$item][$terribleBuys[$item]]["buy"]["count"]) echo "class=\"terrible\">"; 
					else echo "class=\"item\">";
					echo $price[$item][$shop]["buy"]["cost"]."/".$price[$item][$shop]["buy"]["count"]."(".round($price[$item][$shop]["buy"]["cost"]/$price[$item][$shop]["buy"]["count"],3).")</td>"; 
				} else echo "class=\"item\">"."---"."</td>"; 
				//print_r($bestSell); print_r(" "); print_r($bestBuy);print_r("<br>"); 
			};
			echo "<td id=\"".$item."&".$shop."&sell\"";
			if (isset($price[$item]["tirios"]["sell"])) {
					if ($price[$item]["tirios"]["sell"]["cost"]/$price[$item]["tirios"]["sell"]["count"]===$price[$item][$bestSells[$item]]["sell"]["cost"]/$price[$item][$bestSells[$item]]["sell"]["count"]) echo "class=\"best\">"; 
					else if ($price[$item]["tirios"]["sell"]["cost"]/$price[$item]["tirios"]["sell"]["count"]===$price[$item][$terribleSells[$item]]["sell"]["cost"]/$price[$item][$terribleSells[$item]]["sell"]["count"]) echo "class=\"terrible\">"; 
					else echo "class=\"item\">";
					echo $price[$item]["tirios"]["sell"]["cost"]."/".$price[$item]["tirios"]["sell"]["count"]."(".round($price[$item]["tirios"]["sell"]["cost"]/$price[$item]["tirios"]["sell"]["count"],3).")</td>"; 
				} else echo "class=\"item\">"."---"."</td>"; 
				echo "<td id=\"".$item."&".$shop."&buy\"";
				if (isset($price[$item]["tirios"]["buy"])) {
					if ($price[$item]["tirios"]["buy"]["cost"]/$price[$item]["tirios"]["buy"]["count"]===$price[$item][$bestBuys[$item]]["buy"]["cost"]/$price[$item][$bestBuys[$item]]["buy"]["count"]) echo "class=\"best\">"; 
					else if ($price[$item]["tirios"]["buy"]["cost"]/$price[$item]["tirios"]["buy"]["count"]===$price[$item][$terribleBuys[$item]]["buy"]["cost"]/$price[$item][$terribleBuys[$item]]["buy"]["count"]) echo "class=\"terrible\">"; 
					else echo "class=\"item\">";
					echo $price[$item]["tirios"]["buy"]["cost"]."/".$price[$item]["tirios"]["buy"]["count"]."(".round($price[$item]["tirios"]["buy"]["cost"]/$price[$item]["tirios"]["buy"]["count"],3).")</td>"; 
				} else echo "class=\"item\">"."---"."</td>"; 
			if ("tirios"==$bestSells[$item]) echo "<td class=\"best\">"; else echo "<td class=\"item\">";
			if (isset($price[$item]["tirios"]["sell"])) echo round($price[$item]["tirios"]["sell"]["cost"]/$price[$item]["tirios"]["sell"]["count"]-$price[$item][$bestSells[$item]]["sell"]["cost"]/$price[$item][$bestSells[$item]]["sell"]["count"],3)*64; else echo "---";
			echo "</td>";
			if ("tirios"==$bestBuys[$item]) echo "<td class=\"best\">"; else echo "<td class=\"item\">";
			if (isset($price[$item]["tirios"]["buy"])) echo -round($price[$item]["tirios"]["buy"]["cost"]/$price[$item]["tirios"]["buy"]["count"]-$price[$item][$bestBuys[$item]]["buy"]["cost"]/$price[$item][$bestBuys[$item]]["buy"]["count"],3)*64; else echo "---";
			echo "</td>";
			echo "</tr>";
			
		};
	?>
	</table>	
	<script type="text/javascript">
	    
	</script>
  </body>
</html>


<!-- -8593 71 -1069 сровнять территорию. -->