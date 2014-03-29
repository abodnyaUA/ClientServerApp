function addNewReciever(name,bank,phone,adress,archived,callback) 
{	
	var request = new XMLHttpRequest();
	var url = "http://localhost/PHP/ServerAPI/add_reciever.php?name="+name+
	"&account="+bank+"&adress="+adress+"&phone="+phone+"&archived="+archived;
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
