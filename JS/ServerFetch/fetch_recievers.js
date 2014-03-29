function allRecievers(callback) 
{	
	var request = new XMLHttpRequest();
	request.open("GET","http://localhost/PHP/ServerAPI/recievers.php");
	request.onreadystatechange = function()
	{
		if (4 == request.readyState && 200 == request.status)
		{
			alert(request.responseText);
			var data = JSON.parse(request.responseText);
			callback(data.data);
		}
	};
	request.send(null);
};
