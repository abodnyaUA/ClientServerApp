<?php

class DBTemplateError 
{
	public $css = array("/Style/dstudio_style.css");
	public $js = array();
	public $header =
	"<div class=\"head\" id=\"head\">
	<a href=\"index.php\"><div class=\"logo\"><img src=\"/Design/images/logo.png\"></div></a>
	<div class=\"logotext\">Competence and experience are our primary assets</div>
	</div><br><div class='error'>";
	
	public $footer = 
	"<br><br><img src='/Design/images/error.png' style='width: 140px'>
	</div><br></div>
	<div class='footer'>
		<div class='bottomtext'>Site was powered by Bodnya Alexey</div>
	</div>";
	
	public static function create($errorCode)
	{
		$template = new DBTemplateError();
		$template->header .= $template->errorMessage($errorCode);
		return $template;
	}
	
	function errorMessage($error) 
	{
		switch ($error) 
		{
			case 404: return "We are sorry, but this page is unavailable.";
			default: return "Something went wrong. Please notify us.";
		}
	}
}

?>