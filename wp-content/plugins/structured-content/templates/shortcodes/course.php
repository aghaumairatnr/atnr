<?php
/**
 * structuredcontent
 * course.php
 *
 * @author antonioleutsch
 * @package  Default
 * @date     2019-10-13 16:41
 * @version  GIT: 1.0
 */

foreach ( $atts['elements'] as $element ) {

	$title_ID = isset( $element['custom_title_id'] ) && $element['custom_title_id'] !== '' ? sanitize_title( $element['custom_title_id'] ) : sanitize_title( $element['title'] );

	$title = '<' . $atts['title_tag'] . ( $atts['generate_title_id'] ? ' id="' . $title_ID . '"' : '' ) . '>' . esc_attr( $element['title'] ) . '</' . $atts['title_tag'] . '>';

	if ( ! isset( $element['visible'] ) || $element['visible'] == 1 ) : ?>
		<section class="sc_fs_course sc_card <?php echo esc_attr($atts['css_class']); ?> <?php echo esc_attr($atts['className']); ?>">
			<?php echo $title; ?>
			<p>
				<?php echo htmlspecialchars_decode( do_shortcode( $element['description'] ) ); ?>
			</p>
			<?php if ( ! empty( $element['provider_name'] ) && ! empty( $element['provider_same_as'] ) ) : ?>
				<div class="sc_grey-box">
					<div class="sc_box-label">
						<?php echo __( 'Provider Information', 'structured-content' ); ?>
					</div>
					<div class="sc_row">
						<div class="sc_input-group">
							<div class="sc_input-label">
								<?php echo __( 'Provider Name', 'structured-content' ); ?>
							</div>
							<div class="wp-block-structured-content-event__location">
								<?php echo $element['provider_name']; ?>
							</div>
						</div>
						<div class="sc_input-group">
							<div class="sc_input-label">
								<?php echo __( 'Same as (Website / Social Media)', 'structured-content' ); ?>
							</div>
							<div class="wp-block-structured-content-event__sameAs">
								<a href="<?php echo esc_url($element['provider_same_as']); ?>"><?php echo esc_url($element['provider_same_as']); ?></a>
							</div>
						</div>
					</div>
				</div>
			<?php endif; ?>
		</section>
		<?php
	endif;
}

foreach ( $atts['elements'] as $element ) {
	?>
	<script type="application/ld+json">
		{
			"@context": "http://schema.org",
			"@type": "Course",
			"name": "<?php echo wpsc_esc_jsonld($element['title']); ?>",
			"description": "<?php echo wpsc_esc_jsonld( $element['description']); ?>"
			<?php if ( ! empty( $element['provider_name'] ) && ! empty( $element['provider_same_as'] ) ) : ?>
			,"provider": {
				"@type": "Organization",
				"name": "<?php echo wpsc_esc_jsonld($element['provider_name']); ?>",
				"sameAs": "<?php echo wpsc_esc_jsonld($element['provider_same_as']); ?>"
			}
			<?php endif; ?>
		}
	</script>
	<?php
}
