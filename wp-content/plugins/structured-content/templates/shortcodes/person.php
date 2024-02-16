<?php
/**
 * structuredcontent
 * person.php
 *
 * @category Production
 * @author antonioleutsch
 * @package  Default
 * @date     2019-07-13 00:49
 * @license  http://structuredcontent.com/license.txt structuredcontent License
 * @version  GIT: 1.0
 * @link     https://structuredcontent.com/
 */

?>
<?php
if ( ! isset( $atts['html'] ) || $atts['html'] === true || $atts['html'] === 'true' ) :

	$title_ID = isset( $atts['custom_title_id'] ) && $atts['custom_title_id'] !== '' ? sanitize_title( $atts['custom_title_id'] ) : sanitize_title( $atts['person_name'] );

	$title = '<span' . ( $atts['generate_title_id'] ? ' id="' . $title_ID . '"' : '' ) . '>' . esc_attr( $atts['person_name'] ) . '</span>';

	?>

	<section class="sc_fs_person sc_card <?php echo esc_attr($atts['css_class']); ?> <?php echo esc_attr($atts['className']); ?>">
		<div class="sc_row">
			<div class="sc_grey-box">
				<div class="sc_box-label">
					<?php echo __( 'Personal', 'structured-content' ); ?>
				</div>
				<div class="sc_company">
					<div class="sc_person-infos">
						<div class="sc_input-group">
							<div class="sc_input-label">
								<?php echo __( 'Name', 'structured-content' ); ?>
							</div>
							<div class="wp-block-structured-content-person__personName">
								<?php echo $title; ?>
							</div>
						</div>
						<?php if ( ! empty( $atts['alternate_name'] ) ) { ?>
							<div class="sc_input-group">
								<div class="sc_input-label">
									<?php echo __( 'Alternate Name', 'structured-content' ); ?>
								</div>
								<div class="wp-block-structured-content-person__personName">
									<?php echo $atts['alternate_name']; ?>
								</div>
							</div>
						<?php } ?>
						<?php if ( ! empty( $atts['job_title'] ) ) { ?>
							<div class="sc_input-group">
								<div class="sc_input-label">
									<?php echo __( 'Job Title', 'structured-content' ); ?>
								</div>
								<div class="wp-block-structured-content-person__jobTitle">
									<?php echo $atts['job_title']; ?>
								</div>
							</div>
						<?php } ?>
						<?php if ( ! empty( $atts['birthdate'] ) ) { ?>
							<div class="sc_input-group">
								<div class="sc_input-label">
									<?php echo __( 'Birthdate', 'structured-content' ); ?>
								</div>
								<div class="wp-block-structured-content-person__jobTitle">
									<?php echo date_i18n( get_option( 'date_format' ), strtotime( $atts['birthdate'] ) ); ?>
								</div>
							</div>
						<?php } ?>
					</div>
					<?php
					if ( ! empty( $atts['image_url'] ) ) :
						?>
						<div class="sc_person-image">
							<div class="sc_input-group">
								<div class="sc_input-label">
									<?php echo __( 'Image', 'structured-content' ); ?>
								</div>
								<div>
									<figure class="sc_person-image-wrapper">
										<a href="<?php echo esc_url($atts['image_url']); ?>"
										   title="<?php echo esc_attr($atts['image_alt']); ?>">
											<img src="<?php echo esc_url($atts['thumbnail_url']); ?>"
												 alt="<?php echo esc_attr($atts['image_alt']); ?>"/>
										</a>
										<meta content="<?php echo esc_attr($atts['image_url']); ?>">
										<meta content="<?php echo esc_attr($atts['image_size'][0]); ?>">
										<meta content="<?php echo esc_attr($atts['image_size'][1]); ?>">
									</figure>
								</div>
							</div>
						</div>
						<?php
					endif;
					?>
				</div>
			</div>
			<div class="sc_grey-box">
				<div class="sc_box-label">
					<?php echo __( 'Contact', 'structured-content' ); ?>
				</div>
				<div class="sc_input-group">
					<div class="sc_input-label">
						<?php echo __( 'E-Mail', 'structured-content' ); ?>
					</div>
					<div class="wp-block-structured-content-person__email">
						<a href="mailto:<?php echo esc_url($atts['email']); ?>"><?php echo esc_url($atts['email']); ?></a>
					</div>
				</div>
				<div class="sc_input-group">
					<div class="sc_input-label">
						<?php echo __( 'URL', 'structured-content' ); ?>
					</div>
					<div class="wp-block-structured-content-person__url">
						<a href="<?php echo esc_url($atts['url']); ?>"><?php echo esc_url($atts['url']); ?></a>
					</div>
				</div>
				<div class="sc_input-group">
					<div class="sc_input-label">
						<?php echo __( 'Telephone', 'structured-content' ); ?>
					</div>
					<div class="wp-block-structured-content-person__telephone">
						<a href="tel:<?php echo esc_url($atts['telephone']); ?>"><?php echo esc_url($atts['telephone']); ?></a>
					</div>
				</div>
			</div>
		</div>
		<div class="sc_row">
			<div class="sc_grey-box">
				<div class="sc_box-label">
					<?php echo __( 'Address', 'structured-content' ); ?>
				</div>
				<div class="sc_input-group">
					<div class="sc_input-label">
						<?php echo __( 'Street', 'structured-content' ); ?>
					</div>
					<div class="wp-block-structured-content-person__streetAddress">
						<?php echo $atts['street_address']; ?>
					</div>
				</div>
				<div class="sc_row">
					<div class="sc_input-group">
						<div class="sc_input-label">
							<?php echo __( 'Postal Code', 'structured-content' ); ?>
						</div>
						<div class="wp-block-structured-content-person__postalCode">
							<?php echo $atts['postal_code']; ?>
						</div>
					</div>
					<div class="sc_input-group">
						<div class="sc_input-label">
							<?php echo __( 'Locality', 'structured-content' ); ?>
						</div>
						<div class="wp-block-structured-content-person__addressLocality">
							<?php echo $atts['address_locality']; ?>
						</div>
					</div>
				</div>
				<div class="sc_row">
					<div class="sc_input-group">
						<div class="sc_input-label">
							<?php echo __( 'Country ISO Code', 'structured-content' ); ?>
						</div>
						<div class="wp-block-structured-content-person__addressCountry">
							<?php echo $atts['address_country']; ?>
						</div>
					</div>
					<div class="sc_input-group">
						<div class="sc_input-label">
							<?php echo __( 'Region ISO Code', 'structured-content' ); ?>
						</div>
						<div class="wp-block-structured-content-person__addressRegion">
							<?php echo $atts['address_region']; ?>
						</div>
					</div>
				</div>
			</div>
			<div class="sc_grey-box">
				<div class="sc_box-label">
					<?php echo __( 'Colleague', 'structured-content' ); ?>
				</div>
				<div class="sc_input-group">
					<div class="sc_input-label">
						<?php echo __( 'URL', 'structured-content' ); ?>
					</div>
					<div class="wp-block-structured-content-person__colleague_url">
						<ul>
							<?php
							if ( isset( $atts['links'] ) && ! empty( $atts['links'] ) ) {
								foreach ( $atts['links'] as $url ) {
									?>
									<li><a href="<?php echo esc_url($url); ?>"><?php echo esc_url($url); ?></a></li>
									<?php
								}
							}
							?>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<div class="sc_row">
			<?php
			if ( isset( $atts['works_for_name'] ) ) {
				?>
				<div class="sc_grey-box">
					<div class="sc_box-label">
						<?php echo __( 'Work', 'structured-content' ); ?>
					</div>
					<div class="sc_input-group">
						<div class="sc_input-label">
							<?php echo __( 'Organisation Name', 'structured-content' ); ?>
						</div>
						<div class="wp-block-structured-content-person__workName">
							<?php echo $atts['works_for_name']; ?>
						</div>
					</div>
					<?php
					if ( isset( $atts['works_for_alt'] ) ) {
						?>
						<div class="sc_input-group">
							<div class="sc_input-label">
								<?php echo __( 'Alternate Name', 'structured-content' ); ?>
							</div>
							<div class="wp-block-structured-content-person__workAlt">
								<?php echo $atts['works_for_alt']; ?>
							</div>
						</div>
						<?php
					}
					?>
					<?php
					if ( isset( $atts['works_for_url'] ) || $atts['works_for_logo'] ) {
						?>
						<div class="sc_row">
							<?php
							if ( isset( $atts['works_for_url'] ) ) {
								?>
								<div class="sc_input-group">
									<div class="sc_input-label">
										<?php echo __( 'Url', 'structured-content' ); ?>
									</div>
									<div class="wp-block-structured-content-person__workURL">
										<a href="<?php echo esc_url($atts['works_for_url']); ?>"><?php echo esc_url($atts['works_for_url']); ?></a>
									</div>
								</div>
								<?php
							}
							?>
							<?php
							if ( isset( $atts['works_for_logo'] ) ) {
								?>
								<div class="sc_input-group">
									<div class="sc_input-label">
										<?php echo __( 'Logo', 'structured-content' ); ?>
									</div>
									<div class="wp-block-structured-content-person__workLogo">
										<figure class="sc_person-image-wrapper">
											<a href="<?php echo esc_url($atts['works_for_logo']); ?>"
											   title="<?php echo esc_attr($atts['works_for_name']); ?>">
												<img src="<?php echo esc_attr($atts['works_for_logo']); ?>"
													 alt="<?php echo esc_attr($atts['works_for_name']); ?>">
											</a>
										</figure>

									</div>
								</div>
								<?php
							}
							?>
						</div>
						<?php
					}
					?>
				</div>
				<?php
			}
			?>
			<div class="sc_grey-box">
				<div class="sc_box-label">
					<?php echo __( 'Same as', 'structured-content' ); ?>
				</div>
				<div class="sc_input-group">
					<div class="sc_input-label">
						<?php echo __( 'URL', 'structured-content' ); ?>
					</div>
					<div class="wp-block-structured-content-person__samAs_url">
						<ul>
							<?php
							if ( isset( $atts['same_as'] ) && ! empty( $atts['same_as'] ) ) {
								foreach ( $atts['same_as'] as $url ) {
									?>
									<li><a href="<?php echo esc_url($url); ?>"><?php echo esc_url($url); ?></a></li>
									<?php
								}
							}
							?>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</section>
<?php endif; ?>
<script type="application/ld+json">
	{
		"@context": "http://schema.org",
		"@type": "Person",
		<?php if ( ! empty( $atts['street_address'] ) || ! empty( $atts['address_locality'] ) || ! empty( $atts['address_region'] ) || ! empty( $atts['postal_code'] ) || ! empty( $atts['address_country'] ) ) { ?>
		"address" : {
			"@type" : "PostalAddress",
			<?php if ( ! empty( $atts['street_address'] ) ) { ?>
			"streetAddress" : "<?php echo wpsc_esc_jsonld($atts['street_address']); ?>",
			<?php } ?>
			<?php if ( ! empty( $atts['address_locality'] ) ) { ?>
			"addressLocality" : "<?php echo wpsc_esc_jsonld($atts['address_locality']); ?>",
			<?php } ?>
			<?php if ( ! empty( $atts['address_region'] ) ) { ?>
			"addressRegion" : "<?php echo wpsc_esc_jsonld($atts['address_region']); ?>",
			<?php } ?>
			<?php if ( ! empty( $atts['postal_code'] ) ) { ?>
			"postalCode" : "<?php echo wpsc_esc_jsonld($atts['postal_code']); ?>",
			<?php } ?>
			<?php if ( ! empty( $atts['address_country'] ) ) { ?>
			"addressCountry": "<?php echo wpsc_esc_jsonld($atts['address_country']); ?>"
			<?php } ?>
		},
		<?php } ?>
		<?php
		if ( isset( $atts['links'] ) && ! empty( $atts['links'] ) ) {
			echo '"colleague": [';
			foreach ( $atts['links'] as $link => $url ) :
				echo '"' . wpsc_esc_jsonld($url) . '"';
				echo $link !== count( $atts['links'] ) - 1 ? ", \n" : " \n";
		endforeach;
			echo '],';
		}
		?>
		<?php if ( ! empty( $atts['birthdate'] ) ) { ?>
			"birthDate": "<?php echo wpsc_esc_jsonld($atts['birthdate']); ?>",
		<?php } ?>
		<?php if ( ! empty( $atts['email'] ) ) { ?>
			"email": "<?php echo wpsc_esc_jsonld($atts['email']); ?>",
		<?php } ?>
		<?php if ( ! empty( $atts['image_id'] ) ) { ?>
			"image": "<?php echo wp_get_attachment_url( $atts['image_id'] ); ?>",
		<?php } ?>
		<?php if ( ! empty( $atts['job_title'] ) ) { ?>
			"jobTitle": "<?php echo wpsc_esc_jsonld($atts['job_title']); ?>",
		<?php } ?>
		<?php if ( ! empty( $atts['person_name'] ) ) { ?>
			"name": "<?php echo wpsc_esc_jsonld($atts['person_name']); ?>",
		<?php } ?>
		<?php if ( ! empty( $atts['telephone'] ) ) { ?>
			"telephone": "<?php echo wpsc_esc_jsonld($atts['telephone']); ?>",
		<?php } ?>
		<?php if ( ! empty( $atts['url'] ) ) { ?>
			"url": "<?php echo wpsc_esc_jsonld($atts['url']); ?>",
		<?php } ?>
		<?php if ( ! empty( $atts['alternate_name'] ) ) { ?>
			"alternateName" : "<?php echo wpsc_esc_jsonld($atts['alternate_name']); ?>",
		<?php } ?>
		<?php if ( isset( $atts['same_as'] ) && count( $atts['same_as'] ) > 0 ) { ?>
		"sameAs" : [
			<?php
			foreach ( $atts['same_as'] as $link => $url ) :
				echo '"' . wpsc_esc_jsonld($url) . '"';
				echo $link !== count( $atts['same_as'] ) - 1 ? ", \n" : " \n";
	endforeach;
			?>
			],
		<?php } ?>
		<?php if ( isset( $atts['works_for_name'] ) && ! empty( $atts['works_for_name'] ) ) { ?>
		"worksFor": {
			"@type": "Organization",
			"name": "<?php echo wpsc_esc_jsonld($atts['works_for_name']); ?>"
			<?php
			if ( isset( $atts['works_for_alt'] ) ) {
				?>
				,"alternateName": "<?php echo wpsc_esc_jsonld($atts['works_for_alt']); ?>"
				<?php } ?>
			<?php
			if ( isset( $atts['works_for_url'] ) ) {
				?>
				,"url": "<?php echo wpsc_esc_jsonld($atts['works_for_url']); ?>"
				<?php } ?>
			<?php
			if ( isset( $atts['works_for_logo'] ) ) {
				?>
				,"logo": "<?php echo wpsc_esc_jsonld($atts['works_for_logo']); ?>"
				<?php } ?>
		}
		<?php } ?>
	}
</script>
