<?php
/**
 * structured-content
 * job.php
 *
 * @category Production
 * @author antonioleutsch
 * @package  Default
 * @date     2019-05-27 01:49
 */
?>
<?php
if ( ! isset( $atts['html'] ) || $atts['html'] === true || $atts['html'] === 'true' ) :

	$title_ID = isset( $atts['custom_title_id'] ) && $atts['custom_title_id'] !== '' ? sanitize_title( $atts['custom_title_id'] ) : sanitize_title( $atts['title'] );

	$title = '<' . $atts['title_tag'] . ( $atts['generate_title_id'] ? ' id="' . $title_ID . '"' : '' ) . '>' . esc_attr( $atts['title'] ) . '</' . $atts['title_tag'] . '>';

	?>

	<section class="sc_fs_job sc_card <?php echo esc_attr($atts['css_class']); ?> <?php echo esc_attr($atts['className']); ?>">
		<?php echo $title; ?>
		<p>
			<?php echo htmlspecialchars_decode( do_shortcode( $content ) ); ?>
		</p>
		<div class="sc_row">
			<div class="sc_grey-box">
				<div class="sc_box-label">
					<?php echo __( 'Company', 'structured-content' ); ?>
				</div>
				<div class="sc_company">
					<div class="sc_company-infos">
						<div class="sc_input-group">
							<div class="sc_input-label">
								<?php echo __( 'Name', 'structured-content' ); ?>
							</div>
							<div class="wp-block-structured-content-job__companyName">
								<?php echo $atts['company_name']; ?>
							</div>
						</div>
						<div class="sc_input-group">
							<div class="sc_input-label">
								<?php echo __( 'Same as (Website / Social Media)', 'structured-content' ); ?>
							</div>
							<div class="wp-block-structured-content-job__sameAs">
								<a href="<?php echo esc_url($atts['same_as']); ?>"><?php echo esc_url($atts['same_as']); ?></a>
							</div>
						</div>
					</div>
					<?php if ( ! empty( $atts['logo_id'] ) ) : ?>
						<div class="sc_company-logo">
							<div class="sc_input-group">
								<div class="sc_input-label">
									<?php echo __( 'Logo', 'structured-content' ); ?>
								</div>
								<div>
									<figure class="sc_company-logo-wrapper">
										<a href="<?php echo esc_url($atts['logo_url']); ?>"
										   title="<?php echo esc_attr($atts['logo_alt']); ?>">
											<img src="<?php echo esc_url($atts['thumbnail_url']); ?>"
												 alt="<?php echo esc_attr($atts['logo_alt']); ?>"/>
										</a>
										<meta content="<?php echo esc_url($atts['logo_url']); ?>">
										<meta content="<?php echo esc_attr($atts['logo_size'][0]); ?>">
										<meta content="<?php echo esc_attr($atts['logo_size'][1]); ?>">
									</figure>
								</div>
							</div>
						</div>
					<?php endif; ?>
				</div>
			</div>
			<div class="sc_grey-box">
				<div class="sc_box-label">
					<?php echo __( 'Job Location', 'structured-content' ); ?>
				</div>
				<div class="sc_input-group">
					<div class="sc_input-label">
						<?php echo __( 'Street', 'structured-content' ); ?>
					</div>
					<div class="wp-block-structured-content-job__streetAddress">
						<?php echo $atts['street_address']; ?>
					</div>
				</div>
				<div class="sc_row">
					<div class="sc_input-group">
						<div class="sc_input-label">
							<?php echo __( 'Postal Code', 'structured-content' ); ?>
						</div>
						<div class="wp-block-structured-content-job__postalCode">
							<?php echo $atts['postal_code']; ?>
						</div>
					</div>
					<div class="sc_input-group">
						<div class="sc_input-label">
							<?php echo __( 'Locality', 'structured-content' ); ?>
						</div>
						<div class="wp-block-structured-content-job__addressLocality">
							<?php echo $atts['address_locality']; ?>
						</div>
					</div>
				</div>
				<div class="sc_row">
					<div class="sc_input-group">
						<div class="sc_input-label">
							<?php echo __( 'Country ISO Code', 'structured-content' ); ?>
						</div>
						<div class="wp-block-structured-content-job__addressCountry">
							<?php echo $atts['address_country']; ?>
						</div>
					</div>
					<div class="sc_input-group">
						<div class="sc_input-label">
							<?php echo __( 'Region ISO Code', 'structured-content' ); ?>
						</div>
						<div class="wp-block-structured-content-job__addressRegion">
							<?php echo $atts['address_region']; ?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="sc_row">
			<?php if ( $atts['base_salary'] || $atts['currency_code'] || $atts['quantitative_value'] ) { ?>
				<div class="sc_grey-box">
					<div class="sc_box-label">
						<?php echo __( 'Salary', 'structured-content' ); ?>
					</div>
					<?php if ( $atts['base_salary'] ) { ?>
						<div class="sc_input-group">
							<div class="sc_input-label">
								<?php echo __( 'Unit', 'structured-content' ); ?>
							</div>
							<div class="wp-block-structured-content-job__baseSalary">
								<?php
								switch ( $atts['base_salary'] ) :
									case 'HOUR':
										echo __( 'Hourly', 'structured-content' );
										break;
									case 'DAY':
										echo __( 'Daily', 'structured-content' );
										break;
									case 'WEEK':
										echo __( 'Weekly', 'structured-content' );
										break;
									case 'MONTH':
										echo __( 'Monthly', 'structured-content' );
										break;
									case 'YEAR':
										echo __( 'Yearly', 'structured-content' );
										break;
								endswitch;
								?>
							</div>
						</div>
					<?php } ?>
					<div class="sc_row">
						<div class="sc_input-group">
							<div class="sc_input-label">
								<?php echo __( 'Currency ISO Code', 'structured-content' ); ?>
							</div>
							<div class="wp-block-structured-content-job__currency">
								<?php echo $atts['currency_code']; ?>
							</div>
						</div>
						<div class="sc_input-group">
							<div class="sc_input-label">
								<?php echo __( 'Value', 'structured-content' ); ?>
							</div>
							<div class="wp-block-structured-content-job__currency">
								<?php echo number_format_i18n( $atts['quantitative_value'] ?: 0, 2 ); ?>
							</div>
						</div>
					</div>
				</div>
			<?php } ?>
			<div class="sc_grey-box">
				<div class="sc_box-label">
					<?php echo __( 'Job Meta', 'structured-content' ); ?>
				</div>
				<?php if ( $atts['employment_type'] ) { ?>
					<div class="sc_input-group">
						<div class="sc_input-label">
							<?php echo __( 'Employment Type', 'structured-content' ); ?>
						</div>
						<div class="wp-block-structured-content-job__employmentType">
							<?php
							switch ( $atts['employment_type'] ) :
								case 'FULL_TIME':
									echo __( 'Full Time', 'structured-content' );
									break;
								case 'PART_TIME':
									echo __( 'Part Time', 'structured-content' );
									break;
								case 'CONTRACTOR':
									echo __( 'Contractor', 'structured-content' );
									break;
								case 'TEMPORARY':
									echo __( 'Temporary', 'structured-content' );
									break;
								case 'INTERN':
									echo __( 'Intern', 'structured-content' );
									break;
								case 'VOLUNTEER':
									echo __( 'Volunteer', 'structured-content' );
									break;
								case 'PER_DIEM':
									echo __( 'Per Diem', 'structured-content' );
									break;
								case 'OTHER':
									echo __( 'Other', 'structured-content' );
									break;
							endswitch;
							?>
						</div>
					</div>
				<?php } ?>
				<?php if ( $atts['job_location_type'] ) { ?>
					<div class="sc_input-group">
						<div class="sc_input-label">
							<?php echo __( 'Location Type', 'structured-content' ); ?>
						</div>
						<div class="wp-block-structured-content-job__locationType">
							<?php echo __( 'The job is telecommute.', 'structured-content' ); ?>
						</div>
					</div>
				<?php } ?>
				<div class="sc_input-group">
					<div class="sc_input-label">
						<?php echo __( 'Valid Through', 'structured-content' ); ?>
					</div>
					<div class="wp-block-structured-content-job__validThrough">
						<?php echo date_i18n( get_option( 'date_format' ), strtotime( $atts['valid_through'] ) ); ?>
					</div>
				</div>
			</div>
		</div>
	</section>
<?php endif; ?>
<script type="application/ld+json">
  {
		"@context" : "http://schema.org/",
		"@type" : "JobPosting",
		"title" : "<?php echo wpsc_esc_jsonld($atts['title']); ?>",
		"description" : "<?php echo wpsc_esc_jsonld( wpsc_esc_strip_content($content )); ?>",
		"datePosted" : "<?php echo get_the_date( 'c', get_the_ID() ); ?>",
		"validThrough" : "<?php echo date_i18n( 'c', strtotime( $atts['valid_through'] ) ); ?>",
		"employmentType" : "<?php echo $atts['employment_type']; ?>",
		"hiringOrganization" : {
			"@type" : "Organization",
			"name" : "<?php echo $atts['company_name']; ?>",
			"sameAs" : "<?php echo wpsc_esc_jsonld($atts['same_as']); ?>"
			<?php if ( $atts['logo_id'] ) : ?>
			,"logo" : "<?php echo wp_get_attachment_url( $atts['logo_id'] ); ?>"
			<?php endif; ?>
		},
		"jobLocation" : { "@type" : "Place",
			"address" : {
				"@type" : "PostalAddress",
				"streetAddress" : "<?php echo wpsc_esc_jsonld($atts['street_address']); ?>",
				"addressLocality" : "<?php echo wpsc_esc_jsonld($atts['address_locality']); ?>",
				"addressRegion" : "<?php echo wpsc_esc_jsonld($atts['address_region']); ?>",
				"postalCode" : "<?php echo wpsc_esc_jsonld($atts['postal_code']); ?>",
				"addressCountry": "<?php echo wpsc_esc_jsonld($atts['address_country']); ?>"
			}
		}
		<?php
		if ( $atts['job_location_type'] ) {
			?>
			 ,"jobLocationType" : "TELECOMMUTE" <?php } ?>
		<?php if ( $atts['currency_code'] && $atts['quantitative_value'] && $atts['base_salary'] ) : ?>
		,"baseSalary": {
			"@type": "MonetaryAmount",
			"currency": "<?php echo wpsc_esc_jsonld($atts['currency_code']); ?>",
			"value": {
				"@type": "QuantitativeValue",
				"value": <?php echo number_format( $atts['quantitative_value'], 2, '.', '' ); ?>,
				"unitText": "<?php echo wpsc_esc_jsonld($atts['base_salary']); ?>"
			}
		}
		<?php endif; ?>
	}
</script>
