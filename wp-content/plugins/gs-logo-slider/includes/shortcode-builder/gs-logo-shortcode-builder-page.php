<div class="app-container">
	<div class="main-container">
		
		<div id="gs-logo-slider-shortcode-app">

			<header class="gs-logo-slider-header">
				<div class="gs-containeer-f">
					<div class="gs-roow">
						<div class="logo-area col-xs-6">
							<router-link to="/"><img src="<?php echo GSL_PLUGIN_URI . '/assets/img/logo.svg'; ?>" alt="GS Logo Slider Logo"></router-link>
						</div>
						<div class="menu-area col-xs-6 text-right">
							<ul>
								<router-link to="/" tag="li"><a><?php _e( 'Shortcodes', 'gslogo' ); ?></a></router-link>
								<router-link to="/shortcode" tag="li"><a><?php _e( 'Create New', 'gslogo' ); ?></a></router-link>
								<router-link to="/preferences" tag="li"><a><?php _e( 'Preferences', 'gslogo' ); ?></a></router-link>
								<router-link to="/demo-data" tag="li"><a><?php _e( 'Demo Data', 'gslogo' ); ?></a></router-link>
							</ul>
						</div>
					</div>
				</div>
			</header>

			<div class="gs-logo-slider-app-view-container">
				<router-view :key="$route.fullPath"></router-view>
			</div>

		</div>
		
	</div>
</div>