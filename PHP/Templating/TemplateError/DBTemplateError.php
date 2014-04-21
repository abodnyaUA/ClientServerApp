<?php

class DBTemplateError 
{
	public $css = array("/Style/dstudio_style.css");
	public $js = array();
	
	public $content;
	
	public static function create($errorCode)
	{
		$template = new DBTemplateError();
		$errorMessage = $template->errorMessage($errorCode);
		
		ob_start();
		include_once $_SERVER['DOCUMENT_ROOT']."/PHP/Templating/TemplateError/content.php";
		$template->content = ob_get_clean();
		return $template;		
	}
	
	function errorMessage($error) 
	{
		switch ($error) 
		{
			case 404: return "We are sorry, but this page is unavailable.";
			case 500: return "We are sorry, but there are some problems on server. Please try later.";
			default: return "Something went wrong. Please notify us.";
		}
	}
}

?>