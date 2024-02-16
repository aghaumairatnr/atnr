<?php
/**
 * structured-content
 * faq.php
 *
 * @category Production
 * @author antonioleutsch
 * @package  Default
 * @date     2019-05-27 01:19
 */

foreach ( $atts['elements'] as $element ) {
	if ( ! isset( $element['visible'] ) || $element['visible'] == 1 ) : ?>
		<section class="sc_fs_faq sc_card <?php echo esc_attr($atts['css_class']); ?>">
			<div>
				<?php echo '<' . $atts['question_tag'] . '>' . esc_attr($element['question']) . '</' . $atts['question_tag'] . '>'; ?>
				<div>
					<?php if ( ! empty( $element['imageID'] ) ) : ?>
						<figure class="sc_fs_faq__figure">
							<a href="<?php echo esc_url($element['img_url']); ?>" title="<?php echo esc_attr($element['img_alt']); ?>">
								<img src="<?php echo esc_url($element['thumbnail_url']); ?>"
									 alt="<?php echo esc_attr($element['img_alt']); ?>"/>
							</a>
						</figure>
					<?php endif; ?>
					<p>
						<?php echo htmlspecialchars_decode( do_shortcode( $element['answer'] ) ); ?>
					</p>
				</div>
			</div>
		</section>
		<?php
	endif;
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
				"name": "<?php echo wpsc_esc_jsonld( $element['question'] ); ?>",
				"acceptedAnswer": {
					"@type": "Answer",
					"text": "<?php echo wpsc_esc_jsonld( wpsc_esc_strip_content( $element['answer']) ); ?>"
					<?php if ( ! empty( $element['imageID'] ) ) : ?>
					,
					"image" : {
						"@type" : "ImageObject",
						"contentUrl" : "<?php echo wpsc_esc_jsonld($element['img_url']); ?>"
					}
					<?php endif; ?>
				}
			}
			<?php
			if ( $element !== end( $atts['elements'] ) ) {
				echo ',';
			}
			?>
	<?php } ?>
		]
	}
</script>
