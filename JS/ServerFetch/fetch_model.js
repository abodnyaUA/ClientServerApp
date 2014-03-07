function allModels(callback) 
{	
	var request = new XMLHttpRequest();
	request.open("GET","http://localhost/PHP/ServerAPI/model.php");
	request.onreadystatechange = function()
	{
		if (4 == request.readyState && 200 == request.status)
		{
			var data = JSON.parse(request.responseText);
			callback(data.data);
		}
	};
	request.send(null);
};
