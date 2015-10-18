<?php
$class = array("site-footer");
$class[] = Village::get_theme_mod("footer_color_scheme", "dark-font");


//-----------------------------------*/
// Generate variables for passing to JavaScript
//-----------------------------------*/   
function village_settings_spider( $settings ) {
	foreach ($settings as $key => $option) {
		
		if ( is_array( $option ) ) { 
				$out[$key] = village_settings_spider( $option );
		} else {
		
			$val = Village::get_theme_mod($option, false);
			if( $val !== false ) {

				if ( is_numeric( $val) ) { 
					# Instead of casting (int) or (float)
					# Add 0 to the value and make PHP cast it for us
					$val = $val + 0;
				}


				$out[$key] = $val;
			}
		}
	}
	return $out;
}


$js_vars_to_fetch = array(
    "iscroll" => "enable_custom_scroll",
	"slider" => array(
		'duration' => 'slider_duration',
		'animation' => 'slider_animation',
		'animation_speed' => 'slider_animation_speed',
		'animation_easing' => 'slider_animation_easing',
	),
	'portfolio' => array(
		'open_speed' => 'portfolio_open_speed',
		'gallery_transition' => 'portfolio_gallery_transition',
	),
	'footer' => array(
		'image' => 'footer_background_image',
		'stb' => 'footer_sticky_toggle',
	),
	'scroll' => array(
	    'hs_scrollbar' => 'hs_scrollbar',
		'inertiaX' => 'scroll_inertiaX',
		'inertiaY' => 'scroll_inertiaY',
		'pixelsX' => 'scroll_pixelsX',
		'pixelsY' => 'scroll_pixelsY'
	),


);

$js_parsed_vars = village_settings_spider( $js_vars_to_fetch );
$js_vars = array(	
	'isMobile' => wp_is_mobile(),
	'config' => $js_parsed_vars,
	'prefix' => Village_Page::get_prefix(),
);

//-----------------------------------*/
// Get Widget Class
//-----------------------------------*/
    
if ( $widget_count = get_widget_count( 'footer-widgets' ) ) {
	$widget_class = " widgets-{$widget_count}";
} else {
	$widget_class = "";
}


?>
	<div id="upstage"></div>
	<div id="downstage"></div>
	<div id="downstage__close" class="close-button"></div>
	</div><!-- #content -->
</div><!-- #page -->


<footer id="footer" <?php Village::render_class( $class ); ?> role="contentinfo">	
	<div class="js_scroll">
		<div class="wrapper<?php echo $widget_class;?>">
				<?php dynamic_sidebar( 'footer-widgets' ) ?>
		</div>
	</div>
</footer>

<div id="sticky-bottom-area">
	<?php dynamic_sidebar('sticky-bottom-area'); ?>
</div>


<script type="text/javascript">
	__VILLAGE_VARS = <?php echo json_encode( apply_filters('themevillage_javascript_variables', $js_vars ) ); ?>
</script>
<?php /*
<script type="text/javascript">
	$(function() {
	  	$(".section-work").click(function() {
	    //$('#port_block').animate({width:'toggle'}, 350)
		//$('#port_block').show()
		$('#port_block').delay(100).fadeIn(800)
	    $('.item_port').delay(100).fadeIn(800)
	  	});
	  });
</script>

<script type="text/javascript">
	$(".menu-item").click(function() {   // При нажатии на иконку меню
  		if ($("#port_block").is(":visible")) {   // Если меню открыто
  			$('.item_port').fadeOut(100)
  			//$('#port_block').delay(100).animate({width:'toggle'}, 350)   // Плавно закрывается
			//$('#port_block').hide()
			$('#port_block').fadeOut(100)
  		};});
</script>



<script type="text/javascript">
	
	$(function() {
	  	$(".section-work").click(function() {			
			$('#port_block2').fadeIn(800)		
			$(".right_menu_item").removeClass("active in");
			$("#tab_all_galleries").addClass("active in");
			$('.fotorama__nav__frame').removeClass('fotorama__active');
			$(".fotorama__stage").css("display", "none");
	  	});
	  });
	
</script>

<script type="text/javascript">
	
	$(".menu-item").click(function() {   // При нажатии на иконку меню
  		if ($("#port_block2").is(":visible")) {   // Если меню открыто
  			$('#port_block2').fadeOut(100)   // Плавно закрывается
  		};});
	
</script>

<script type="text/javascript">
	//$(".right_menu_item").css("display", "none");		
	
	$(".home_portfolio_link").click(function() {
		//var link = $(this).find("[href]");
		var link = $(this).find('a').data('workid');
		//alert(link);
		window.location.href = "#work";
		$('.section-work')[0].click();
		//$('#tab_all_galleries').removeClass('active in');
		$('.tab-pane').removeClass('active in');
		$('#' + link).addClass('active in');		
		
		//$("#port_block").find("[data-dropdownid='" + link + "']").attr('aria-expanded','true');
		
		//$(link).click();
	});
	
	
	$(function () {
		
		$('.right_menu_item_content').on('click', '.fotorama__nav__shaft', function (e) {
			//$(this).next('.fotorama__thumb-border').css("display", "block");
			//alert();
			
			//$(this).children(".fotorama__stage").css("display", "block");
			
			$(this).parents('.fotorama__wrap').children(".fotorama__stage").css("display", "block");
			//$(this).parents('.fotorama__wrap').children(".fotorama__stage:hidden").show();
			//$(this).children(".fotorama__thumb-border").css("display", "block");
		});
		
		
		$('.right_menu_item').on('click', '.fotorama__stage__frame', function (e) {
			//$(this).parents('.fotorama__wrap').children(".fotorama__stage:hidden").show();
			//$(this).parents('.fotorama__wrap').children(".fotorama__stage:visible").hide();
			$(this).parents('.fotorama__wrap').children(".fotorama__stage").css("display", "none");
		});
	});
</script>

*/ ?>





<script type="text/javascript">
	$(".home_portfolio_link").click(function() {
		//var link = $(this).find("[href]");
		var link = $(this).find('a').data('workid');
		//alert(link);
		window.location.href = "#work";
		$('.section-work')[0].click();
		//$('#tab_all_galleries').removeClass('active in');
		$('.home_tab').removeClass('active in');
		$('#' + link).addClass('active in');		
		//$("#port_block").find("[data-dropdownid='" + link + "']").attr('aria-expanded','true');
		
		//$(link).click();
		
		//$(".js_scroll__canvas").css("height", "100%");
		//window.dispatchEvent(new Event('resize'));
		$( document ).ready(function() {			
			setTimeout(
			  function() 
			  {
				window.dispatchEvent(new Event('resize'));
			  }, 500);
		});		
	});
	
	$(".left_menu_item_wrapper").click(function() {
		//window.dispatchEvent(new Event('resize'));
		$( document ).ready(function() {			
			setTimeout(
			  function() 
			  {
				window.dispatchEvent(new Event('resize'));
			  }, 100);
		});		
	});
	
	$(".load_more").click(function() {
		$( document ).ready(function() {			
			setTimeout(
			  function() 
			  {
				window.dispatchEvent(new Event('resize'));
			  }, 100);
		});		
	});
	
	$(".section-work").click(function() {			
		$(".home_tab").removeClass("active in");
		$(".main_tab").removeClass("active in");
		$("#main_tab_all_galleries").addClass("active in");
		$("#home_tab_all_galleries").addClass("active in");	
		//window.dispatchEvent(new Event('resize'));
		$( document ).ready(function() {			
			setTimeout(
			  function() 
			  {
				window.dispatchEvent(new Event('resize'));
			  }, 100);
		});		
	});
	
	$('.right_menu_item_content').on('click', '.fotorama__nav__shaft', function (e) {		
		$(this).parents('.fotorama__wrap').children(".fotorama__stage").css("display", "block");	
		window.dispatchEvent(new Event('resize'));					
	});
		
		
	$('.right_menu_item_content').on('click', '.fotorama__stage__frame', function (e) {			
		$(this).parents('.fotorama__wrap').children(".fotorama__stage").css("display", "none");
		window.dispatchEvent(new Event('resize'));		
	});	
		
</script>


<?php wp_footer(); ?>
</body>
</html>