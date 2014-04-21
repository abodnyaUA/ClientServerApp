<!-- Display catalog -->
<div class="catalog">
	<table>
		<?php $percentWidth = 100 / count($pages);?>
		<?php foreach ($pages as $page) : ?>
		<tr>
			<td style='width: 150px'>
				<div class='catalogElement'>
					<img src='/DataBase/images/<?=$page->name?>/logo.png' class='catalogElement'>
				</div>
			</td>
			<td>
				<span class='productTitle'>
					<strong><?=$page->title?></strong>
				</span>
				<br />
				<?=$page->content?>
				<br />
				<a href='/?page=<?=$page->name?>' style="text-align: right">Read more...</a>
			</td>
		</tr>
		<?php endforeach;?>
		
	</table>
</div>

