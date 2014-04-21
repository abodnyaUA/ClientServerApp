<?php

class DBTemplateProduct
{
	public $css = array("/Style/dstudio_style.css", "/Style/lightbox.css");
	public $js = array("/JS/LightBox/jquery-1.7.2.min.js", "/JS/LightBox/lightbox.js");
	
	public function content($page)
	{
		ob_start();
		include_once $_SERVER['DOCUMENT_ROOT']."/PHP/Templating/TemplateProduct/content.php";
		$content = ob_get_clean();
		return $content;
	}	
}

?>