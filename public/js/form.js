$(document).ready(function(){
	$('form').submit(function(event){
		let json;
		event.preventDeafult();
		$.ajax({
			type: $(this).attr('method'),
			url: $(this).attr('action'),
			data: new FormData(this),
			contentType: false,
			cache: false,
			processData: false,
			success: function(data){
				json = jQuery.parseJSON(data);
				if(json.url)
				{
					window.location.href = '/simple_blog/'+json.url;
				}
				else
				{
					alert(json.status+' - '+json.message);
				}
			}
		});
	});
});