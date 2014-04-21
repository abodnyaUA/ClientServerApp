<?php

class DBTemplateCatalog
{
	public $css = array("/Style/dstudio_style.css");
	public $js = array();
	
	private static $kDisplayAsGallery = 1;
	private static $kDisplayAsList = 2;
		
	public function content($parent)
	{
		$sortField = isset($_GET["sortBy"]) && isset($parent->$_GET["sortBy"]) ? $_GET["sortBy"] : $parent->sortChildsField;
		$sortAsc = isset($_GET["sortAsc"]) ? $_GET["sortAsc"] : $parent->sortAscending;
		$sql = DSQL("select * from `dStudioSite`.`Page` where `Page`.`parentPage` = :pageID 
			order by ".$sortField." ".($sortAsc ? "asc" : "desc"),
			array("pageID" => $parent->id));
		$pages = $sql->arrayObjectsOfType("DBPage");
		$catalogView = isset($_GET["displayType"]) && intval($_GET["displayType"]) > 0 
						&& intval($_GET["displayType"]) <= 2 ? intval($_GET["displayType"]) : 1;
				
		ob_start();
		include_once $_SERVER['DOCUMENT_ROOT']."/PHP/Templating/TemplateCatalog/sortmenu.php";
		switch ($catalogView) 
		{
			case DBTemplateCatalog::$kDisplayAsGallery:
			include_once $_SERVER['DOCUMENT_ROOT']."/PHP/Templating/TemplateCatalog/catalogGallery.php";
			break;
			
			case DBTemplateCatalog::$kDisplayAsList:
			include_once $_SERVER['DOCUMENT_ROOT']."/PHP/Templating/TemplateCatalog/catalogList.php";
			break;
			
			default:
			break;
		}
		$content = ob_get_clean();
		return $content;
	}
	
}

?>