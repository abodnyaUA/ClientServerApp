/*
* @method include
* Include another Javascript File
*/
function include(filename)
{
    var head = document.getElementsByTagName('head')[0];

    var script = document.createElement('script');
    script.src = filename;
    script.type = 'text/javascript';

    head.appendChild(script)
}

/* Include JS with Fetch and Add methods */
include("../JS/ServerFetch/fetch_recievers.js");
include("../JS/ServerAdd/add_reciever.js");

/******************** 
 * Table with models' data 
 ********************/

/* Add entry to table */
function addEntryToTable(entry)
{
	var newLine = "<tr>";
	newLine += "<td>"+entry.reciever_name+"</td>";
	newLine += "<td>"+entry.account+"</td>";
	newLine += "<td>"+entry.phone+"</td>";
	newLine += "<td>"+entry.adress+"</td>";
	newLine += "<td>"+(entry.reciever_archived > 0 ? "YES" : "NO")+"</td>";
	newLine += "</tr>";
	document.getElementById("dataTable").innerHTML += newLine;
}

function addLastReciever()
{
	allRecievers(function (entries) 
	{
		addEntryToTable(entries[entries.length-1]);
	});	
}

/******************** 
 * "New model" panel 
 ********************/

/* Event-handler "User did tap on 'Add' button in 'New Model' panel" */
function didTapAddButton()
{
	var name = valueWithName("name");
	var adress = valueWithName("adress");
	var phone = valueWithName("phone");
	var bank = valueWithName("bank");
	var archived = document.getElementById("archived_yes").checked ? "1" : "0";
	if ("" != name && "" != adress && "" != phone && "" != bank && "" != archived)
	{
	// alert("name = "+name+"; count = "+count+"; price = "+price+"; archived = "+archived);
		addNewReciever(name,bank,phone,adress,archived,function (success, error) 
		{
			hideBar();
			clearBar();
			if (success)
			{
				var emptyTable = document.getElementById("dataTable") == null;
				if (emptyTable)
				{
					alert("EMPTY!");
				}
				else
				{
					addLastReciever();
				}
			}
			else
			{
				alert(error);
			}
		});
	}
}
