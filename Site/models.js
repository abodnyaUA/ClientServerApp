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
include("/JS/ServerFetch/fetch_model.js");
include("/JS/ServerAdd/add_model.js");

/******************** 
 * Table with models' data 
 ********************/

/* Add entry to table */
function addEntryToTable(entry)
{
	var newLine = "<tr>";
	newLine += "<td>"+entry.model_name+"</td>";
	newLine += "<td>"+entry.price+"</td>";
	newLine += "<td>"+entry.count+"</td>";
	newLine += "<td>"+(entry.model_archived > 0 ? "YES" : "NO")+"</td>";
	newLine += "</tr>";
	document.getElementById("dataTable").innerHTML += newLine;
}

function addLastModel()
{
	allModels(function (entries) 
	{
		addEntryToTable(entries[entries.length-1]);
	});	
}

/******************** 
 * "New model" panel 
 ********************/


/* Clear left-side "New model" panel */
function clearBar()
{
	document.getElementById("name").value = "";
	document.getElementById("price").value = "";
	document.getElementById("count").value = "";
	document.getElementById("archived_yes").checked = "";
	document.getElementById("archived_no").checked = "checked";
}

/* Event-handler "User did tap on 'Add' button in 'New Model' panel" */
function didTapAddButton()
{
	var name = valueWithName("name");
	var price = valueWithName("price");
	var count = valueWithName("count");	
	var archived = document.getElementById("archived_yes").checked ? "1" : "0";
	if ("" != name && "" != count && "" != price && "" != archived)
	{
	// alert("name = "+name+"; count = "+count+"; price = "+price+"; archived = "+archived);
		addNewModel(name,count,price,archived,function (success, error) 
		{
			hideBar();
			clearBar();
			if (success)
			{
				var emptyTable = document.getElementById("dataTable") == null;
				if (emptyTable)
				{
					window.location.reload();
				}
				else
				{
					addLastModel();
				}
			}
			else
			{
				alert(error);
			}
		});
	}
}
