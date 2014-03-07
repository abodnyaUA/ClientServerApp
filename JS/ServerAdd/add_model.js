function addNewModel(name,count,price,archived,callback) 
{	
	var request = new XMLHttpRequest();
	var url = "http://localhost/PHP/ServerAPI/add_model.php?name="+name+
	"&count="+count+"&price="+price+"&archived="+archived;
	request.open("GET",url);
	request.onreadystatechange = function()
	{
		if (4 == request.readyState && 200 == request.status)
		{
			var data = JSON.parse(request.responseText);
			callback(data.success,data.error);
		}
	};
	request.send(null);
};
