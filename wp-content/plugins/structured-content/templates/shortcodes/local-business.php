<?php

if ( ! isset( $atts['html'] ) || $atts['html'] === true || $atts['html'] === 'true' ) :
	$title_ID = isset( $atts['custom_title_id'] ) && $atts['custom_title_id'] !== '' ? sanitize_title( $atts['custom_title_id'] ) : sanitize_title( $atts['business_name'] );
	$title = '<' . $atts['title_tag'] . ( $atts['generate_title_id'] ? ' id="' . $title_ID . '"' : '' ) . '>' . esc_attr( $atts['business_name'] ) . '</' . $atts['title_tag'] . '>';
	?>
	<section class="sc_fs_local_business sc_card <?php echo esc_attr($atts['className']); ?>">
		<?php echo $title; ?>
		<?php if ( $atts['description'] ) { ?>
			<p><?php echo htmlspecialchars_decode( do_shortcode( $atts['description'] ) ); ?></p>
		<?php } ?>
		<div class="sc_row">
			<div class="sc_grey-box">
				<div class="sc_box-label">
					<?php echo __( 'Business', 'structured-content' ); ?>
				</div>
				<div class="sc_business">
					<div class="sc_business-infos">
						<?php if ( $atts['email'] ) { ?>
							<div class="sc_input-group">
								<div class="sc_input-label">
									<?php echo __( 'E-Mail', 'structured-content' ); ?>
								</div>
								<div class="wp-block-structured-content-local_business__email">
									<a href="mailto:<?php echo esc_url($atts['email']); ?>"><?php echo esc_url($atts['email']); ?></a>
								</div>
							</div>
						<?php } ?>
						<?php if ( $atts['telephone'] ) { ?>
							<div class="sc_input-group">
								<div class="sc_input-label">
									<?php echo __( 'Telephone', 'structured-content' ); ?>
								</div>
								<div class="wp-block-structured-content-local_business__telephone">
									<a href="tel:<?php echo esc_url($atts['telephone']); ?>"><?php echo esc_url($atts['telephone']); ?></a>
								</div>
							</div>
						<?php } ?>
						<?php if ( $atts['website'] ) { ?>
							<div class="sc_input-group">
								<div class="sc_input-label">
									<?php echo __( 'Website', 'structured-content' ); ?>
								</div>
								<div class="wp-block-structured-content-local_business__url">
									<a href="<?php echo esc_url($atts['website']); ?>"><?php echo esc_url($atts['website']); ?></a>
								</div>
							</div>
						<?php } ?>
					</div>
					<?php if ( $atts['image_id'] !== '' || $atts['logo_id'] !== '' ) { ?>
						<div class="sc_business-images sc_row">
							<?php if ( $atts['image_id'] !== '' ) { ?>
								<div class="sc_business-image">
									<div class="sc_input-group">
										<div class="sc_input-label">
											<?php echo _x( 'Image', 'Image of the business', 'structured-content' ); ?>
										</div>
										<div>
											<figure class="sc_business-image-wrapper">
												<a href="<?php echo esc_url($atts['image_url']); ?>"
												   title="<?php echo esc_attr($atts['image_alt']); ?>">
													<img src="<?php echo esc_url($atts['image_thumbnail']); ?>"
														 alt="<?php echo esc_attr( $atts['image_alt']); ?>"/>
												</a>
												<meta content="<?php echo esc_attr($atts['image_url']); ?>">
												<meta content="<?php echo esc_attr($atts['image_size'][0]); ?>">
												<meta content="<?php echo esc_attr($atts['image_size'][1]); ?>">
											</figure>
										</div>
									</div>
								</div>
							<?php } ?>

							<?php if ( $atts['logo_id'] !== '' ) { ?>
								<div class="sc_business-logo">
									<div class="sc_input-group">
										<div class="sc_input-label">
											<?php echo _x( 'Logo', 'Logo of the business', 'structured-content' ); ?>
										</div>
										<div>
											<figure class="sc_business-logo-wrapper">
												<a href="<?php echo esc_url($atts['logo_url']); ?>"
												   title="<?php echo esc_attr($atts['logo_alt']); ?>">
													<img src="<?php echo esc_url($atts['logo_thumbnail']); ?>"
														 alt="<?php echo esc_attr($atts['logo_alt']); ?>"/>
												</a>
												<meta content="<?php echo esc_attr($atts['logo_url']); ?>">
												<meta content="<?php echo esc_attr($atts['logo_size'][0]); ?>">
												<meta content="<?php echo esc_attr($atts['logo_size'][1]); ?>">
											</figure>
										</div>
									</div>
								</div>
							<?php } ?>
						</div>
					<?php } ?>
				</div>
			</div>
			<?php if ( $atts['contact_type'] || $atts['contact_email'] || $atts['contact_url'] || $atts['contact_telephone'] ) { ?>
				<div class="sc_grey-box">
					<div class="sc_box-label">
						<?php echo __( 'CONTACT', 'structured-content' ); ?>
					</div>
					<div class="sc_business">
						<div class="sc_business-contact">
							<?php if ( $atts['contact_type'] ) { ?>
								<div class="sc_input-group">
									<div class="sc_input-label">
										<?php echo __( 'Contact Type', 'structured-content' ); ?>
									</div>
									<div class="wp-block-structured-content-local_business__contact_type">
										<?php echo $atts['contact_type']; ?>
									</div>
								</div>
							<?php } ?>
							<?php if ( $atts['contact_email'] ) { ?>
								<div class="sc_input-group">
									<div class="sc_input-label">
										<?php echo __( 'E-Mail', 'structured-content' ); ?>
									</div>
									<div class="wp-block-structured-content-local_business__contact_email">
										<a href="mailto:<?php echo esc_url($atts['contact_email']); ?>">
											<?php echo esc_url($atts['contact_email']); ?>
										</a>
									</div>
								</div>
							<?php } ?>
							<?php if ( $atts['contact_url'] ) { ?>
								<div class="sc_input-group">
									<div class="sc_input-label">
										<?php echo __( 'Url', 'structured-content' ); ?>
									</div>
									<div class="wp-block-structured-content-local_business__contact_url">
										<a href="<?php echo esc_url($atts['contact_url']); ?>">
											<?php echo esc_url($atts['contact_url']); ?>
										</a>
									</div>
								</div>
							<?php } ?>
							<?php if ( $atts['contact_telephone'] ) { ?>
								<div class="sc_input-group">
									<div class="sc_input-label">
										<?php echo __( 'Telephone', 'structured-content' ); ?>
									</div>
									<div class="wp-block-structured-content-local_business__contact_telephone">
										<a href="tel:<?php echo esc_url($atts['contact_telephone']); ?>">
											<?php echo esc_url($atts['contact_telephone']); ?>
										</a>
									</div>
								</div>
							<?php } ?>
						</div>
					</div>
				</div>
			<?php } ?>
		</div>
		<div class="sc_row">
			<?php if ( $atts['street_address'] || $atts['postal_code'] || $atts['address_locality'] || $atts['address_country'] || $atts['address_region'] || $atts['latitude'] || $atts['longitude'] ) { ?>
				<div class="sc_grey-box">
					<div class="sc_box-label">
						<?php echo __( 'Address', 'structured-content' ); ?>
					</div>
					<?php if ( $atts['street_address'] ) { ?>
						<div class="sc_input-group">
							<div class="sc_input-label">
								<?php echo __( 'Street', 'structured-content' ); ?>
							</div>
							<div class="wp-block-structured-content-local_business__streetAddress">
								<?php echo $atts['street_address']; ?>
							</div>
						</div>
					<?php } ?>
					<div class="sc_row">
						<?php if ( $atts['postal_code'] ) { ?>
							<div class="sc_input-group">
								<div class="sc_input-label">
									<?php echo __( 'Postal Code', 'structured-content' ); ?>
								</div>
								<div class="wp-block-structured-content-local_business__postalCode">
									<?php echo $atts['postal_code']; ?>
								</div>
							</div>
						<?php } ?>
						<?php if ( $atts['address_locality'] ) { ?>
							<div class="sc_input-group">
								<div class="sc_input-label">
									<?php echo __( 'Locality', 'structured-content' ); ?>
								</div>
								<div class="wp-block-structured-content-local_business__addressLocality">
									<?php echo $atts['address_locality']; ?>
								</div>
							</div>
						<?php } ?>
					</div>
					<div class="sc_row">
						<?php if ( $atts['address_country'] ) { ?>
							<div class="sc_input-group">
								<div class="sc_input-label">
									<?php echo __( 'Country ISO Code', 'structured-content' ); ?>
								</div>
								<div class="wp-block-structured-content-local_business__addressCountry">
									<?php echo $atts['address_country']; ?>
								</div>
							</div>
						<?php } ?>
						<?php if ( $atts['address_region'] ) { ?>
							<div class="sc_input-group">
								<div class="sc_input-label">
									<?php echo __( 'Region ISO Code', 'structured-content' ); ?>
								</div>
								<div class="wp-block-structured-content-local_business__addressRegion">
									<?php echo $atts['address_region']; ?>
								</div>
							</div>
						<?php } ?>
					</div>
					<div class="sc_row">
						<?php if ( $atts['latitude'] ) { ?>
							<div class="sc_input-group">
								<div class="sc_input-label">
									<?php echo __( 'Latitude', 'structured-content' ); ?>
								</div>
								<div class="wp-block-structured-content-local_business__longitude">
									<?php echo $atts['latitude']; ?>
								</div>
							</div>
						<?php } ?>
						<?php if ( $atts['longitude'] ) { ?>
							<div class="sc_input-group">
								<div class="sc_input-label">
									<?php echo __( 'Longitude', 'structured-content' ); ?>
								</div>
								<div class="wp-block-structured-content-local_business__longitude">
									<?php echo $atts['longitude']; ?>
								</div>
							</div>
						<?php } ?>
					</div>
				</div>
			<?php } ?>
			<?php if ( $atts['founding_date'] || $atts['currencies_accepted'] || $atts['price_range'] || $atts['has_map'] ) { ?>
				<div class="sc_grey-box">
					<div class="sc_box-label">
						<?php echo __( 'Meta', 'structured-content' ); ?>
					</div>
					<?php if ( $atts['founding_date'] ) { ?>
						<div class="sc_input-group">
							<div class="sc_input-label">
								<?php echo __( 'Founding Date', 'structured-content' ); ?>
							</div>
							<div class="wp-block-structured-content-local_business__founding_date">
								<?php echo $atts['founding_date']; ?>
							</div>
						</div>
					<?php } ?>
					<?php if ( $atts['currencies_accepted'] ) { ?>
						<div class="sc_input-group">
							<div class="sc_input-label">
								<?php echo __( 'Currencies Accepted', 'structured-content' ); ?>
							</div>
							<div class="wp-block-structured-content-local_business__currencies_accepted">
								<?php echo $atts['currencies_accepted']; ?>
							</div>
						</div>

					<?php } ?>
					<?php if ( $atts['price_range'] ) { ?>
						<div class="sc_input-group">
							<div class="sc_input-label">
								<?php echo __( 'Price Range', 'structured-content' ); ?>
							</div>
							<div class="wp-block-structured-content-local_business__price_range">
								<?php echo $atts['price_range']; ?>
							</div>
						</div>
					<?php } ?>
					<?php if ( $atts['has_map'] ) { ?>
						<div class="sc_input-group">
							<div class="sc_input-label">
								<?php echo __( 'Map', 'structured-content' ); ?>
							</div>
							<div class="wp-block-structured-content-local_business__has_map">
								<a href="<?php echo esc_url($atts['has_map']); ?>"><?php echo esc_url($atts['has_map']); ?></a>
							</div>
						</div>
					<?php } ?>
				</div>
			<?php } ?>
		</div>
		<?php if ( count( $atts['opening_hours'] ) > 1 || count( $atts['same_as'] ) > 1 ) { ?>
			<div class="sc_row">
				<?php if ( count( $atts['opening_hours'] ) > 1 ) { ?>
					<div class="sc_grey-box">
						<div class="sc_box-label">
							<?php echo __( 'Opening Hours', 'structured-content' ); ?>
						</div>
						<div class="sc_input-group">
							<div class="wp-block-structured-content-local_business__opening_hour">
								<?php foreach ( $atts['opening_hours'] as $opening ) { ?>
									<div><?php echo $opening['opening']; ?></div>
								<?php } ?>
							</div>
						</div>
					</div>
				<?php } ?>
				<?php if ( count( $atts['same_as'] ) > 1 ) { ?>
					<div class="sc_grey-box">
						<div class="sc_box-label">
							<?php echo __( 'Same as', 'structured-content' ); ?>
						</div>
						<div class="sc_input-group">
							<div class="wp-block-structured-content-local_business__same_as">
								<ul>
									<?php foreach ( $atts['same_as'] as $url ) { ?>
										<li><a href="<?php echo esc_url($url['url']); ?>"><?php echo esc_url($url['url']); ?></a></li>
									<?php } ?>
								</ul>
							</div>
						</div>
					</div>
				<?php } ?>
			</div>
		<?php } ?>
	</section>
<?php endif; ?>
<script type="application/ld+json">
	{
		"@context": "http://schema.org",
		"@type": "LocalBusiness",
		<?php if ( $atts['website'] !== '' ) { ?>
		"url": "<?php echo wpsc_esc_jsonld( $atts['website']); ?>",
		<?php } ?>
		<?php if ( $atts['logo_url'] !== '' ) { ?>
		"logo": "<?php echo wpsc_esc_jsonld( $atts['logo_url']); ?>",
		<?php } ?>
		<?php if ( $atts['image_url'] !== '' ) { ?>
		"image": "<?php echo wpsc_esc_jsonld( $atts['image_url']); ?>",
		<?php } ?>
		<?php if ( $atts['has_map'] !== '' ) { ?>
		"hasMap": "<?php echo wpsc_esc_jsonld( $atts['has_map']); ?>",
		<?php } ?>
		<?php if ( $atts['email'] !== '' ) { ?>
		"email": "<?php echo wpsc_esc_jsonld( $atts['email']); ?>",
		<?php } ?>

		<?php if ( $atts['street_address'] !== '' || $atts['address_locality'] !== '' || $atts['address_region'] !== '' || $atts['postal_code'] !== '' || $atts['address_country'] !== '' ) { ?>
		"address" : {
			"@type" : "PostalAddress",
			<?php if ( $atts['street_address'] !== '' ) { ?>
			"streetAddress" : "<?php echo wpsc_esc_jsonld( $atts['street_address']); ?>",
			<?php } ?>
			<?php if ( $atts['address_locality'] !== '' ) { ?>
			"addressLocality" : "<?php echo wpsc_esc_jsonld( $atts['address_locality']); ?>",
			<?php } ?>
			<?php if ( $atts['address_region'] !== '' ) { ?>
			"addressRegion" : "<?php echo wpsc_esc_jsonld( $atts['address_region']); ?>",
			<?php } ?>
			<?php if ( $atts['postal_code'] !== '' ) { ?>
			"postalCode" : "<?php echo wpsc_esc_jsonld( $atts['postal_code']); ?>",
			<?php } ?>
			<?php if ( $atts['address_country'] !== '' ) { ?>
			"addressCountry": "<?php echo wpsc_esc_jsonld( $atts['address_country']); ?>"
			<?php } ?>
		},
		<?php } ?>

		<?php if ( $atts['contact_type'] !== '' ) { ?>
		"contactPoint": {
			"@type": "ContactPoint",
			"contactType": "<?php echo wpsc_esc_jsonld( $atts['contact_type']); ?>",
			<?php if ( $atts['contact_telephone'] !== '' ) { ?>
			"telephone": "<?php echo wpsc_esc_jsonld( $atts['contact_telephone']); ?>",
			<?php } ?>
			<?php if ( $atts['contact_email'] !== '' ) { ?>
			"email": "<?php echo wpsc_esc_jsonld( $atts['contact_email']); ?>",
			<?php } ?>
			<?php if ( $atts['contact_url'] !== '' ) { ?>
			"url": "<?php echo wpsc_esc_jsonld( $atts['contact_url']); ?>"
			<?php } ?>
		},
		<?php } ?>

		<?php if ( $atts['description'] !== '' ) { ?>
		"description": "<?php echo wpsc_esc_jsonld( $atts['description']); ?>",
		<?php } ?>
		<?php if ( $atts['business_name'] !== '' ) { ?>
		"name": "<?php echo wpsc_esc_jsonld( $atts['business_name']); ?>",
		<?php } ?>
		<?php if ( $atts['price_range'] !== '' ) { ?>
		"priceRange": "<?php echo wpsc_esc_jsonld( $atts['price_range']); ?>",
		<?php } ?>
		<?php if ( $atts['telephone'] !== '' ) { ?>
		"telephone": "<?php echo wpsc_esc_jsonld( $atts['telephone']); ?>",
		<?php } ?>

		<?php if ( $atts['currencies_accepted'] !== '' ) { ?>
		"currenciesAccepted": "<?php echo wpsc_esc_jsonld( $atts['currencies_accepted']); ?>",
		<?php } ?>

		<?php if ( $atts['latitude'] !== '' && $atts['longitude'] !== '' ) { ?>
		"geo": {
			"@type": "GeoCoordinates",
			"latitude": "<?php echo wpsc_esc_jsonld( $atts['latitude']); ?>",
			"longitude": "<?php echo wpsc_esc_jsonld( $atts['longitude']); ?>"
		},
		<?php } ?>

		<?php if ( $atts['founding_date'] !== '' ) { ?>
		"foundingDate": "<?php echo wpsc_esc_jsonld( $atts['founding_date']); ?>",
		<?php } ?>

		<?php if ( count( $atts['opening_hours'] ) > 0 ) { ?>
		"openingHours" : [
				<?php
				foreach ( $atts['opening_hours'] as $index => $opening ) :
					echo '"' . wpsc_esc_jsonld($opening['opening']) . '"';
					echo $index !== count( $atts['opening_hours'] ) - 1 ? ", \n" : " \n";
	endforeach;
				?>
			],
		<?php } ?>

		<?php if ( count( $atts['same_as'] ) > 0 ) { ?>
		"sameAs" : [
			<?php
			foreach ( $atts['same_as'] as $index => $url ) :
				echo '"' . wpsc_esc_jsonld($url['url']) . '"';
				echo $index !== count( $atts['same_as'] ) - 1 ? ", \n" : " \n";
	endforeach;
			?>
			]
		<?php } ?>
	}
</script>

