<!DOCTYPE html>
<head>
	<link rel="stylesheet" href="models.css" type="text/css"  />
	<script type="text/javascript" src="models.js"></script>
	<?php include_once "../www/PHP/Database/DBController.php"; ?>
</head>
<body>
	<div id="background">
   	<p><input type="button" value="Add new model" onclick="showNewModelPanel()" id="callNewModelPanelButton"></p>
	<table><?php

	// $directory = getcwd();
	// $it = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($directory));

	// while($it->valid()) {

	//     if (!$it->isDot()) {

	//         echo 'SubPathName: ' . $it->getSubPathName() . "<br>";
	//         echo 'SubPath:     ' . $it->getSubPath() . "<br>";
	//         echo 'Key:         ' . $it->key() . "<br><br>";
	//     }

	//     $it->next();
	// }

	?>
	<?php echo getcwd()."<br>"; ?>
	<?php $models = DBController::sharedController()->fetch->model->all(); ?>
	<h1><?php print_r($models); ?></h1>
	<tbody id="dataTable">
		<tr>
			<td><b>Name</b></td>
			<td><b>Price</b></td>
			<td><b>Count</b></td>
			<td><b>Archived</b></td>
		</tr>
	</tbody>
	</table>
	</div>

	<div id="bar">
	    Add new Model to warehouse
	    <p>Name</p>
	    <input type="text" id="name">
	    <p>Price</p>
	    <input type="number" id="price">
	    <p>Count</p>
	    <input type="number" id="count">
	    <p></p>
	    <input type="radio" name="archived" checked="checked" id="archived_yes"/><label for="archived_yes">In Archive</label> 
	    <input type="radio" name="archived" id="archived_no"/><label for="archived_no">Active</label>
	    <p></p>
	    <input type="button" class="addPanelButton" value="Add" onclick="didTapAddButton()">
	    <input type="button" class="addPanelButton" value="Don't add" onclick="hideNewModelPanel()">
	</div>
</body>
</html>