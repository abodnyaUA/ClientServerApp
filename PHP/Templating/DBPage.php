<?php

include_once $_SERVER['DOCUMENT_ROOT']."/PHP/DBEntity/DBEntity.php";

class DBPage extends DBEntity 
{
	public $id, $name, $content, $aditional_css, $additional_js, $template, $title;
	function toArray() {}
}