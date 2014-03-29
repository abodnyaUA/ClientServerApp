<!DOCTYPE html>
<head>
	<link rel="stylesheet" href="../Style/style.css" type="text/css"  />
	<script type="text/javascript" src="../models.js"></script>
	<script type="text/javascript" src="../JS/addBar.js"></script>
	<?php include_once $_SERVER['DOCUMENT_ROOT']."/PHP/Templating/models.php"; ?>
</head>
<body>
	<div id="content">
		<?php if (count($models) > 0) : ?>
		   	<input type="button" value="Add new model" onclick="showBar()" id="callNewModelPanelButton">
			<table>
				<tbody id="dataTable">
					<tr>
						<td class="header"><b>Name</b></td>
						<td class="header"><b>Price</b></td>
						<td class="header"><b>Count</b></td>
						<td class="header"><b>Archived</b></td>
					</tr>
					<?php foreach ($models as $model): ?>
						<tr>
							<td><?=$model->model_name?></td>
							<td><?=$model->price?></td>
							<td><?=$model->count?></td>
							<td><?=$model->model_archived > 0 ? "YES" : "NO"?></td>
						</tr>
					<? endforeach; ?>
				</tbody>
			</table>
		<?php else : ?>
			<div class="emptyData">
				<p/>There aren't any model. Do you want some?<p/>
		   		<input type="button" value="Add new model" onclick="showBar()" id="callNewModelPanelButton">
			</div>
		<?php endif; ?>
	</div>

	<div id="bar" onload="clearBar()">
	    <div class="addModelTitle">Add new Model to warehouse</div><p/>
	    Name
	    <input type="text" id="name"><p/>
	    Price
	    <input type="number" id="price"><p/>
	    Count
	    <input type="number" id="count"><p/>
	    <div class="radiobuttonsGroup">
		    <input type="radio" name="archived" id="archived_yes"/>
		    <label for="archived_yes" id="radioLabel">In Archive</label> 
		    <input type="radio" name="archived" checked="checked" id="archived_no"/>
		    <label for="archived_no" id="radioLabel">Active</label>
	    </div><p/>
	    <input type="button" id="addPanelButton" value="Add" onclick="didTapAddButton()">
	    <input type="button" id="addPanelButton" value="Don't add" onclick="hideBar()">
	</div>
</body>
</html>