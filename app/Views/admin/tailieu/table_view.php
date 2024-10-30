<?php if ($ds_vanban == NULL || count($ds_vanban) == 0): ?>
	<tr>
		<td></td>
		<td>Không có văn bản phù hợp</td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		
	</tr>
<?php else: ?>
	<?php $stt=1; foreach($ds_vanban as $vanban): ?>
		<tr data-id="<?= $vanban->get('VB_ID') ?>" data-tt-id="<?= $vanban->get('VB_ID') ?>">
			<td> <?= $vanban->get('VB_SO') ?> </td>
			<td> 
				<a class="a_show_modal" href="#"><?= $vanban->get('VB_TRICH_YEU') ?></a>
			</td>
			<td> <?= $vanban->get('VB_LOAI') ?> </td>
			<td> <?= $vanban->get_cap()->get('VBC_TEN') ?> </td>
			<td> <?= date('d/m/Y', strtotime($vanban->get('VB_NGAY_BAN_HANH'))) ?> </td>
			<td class="hidden d-none"> <?= $vanban->get('VB_CO_QUAN_BAN_HANH') ?> </td>
			<td class="hidden d-none"> <?= $vanban->get('VB_NGUOI_KY') ?> </td>
			<td class="hidden d-none"> <?= $vanban->get('VB_TRANG_THAI')==1?"Còn hiệu lực":"Hết hiệu lực" ?> </td>
			<td class="text-center">
				<a target="_blank" href="media/files/<?=$vanban->get('VB_URL')?>" class="text-success"><i class="fa fa-lg fa-download"></i></a>
				
				<?php if($vanban->get('VB_URL2') != NULL) : ?>
					<a target="_blank" href="media/files/<?=$vanban->get('VB_URL2')?>" class="text-success"><i class="fa fa-lg fa-download"></i></a>
				<?php endif; ?>
				
				<?php if($vanban->get('VB_URL3') != NULL) : ?>
					<a target="_blank" href="media/files/<?=$vanban->get('VB_URL3')?>" class="text-success"><i class="fa fa-lg fa-download"></i></a>
				<?php endif; ?>
			</td>
			
		</tr>
	<?php endforeach; ?>
<?php endif ?>
modalView
