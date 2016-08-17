function test_feed() {
	
	var data = $('form').serializeArray();
	
	console.log(data);
	
	$.ajax({
		type: "POST",
		url: "api/index.php?uri=feed/test",
		crossDomain: true,
		data: {'feed': data},
		dataType: "json",
		success: function (data, status, jqXHR)
		{
			var sendit = true;
			if(data.xml) {
				$('#htmlbox').append(data.html);
				if(data.title) 
					$('#infobox').append("<p>Title: "+data.title[0]+"</p>");
				else
					sendit = false;
				if(data.url) 
					$('#infobox').append("<p>Article: <a href='"+data.url[0]+"'>"+data.url[0]+"</a></p>");
				else
					sendit = false;
			}
			else if(data.html) {
				$('#htmlbox').append(data.html);
				if(data.date) 
					$('#infobox').append("<p>Published: "+data.date+"</p>");
				else
					sendit = false;
				if(data.url) 
					$('#infobox').append("<p>Article: <a href='"+data.url+"'>"+data.url+"</a></p>");
				else
					sendit = false;
			} else {
				sendit = false;
			}
			
			if(sendit){
				$('#send-feed').show();
			}
		}
	});
}

function send_feed() {
	var data = $('form').serializeArray();
	
	console.log(data);
	
	$.ajax({
		type: "POST",
		url: "api/index.php?uri=feed/add",
		crossDomain: true,
		data: {'feed': data},
		dataType: "json",
		success: function (data, status, jqXHR)
		{
			if(data.added)
				console.log('ya');
			else
				console.log('nah');
		}
	});
}