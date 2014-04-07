<?php

include_once $_SERVER['DOCUMENT_ROOT']."/PHP/Database/DBController.php";
include_once $_SERVER['DOCUMENT_ROOT']."/PHP/Templating/DBPage.php";
include_once $_SERVER['DOCUMENT_ROOT']."/PHP/Templating/TemplateProduct/DBTemplateProduct.php";
include_once $_SERVER['DOCUMENT_ROOT']."/PHP/Templating/TemplateError/DBTemplateError.php";

class DBPageBuilder 
{
	/*************** Base Init *****************/
	
	protected static $_instance;
	private function __construct() {}
	private function __clone() {}
	
	public static function sharedBuilder()
	{
		if (null === self::$_instance)
		{
			$instance = self::$_instance = new self();
		}
		return self::$_instance;
	}
	
	public function pageContent($pageName) 
	{
		$page = $this->page($pageName);
		$template = null;
		if (null != $page)
		{
			$template = $this->template($page->template);
		}
		else
		{
			$template = DBTemplateError::create(404);	
		}
		return $this->buildPage($page, $template);
	}
	
	public function defaultPage()
	{
		$template = DBTemplateProduct::create();
		return $this->buildPage(null, $template);
	}
	
	public function notFoundPage()
	{
		return $this->buildPage(null, $template);
	}
	
	private function page($pageName)
	{
		$sql = SQL("select * from `dStudioSite`.`Page`
			where `Page`.`name` = :pageName",
			array ("pageName" => $pageName));
		$pages = $sql->arrayObjectsOfType("DBPage");
		if (count($pages) != 0)
		{
			$page = $pages[0];
			return $page;
		}
		else
		{
			return null;	
		}
	}
	
	private function template($templateID)
	{
			
		$sql = SQL("select * from `dStudioSite`.`Template`
			where `Template`.`templateID` = :templateID",
			array ("templateID" => $templateID));
		$templates = $sql->arrayPHP();
		if (count($templates) != 0)
		{
			$template = $templates[0];
			$templateClass = $template["templateClass"];
			$templateInstance = $templateClass::create();
			return $templateInstance;
		}
		else
		{
			return $template = DBTemplateError::create(500);
		}
	}
	
	private function buildPage($page, $template)
	{
		$content = 
		"<!doctype=html>
		<html>
		<head>
			<meta http-equiv='content-type' content='text/html; charset=utf-8' />
			<title>d-Studio - Unofficial site";
		if (null != $page)
		{
			$content .= " - ".$page->title;
		}
		$content .=  "</title>";
		
		foreach ($template->css as $css) 
		{
			$content .=	"<link rel='stylesheet' href='".$css."' type='text/css'/>";
		}
		foreach ($template->js as $js)
		{
			$content .= "<script src='".$js."'></script>";
		}
		if (null != $page)
		{
			$content .=	"<style>".$page->aditional_css."</style>";
			$content .= "<script>".$page->additional_js."</script>";			
		}
		$content .= "</head>";
		
		$content .= "<body>";
		$content .= $template->header;
		if (null != $page)
		{
			$content .= $template->adaptedPageContent($page);
		}
		$content .= $template->footer;
		$content .= "</body> </html>";
		return $content;
	}
}

?>