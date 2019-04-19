<div class="qodef-section-title-holder <?php echo esc_attr($holder_classes); ?>" <?php echo succulents_qodef_get_inline_style($holder_styles); ?>>
	<div class="qodef-st-inner">
        <?php if(!empty($subtitle)) { ?>
            <<?php echo esc_attr($subtitle_tag); ?> class="qodef-st-subtitle" <?php echo succulents_qodef_get_inline_style($subtitle_styles); ?>>
                <?php echo wp_kses($subtitle, array('br' => true, 'span' => array('class' => true))); ?>
            </<?php echo esc_attr($subtitle_tag); ?>>
        <?php } ?>
		<?php if(!empty($title)) { ?>
			<<?php echo esc_attr($title_tag); ?> class="qodef-st-title" <?php echo succulents_qodef_get_inline_style($title_styles); ?>>
				<?php echo wp_kses($title, array('br' => true, 'span' => array('class' => true))); ?>
			</<?php echo esc_attr($title_tag); ?>>
		<?php } ?>
		<?php if(!empty($text)) { ?>
			<<?php echo esc_attr($text_tag); ?> class="qodef-st-text" <?php echo succulents_qodef_get_inline_style($text_styles); ?>>
				<?php echo wp_kses($text, array('br' => true)); ?>
			</<?php echo esc_attr($text_tag); ?>>
		<?php } ?>
	</div>
</div>