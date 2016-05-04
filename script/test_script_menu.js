$(document).ready(function(){
	$('.menulink').attr('onclick',"return false");
	var url;
	var tf = true;
	function trues () {
	tf=true; 
	}
	$('.menulink').click(function(){
	if (url != $(this).attr('href')&&tf===true) {
		tf = false;
		setTimeout(trues, 1100);
		$('#content').css('opacity',0);
		$('#content').animate({opacity: 1}, 1000);
		var k = document.getElementById("this");
		url = $(this).attr('href');
		$('#content').load(url, "?random="+Math.random());
		k.toggleClass("this");
		k = $(this);
		k.toggleClass("this");
		}
	});
	var i = 0;
	var d = new Array();
	$('li.spoiler ul').each(function(){
		$(this).css("display", "none");
	});
	$('span.spoiler').each(function() {
		$(this).attr("id", i); i++;
		d[i]=true;
	});
		$('span.spoiler').click(function(){
			var ul = $(this).parent().children("ul");
			var i = $(this).attr("id");
			i = +i;
			if (d[i] == true) {
				ul.show('medium')
				d[i] = false;
			} else {
				d[i] = true;
				ul.hide('medium')
			}
		});
	$('.php_get').attr('onclick',"return false");
});

//setTimeout(clearInterval(animation), 30000);
//var animation = setInterval('alert("прошла секунда")', 1000);