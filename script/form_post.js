	$(document).ready(function(){
	$('input').attr('value', 'today');
		$('button').click(function(event){
		var parent = $(this).parent();
		var url = parent.attr('action');
		var input = jQuery(parent).children("input");
		var i,k,name,value;
		var get = new Object();
		for (i=0; i<input.length; i++) {
			name = input[i].name;
			value = input[i].value;
			get[name]=value;
		};
		for (i=0; i<input.length; i++) {
			};
		$('#content').load(url, get);
		});
});