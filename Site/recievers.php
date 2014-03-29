<!DOCTYPE html>
<head>
	<link rel="stylesheet" href="../Style/style.css" type="text/css"  />
	<script type="text/javascript" src="recievers.js"></script>
	<script type="text/javascript" src="../JS/addBar.js"></script>
	<?php include_once $_SERVER['DOCUMENT_ROOT']."/PHP/Templating/recievers.php"; ?>
</head>
<body>
	<div id="background">
	   	<p><input type="button" value="Add new reciever" onclick="showBar()" id="callNewModelPanelButton"></p>
		<table>
		<tbody id="dataTable">
			<tr>
				<td class="header"><b>Name</b></td>
				<td class="header"><b>Bank</b></td>
				<td class="header"><b>Phone</b></td>
				<td class="header"><b>Adress</b></td>
				<td class="header"><b>Archived</b></td>
			</tr>
			{foreach $recievers as $reciever}
			<tr>
				<td><?=$reciever->reciever_name?></td>
				<td><?=$reciever->account?></td>
				<td><?=$reciever->phone?></td>
				<td><?=$reciever->adress?></td>
				<td><?=$reciever->reciever_archived > 0 ? "YES" : "NO"?></td>
			</tr>
			{/foreach}
		</tbody>
		</table>
	</div>

	<div id="bar" onload="clearBar()">
	    <div class="addModelTitle">Add new Reciever</div><p/>
	    Name
	    <input type="text" id="name"><p/>
	    Bank account
	    <input type="text" id="bank"><p/>
	    Phone
	    <input type="text" id="phone"><p/>
	    Adress
	    <input type="text" id="adress"><p/>
	    <div class="radiobuttonsGroup">
		    <input type="radio" name="archived" checked="checked" id="archived_yes"/>
		    <label for="archived_yes" id="radioLabel">In Archive</label> 
		    <input type="radio" name="archived" id="archived_no"/>
		    <label for="archived_no" id="radioLabel">Active</label>
	    </div><p/>
	    <input type="button" id="addPanelButton" value="Add" onclick="didTapAddButton()">
	    <input type="button" id="addPanelButton" value="Don't add" onclick="hideBar()">
	</div>
</body>
</html>