<?php echo qodef_core_get_cpt_shortcode_module_template_part('portfolio', 'portfolio-list', 'parts/image', $item_style, $params); ?>

<div class="qodef-pli-text-holder">
	<div class="qodef-pli-text-wrapper">
		<div class="qodef-pli-text">
			<?php echo qodef_core_get_cpt_shortcode_module_template_part('portfolio', 'portfolio-list', 'parts/title', $item_style, $params); ?>
			
			<?php echo qodef_core_get_cpt_shortcode_module_template_part('portfolio', 'portfolio-list', 'parts/category', $item_style, $params); ?>

			<?php echo qodef_core_get_cpt_shortcode_module_template_part('portfolio', 'portfolio-list', 'parts/images-count', $item_style, $params); ?>
			
			<?php echo qodef_core_get_cpt_shortcode_module_template_part('portfolio', 'portfolio-list', 'parts/excerpt', $item_style, $params); ?>
		</div>
	</div>
</div>