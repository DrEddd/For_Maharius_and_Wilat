<html>
<head>
	<meta http-equiv="content-type" charset="UTF-8">
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js"></script>
</head>

<style>
	.alive {
		background-color: black;
	}
	.ceil {
		margin:0px;
		padding:0px;
		display:inline-block;
		color: red;
	}
	#menu {
		border: 1px solid black;
	}
</style>

<?php
	if (isset($_GET["width"])) $width=$_GET["width"]; else $width=20;
	if (isset($_GET["height"])) $height=$_GET["height"]; else $height=15;
	if (isset($_GET["delay"])) $delay=$_GET["delay"]; else $delay = 100;
?>

<body>
	<table style="width:100%" height="100%" id="main_gameoflife">
	<tr height = "30px" width="100%" style="border: 1px dashed black; vertical-align: middle; text-align: center; font-size: 29px"><td><a href="javascript:window.location.reload()">Рестарт</a></td></tr>
	<tr><td id="body"><br></td><!--<td id="menu"></td>--></tr>
	</table>
	<div id="test"></div>
	<script>
	$(document).ready(function(){
		var countWidth=<?php echo $width;?>;
		var delay = <?php echo $delay; ?>;
		var countHeight=<?php echo $height;?>;
		var sizeWidth=100/(countWidth)+"%";
		var sizeHeight=100/countHeight+"%";
		var last = new Array();
		var next = new Array();
		for (i=0; i<=countHeight+1; i++) {
			last[i]=new Array();
			next[i]=new Array();
			for (j=0; j<=countWidth+1; j++)  {next[i][j]=0; last[i][j]=0; };
			}
		var table = document.getElementById("body");
		for (var i=1; i<=countHeight; i++) {
			for (var j=1; j<=countWidth; j++) {
				var id=i+"and";
				if (i<10) id="0"+id;
				if (j<10) id+="0";
				id+=j;
				var k=Math.round(Math.random());
				if (k) table.innerHTML+="<div class=\"ceil alive\" id=\""+id+"\">"+"</div>"; else table.innerHTML+="<div class=\"ceil\" id=\""+id+"\">"+"</div>";
				last[i][j]=k;
				////document.getElementById("test").innerHTML+=last[i][k]+" ";
			};
			////document.getElementById("test").innerHTML+="<br>";
			table.innerHTML+="<br>";
		};
		$(".ceil").each(function() {
			$(this).css("height", sizeHeight);
			$(this).css("width", sizeWidth);
		});
		//$('#menu').attr("width", "20%");
		//$('#menu').attr("height", "100%");
	
		function alive(i,j) {
			var cont=0;
			if (last[(i+1)%countHeight][(j)%countWidth]) cont++;
			if (last[(i-1+countHeight)%countHeight][(j)%countWidth]) cont++;
			if (last[(i+1)%countHeight][(j+1)%countWidth]) cont++;
			if (last[(i+1)%countHeight][(j-1+countWidth)%countWidth]) cont++;
			if (last[(i-1+countHeight)%countHeight][(j+1)%countWidth]) cont++;
			if (last[(i-1+countHeight)%countHeight][(j-1+countWidth)%countWidth]) cont++;
			if (last[(i)%countHeight][(j+1)%countWidth]) cont++;
			if (last[(i)%countHeight][(j-1+countWidth)%countWidth]) cont++;
			return cont;
		};
		function display() {
		//alert("display");
			$('.ceil').each(function(){
				
				var id = $(this).attr('id'); 
				//alert (id);
				var i = id[0]+id[1];
				var j = id[5]+id[6];
				//alert(i+" "+j);
				i = parseInt(i);
				j = parseInt(j);
				//alert(i+" "+j);
				if (last[i][j]==1) {
					$(this).attr("class", "ceil alive"); 
					//$(this).css("background-color", "rgb("+Math.round(Math.random()*1000%255)+","+Math.round(Math.random()*1000%255)+","+Math.round(Math.random()*1000%255)+")");
				}else { 
					$(this).attr("class", "ceil"); 
					//$(this).css("background-color", "white");
				};
				//alert(last[i][j]+" "+next[i][j]);
			});
		};
		
		function nextStep() {
			//alert("nextStep");
			for (i=0; i<=countHeight+1; i++) for(j=0; j<=countWidth+1; j++)
			 last[i][j]=next[i][j];
		};
		
		function update() {
		//alert("update");
		//document.getElementById("test").innerHTML+="<br>";
		//document.getElementById("test").innerHTML+="<br>";
			for(i=1; i<=countHeight; i++) {
			  for (j=1; j<=countWidth; j++) {
				var cont = alive(i,j);
				if (cont==3) next[i][j]=1; else 
				  if (cont!=2) next[i][j]=0; 
				  else next[i][j]=last[i][j];
				  //document.getElementById("test").innerHTML+=next[i][j]+"or"+cont+" ";
				//alert (last[i][j]+" "+next[i][j]);
			  };
			  //document.getElementById("test").innerHTML+="<br>";
			  };
			nextStep();
			display();
			//document.getElementById("test").innerHTML+="<br>";
			//document.getElementById("test").innerHTML+="<br>";
			/*for (i=1; i<=20; i++) {
				for(j=1; j<=20; j++) //document.getElementById("test").innerHTML+=last[i][j]+"and"+next[i][j]+" ";
				//document.getElementById("test").innerHTML+="<br>";
				};*/
		};
		window.setInterval(update, delay);
		//window.setTimeOut(update, 5000);
	});
	</script>
</body>
</html>	
