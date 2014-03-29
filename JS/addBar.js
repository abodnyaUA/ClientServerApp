
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
		exist = e.target.id == "radioLabel" || e.target.id == "archived_no" || e.target.id == "archived_yes" || e.target.id == "addPanelButton";
	}
	if (!exist)
	{
		exist = e.clientX < 228;
	}
    if (!exist)
    {
        hideBar();
    } 
}

/* Display left-side "New model" panel */
function showBar() 
{   
	document.getElementById("bar").style.left = "0em";
	document.getElementById("content").style.left = "14.5em";
}

/* Hide left-side "New model" panel */
function hideBar() 
{   
	document.getElementById("bar").style.left = "-15em";
	document.getElementById("content").style.left = "0.5em";
}

function valueWithName(name)
{
	var parameter = document.getElementById(name).value;
	if (parameter == "")
	{
		alert("All fields are requirement! Please fill '"+name+"'' field.");
		document.getElementById(name).focus();
		throw new Error("Invalid Field");
	}
	return parameter;
}