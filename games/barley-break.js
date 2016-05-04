$('#start_game').click(function(){
document.getElementById("bground").innerHTML ="";
var field = new Array();
	for (var i=0; i<6; i++) field[i] = new Array(); 
	var s = new Array("bb_0","bb_1","bb_2","bb_3","bb_4","bb_5","bb_6","bb_7","bb_8","bb_9","bb_10","bb_11","bb_12","bb_13","bb_14","bb_15");
	var i = 0;
	var cost = 14;
	for (i=1; i<5; i++) {
		for (var k=1; k<5; k++) {
			var rand = 0;
			rand = Math.round(Math.random()*cost+1); 
			field[i][k]=s[rand];
			cost --;
			if(s[rand]) {document.getElementById("bground").innerHTML +="<div class=\"cell\" id="+field[i][k]+" style=\"top:"+(i-1)*72+"px; left:"+(k-1)*72+"px;\"></div>";
			//document.write("<div class=\"cell\" id="+field[i][k]+" style=\"top:"+(i-1)*72+"px; left:"+(k-1)*72+"px;\"></div>");
			document.getElementById(s[rand]).innerText = s[rand];
			s.splice(rand,1);} else field[i][k]=0;
		}; 
	};
	
	for (var i=0; i<3; i++) {
		field[0][i] = 16;
		field[i][0] = 16;
		field[0][5-i] = 16;
		field[5-i][0] = 16;
		field[5][i] = 16;
		field[i][5] = 16;
		field[5][5-i] = 16;
		field[5-i][5] = 16;
	};
		function input_array () {
			document.getElementById('test_arr').innerHTML = "";
			for (var i=0; i<6; i++) {
				for (var k=0; k<6; k++) document.getElementById('test_arr').innerHTML += "<div style=\"display: inline-block; margin: 0px; width: 20px; height: 20px; border: 1px solid black;\">"+field[i][k]+ "</div>";
				document.getElementById('test_arr').innerHTML += "<br>";
			};
		};
		//input_array();
		function swap (i,k,l,m, snew, celltop, cellleft) {
		var b = field[i][k];
		field[i][k]=field[l][m];
		field[l][m]=b;
		var tops = "";
		for (var o=0; o<celltop.length-2; o++) tops += celltop[o];
		celltop = parseInt(tops);
		var tops = "";
		for (var o=0; o<cellleft.length-2; o++) tops += cellleft[o];
		cellleft = parseInt(tops);
		if (snew === "right") cellleft +=72; 
		if (snew === "up") celltop -=72;
		if (snew === "down") celltop +=72;
		if (snew === "left") cellleft -=72;
		return [celltop, cellleft];
	};
	function move (value, celltop, cellleft) {
		for (var i=1; i<5; i++) for (var k=1; k<5; k++) if ( field[i][k] === value) var i2 = i, k2 = k;
		if (field[i2-1][k2] === 0) return swap(i2,k2, i2-1,k2, "up", celltop, cellleft);;
		if (field[i2+1][k2] === 0) return swap(i2,k2, i2+1,k2, "down", celltop, cellleft);
		if (field[i2][k2-1] === 0) return swap(i2,k2, i2,k2-1, "left", celltop, cellleft); 
		if (field[i2][k2+1] === 0) return swap(i2,k2, i2,k2+1, "right", celltop, cellleft); 
		return false;
	};	

              function done (i,k) {
                    for (var i=1; i<5; i++) for (var k=1; k<5; k++) if ( field[i][k] != (i-1)*4+k&&field[i][k]!=0) return false;
                     return true;
                };


		$('.cell').click(function(){
		var absolute = move($(this).attr('id')), this.style.top, this.style.left);
		if (typeof(absolute)!="boolean") {
			if (this.style.top != absolute[0]+"px") $(this).animate({
			 top: absolute[0]+'px'
			}, 500);
			if (this.style.left != absolute[1]+"px") $(this).animate({
			 left: absolute[1]+'px'
			}, 500);
		};
                             if (done() ) alert ("You win");
		//input_array();
	});	

	

});	