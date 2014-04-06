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
		$sql = SQL("select * from `dStudioSite`.`Page` where 1",null);
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
		$content = "<div class='logoElement'><img src='/DataBase/images/".$page->name."/logo.png'></div>
		<div class='description'>
		<h3>".$page->title."</h3>
		<span class='simpleText' id='descriptionFromText'>".
		$page->content.
		"</span>
		<h4>Screenshots:</h4>";
		for ($i = 1; $i < 4; $i++) 
		{
			$adress = "/DataBase/images/".$page->name."/screen_".$i.".png";
			$content .= "<div class='screenshot'>
			<a href='".$adress."' rel='lightbox[screen]' title=''>
			<img src='".$adress."' class='screenshot'></a></div>";
		}
		$content .= "</div>";
		return $content;
	}
	
}

?>