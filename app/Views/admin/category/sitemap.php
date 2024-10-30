<div class="row">
	<div class="col-md-12">
		<ul id="ul_sitemap">
			<?php foreach ($ds_cat as $cat): ?>
			<li>
				<a href="page/<?=$cat->get('CAT_ALIAS_NAME')?>"><?=$cat->get('CAT_NAME') ?></a>
				<?php $children = $cat->get_children(); ?>
				<?php if ($children != NULL): ?>
					<ul>
						<?php foreach ($children as $child): ?>
							<li><a href="page/<?=$child->get('CAT_ALIAS_NAME')?>"><?=$child->get('CAT_NAME') ?></a></li>
						<?php endforeach ?>
					</ul>
						

				<?php endif ?>
			</li>
			<?php endforeach ?>
			<li><a href="van_ban_lien_quan">Văn bản liên quan</a></li>
		</ul>
		
	</div>
</div>
<style type="text/css">
	#ul_sitemap{
		line-height: 200%;
	}
	#ul_sitemap > li{
		list-style: circle inside ;	/*circle, disc, */
	}
	#ul_sitemap > li > ul{
		margin-left: 30px;
	}
	#ul_sitemap > li > ul >li{
		list-style: disc inside ;
	}
</style>