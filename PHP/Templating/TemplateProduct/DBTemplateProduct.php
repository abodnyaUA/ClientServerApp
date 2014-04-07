<?php

class DBTemplateProduct
{
	public $css = array("/Style/dstudio_style.css", "/Style/lightbox.css");
	public $js = array("/JS/LightBox/jquery-1.7.2.min.js", "/JS/LightBox/lightbox.js");
	public $header;
	public $footer;
	
	
	public static function create()
	{
		$template = new DBTemplateProduct();
		
		// All pages for menu
		$sql = SQL("select * from `dStudioSite`.`Page` where 1 limit 0,10",null);
		$pages = $sql->arrayObjectsOfType("DBPage");
		
		ob_start();
		include_once $_SERVER['DOCUMENT_ROOT']."/PHP/Templating/TemplateProduct/header.php";
		$template->header = ob_get_clean();

		ob_start();
		include_once $_SERVER['DOCUMENT_ROOT']."/PHP/Templating/TemplateProduct/footer.php";
		$template->footer = ob_get_clean();
				
		return $template;
	}
	
	public function adaptedPageContent($page)
	{
		ob_start();
		include_once $_SERVER['DOCUMENT_ROOT']."/PHP/Templating/TemplateProduct/contentProcessing.php";
		$content = ob_get_clean();
		return $content;
	}
	
}

?>