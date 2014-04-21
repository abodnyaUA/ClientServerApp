<!-- Display catalog -->
<div class="catalog">
	<table>
		<tr>
		<?php $percentWidth = 100 / count($pages);?>
		<?php foreach ($pages as $page) : ?>
			<td style='width: ".$percentWidth."%'>
				<div class='catalogElement'>
					<a href='/?page=<?=$page->name?>'>
						<img src='/DataBase/images/<?=$page->name?>/logo.png' class='catalogElement'>
					</a>
				</div>
			</td>
		<?php endforeach;?>
		</tr>
		<tr>
		<?php foreach ($pages as $page) : ?>
			<td style='width: <?=$percentWidth?> %'>
				<div class='catalogElement'>
					<a href='/?page=<?=$page->name?>'>
						<span class='productTitle'>
							<?=$page->title?>
						</span>
					</a>
				</div>
			</td>
		<?php endforeach;?>
		</tr>
	</table>
</div>

