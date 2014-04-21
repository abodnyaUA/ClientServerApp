<?php
class DBMenuEntry 
{
	public $page, $selected;
	public static function entry($page, $selected)
	{
		$entry = new DBMenuEntry();
		$entry->page = $page;
		$entry->selected = $selected;
		return $entry;
	}
}



?>