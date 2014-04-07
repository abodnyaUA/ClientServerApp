<div class='logoElement'>
	<img src='/DataBase/images/<?=$page->name?>/logo.png'>
</div>
<div class='description'>
	<h3><?=$page->title?></h3>
	<span class='simpleText' id='descriptionFromText'>
		<?=$page->content?>
	"</span>
	<h4>Screenshots:</h4>
	<?php for ($i = 1; $i < 4; $i++) : ?>
	<?php $adress = "/DataBase/images/".$page->name."/screen_".$i.".png"; ?>
		<div class='screenshot'>
			<a href='<?=$adress?>' rel='lightbox[screen]' title=''>
				<img src='<?=$adress?>' class='screenshot'>
			</a>
		</div>";
	<?php endfor; ?>
</div>
