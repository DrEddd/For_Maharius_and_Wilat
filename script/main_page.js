		$('#menu').parent().css("vertical-align", "top");
		$('#rightmenu').parent().css("vertical-align", "top");
		$('#content').parent().css("vertical-align", "top");
		var height, height_old=0, width, width_old=0;
		function resize() {
		//	height = document.documentElement.clientHeight - $('#bottom').height()*1.3;
		//	width = document.documentElement.clientWidth - 345;
			if( typeof( window.innerWidth ) == 'number' ) {
				//Non-IE
				width = window.innerWidth;
				height = window.innerHeight;
			 } else if( document.documentElement && ( document.documentElement.clientWidth ||document.documentElement.clientHeight ) ) {
				//IE 6+ in 'standards compliant mode'
				width = document.documentElement.clientWidth;
				height = document.documentElement.clientHeight;
			} else if( document.body && ( document.body.clientWidth || document.body.clientHeight ) ) {
				//IE 4 compatible
				width = document.body.clientWidth;
				height = document.body.clientHeight;
			}
			height = height - $('#bottom').height()*1.3;
			width = width - 345;
			if ((height > height_old+100||height < height_old - 100)&&height>$('#content').height()+100) {
				height_old = height;
				$('#content').css("height", height);
			}
			if (width > width_old+100||width < width_old - 100) {
				width_old = width;
				$('#content').css("width", width);
			}
			clearInterval(firstsec)
		}
		setInterval(resize, 1000);
		var firstsec = setInterval (resize, 50);
		$('input').click(function(){
			if ($(this).attr('value') === "Script loaded") $('input').attr('value', '');
		});
		function hide_block () {
			 $('#block').css("display", "none")
		};
			$('#block').animate({
				opacity: 1
			},1500/*, hide_block*/);
			//Изменить #block на #all; Сделать изначельно opacity 0, потом - 1;