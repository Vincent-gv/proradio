/*jslint vars: true, plusplus: true, unused:false, devel: true, nomen: true, indent: 4, maxerr: 50 */ 


(function($) {
	"use strict";


	$.prih = {

		fn: {
			currentIndex: false,
			itemsIndex: {
				
				'#menu-appearance':'https://pro.radio/shop/knowledgebase/12/3.1-Accessing-the-WordPress-customizer.html',
				'[href="themes.php"]': 'https://pro.radio/shop/knowledgebase/7/1.4-Theme-Installation.html',
				'[href="themes.php?page=proradio-tgmpa-install-plugins"]': 'https://pro.radio/shop/knowledgebase/8/1.5-Plugins-installation.html',
				'[href="themes.php?page=pt-one-click-demo-import"]': 'https://pro.radio/shop/knowledgebase/9/1.6-Demo-contents.html',
				'[href="widgets.php"]':'https://pro.radio/shop/knowledgebase/24/3.15-Widgets.html',
				'[href="plugins.php"]':'https://pro.radio/shop/knowledgebase/8/1.5-Plugins-installation.html',

				// Customizer
				'#accordion-panel-panel_menubar': 'https://pro.radio/shop/knowledgebase/13/3.2-Logo-and-menu.html',
				'#accordion-section-proradio_header_section': 'https://pro.radio/shop/knowledgebase/13/3.2-Logo-and-menu.html',
				'#accordion-section-proradio_cta_section': 'https://pro.radio/shop/knowledgebase/14/3.3-Call-to-action-button.html',
				'#accordion-section-proradio_secondary_header_section': 'https://pro.radio/shop/knowledgebase/15/3.4-Secondary-menu.html',
				'#accordion-section-proradio_layout_section':'https://pro.radio/shop/knowledgebase/128/3.1-Layout-and-design.html',
				'#accordion-section-proradio_captions_section':'https://pro.radio/shop/knowledgebase/16/3.6-Captions-and-separators.html',
				'#accordion-section-proradio_pageheader_section':'https://pro.radio/shop/knowledgebase/129/3.7-Page-header.html',
				'#accordion-section-proradio_buttons_section':'https://pro.radio/shop/knowledgebase/17/3.8-Buttons.html',
				'#accordion-section-proradio_related_section':'https://pro.radio/shop/knowledgebase/18/3.9-Related-contents.html',
				'#accordion-section-proradio_colors_section':'https://pro.radio/shop/knowledgebase/19/3.10-Colors.html',
				'#accordion-section-proradio_typo_section': 'https://pro.radio/shop/knowledgebase/20/3.11-Typography.html',
				'#accordion-section-proradio_social_section': 'https://pro.radio/shop/knowledgebase/21/3.12-Social-icons.html',
				'#accordion-section-proradio_footer_section':'https://pro.radio/shop/knowledgebase/23/3.13-Footer-copyright-bar.html',
				'#accordion-panel-qtmplayer_player_panel':'https://pro.radio/shop/knowledgebase/125/18.-Music-player.html',
				'#accordion-section-proradio_megafooter_options_section':'https://pro.radio/shop/knowledgebase/122/17.-Mega-footer.html',
				'#accordion-panel-nav_menus':'https://pro.radio/shop/knowledgebase/22/3.14-Menus.html',
				'#accordion-panel-widgets':'https://pro.radio/shop/knowledgebase/24/3.15-Widgets.html',
				'#accordion-section-proradio_advanced_settings':'https://pro.radio/shop/knowledgebase/27/3.18-Advanced-settings.html',
				'#accordion-section-custom_css':'https://pro.radio/shop/knowledgebase/25/3.17-Additional-CSS.html',
				'[href="options-reading.php"]':'https://pro.radio/shop/knowledgebase/26/3.16-Homepage-settings.html',
				'#accordion-section-static_front_page':'https://pro.radio/shop/knowledgebase/26/3.16-Homepage-settings.html',
				// Blog
				'[href="edit-tags.php?taxonomy=category"]':'https://pro.radio/shop/knowledgebase/54/5.2-Blog-categories.html',
				'#menu-posts': 'https://pro.radio/shop/knowledgebase/53/5.1-Blog-posts.html',
				'[href="post-new.php"]': 'https://pro.radio/shop/knowledgebase/53/5.1-Blog-posts.html',

				// chart
				'#menu-posts-chart':'https://pro.radio/shop/knowledgebase/64/7.-Music-charts-top-10.html',
				'[href="edit.php?post_type=chart"]':'https://pro.radio/shop/knowledgebase/65/7.1-How-to-create-a-music-chart.html',
				'[href="edit-tags.php?taxonomy=chartcategory&post_type=chart"]':'https://pro.radio/shop/knowledgebase/66/7.2-Chart-categories.html',
				'[href="post-new.php?post_type=chart"]':'https://pro.radio/shop/knowledgebase/65/7.1-How-to-create-a-music-chart.html',
				//members
				'[href="edit.php?post_type=members"]':'https://pro.radio/shop/knowledgebase/71/8.-Team-Members.html',
				'[href="post-new.php?post_type=members"]':'https://pro.radio/shop/knowledgebase/72/8.1-How-to-create-a-team-member.html',
				'[href="edit-tags.php?taxonomy=membertype&post_type=members"]':'https://pro.radio/shop/knowledgebase/73/8.2-Member-type.html',

				// podcast
				'#menu-posts-podcast':'https://pro.radio/shop/knowledgebase/78/9.-Podcasts.html',
				'[href="edit.php?post_type=podcast"]':'https://pro.radio/shop/knowledgebase/78/9.-Podcasts.html',
				'[href="post-new.php?post_type=podcast"]':'https://pro.radio/shop/knowledgebase/79/9.1-How-to-create-a-Podcast.html',
				'[href="edit-tags.php?taxonomy=podcastfilter&post_type=podcast"]':'https://pro.radio/shop/knowledgebase/80/9.2-Podcast-filters.html',
				// events
				'#menu-posts-event':'https://pro.radio/shop/knowledgebase/85/10.-Events.html',
				'[href="edit.php?post_type=event"]':'https://pro.radio/shop/knowledgebase/86/10.1-How-to-create-an-Event.html',
				'[href="post-new.php?post_type=event"]':'https://pro.radio/shop/knowledgebase/86/10.1-How-to-create-an-Event.html',
				'[href="edit-tags.php?taxonomy=eventtype&post_type=event"]':'https://pro.radio/shop/knowledgebase/87/10.2-Event-types.html',

				// video
				'[href="edit.php?post_type=qtvideo"]':'https://pro.radio/shop/knowledgebase/94/11.-Videos.html',
				'[href="post-new.php?post_type=qtvideo"]':'https://pro.radio/shop/knowledgebase/95/11.1-Create-a-video.html',
				'[href="edit-tags.php?taxonomy=vdl_filters&post_type=qtvideo"]':'https://pro.radio/shop/knowledgebase/97/11.3-Create-a-filterable-videos-grid.html',

				// radio
				'#menu-posts-radiochannel':'https://pro.radio/shop/knowledgebase/98/12.-Radio-channels.html',
				'[href="post-new.php?post_type=radiochannel"]':'https://pro.radio/shop/knowledgebase/99/12.1-Creating-a-radio-channel.html',
				'[for="mp3_stream_url"]':'https://pro.radio/shop/knowledgebase/99/12.1-Creating-a-radio-channel.html',
				'[for="proradio_servertype"]':'https://pro.radio/shop/knowledgebase/99/12.1-Creating-a-radio-channel.html',
				'[value="type-auto"]':'https://pro.radio/shop/knowledgebase/100/12.2-Server-type---Metadata.html',
				'#qtradiofeedHost':'https://pro.radio/shop/knowledgebase/101/12.3-Server-type---Shoutcast.html',
				'#qticecasturl':'https://pro.radio/shop/knowledgebase/102/12.4-Server-Type---Icecast.html',
				'#qtradiodotco':'https://pro.radio/shop/knowledgebase/103/12.5-Server-type---Radio.co.html',
				'#qtairtime':'https://pro.radio/shop/knowledgebase/104/12.6-Server-type---Airtime.html',
				'#qtradionomy':'https://pro.radio/shop/knowledgebase/105/12.7-Server-type---Radionomy.html',
				'#qtlive365':'https://pro.radio/shop/knowledgebase/106/12.8-Server-type---Live365.html',
				'#qttextfeed':'https://pro.radio/shop/knowledgebase/107/12.9-Server-type---plain-text.html',
				'#proradio-useproxy':'https://pro.radio/shop/knowledgebase/99/12.1-Creating-a-radio-channel.html',

				// shows
				'#menu-posts-shows':'https://pro.radio/shop/knowledgebase/109/13.1-Radio-Shows.html',
				'#menu-posts-schedule':'https://pro.radio/shop/knowledgebase/110/13.2-Schedule.html',
				// elementor
				'#toplevel_page_elementor':'https://pro.radio/shop/knowledgebase/31/4.2-Elementor-pages.html',
				'#toplevel_page_wpcf7':'https://pro.radio/shop/knowledgebase/15/14.-Contact-pages-and-form',
				// other
				'#menu-posts-proradio-megafooter': 'https://pro.radio/shop/knowledgebase/122/17.-Mega-footer.html',
				'[for="WPLANG"]':'https://pro.radio/shop/knowledgebase/123/20.-Translating-theme-and-plugins.html',
				'#WPLANG':'https://pro.radio/shop/knowledgebase/123/20.-Translating-theme-and-plugins.html',
				'[href="options-general.php?page=proradio-ajax-settings"]':'https://pro.radio/shop/knowledgebase/126/19.-Ajax-page-load-plugin.html',
				'[href="options-general.php?page=t2gicons_settings"]':'https://pro.radio/shop/knowledgebase/121/16.-Icons2Go-plugin.html',
			},
			setupDocs: function(url){
				console.log(url);
				
				
			},
			init: function(){
				var that = this;
				var btn;
				var value;
				var box;
				var boxc;
				var top;
				var left;
				var item;
				var timeouter = false;
				var currentPageUrl;
				var result;
				var msg;
				var currentlyLoaded;

				$('body').append('<div id="prih" class="prih--container"><button type="button" id="prih-close" class="notice-dismiss"></button><div id="prih-c" class="prih--container__c">Loading...</div></div>');
				$('body').append('<span id="prihlink" class="prih--link">?</span>');
				box = $("#prih");
				boxc = $("#prih-c");

				// Close button
				$("#prih-close").on('click', function(){
					box.removeClass('open');
				});

				// Hover function
				$.each(that.itemsIndex,function(i,pageUrl){
					$(i).on('mouseenter', function(){
						
						item = $(this);
						$('#prihlink').hide();
						var top = item.offset().top - $(document).scrollTop();
						var left = item.offset().left + item.outerWidth();
						$('#prihlink').css({top: top - 12 +'px', left: left - 12 +'px', display: 'block'}).show();
						if( timeouter ){
							clearTimeout(timeouter);
						}
						currentPageUrl = pageUrl;
					}).on('mouseout, mouseleave', function(){
						timeouter = setTimeout( function(){
							$('#prihlink').hide();
						}, 2500);
						
					});
				});

				// Click
				$('#prihlink').on('click', function(e){
					box.addClass('open');
					if( currentlyLoaded !== currentPageUrl ){ 
						$.ajax({
							url: currentPageUrl,
							crossDomain:true,
							// xhr:false,
						}).done(function(response) {

							response = response.split('shop/templates/lagom/assets/img/logo/logo_big.png').join('wp-content/themes/proradio/img/arrow.svg');
							response = response.split('shop/assets/img/overlay-spinner.svg').join('wp-content/themes/proradio/img/arrow.svg');
							response = response.split('shop/assets/img/clippy.svg').join('wp-content/themes/proradio/img/arrow.svg');

							result = $(response).find("#proradiokbcontent");
							// console.log(response);
							boxc.html( result);
							currentlyLoaded = currentPageUrl;
						}).fail(function(e) {
							msg = "Sorry but there was an error: ";
						    boxc.html( msg + e );
						});
					}
				});
			}
		}
	};

	/**====================================================================
	 *
	 *	Page Ready Trigger
	 * 
	 ====================================================================*/
	jQuery(document).ready(function() {
		$.prih.fn.init();	
	});


})(jQuery);