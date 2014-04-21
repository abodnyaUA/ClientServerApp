<?php

include_once $_SERVER['DOCUMENT_ROOT']."/PHP/Templating/System/DBMenu.php";

class DBSystem 
{
	private static function menuList($page, &$existarray)
	{
		if ($page->id != 0)
		{
			$sql = SQL("select * from `dStudioSite`.`Page` where `Page`.`parentPage` = :parent",
				array("parent" => $page->parentPage));
			$pages = $sql->arrayObjectsOfType("DBPage");
			$menus = array();
			foreach ($pages as $pageOnLevel)
			{
				if ($pageOnLevel->id != 0)
				{
					array_push($menus, DBMenuEntry::entry($pageOnLevel, $pageOnLevel->id == $page->id));
				}
			}
			array_push($existarray, $menus);
			
			$sql = SQL("select * from `dStudioSite`.`Page` where `Page`.`id` = :parent",
				array("parent" => $page->parentPage));
			$parents = $sql->arrayObjectsOfType("DBPage");
			DBSystem::menuList($parents[0], $existarray);
		}
	}
	
	private static function menuRecursive($selectedPage)
	{
		$menus = array(); 
		$sql = SQL("select * from `dStudioSite`.`Page` where `Page`.`parentPage` = :parent",
			array("parent" => $selectedPage->id));
		$childPages = $sql->arrayObjectsOfType("DBPage");
		if (count($childPages) > 0)
		{
			$childMenus = array();
			foreach ($childPages as $pageOnLevel)
			{
				array_push($childMenus, DBMenuEntry::entry($pageOnLevel, false));
			}
			array_push($menus, $childMenus);
		}
		DBSystem::menuList($selectedPage, $menus);
		$menus = array_reverse($menus);
		return $menus;
	}
	
	public static function menu($selectedPage) 
	{
		$menus = DBSystem::menuRecursive($selectedPage);
		ob_start();
		include_once $_SERVER['DOCUMENT_ROOT']."/PHP/Templating/System/menu.php";
		$content = ob_get_clean();
		return $content;
	}
	
	public static function header()
	{
		ob_start();
		include_once $_SERVER['DOCUMENT_ROOT']."/PHP/Templating/System/header.php";
		$content = ob_get_clean();
		return $content;
	}
	
	public static function footer()
	{
		ob_start();
		include_once $_SERVER['DOCUMENT_ROOT']."/PHP/Templating/System/footer.php";
		$content = ob_get_clean();
		return $content;
	}
}
?>
