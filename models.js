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
include("JS/ServerFetch/fetch_model.js");
include("JS/ServerAdd/add_model.js");

/******************** 
 * Table with models' data 
 ********************/

var entries = [];

/* Add entry to table */
function addEntryToTable(entry)
{
	var newLine = "<tr>";
	newLine += "<td>"+entry.name+"</td>";
	newLine += "<td>"+entry.price+"</td>";
	newLine += "<td>"+entry.count+"</td>";
	newLine += "<td>"+(entry.model_archived > 0 ? "YES" : "NO")+"</td>";
	newLine += "</tr>";
	document.getElementById("dataTable").innerHTML += newLine;
	entries.push(entry);
}

/* Updating data from table */
function updateTable() 
{
	allModels(function (entries) 
	{
		for (var i = 0; i < entries.length; i++) 
		{
			addEntryToTable(entries[i]);
		};
	});					
}

function addLastModel()
{
	allModels(function (entries) 
	{
		var lastDate = entries[0].model_creationDate;
		var lastModelIndex = 0;
		for (var i = 1; i < entries.length; i++) 
		{
			if (lastDate < entries[i].model_creationDate)
			{
				lastDate = entries[i].model_creationDate;
				lastModelIndex = i;
			}
		};
		addEntryToTable(entries[lastModelIndex]);
	});	
}

/******************** 
 * "New model" panel 
 ********************/

window.onclick = function(e) 
{
	var exist = e.target == document.getElementById("bar");
	var array = document.getElementById("bar").childNodes;
	for (var i = 0; i < array.length; i++) 
	{
		if (array[i] == e.target)
		{
			exist = true;
		}
	};
	if (!exist)
	{
		exist = e.target == document.getElementById("callNewModelPanelButton");
	}
    if (!exist)
    {
        hideNewModelPanel();
    } 
}

/* Display left-side "New model" panel */
function showNewModelPanel() 
{   
	document.getElementById("bar").style.left = "0em";
}

/* Hide left-side "New model" panel */
function hideNewModelPanel() 
{   
	document.getElementById("bar").style.left = "-15em";
}

/* Clear left-side "New model" panel */
function clearModelPanel()
{
	document.getElementById("name").value = "";
	document.getElementById("count").value = "";
	document.getElementById("price").value = "";
	document.getElementById("archived_yes").checked = "checked";
	document.getElementById("archived_no").checked = "";
}

function valueWithName(name)
{
	var parameter = document.getElementById(name).value;
	if (parameter == "")
	{
		alert("All fields are requirement! Please fill '"+name+"'' field.");
		throw new Error("Invalid Field");
	}
	return parameter;
}

/* Event-handler "User did tap on 'Add' button in 'New Model' panel" */
function didTapAddButton()
{
	var name = valueWithName("name");
	var count = valueWithName("count");
	var price = valueWithName("price");
	var archived = document.getElementById("archived_yes").checked ? "1" : "0";
	if ("" != name && "" != count && "" != price && "" != archived)
	{
	// alert("name = "+name+"; count = "+count+"; price = "+price+"; archived = "+archived);
		addNewModel(name,count,price,archived,function (success, error) 
		{
			hideNewModelPanel();
			clearModelPanel();
			if (success)
			{
				addLastModel();
			}
			else
			{
				alert(error);
			}
		});
	}
}
