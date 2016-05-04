<html>
<head>
	<meta http-equiv="content-type" charset="UTF-8">
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js"></script>
	<style>
	.cell {
		height: 70px;
		width: 70px;
		margin: 1px;
		background-color: #7fc7ff;
		display: inline-block;
		position: absolute;
		text-align: center;
		font-size: 55px;
	}
	#bground {
		position: relative;
		background: blue;
		width: 288px;
		height: 288px;
	}
	
	#bgoth {
		position: relative;
		width: 288px;
		height: 300px;
		left: 30%;
	}
	
	#start_game {
		position: relative;
		left: 100px;
	}
	</style>
</head>
<body>
	<div id="bgoth">
	
	<button id="start_game">Начать игру.</button><br>
	<div id="bground">	<script type="text/javascript" src="/games/barley-break.js"></script>	</div>
	<div id="test_arr"></div>
	</div>
</body>
</html>	
