jQuery(document).ready(function(){
    jQuery('.p2col .span6:even').addClass('no-margin-left');
    jQuery('#component .button, #component .btn-primary, #component .btn-info, #component .btn-success, #component .btn-warning, #component .btn-danger, #component .btn-inverse, #component .btn-large, #component .btn-primary-large, #component .btn-info-large, #component .btn-success-large, #component .btn-warning-large, #component .btn-danger-large, #component .btn-inverse-large, #component .btn-small, #component .btn-primary-small, #component .btn-info-small, #component .btn-success-small, #component .btn-warning-small, #component .btn-danger-small, #component .btn-inverse-small, #component .btn-mini, #component .btn-primary-mini, #component .btn-info-mini, #component .btn-success-mini, #component .btn-warning-mini, #component .btn-danger-mini, #component .btn-inverse-mini').addClass('btn');
    jQuery('table').addClass('table');
    jQuery('.hasTooltip').tooltip();
    jQuery('.alert-success, .alert-danger, .alert-error, .alert-info').addClass('alert');
    jQuery('.carousel-inner > .item:first-child, .carousel-indicators > li:first-child').addClass('active');
    jQuery('.carousel').carousel({interval: 6000});
    jQuery('.pagination li').not(':has(span, a)').wrapInner('<span>');
    
    //images
   	jQuery('.portfolio_item_image').hoverdir();
   	jQuery("a.lightbox-prettyphoto").attr('rel', 'prettyPhoto[1]');
    jQuery("a[rel^='prettyPhoto']").prettyPhoto({
		theme: 'pp_default', /* light_rounded / dark_rounded / light_square / dark_square / facebook / pp_default*/
   	});

    //Menu
    jQuery('#mainmenu ul.menu').addClass('sf-menu responsive-menu sf-js-enabled hidden-phone');
    //jQuery('.aside ul.menu').addClass('sf-menu responsive-menu sf-js-enabled sf-vertical hidden-phone');
	jQuery('ul.sf-menu').superfish({
		hoverClass:  'sfHover',
		delay:       'false',
		// animation:   {
		// 	opacity:'show',
		// 	height:'auto'
		// },
		animationOut:  {opacity:'hide'},
		speed:       200,
		speedOut:    400,
		 // animationOpen:    {height:'show'},
   //      animationClose:    {height:'hide',opacity:'hide'},
		delay:       600,
		autoArrows:  false,
		dropShadows: false,
		disableHI:   true,
		// onInit		: jQuery.supposition.onInit,
		// onBeforeShow	: jQuery.supposition.onBeforeShow,
		// onHide		: jQuery.supposition.onHide		
	}).supposition();
	//});


    jQuery('.sf-sub-indicator').remove();
    (function() {
		var $menu = jQuery('#mainmenu ul'),
			optionsList = '<option value="" selected>Menu...</option>';

		$menu.find('li').each(function() {
			var $this   = jQuery(this),
				$anchor = $this.children('a'),
				depth   = $this.parents('ul').length - 1,
				indent  = '';

			if( depth ) {
				while( depth > 0 ) {
					indent += ' - ';
					depth--;
				}
			}
			optionsList += '<option value="' + $anchor.attr('href') + '">' + indent + ' ' + $anchor.text() + '</option>';
		}).end()
		  .after('<select class="res-menu visible-phone">' + optionsList + '</select>');

		jQuery('.res-menu').on('change', function() {
			window.location = jQuery(this).val();
		});
		
	})();
     
    jQuery(".our-blog article").hover(function () {
    	jQuery(this).find("img").stop(true, true).animate({ opacity: 0.7 }, 300);
    }, function() {
    	jQuery(this).find("img").stop(true, true).animate({ opacity: 1 }, 300);
    });

    // To Top Button
    jQuery(function(){
        jQuery().UItoTop({ easingType: 'easeOutQuart' });
    });
                       
});

	
jQuery(document).ready(function() {
    jQuery(function () {
    	//jQuery(".lightbox-prettyphoto").wrap('<div class="lightbox-wrapper" />');
        jQuery(".lightbox-prettyphoto").append("<span style='opacity:0'></span>");
        jQuery(".lightbox-prettyphoto").hover(function () {
            jQuery(this).find("img + span").stop().animate({opacity:0.9}, "normal")
        }, function () {
            jQuery(this).find("img + span").stop().animate({opacity:0}, "normal")
        })
    });

	(function($){ 
	   $(window).load(function(){

	   	$(window).resize(function(){
	   		$windowWidth = $(window).width();
	   	});

	   	var $container = $('#portfolioContainer');
			$container.isotope({
				layoutMode : 'fitRows',
				animationEngine: 'best-available',
				animationOptions: {
			      queue: false,
			      duration: 800
			    }
			});

			// filter items when filter link is clicked
			$('#filtrable a').click(function(){
				var selector = $(this).attr('data-filter');
				$container.isotope({ filter: selector, layoutMode : 'fitRows' });
				return false;
			});

			var $optionSets = $('#filtrable li'),
			    $optionLinks = $optionSets.find('a');

			    $optionLinks.click(function(){
			        var $this = $(this);
			        // don't proceed if already selected
			        if ( $this.hasClass('selected') ) {
			          return false;
			        }
			        var $optionSet = $this.parents('#filtrable');
			        $optionSet.find('.selected').removeClass('selected');
			        $this.addClass('selected');
			  
			        // make option object dynamically, i.e. { filter: '.my-filter-class' }
			        var options = {},
			            key = $optionSet.attr('data-option-key'),
			            value = $this.attr('data-option-value');
			        // parse 'false' as false boolean
			        value = value === 'false' ? false : value;
			        options[ key ] = value;
			        if ( key === 'layoutMode' && typeof changeLayoutMode === 'function' ) {
			          // changes in layout modes need extra logic
			          changeLayoutMode( $this, options )
			        } else {
			          // otherwise, apply new options
			          $container.isotope( options );
			        }
			        
			        return false;
			    });

			
		});
	})(jQuery);
});