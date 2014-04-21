<div class=separateLine></div>
<?php for ($i = 0; $i < count($menus); $i++)  :?>
	<div class="menu">
		<span class="separator">|</span>
		<?php foreach ($menus[$i] as $menuEntry) :?>
		<?php $class = ($menuEntry->selected) ? "menuSelectedEntry" : "menuDefaultEntry"?>
			<span class=<?=$class?> style="font-size:<?=16 - $i*3?>pt">
				<a class="menuLink" href="/?page=<?=$menuEntry->page->name?>"><?=$menuEntry->page->title?></a>
			</span>
			<span class="separator">|</span>
		<?php endforeach;?>
	</div>
<?php endfor;?>
