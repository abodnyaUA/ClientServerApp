<?php
include_once $_SERVER['DOCUMENT_ROOT']."/PHP/Templating/DBPageBuilder.php";

$pageName = $_GET["page"];
$content = "";

if (isset($pageName))
{
	$content = DBPageBuilder::sharedBuilder()->pageContent($pageName);
}
else
{
	$content = DBPageBuilder::sharedBuilder()->defaultPage();
}
echo $content;
?>