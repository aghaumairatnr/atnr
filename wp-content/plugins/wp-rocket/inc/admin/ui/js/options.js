jQuery( document ).ready( function($){
	$( '#submit-support-button' ).prop( 'disabled', true );
	var support_submit_disabled = true;

	$( '#support_documentation_validation' ).change( function() {
		if ( true === support_submit_disabled ) {
			$( '#submit-support-button' ).prop( 'disabled', false );
			support_submit_disabled = false;
		} else if ( false === support_submit_disabled ) {
			$( '#submit-support-button' ).prop( 'disabled', true );
			support_submit_disabled = true;
		}
	});

	// Fancybox
	$(".fancybox").fancybox({'type' : 'iframe'});

	// Display warning message if lazyload options are checked
	var $info = $('.fieldname-lazyload_common_issues'),
    	$inputs = $('input[id^="lazyload"]'),
		is_lazy_checked = function(){
		return $inputs.filter(':checked').length > 0 ? true : false;
    	},
		check_lazy = function(){
			if( is_lazy_checked() ) {
				$info.fadeIn( 275 ).attr('aria-hidden', 'false' );
      		} else {
	  			$info.fadeOut( 275 ).attr('aria-hidden', 'true' );
      		}
    	};

	check_lazy();

	$inputs.on('change.wprocket', check_lazy);

	// Display warning message if any minification options are checked
	var $info_minify = $('.fieldname-minify_warning'),
	    $inputs_minify = $('input[id^="minify"]'),
	    is_minify_checked = function(){
			return $inputs_minify.filter(':checked').length > 0 ? true : false;
		},
		check_minify = function(){
			if( is_minify_checked() ){
				$info_minify.fadeIn( 275 ).attr('aria-hidden', 'false' );
			} else {
	  			$info_minify.fadeOut( 275 ).attr('aria-hidden', 'true' );
			}
		};

	check_minify();

	$inputs_minify.on('change.wprocket', check_minify);

	// Display HTTP/2 warning message if CSS/JS minification options are checked
	var $info_minify_js_css = $('.fieldname-minify_combine_http2_warning'),
	    $inputs_minify_js_css = $('input#minify_css, input#minify_js'),
	    is_minify_css_js_checked = function(){
			return $inputs_minify_js_css.filter(':checked').length > 0 ? true : false;
		},
		check_minify_css_js = function(){
			if( is_minify_css_js_checked() ){
				$info_minify_js_css.fadeIn( 275 ).attr('aria-hidden', 'false' );
			} else {
	  			$info_minify_js_css.fadeOut( 275 ).attr('aria-hidden', 'true' );
			}
		};

	check_minify_css_js();

	$inputs_minify_js_css.on('change.wprocket', check_minify_css_js);

	// Display warning message if purge interval is too low or too high
	var $info_lifespan_less = $('.fieldname-purge_warning_less'),
		$info_lifespan_more = $('.fieldname-purge_warning_more'),
    	$input_cron_interval = $('#purge_cron_interval'),
    	$input_cron_unit = $('#purge_cron_unit'),

		check_purge_cron = function(){
			if( 'DAY_IN_SECONDS' === $input_cron_unit.val() || 'HOUR_IN_SECONDS' === $input_cron_unit.val() && 10 < $input_cron_interval.val() ) {
				$info_lifespan_less.fadeIn( 275 ).attr('aria-hidden', 'false' );
				$info_lifespan_more.fadeOut( 275 ).attr('aria-hidden', 'true' );
      		} else if ( 'MINUTE_IN_SECONDS' === $input_cron_unit.val() && 300 > $input_cron_interval.val() ) {
	  			$info_lifespan_less.fadeOut( 275 ).attr('aria-hidden', 'true' );
	  			$info_lifespan_more.fadeIn( 275 ).attr('aria-hidden', 'false' );
      		} else {
	      		$info_lifespan_less.fadeOut( 275 ).attr('aria-hidden', 'true' );
	  			$info_lifespan_more.fadeOut( 275 ).attr('aria-hidden', 'true' );
      		}
    	};

	check_purge_cron();

	$input_cron_interval.on('change.wprocket', check_purge_cron);
	$input_cron_unit.on('change.wprocket', check_purge_cron);

	// Display warning message if render blocking options are checked
	var $info_render_blocking = $('.fieldname-render_blocking_warning '),
    	$inputs_render_blocking = $('#async_css, #defer_all_js'),
		is_render_blocking_checked = function(){
		return $inputs_render_blocking.filter(':checked').length > 0 ? true : false;
    	},
		check_minify = function(){
			if( is_render_blocking_checked() ) {
				$info_render_blocking.fadeIn( 275 ).attr('aria-hidden', 'false' );
      		} else {
	  			$info_render_blocking.fadeOut( 275 ).attr('aria-hidden', 'true' );
      		}
    	};

	check_minify();

	$inputs_render_blocking.on('change.wprocket', check_minify);

	var minify_css 		= $( '#minify_css' );
	var concatenate_css	= $( '.fieldname-minify_concatenate_css' );
	var exclude_css_row = $( '.exclude-css-row' );

	if ( ! minify_css.is( ':checked' ) ) {
		concatenate_css.hide();
		exclude_css_row.hide();
	}

	minify_css.change( function() {
		if ( ! minify_css.is( ':checked' ) ) {
			concatenate_css.find( '#minify_concatenate_css' ).prop( 'checked', false );
		}

		concatenate_css.toggle( 'fast' );
		exclude_css_row.toggle( 'fast' );
	});

	var minify_js	   = $( '#minify_js' );
	var concatenate_js = $( '.fieldname-minify_concatenate_js' );
	var exclude_js_row = $( '.exclude-js-row' );

	if ( ! minify_js.is( ':checked' ) ) {
		concatenate_js.hide();
		exclude_js_row.hide();
	}

	minify_js.change( function() {
		if ( ! minify_js.is( ':checked' ) ) {
			concatenate_js.find( '#minify_concatenate_js' ).prop( 'checked', false );
		}

		concatenate_js.toggle( 'fast' );
		exclude_js_row.toggle( 'fast' );
	});

	// Remove input
	$('.rkt-module-remove').css('cursor','pointer').live('click', function(e){
		e.preventDefault();
		$(this).parent().css('background-color','red' ).slideUp( 'slow' , function(){$(this).remove(); } );
	} );

	// CNAMES
	$('.rkt-module-clone').on('click', function(e)
	{
		var moduleID = $(this).parent().siblings('.rkt-module').attr('id');

		e.preventDefault();
		$($('#' + moduleID ).siblings('.rkt-module-model:last')[0].innerHTML).appendTo('#' + moduleID);

	});

	// Inputs with parent
	$('.has-parent').each( function() {
		var input  = $(this),
			parent = $('#'+$(this).data('parent'));

		parent.change( function() {
			if( parent.is(':checked') ) {
				input.parents('fieldset').show(200);
			} else {
				input.parents('fieldset').hide(200);
			}
		});

		if( ! parent.is(':checked') ) {
			$(this).parents('fieldset').hide();
		}
	});

	// Tabs
	$('#rockettabs').css({padding: '5px', border: '1px solid #ccc', borderTop: '0px'});
	$('.nav-tab-wrapper a').css({outline: '0px'});
	$('#rockettabs .rkt-tab').hide();
	$('#rockettabs h3').hide();
	var sup_html5st = 'sessionStorage' in window && window['sessionStorage'] !== undefined;
	if( sup_html5st ) {
		var tab = unescape( sessionStorage.getItem( 'rocket_tab' ) );
		if( tab!='null' && tab!=null && tab!=undefined && $('h2.nav-tab-wrapper a[href="'+tab+'"]').length==1 ) {
			$('#rockettabs .nav-tab').hide();
			$('h2.nav-tab-wrapper a[href="'+tab+'"]').addClass('nav-tab-active');
			$(tab).show();
		}else{
			$('h2.nav-tab-wrapper a:first').addClass('nav-tab-active');
			if( $('#tab_basic').length==1 )
				$('#tab_basic').show();
		}
	}
	// Context includes tab links in admin notices.
	$( 'h2.nav-tab-wrapper .nav-tab, a[href^="#tab_"]', '#rocket_options' ).on( 'click', function(e){
		e.preventDefault();
		tab = $(this).attr( 'href' );
		if( sup_html5st ) {
    		try {
                sessionStorage.setItem( 'rocket_tab', tab );
            } catch( e ) {}
        }
		$('#rockettabs .rkt-tab').hide();
		$('h2.nav-tab-wrapper .nav-tab').removeClass('nav-tab-active');
		$('h2.nav-tab-wrapper a[href="'+tab+'"]').addClass('nav-tab-active');
		$(tab).show();
	} );
	if( $('#rockettabs .rkt-tab:visible').length == 0 ){
		$('h2.nav-tab-wrapper a:first').addClass('nav-tab-active');
		$('#tab_apikey').show();
		$('#tab_basic').show();
		if( sup_html5st ) {
            try {
                sessionStorage.setItem( 'rocket_tab', null );
            } catch( e ) {}
        }
	}

	// Sweet Alert for CSS & JS minification
	$( '#minify_css, #minify_js, #minify_concatenate_css, #minify_concatenate_js' ).click(function() {
		obj = $(this);
		if ( obj.is( ':checked' ) ) {
			swal({
				title: sawpr.warningTitle,
				html: sawpr.minifyText,
				type: "warning",
				showCancelButton: true,
				confirmButtonColor: "#A5DC86",
				confirmButtonText: sawpr.confirmButtonText,
				cancelButtonText: sawpr.cancelButtonText,
			}).then( function() {
			}, function(dismiss){
				if ( dismiss === 'cancel' ) {
					obj.attr('checked', false);
				}
			});
		}
	});

	// Sweet Alert for CloudFlare activation
	$( '#do_cloudflare' ).click(function() {
		if ( $(this).is( ':checked' ) ) {
			swal({
				title: sawpr.cloudflareTitle,
				html: sawpr.cloudflareText,
				timer: 5000
			});
		}
	});

	// Support form
	$( '#submit-support-button' ).click( function(e) {
		e.preventDefault();

		var summary 	= $('#support_summary').val().trim(),
			description = $('#support_description').val().trim(),
			validation  = $('#support_documentation_validation'),
			wpnonce		= $('#_wpnonce').val();

		if ( ! validation.is( ':checked' ) ) {
			swal({
				title: sawpr.warningSupportTitle,
				html: sawpr.warningSupportText,
				type: "warning"
			});
		}

		if ( validation.is( ':checked' ) && ( summary == '' || description == '' ) ) {
			swal({
				title: sawpr.requiredTitle,
				type: "warning",
			});
		}

		if ( summary != '' && description != '' && validation.is( ':checked' ) ) {

			swal({
				title: sawpr.preloaderTitle,
				showCancelButton: false,
				showConfirmButton: false,
				imageUrl: sawpr.preloaderImg,
			});

			$.post(
				ajaxurl,
				{
					action: 'rocket_new_ticket_support',
					summary: summary,
					description: description,
					_wpnonce: wpnonce,
				},
				function(response) {
					response = JSON.parse(response);
					var title, text, type, confirmButtonText, confirmButtonColor;
					if( response.msg == 'BAD_EMAIL' ) {
						title              = sawpr.badSupportTitle;
						text               = sawpr.badSupportText;
						confirmButtonText  = sawpr.badConfirmButtonText;
						confirmButtonColor = "#f7a933";
						type               = "error";
					}

					if( response.msg == 'BAD_LICENCE' ) {
						title = sawpr.expiredSupportTitle;
						text  = sawpr.expiredSupportText;
						confirmButtonText  = sawpr.expiredConfirmButtonText;
						confirmButtonColor = "#f7a933";
						type  = "warning";
					}

					if( response.msg == 'BAD_CONNECTION' ) {
						title = sawpr.badServerConnectionTitle;
						text  = sawpr.badServerConnectionText;
						confirmButtonText  = sawpr.badServerConnectionConfirmButtonText;
						confirmButtonColor = "#f7a933";
						type  = "error";
					}

					if( response.msg == 'SUCCESS' ) {
						title = sawpr.successSupportTitle;
						text  = sawpr.successSupportText;
						confirmButtonText = 'OK';
						confirmButtonColor = '#3085d6';
						type  = "success";

						// Reset the values
						$('#support_summary, #support_description, #support_documentation_validation').val('');
					}

					swal({
						title: title,
						html: text,
						type: type,
						confirmButtonText: confirmButtonText,
						confirmButtonColor: confirmButtonColor,
					}).then(
					function() {
						if( response.msg == 'BAD_EMAIL' ) {
							window.open(response.order_url);
						}

						if( response.msg == 'BAD_LICENCE' ) {
							window.open(response.renew_url);
						}

						if( response.msg == 'BAD_CONNECTION' ) {
							window.open('http://wp-rocket.me/support/');
						}
					});
				}
			);
		}
	});

	$('#support_summary').parents('fieldset').append( '<div id="support_searchbox" class="hidden"><p><strong>These articles should help you resolving your issue (EN):</strong></p><div id="support_searchbox-suggestions"><ul></ul></div></div>' );

    // Live Search Cached Results
    last_search_results = new Array();

	 //Listen for the event
	$( "#support_summary" ).on( "keyup", function(e) {
		// Set Search String
		var query_value = $(this).val();
		// Set Timeout
		clearTimeout($.data(this, 'timer'));

		if ( query_value.length < 3 ) {
			$("#support_searchbox").fadeOut();
			$(this).parents('fieldset').attr( 'data-loading', "false" );
			return;
		}

		if ( last_search_results[ query_value ] != undefined ) {
			$(this).parents('fieldset').attr( 'data-loading', "false" );
			$("#support_searchbox-suggestions ul").html(last_search_results[ query_value ]);
			$("#support_searchbox").fadeIn();
			return;
		}
		// Do Search
		$(this).parents('fieldset').attr( 'data-loading', "true" );
		$(this).data('timer', setTimeout(search, 200));
	});

    // Live Search
    // On Search Submit and Get Results
    function search() {
        var query_value = $('#support_summary').val();
        if( query_value !== '' ) {
            $.ajax({
                type: "POST",
                url: ajaxurl,
                data: {
	                action : 'rocket_helpscout_live_search',
	                query  : query_value
	            },
                success: function(html) {
	                html = JSON.parse(html);
                    if ( html ) {
	                	last_search_results[ query_value ] = html;
	                	$("#support_searchbox-suggestions ul").html(html);
						$("#support_searchbox").fadeIn();
					}
                    $('#support_summary').parents('fieldset').attr( 'data-loading', "false" );
                }
            });
        }
        return false;
    }

	$( '.rocket-analytics-data-container' ).hide();
	$( '.rocket-preview-analytics-data' ).on( 'click', function( e ) {
		e.preventDefault();

		$(this).parent().next( '.rocket-analytics-data-container' ).toggle();
	} );
} );
;
