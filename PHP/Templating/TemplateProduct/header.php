<div class="head" id="head">
	<div class="logo">
		<a href="/">
			<img src="/Design/images/logo.png">
		</a>
	</div>
	<div class="logotext">
		Competence and experience are our primary assets
	</div>
</div>
<div class="content">
	<div class="menu">
		<table>
			<tr>
			<?php $percentWidth = 100 / count($pages);?>
			<?php foreach ($pages as $page) : ?>
				<td style='width: ".$percentWidth."%'>
					<div class='menuElement'>
						<a href='/?page=<?=$page->name?>'>
							<img src='/DataBase/images/<?=$page->name?>/logo.png' class='menuElement'>
						</a>
					</div>
				</td>
			<?php endforeach;?>
			</tr>
			<tr>
			<?php foreach ($pages as $page) : ?>
				<td style='width: <?=$percentWidth?> %'>
					<div class='menuElement'>
						<a href='/?page=<?=$page->name?>'>
							<span class='productTitle'>
								<?= $page->title ?>
							</span>
						</a>
					</div>
				</td>
			<?php endforeach;?>
			</tr>
		</table>
	</div>
	<div id='productDescription'>

