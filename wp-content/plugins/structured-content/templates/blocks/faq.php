<?php
/**
 * structured-content
 * faq.php
 *
 * @author antonioleutsch
 * @package  Default
 * @date     12.09.20 12:11
 * @version  GIT: 1.0
 */
foreach ( $atts['elements'] as $element ) {

	$title_ID = $element->atts->custom_title_id !== '' ? sanitize_title( $element->atts->custom_title_id ) : sanitize_title( $element->atts->question );

	$title = '<' . $atts['title_tag'] . ( $atts['generate_title_id'] ? ' id="' . $title_ID . '"' : '' ) . '>' . esc_attr( $element->atts->question ) . '</' . $atts['title_tag'] . '>';

	if ( $element->atts->visible ) { ?>
		<<?php echo $atts['summary'] ? 'details' : 'section'; ?>
		class="sc_fs_faq sc_card <?php echo esc_attr($atts['css_class']); ?> <?php echo esc_attr($atts['className']); ?> <?php echo $element->atts->className; ?> <?php echo $atts['summary'] && $atts['animate_summary'] ? ' sc_fs_card__animate' : ''; ?>"
		<?php echo $atts['summary'] && $element->atts->open ? 'open' : ''; ?>
		>
		<?php if ( $atts['summary'] ) { ?>
			<summary>
		<?php } ?>
		<?php echo $title; ?>
		<?php if ( $atts['summary'] ) { ?>
			</summary>
		<?php } ?>
		<div>
			<?php if ( $element->atts->thumbnailImageUrl ) { ?>
				<figure class="sc_fs_faq__figure">
					<a
							href="<?php echo esc_url($element->atts->thumbnailImageUrl); ?>"
							title="<?php echo esc_attr($element->atts->imageAlt); ?>"
					>
						<img
								class="sc_fs_faq__image"
								src="<?php echo esc_url($element->atts->thumbnailImageUrl); ?>"
								alt="<?php echo esc_attr($element->atts->imageAlt); ?>"
						>
					</a>
				</figure>
			<?php } ?>
			<div class="sc_fs_faq__content">
				<?php echo $element->content; ?>
			</div>
		</div>
		</<?php echo $atts['summary'] ? 'details' : 'section'; ?>>
		<?php
	}
}
?>

<script type="application/ld+json">
	{
		"@context": "https://schema.org",
		"@type": "FAQPage",
		"mainEntity": [
		<?php foreach ( $atts['elements'] as $element ) { ?>
			{
				"@type": "Question",
				"name": "<?php echo wpsc_esc_jsonld( $element->atts->question ); ?>",
				"acceptedAnswer": {
					"@type": "Answer",
					"text": "<?php echo wpsc_esc_jsonld( wpsc_esc_strip_content($element->content)); ?>"
					<?php if ( $element->atts->thumbnailImageUrl ) { ?>
					,
					"image" : {
						"@type" : "ImageObject",
						"contentUrl" : "<?php echo wpsc_esc_jsonld($element->atts->thumbnailImageUrl); ?>"
					}
					<?php } ?>
				}
			}
			<?php echo $element !== end( $atts['elements'] ) ? ',' : ''; ?>
	<?php } ?>
		]
	}
</script>
