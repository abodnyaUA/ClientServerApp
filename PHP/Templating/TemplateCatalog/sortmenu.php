<!-- Display Sort menu -->
<div class="separateLine"></div>
<div class="menu">Sort by: 
	<span class=<?=($sortField == "title") ? "menuSelectedEntry" : "menuDefaultEntry"?>>
		<a class="menuLink" href="/?page=<?=$parent->name?>
		&sortBy=title&sortAsc=<?=$sortAsc?>&displayType=<?=$catalogView?>">Title</a>
	</span> / 
	<span class=<?=($sortField == "name") ? "menuSelectedEntry" : "menuDefaultEntry"?>>
		<a class="menuLink" href="/?page=<?=$parent->name?>
		&sortBy=name&sortAsc=<?=$sortAsc?>&displayType=<?=$catalogView?>">Name</a>
	</span> / 
	<span class=<?=($sortField == "createDate") ? "menuSelectedEntry" : "menuDefaultEntry"?>>
		<a class="menuLink" href="/?page=<?=$parent->name?>
		&sortBy=createDate&sortAsc=<?=$sortAsc?>&displayType=<?=$catalogView?>">Date</a>
	</span> 
	<span class="separator">|</span> 
	<span class=<?=($sortAsc == 1) ? "menuSelectedEntry" : "menuDefaultEntry"?>>
		<a class="menuLink" href="/?page=<?=$parent->name?>
		&sortBy=<?=$sortField?>&sortAsc=1&displayType=<?=$catalogView?>">Ascending</a>
	</span> / 
	<span class=<?=($sortAsc == 0) ? "menuSelectedEntry" : "menuDefaultEntry"?>> 
		<a class="menuLink" href="/?page=<?=$parent->name?>
		&sortBy=<?=$sortField?>&sortAsc=0&displayType=<?=$catalogView?>">Descending</a>
	</span> 
</div>
<div class="menu">Display as:
	<span class=<?=($catalogView == DBTemplateCatalog::$kDisplayAsGallery) ? "menuSelectedEntry" : "menuDefaultEntry"?>>
		<a class="menuLink" href="/?page=<?=$parent->name?>
		&sortBy=<?=$sortField?>&sortAsc=<?=$sortAsc?>&displayType=<?=DBTemplateCatalog::$kDisplayAsGallery?>">Gallery</a>
	</span> 
	<span class="separator">|</span> 
	<span class=<?=($catalogView == DBTemplateCatalog::$kDisplayAsList) ? "menuSelectedEntry" : "menuDefaultEntry"?>>
		<a class="menuLink" href="/?page=<?=$parent->name?>
		&sortBy=<?=$sortField?>&sortAsc=<?=$sortAsc?>&displayType=<?=DBTemplateCatalog::$kDisplayAsList?>">List</a>
	</span> 
</div> 