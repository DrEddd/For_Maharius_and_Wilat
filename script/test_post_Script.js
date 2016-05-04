$(document).ready(function(){
	$('button').click(function(event){
		var parent = $(this).parent('form');
		var url = parent.attr('action');
		var input = jQuery(parent).children("table tr td input");
		var i,k,name,value;
		var get = new Object();
		for (i=0; i<input.length; i++) {
			name = input[i].name;
			value = input[i].value;
			get[name]=value;
		};
		$('#content').load(url, get);
		});
});