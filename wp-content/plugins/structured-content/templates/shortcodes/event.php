<?php
/**
 * structuredcontent
 * event.php
 *
 * @category Production
 * @author antonioleutsch
 * @package  Default
 * @date     2019-06-26 22:10
 * @license  http://structuredcontent.com/license.txt structuredcontent License
 * @version  GIT: 1.0
 * @link     https://structuredcontent.com/
 */ ?>
<?php
foreach ( $atts['elements'] as $element ) {

	$title_ID = isset( $element['custom_title_id'] ) && $element['custom_title_id'] !== '' ? sanitize_title( $element['custom_title_id'] ) : sanitize_title( $element['title'] );

	$title = '<' . $atts['title_tag'] . ( $atts['generate_title_id'] ? ' id="' . $title_ID . '"' : '' ) . '>' . esc_attr( $element['title'] ) . '</' . $atts['title_tag'] . '>';

	if ( ! isset( $element['visible'] ) || $element['visible'] == 1 ) :
		?>
		<section class="sc_fs_event sc_card <?php echo esc_attr($atts['css_class']); ?> <?php echo esc_attr($atts['className']); ?>">
			<?php echo $title; ?>
			<?php if ( ! empty( $element['image_id'] ) ) : ?>
				<figure>
					<a href="<?php echo esc_url( $element['img_url']); ?>" title="<?php echo esc_attr($element['img_alt']); ?>">
						<img src="<?php echo esc_url($element['thumbnail_url']); ?>" alt="<?php echo esc_attr($element['img_alt']); ?>"/>
					</a>
					<meta content="<?php echo esc_attr($element['img_url']); ?>">
					<meta content="<?php echo esc_attr($element['img_size'][0]); ?>">
					<meta content="<?php echo esc_attr($element['img_size'][1]); ?>">
				</figure>
			<?php endif; ?>
			<p>
				<?php echo htmlspecialchars_decode( do_shortcode( $element['description'] ) ); ?>
			</p>
			<div class="sc_row w-100">
				<div class="sc_grey-box">
					<div class="sc_box-label">
						<?php echo __( 'Event Meta', 'structured-content' ); ?>
					</div>
					<div class="sc_company">
						<div class="sc_company-infos">
							<div class="sc_input-group">
								<div class="sc_input-label">
									<?php echo __( 'Name', 'structured-content' ); ?>
								</div>
								<div class="wp-block-structured-content-event__location">
									<?php echo $element['event_location']; ?>
								</div>
							</div>
							<div class="sc_input-group">
								<div class="sc_input-label">
									<?php echo __( 'Event Status', 'structured-content' ); ?>
								</div>
								<div class="wp-block-structured-content-event__status">
									<?php
									switch ( $element['status'] ) {
										case 'EventScheduled':
											echo __( 'Scheduled', 'structured-content' );
											break;
										case 'EventCancelled':
											echo __( 'Cancelled', 'structured-content' );
											break;
										case 'EventMovedOnline':
											echo __( 'Moved Online', 'structured-content' );
											break;
										case 'EventPostponed':
											echo __( 'Postponed', 'structured-content' );
											break;
										case 'EventRescheduled':
											echo __( 'Rescheduled', 'structured-content' );
											break;
									}
									?>
								</div>
							</div>
							<?php if ( $element['status'] === 'EventRescheduled' ) { ?>
								<div class="sc_input-group">
									<div class="sc_input-label">
										<?php echo __( 'Previous Start Date', 'structured-content' ); ?>
									</div>
									<div class="wp-block-structured-content-event__prev_start_date">
										<?php echo date_i18n( get_option( 'date_format' ) . ' ' . get_option( 'time_format' ), strtotime( $element['prev_start_date'] ) ); ?>
									</div>
								</div>
							<?php } ?>
							<div class="sc_input-group">
								<div class="sc_input-label">
									<?php echo __( 'Start Date', 'structured-content' ); ?>
								</div>
								<div class="wp-block-structured-content-event__start_date">
									<?php echo date_i18n( get_option( 'date_format' ) . ' ' . get_option( 'time_format' ), strtotime( $element['start_date'] ) ); ?>
								</div>
							</div>
							<div class="sc_input-group">
								<div class="sc_input-label">
									<?php echo __( 'End Date', 'structured-content' ); ?>
								</div>
								<div class="wp-block-structured-content-event__end_date">
									<?php echo date_i18n( get_option( 'date_format' ) . ' ' . get_option( 'time_format' ), strtotime( $element['end_date'] ) ); ?>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="sc_grey-box">
					<div class="sc_box-label">
						<?php echo __( 'Event Location', 'structured-content' ); ?>
					</div>
					<div class="sc_input-group">
						<div class="sc_input-label">
							<?php echo __( 'Attendance Mode', 'structured-content' ); ?>
						</div>
						<div class="wp-block-structured-content-event__event_attendance_mode">
							<?php
							switch ( $element['event_attendance_mode'] ) {
								case 'OfflineEventAttendanceMode':
									echo __( 'Offline', 'structured-content' );
									break;
								case 'OnlineEventAttendanceMode':
									echo __( 'Online', 'structured-content' );
									break;
								case 'MixedEventAttendanceMode':
									echo __( 'Mixed', 'structured-content' );
									break;
							}
							?>
						</div>
					</div>
					<?php if ( $element['event_attendance_mode'] !== 'OfflineEventAttendanceMode' ) { ?>
						<div class="sc_input-group">
							<div class="sc_input-label">
								<?php echo __( 'URL', 'structured-content' ); ?>
							</div>
							<div class="wp-block-structured-content-event__online_url">
								<a target="_blank"
								   href="<?php echo esc_url($element['online_url']); ?>"><?php echo esc_url($element['online_url']); ?></a>
							</div>
						</div>
					<?php } ?>
					<?php if ( $element['event_attendance_mode'] !== 'OnlineEventAttendanceMode' ) { ?>
						<div class="sc_input-group">
							<div class="sc_input-label">
								<?php echo __( 'Street', 'structured-content' ); ?>
							</div>
							<div class="wp-block-structured-content-event__streetAddress">
								<?php echo $element['street_address']; ?>
							</div>
						</div>
						<div class="sc_row">
							<div class="sc_input-group">
								<div class="sc_input-label">
									<?php echo __( 'Postal Code', 'structured-content' ); ?>
								</div>
								<div class="wp-block-structured-content-event__postalCode">
									<?php echo $element['postal_code']; ?>
								</div>
							</div>
							<div class="sc_input-group">
								<div class="sc_input-label">
									<?php echo __( 'Locality', 'structured-content' ); ?>
								</div>
								<div class="wp-block-structured-content-event__addressLocality">
									<?php echo $element['address_locality']; ?>
								</div>
							</div>
						</div>
						<div class="sc_row">
							<div class="sc_input-group">
								<div class="sc_input-label">
									<?php echo __( 'Country ISO Code', 'structured-content' ); ?>
								</div>
								<div class="wp-block-structured-content-event__addressCountry">
									<?php echo $element['address_country']; ?>
								</div>
							</div>
							<div class="sc_input-group">
								<div class="sc_input-label">
									<?php echo __( 'Region ISO Code', 'structured-content' ); ?>
								</div>
								<div class="wp-block-structured-content-event__addressRegion">
									<?php echo $element['address_region']; ?>
								</div>
							</div>
						</div>
					<?php } ?>
				</div>
			</div>
			<div class="sc_row w-100">
				<?php if ( $element['currency_code'] && $element['offer_valid_from'] && $element['offer_availability'] && $element['offer_url'] ) : ?>
					<div class="sc_grey-box">
						<div class="sc_box-label">
							<?php echo __( 'Performer', 'structured-content' ); ?>
						</div>
						<div class="sc_input-group">
							<div class="sc_input-label">
								<?php echo __( 'Type', 'structured-content' ); ?>
							</div>
							<div class="wp-block-structured-content-event__offer_availability">
								<?php
								switch ( $element['performer'] ) {
									case 'PerformingGroup':
										echo __( 'Performing Group', 'structured-content' );
										break;
									case 'Person':
										echo __( 'Person', 'structured-content' );
										break;
								}
								?>
							</div>
						</div>
						<div class="sc_input-group">
							<div class="sc_input-label">
								<?php echo __( 'Name', 'structured-content' ); ?>
							</div>
							<div class="wp-block-structured-content-event__offer_url">
								<?php echo $element['performer_name']; ?>
							</div>
						</div>
					</div>
				<?php endif; ?>
				<?php if ( $element['currency_code'] && $element['offer_valid_from'] && $element['offer_availability'] && $element['offer_url'] ) : ?>
					<div class="sc_grey-box">
						<div class="sc_box-label">
							<?php echo __( 'Offer', 'structured-content' ); ?>
						</div>
						<div class="sc_row">
							<div class="sc_input-group">
								<div class="sc_input-label">
									<?php echo __( 'Availability', 'structured-content' ); ?>
								</div>
								<div class="wp-block-structured-content-event__offer_availability">
									<?php
									switch ( $element['offer_availability'] ) {
										case 'InStock':
											echo __( 'In Stock', 'structured-content' );
											break;
										case 'SoldOut':
											echo __( 'Sold Out', 'structured-content' );
											break;
										case 'PreOrder':
											echo __( 'Pre Order', 'structured-content' );
											break;
									}
									?>
								</div>
							</div>
							<div class="sc_input-group">
								<div class="sc_input-label">
									<?php echo __( 'Ticket Website', 'structured-content' ); ?>
								</div>
								<div class="wp-block-structured-content-event__offer_url">
									<a href="<?php echo esc_url($element['offer_url']); ?>"><?php echo esc_url($element['offer_url']); ?></a>
								</div>
							</div>
						</div>

						<div class="sc_row">
							<div class="sc_input-group">
								<div class="sc_input-label">
									<?php echo __( 'Currency ISO Code', 'structured-content' ); ?>
								</div>
								<div class="wp-block-structured-content-event__currency">
									<?php echo $element['currency_code']; ?>
								</div>
							</div>
							<div class="sc_input-group">
								<div class="sc_input-label">
									<?php echo __( 'Price', 'structured-content' ); ?>
								</div>
								<div class="wp-block-structured-content-event__price">
									<?php echo number_format_i18n( $element['price'], 2 ); ?>
								</div>
							</div>
						</div>
						<div class="sc_input-group">
							<div class="sc_input-label">
								<?php echo __( 'Valid From', 'structured-content' ); ?>
							</div>
							<div class="wp-block-structured-content-event__valid_from">
								<?php echo date_i18n( get_option( 'date_format' ) . ' ' . get_option( 'time_format' ), strtotime( $element['offer_valid_from'] ) ); ?>
							</div>
						</div>
					</div>
				<?php endif; ?>
			</div>
		</section>
		<?php
	endif;
}

foreach ( $atts['elements'] as $element ) {
	?>
	<script type="application/ld+json">
	{
		"@context": "https://schema.org",
		"@type": "Event",
		"eventStatus": "https://schema.org/<?php echo wpsc_esc_jsonld($element['status']); ?>",
		"eventAttendanceMode": "https://schema.org/<?php echo wpsc_esc_jsonld($element['event_attendance_mode']); ?>",
		"name": "<?php echo wpsc_esc_jsonld($element['title']); ?>",
		"startDate": "<?php echo date_i18n( 'c', strtotime( $element['start_date'] ) ); ?>",
		"endDate": "<?php echo date_i18n( 'c', strtotime( $element['end_date'] ) ); ?>",
		<?php if ( $element['event_attendance_mode'] === 'EventRescheduled' ) { ?>
		"previousStartDate": "<?php echo date_i18n( 'c', strtotime( $element['prev_start_date'] ) ); ?>",
		<?php } ?>
		"location":
			<?php echo $element['event_attendance_mode'] === 'MixedEventAttendanceMode' ? '[' : ''; ?>
			<?php if ( $element['event_attendance_mode'] !== 'OfflineEventAttendanceMode' ) { ?>
				{
				"@type": "VirtualLocation",
				"url": "<?php echo wpsc_esc_jsonld($element['online_url']); ?>"
				}
			<?php } ?>
			<?php echo $element['event_attendance_mode'] === 'MixedEventAttendanceMode' ? ',' : ''; ?>
			<?php if ( $element['event_attendance_mode'] !== 'OnlineEventAttendanceMode' ) { ?>
			{
			"@type": "Place",
			"name": "<?php echo wpsc_esc_jsonld($element['event_location']); ?>",
			"address": {
				"@type": "PostalAddress",
				"streetAddress" : "<?php echo wpsc_esc_jsonld($element['street_address']); ?>",
				"addressLocality" : "<?php echo wpsc_esc_jsonld($element['address_locality']); ?>",
				"postalCode" : "<?php echo wpsc_esc_jsonld($element['postal_code']); ?>",
				"addressRegion" : "<?php echo wpsc_esc_jsonld($element['address_region']); ?>",
				"addressCountry": "<?php echo wpsc_esc_jsonld($element['address_country']); ?>"
				}
			}
			<?php } ?>
			<?php echo $element['event_attendance_mode'] === 'MixedEventAttendanceMode' ? ']' : ''; ?>
		,
	  <?php if ( ! empty( $element['image_id'] ) ) : ?>
			"image" : ["<?php echo wp_get_attachment_url( $element['image_id'] ); ?>"],
	<?php endif; ?>
	<?php if ( $element['currency_code'] && $element['offer_valid_from'] && $element['offer_availability'] && $element['offer_url'] ) : ?>
		"offers": {
			"@type": "Offer",
			"url": "<?php echo wpsc_esc_jsonld($element['offer_url']); ?>",
			"price": "<?php echo number_format( $element['price'], 2, '.', '' ); ?>",
			"priceCurrency": "<?php echo wpsc_esc_jsonld($element['currency_code']); ?>",
			"availability": "https://schema.org/<?php echo $element['offer_availability']; ?>",
			"validFrom": "<?php echo date_i18n( 'c', strtotime( $element['offer_valid_from'] ) ); ?>"
		},
	<?php endif; ?>
	<?php if ( $element['performer_name'] && $element['performer'] ) : ?>
		"performer": {
			"@type": "<?php echo wpsc_esc_jsonld($element['performer']); ?>",
			"name": "<?php echo wpsc_esc_jsonld($element['performer_name']); ?>"
		  },
	<?php endif; ?>
		"description": "<?php echo wpsc_esc_jsonld( $element['description'] ); ?>"
	}
	</script>
<?php } ?>
