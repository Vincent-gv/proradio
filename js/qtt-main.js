/**====================================================================
 *
 *  Main Script File
 *  V. 1.4.4
 *
 *====================================================================*/

 /*====================================================================

	CODEKIT PREPENDS:
	THESE BELOW ARE NOT COMMENTS, BUT THE CODEKIT'S PREPEND FILES 
	ENQUEUED IN MAIN-MIN.JS

	TO USE THE OPEN VERSION OF THE FILES FOR YOUR CUSTOMIZATIONS, 
	ENABLE THE DEBUG OPTIONS IN THE THEME'S CUSTOMIZER

====================================================================*/

// @codekit-prepend "../components/materialize-src/js/collapsible.js";
// @codekit-prepend "../components/materialize-src/js/jquery.easing.1.3.js";
// @codekit-prepend "../components/modernizr/modernizr-custom.js";
// @codekit-prepend "../components/owl-carousel/dist/owl.carousel-min.js";
// @codekit-prepend "../components/stellar/jquery.stellar.min.js";
// @codekit-prepend "../components/ttg-stickysidebar/min/ttg-sticky-sidebar-min.js";
// @codekit-prepend "../js/skip-link-focus-fix.js";

(function($) {
	"use strict";
	$.fn.waterwave = function( options ) {
        // DEFAULT OPTIONS
        var settings = $.extend({
            parent : '',
            color : '#fff',
            direction: 'down',
            background: '',
            speed: 1
        }, options );
        var waterwave = this;
        waterwave.init = function() {
            var TAU = Math.PI * 2.5;
            var density = 1;
            var speed = options.speed;
            var res = 0.005; // percentage of screen per x segment
            var outerScale = 0.05 / density;
            var inc = 0;
            var c = waterwave[0];
            var ctx = c.getContext('2d');
            var grad = ctx.createLinearGradient(0, 0, 0, c.height * 4);
            var height = options.parent.outerHeight();
            var width = options.parent.outerWidth();

            function onResize() {
                if(options.direction == 'down') {
                    waterwave.attr({
                        width: width+ "px"
                    });
                }
                else {
                    waterwave.attr({
                        width:  width+ "px",
                        height: height + "px"
                    });
                }
            }

            onResize();
            setTimeout(function() {
                loop();
            }, 500);
            $(window).resize(onResize);

            function loop() {
                inc -= speed;
                drawWave(options.color);
                requestAnimationFrame(loop);
            }


            function drawBG(patternCanvas, w, h) {
                var space = ctx.createPattern(patternCanvas, 'repeat');
                ctx.fillStyle = space;
                ctx.fillRect(0, 0, w, h);
            }

            function drawWave(color) {
                var w = c.offsetWidth;
                var h = c.offsetHeight;
                var cx = w * 0.5;
                var cy = h * 0.5;
                ctx.clearRect(0, 0, w, h);
                var segmentWidth = w * res;
                if(options.background != '') {
                    var image = new Image();
                    image.src = options.background;
                    image.onload = function() {
                        // create an off-screen canvas
                        var patt = document.createElement('canvas');
                        // set the resized width and height
                        patt.width = w;
                        patt.height = h;
                        patt.getContext('2d').drawImage(this, 0, - 1 * (h / 4), patt.width, patt.height);
                        // pass the resized canvas to your createPattern
                        drawBG(patt, w , h);
                    };
                }
                else {
                    ctx.fillStyle = color;
                }
                ctx.beginPath();
                ctx.moveTo(0, cy);
                for (var i = 0, endi = 1 / res; i <= endi; i++) {
                    var _y = cy + Math.sin((i + inc) * TAU * res * density) * cy * Math.sin(i * TAU * res * density * outerScale);
                    var _x = i * segmentWidth;
                    ctx.lineTo(_x, _y);
                }
                if(options.direction == 'down') {
                    ctx.lineTo(w, 0);
                    ctx.lineTo(0, 0);
                }
                else {
                    ctx.lineTo(w, h);
                    ctx.lineTo(0, h);
                }
                ctx.closePath();
                ctx.fill();
            }
        };
        waterwave.init();
        return waterwave;
    };


    /**
     * Website functionalities
     */

	$.ProRadioMainObj = {
		/**
		 * Global function variables and main objects
		 */
		body: $("body"),
		window: $(window),
		document: $(document),
		htmlAndbody: $('html,body'),
		scrolledTop: 0, // global value of the amount of top scrolling
		oldScroll: 0,
		scroDirect: false,
		clock: false,
		headerbar: $('#proradio-headerbar'),
		stickyheader: $('[data-proradio-stickyheader]'),
		clockTimer: 130,
		clockTimerMobile: 180,

		/**
		 * ======================================================================================================================================== |
		 * 																																			|
		 * 																																			|
		 * START SITE FUNCTIONS 																													|
		 * 																																			|
		 *																																			|
		 * ======================================================================================================================================== |
		 */
		
		fn: {
			window: $(window),
			isExplorer: function(){
				return /Trident/i.test(navigator.userAgent) ;
			},
			isSafari: function(){
				return navigator.userAgent.indexOf('Safari') != -1 && navigator.userAgent.indexOf('Chrome') == -1;
			},
			isMobile: function(){
				return /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) || $.ProRadioMainObj.window.width() < 1170 ;
			},
			isLowPerformance: function(){
				return (  navigator.userAgent.indexOf('Safari') != -1 && navigator.userAgent.indexOf('Chrome') == -1 ) || /Trident/i.test(navigator.userAgent) ;
			},
			doDebug: function(msg){
				if( $("body").hasClass('proradio-jsdebug') ){
					console.log(msg);
				}
			},
			areClipPathShapesSupported: function(){
				var base = 'clipPath',
					prefixes = [ 'webkit', 'moz', 'ms', 'o' ],
					properties = [ base ],
					testElement = document.createElement( 'testelement' ),
					attribute = 'polygon(50% 0%, 0% 100%, 100% 100%)';

				// Push the prefixed properties into the array of properties.
				for ( var i = 0, l = prefixes.length; i < l; i++ ) {
					var prefixedProperty = prefixes[i] + base.charAt( 0 ).toUpperCase() + base.slice( 1 ); // remember to capitalize!
					properties.push( prefixedProperty );
				}

				// Interate over the properties and see if they pass two tests.
				for ( var i = 0, l = properties.length; i < l; i++ ) {
					var property = properties[i];

					// First, they need to even support clip-path (IE <= 11 does not)...
					if ( testElement.style[property] === '' ) {

						// Second, we need to see what happens when we try to create a CSS shape...
						testElement.style[property] = attribute;
						if ( testElement.style[property] !== '' ) {
							 $("body").addClass('proradio-clip-enabled');
							 return true;
						}
					}
				}
				$("body").addClass('proradio-clip-disabled');
				return false;
			},

			

			/** random id when required
			====================================================================*/
			uniqId: function() {
			  return Math.round(new Date().getTime() + (Math.random() * 100));
			},

			/** Check if pics are loaded for given cotnainer
			====================================================================*/

		

			// Website tree menu			
			treeMenu: function() {

				// First check native height of grand child items 
				$( ".proradio-menu-tree li li.menu-item-has-children ul" ).each(function(i,c){
					var t = $(c);
					t.attr('data-max', t.outerHeight() );
				});

				$( ".proradio-menu-tree > li.menu-item-has-children ul" ).each(function(i,c){
					var t = $(c);
					t.attr('data-max', t.outerHeight() );
				});

				$( ".proradio-menu-tree li.menu-item-has-children" ).each(function(i,c){
					var t = $(c);
					t.find('> a').after("<a class='proradio-openthis' href='#'><i class='material-icons'>keyboard_arrow_down</i></a>");
					
					var sub = t.children('ul');
					sub.css({'opacity': 0, 'max-height': '0px' });
					
					t.on("click","> .proradio-openthis", function(e){
						e.preventDefault();
						t.toggleClass("proradio-open").promise().done(function(){
							sub = t.children('ul');
							if(t.hasClass('proradio-open')){
								t.closest('li').animate({'padding-bottom': '15px' },200);
								sub.css({ 'max-height': sub.data('max')+'px'  }).delay('400').promise().done(function(){
									sub.css({opacity: 1});
								});
							} else {
								t.closest('li').animate({'padding-bottom': '0px' },200);
								sub.css({opacity: 0}).delay('200').promise().done(function(){
									sub.css({'max-height':'0px'});
								});
							}
						});

						return false;
					});
					return;
				});
				return true;
			},


			/**====================================================================
			 *
			 *
			 * Automatic link embed
			 *
			 * 
			 ====================================================================*/
			embedVideo: function (content, width, height) {
				height = width / 16 * 9;
				var youtubeUrl = content;
				var youtubeId = youtubeUrl.match(/=[\w-]{11}/);
				var strId = youtubeId[0].replace(/=/, '');
				var result = '<iframe width="'+width+'" height="'+height+'" src="'+window.location.protocol+'//www.youtube.com/embed/' + strId + '?html5=1" class="youtube-player" allowfullscreen></iframe>';
				return result;
			},

			embedSpotify: function(mystring, width, height){
				var isPodcast =  /episode/i.test(mystring);
				if(isPodcast){
					var trackID = mystring.split('https://open.spotify.com/episode/').join('');
					var url = 'https://open.spotify.com/embed/episode/'+trackID;
					height= 160;
				} else {
					var trackID = mystring.split('https://open.spotify.com/track/').join('');
					var url = 'https://open.spotify.com/embed/track/'+trackID;
				}
				
				return '<iframe src="'+url+'" width="'+width+'" height="'+height+'" frameborder="0" allowtransparency="true" allow="encrypted-media"></iframe>';
			},

			transformlinks: function (targetContainer, differ) {
				if(undefined === targetContainer) {
					targetContainer = "body";
				}
				if(undefined === differ) {
					differ = false;
				}

				var obj = $.ProRadioMainObj;
				jQuery(targetContainer).find("a[href*='youtube.com'],a[href*='youtu.be'],a[href*='mixcloud.com'],a[href*='soundcloud.com'], [data-autoembed]").not('.noembed').not('.qw-disableembedding').not('.qt-disableembedding').each(function(element) {
					
					var that = jQuery(this),
						mystring = that.attr('href'),
						width = that.parent().width(),
						height = that.height(),
						element = that,
						fixedheight = that.data('fixedheight');

					if(differ === false && that.hasClass('qt-differembed')){
						return;
					}
					

					if(width === 0){
						width = that.parent().parent().parent().width();
					}
					if(width === 0){
						width = that.parent().parent().parent().width();
					}
					if(width === 0){
						width = that.parent().parent().parent().parent().width();
					}


					if(that.attr('data-autoembed')) {
						mystring = that.attr('data-autoembed');
					}
					//=== YOUTUBE 
					var expression = /(http|https):\/\/(\w{0,3}\.)?youtube\.\w{2,3}\/watch\?v=[\w-]{11}/gi,
						videoUrl = mystring.match(expression);
					if (videoUrl !== null) {
						for (var count = 0; count < videoUrl.length; count++) {
							mystring = mystring.replace(videoUrl[count], $.ProRadioMainObj.fn.embedVideo(videoUrl[count], width, (width/16*9)));
							replacethisHtml(mystring);
						}
					}    
					//=== SPOTIFY 
					var expression = /https:\/\/open\.spotify\.\w{2,3}\/track\/[\w-]{22}/gi,
						trackurl = mystring.match(expression);
					if (trackurl == null) {
						expression = /https:\/\/open\.spotify\.\w{2,3}\/episode\/[\w-]{22}/gi,
						trackurl = mystring.match(expression);
					}
					if (trackurl !== null) {
						for (var count = 0; count < trackurl.length; count++) {
							mystring = mystring.replace( trackurl[count], $.ProRadioMainObj.fn.embedSpotify( trackurl[count], width, 80 ) );
							
							replacethisHtml(mystring);
						}
					} 

					//=== SOUNDCLOUD
					var temphtml = '',
						iframeUrl = '',
						$temphtml,
						expression = /(http|https)(\:\/\/soundcloud.com\/+([a-zA-Z0-9\/\-_]*))/g,
						scUrl = mystring.match(expression);
					if (scUrl !== null) {
						for (count = 0; count < scUrl.length; count++) {
							var finalurl = scUrl[count].replace(':', '%3A');
							if(!fixedheight){
								fixedheight = 180;
							}
							jQuery.getJSON(
								'https://soundcloud.com/oembed?maxheight='+fixedheight+'&format=js&url=' + finalurl + '&iframe=true&callback=?'
								, function(response) {
									temphtml = response.html;
									if(that.closest("li").length > 0){
										if(that.closest("li").hasClass("qt-collapsible-item") ) {
											$temphtml = $(temphtml);
											iframeUrl = $temphtml.attr("src");
											replacethisHtml('<div class="qt-dynamic-iframe" data-src="'+iframeUrl+'"></div>');
										} else {
											replacethisHtml(temphtml);
										}
									} else {
										replacethisHtml(temphtml);
									}
							});
						}
					}
					//=== MIXCLOUD
					var expression = /(http|https)\:\/\/www\.mixcloud\.com\/[\w-]{0,150}\/[\w-]{0,150}\/[\w-]{0,1}/ig;
					var mixcloudUrl = mystring.match(expression);
					if (mixcloudUrl !== null) {
					
						for (count = 0; count < mixcloudUrl.length; count++) {

							var finalurl = encodeURIComponent(mixcloudUrl[count]);
							// finalurl = finalurl.replace("https","http");
							var embedcode ='<iframe data-state="0" class="mixcloudplayer" width="100%" height="160" src="//www.mixcloud.com/widget/iframe/?feed='+finalurl+'&embed_uuid=addfd1ba-1531-4f6e-9977-6ca2bd308dcc&stylecolor=&embed_type=widget_standard"></iframe><div class="canc"></div>';    
							replacethisHtml(embedcode);
						}
					}
					//=== STRING REPLACE (FINAL FUNCTION)
					function replacethisHtml(mystring) {
						if(element.is("a")){
							element.replaceWith(mystring);
						} else {
							element.html(mystring);
						}
						return true;
					}
					obj.fn.YTreszr();
				});
				
				/**
				 * Fix for soundcloud loaded in collapsed div for the chart
				 */
				obj.body.off('click','.qt-collapsible li');
				obj.body.on('click','.qt-collapsible li', function(e){
					var that = $(this);
					if(that.hasClass("active")){
						var item = that.find(".qt-dynamic-iframe");
						var itemurl = item.attr("data-src");
						item.replaceWith('<iframe src="'+itemurl+'" frameborder="0"></iframe>');
						obj.fn.YTreszr();
					}
				});
				obj.body.off('click','ul.tabs li a');
				obj.body.on('click','ul.tabs li a', function(e){
					obj.fn.YTreszr();
					window.dispatchEvent(new Event('resize'));
				});
			},
			
			/* activates
			*  Adds and removes the class "proradio-active" from the target item	
			====================================================================*/
			activatesComponent: function(targetContainer){
				if(undefined === targetContainer) {
					targetContainer = "body";
				}
				var t, // target
					o = $.ProRadioMainObj,
					s = false;

				$(targetContainer).find('[data-proradio-activates]').each(function(i,c){
					var btn = $(c), s;
					btn.off("click");
					btn.on("click", function(e){
						e.preventDefault();
						$(this).toggleClass("proradio-enabled")
						s = $(this).attr("data-proradio-activates");
						t = $(s);
						if(!s || s === ''){
							t = $(this); }
						if( s == 'parent'){
							t = $(this).parent(); }
						if( s == 'gparent'){
							t = $(this).parent().parent(); }
						t.toggleClass("proradio-enabled"); // changed on 2020 04 06 because the class proradio-actived was used by the laodmore
						return;
					});
				});
			},

			tabsComponent: function( targetContainer ){
				
				if(undefined === targetContainer) {
					targetContainer = "body";
				}
				var t, // target
					o = $.ProRadioMainObj,
					s = false;

				$(targetContainer).find('[data-proradio-tabs]').each(function(i,c){
					var btn = $(c).find('.proradio-tabs__menu a'), 
						s,
						tcnt = $(c).find('.proradio-tabs__content');

					// tcnt.fadeOut('fast').first().fadeIn('fast'); // Breaking in certain conditions, so disabled
					
					// 2019 12 19 preactivate a tab
					var activeTab = $(c).find('.proradio-active');
					if( 0 == activeTab.length ){
						tcnt.first().show();
						$(c).find('.proradio-tabs__menu li:first-child a').addClass('proradio-active');
					} else {
						tcnt.hide();
						$( activeTab.attr("href") ).show();
					}

					btn.off("click");
					btn.on("click", function(e){
						e.preventDefault();
						var t = $(this);
						$(c).find('.proradio-tabs__menu a.proradio-active').removeClass('proradio-active');
						t.addClass("proradio-active");
						s = t.attr("href");
						tcnt.fadeOut('fast').promise().done(function(){
							$(s).fadeIn('fast');
						});
						return;
					});
				});
			},

			/* switchClass
			*  toggles the class defined with "data-proradio-switch" from the target element data-proradio-target
			*  used to change state of other items (search and similar)
			====================================================================*/
			switchClass: function( targetContainer ){
				var t, // target
					tc, // toggle class
					c, // class to switch
					o = $.ProRadioMainObj;
				if(undefined === targetContainer) {
					targetContainer = "body";
				}
				$(targetContainer).off("click",  "[data-proradio-switch]");
				$(targetContainer).on("click",  "[data-proradio-switch]", function(e){
					e.preventDefault();
					tc = $(this).attr("data-proradio-target");
					t = $(tc);
					c = $(this).attr("data-proradio-switch");
					t.toggleClass(c);

					if(tc === '#proradio-searchbar'){
						if(t.hasClass(c)){
							setTimeout(function() { $('#proradio-searchbar input').focus() }, 200);
						} else {
							$('#proradio-searchbar input').blur();
						}
					}
				});
			},

			extractYoutubeId: function(url){
				if(void 0===url)return!1;
				var id=url.match(/(?:https?:\/{2})?(?:w{3}\.)?youtu(?:be)?\.(?:com|be)(?:\/watch\?v=|\/)([^\s&]+)/);
				return null!==id&&id[1];
			},

			/**
			 * Fix video background Page Builder rows su ajax load
			 */
			qtVcVideobg: function(){
				var o = $.ProRadioMainObj,
					f = o.fn,
					ytu, t, vid;
				if( !f.isMobile() && typeof( insertYoutubeVideoAsBackground ) == 'function' && typeof(vcResizeVideoBackground) == 'function' ){
					jQuery("[data-proradio-video-bg]").each(
						function(){
							t = $(this);
							var videoId = f.extractYoutubeId(t.data("proradio-video-bg"));
							insertYoutubeVideoAsBackground( t, videoId );
							vcResizeVideoBackground(t);
						}
					);
				}
			},

			
			/**====================================================================
			 *
			 *
			 *	 Responsive video resize
			 *
			 * 
			 ====================================================================*/
			YTreszr: function  (){
				jQuery("iframe").each(function(i,c){ // .youtube-player
					var t = jQuery(this);
					if(t.attr("src")){
						var href = t.attr("src");
						if(href.match("youtube.com") || href.match("vimeo.com") || href.match("vevo.com")  ){
							var width = t.parent().width(),
								height = t.height();
							t.css({"width":width});
							t.height(width/16*9);
						}
						else if(href.match("soundcloud.com")){
							var width = t.parent().width();
							t.css({"width":width});
						}; 
					};
				});
			},

			/* Fix background in safari
			====================================================================*/

			ipadBgFix: function(){
				var o = $.ProRadioMainObj,
					f = o.fn;
				if(f.isMobile() && f.isSafari()){
					o.body.addClass('proradio-safari-mobile');
				}
			},

			/* Parallax background
			====================================================================*/
			qtParallax: function(){
				if('undefined'  == typeof($.stellar) && $('[data-proradio-parallax]').length == 0 ){
					return;
				}
				var o = $.ProRadioMainObj,
					b = o.body;
				if(o.fn.isMobile()){return;}
				b.stellar('destroy');
				$.each($('[data-proradio-parallax]'), function(i,c){
					$(c).css({'transform':'translate3d'});
					$(c).imagesLoaded().then(function(){
						b.stellar({
							hideDistantElements: false,
						});
					});
				});
			},

			/* scrolledTop: set a global parameter with the amount of top scrolling
			*	Used by themeScroll
			====================================================================*/
			scrolledTop: function(){
				var o = $.ProRadioMainObj,
					s = window.pageYOffset || document.documentElement.scrollTop,
					d = 0;
				d = o.scrolledTop - s;
				if(d != 0){
					o.scroDirect = d;
				}
				o.scrolledTop = s;
				return s;
			},

			/* Sticky sidebar preparation
			====================================================================*/
			stickyBarLinkPrep: function  (){

				var o 		= $.ProRadioMainObj,
					ab = $('#wpadminbar'),
					ah = ab.outerHeight(),
					fm = $('#proradio-menu'),
					fh = fm.outerHeight(),
					cando = o.fn.areClipPathShapesSupported();
				if(false === cando)return;
				o.OTS = $("#proradio-sticky"); // Object To Stick (BAR container)
				if(o.OTS.length === 0)return;
				o.OTSc = $('#proradio-stickycon'); // Object To Stick CONTENT (internal menu)
				var OTS 	= o.OTS,
					OTSh 	=	OTS.outerHeight();
				OTS.css({'height': Math.round( OTSh )+'px'});
				OTS.closest('.proradio-vc-row-container').addClass('proradio-stickybar-parent'); // 7 may
				o.StickMeTo = 0;
				o.whenToStick = $('.proradio-stickybar-parent').position().top - OTSh;
				if( o.stickyheader.length > 0 ){
					o.whenToStick -= fh;
					o.StickMeTo += fh;
				}
				if(ab.length >= 1){
					o.whenToStick -= ah;
					o.StickMeTo += ah;
				}
				o.whenToStick = Math.floor(o.whenToStick);
				o.StickMeTo = Math.floor(o.StickMeTo);

			},
			/* Sticky header
			====================================================================*/
			stickyBarLink: function  (st){
				var o = $.ProRadioMainObj,
					smt = o.StickMeTo,
					wts = o.whenToStick,
					cando = o.fn.areClipPathShapesSupported();
				if(o.OTS.length === 0 || false === cando)return;
				if(st >= wts ){
					o.OTS.addClass("proradio-stickme");
					o.OTSc.addClass('proradio-paper').css({ 'top': smt+'px'} );
				} else {
					o.OTSc.removeClass('proradio-paper');
					o.OTS.removeClass("proradio-stickme");
				}
			},

			/* Sticky menu
			====================================================================*/
			stickyMenu: {
				doScrolledAction: $('body').hasClass('proradio-menu-stick'),
				init: function(){
					var that = $(this);
					$.ProRadioMainObj.body.addClass('proradio-unscrolled');
				},
				pageScrolled: function (st, direction){
					var that = $(this)[0];
					if( true === that.doScrolledAction ){
						var o = $.ProRadioMainObj,
							c = "proradio-headerbar__sticky__s";
						if( direction === 'up'){
							o.headerbar.removeClass(c);
						} else {
							if( st > 30 ){
								o.headerbar.addClass(c);
							}
						}
						if( st > 30 ){
							o.body.removeClass('proradio-unscrolled');
							o.body.addClass('proradio-scrolled');
						} else {
							o.body.addClass('proradio-unscrolled');
							o.body.removeClass('proradio-scrolled');
						}
					}
					
				}
			},
			
			/* Item menu right align: add class if item is > half
			====================================================================*/
			menuItemAlign: function(){
				var o = $.ProRadioMainObj,
					b = o.body,
					items = b.find('#proradio-menubar > li.menu-item'),
					hw = b.width() / 2;
				if(items.length == 0){ return; }
				items.each(function(i,c){
					var t = $(c);
					if(t.offset().left > hw){
						t.addClass('proradio-iright');
					}
				});
			},

			

			/* Countdown
			====================================================================*/
			countDown: {

				cd: $(".proradio-countdown"),
				cdf: this,
				pad: function(n,size) {
					return (n < size) ? ("0" + n) : n;
				},
				doClock:function(T, item){
					var cd = item;
					if(!cd.data('proradio-date') || !cd.data('proradio-time')){
						T.remove(cd);
						return;
					}
					var days, hours, min,
						cdf = T.cdf,
						html = '',
						fieldNow = cd.data('proradio-now'),
						nowdate = new Date(fieldNow),
						curDate = new Date(),
						fieldDate = cd.data('proradio-date').split('-'),
						fieldTime = cd.data('proradio-time').split(':'),

						label_days = cd.data('proradio-days'),
						label_hours = cd.data('proradio-hours'),
						label_minutes = cd.data('proradio-minutes'),
						label_seconds = cd.data('proradio-seconds'),
						label_msec = cd.data('proradio-msec'),

						futureDate = new Date(fieldDate[0],fieldDate[1]-1,fieldDate[2], fieldTime[0], fieldTime[1]),
						sec = futureDate.getTime() / 1000 - curDate.getTime() / 1000,
						msec =  futureDate.getTime() -  curDate.getTime();
					
					if(sec<=0 || isNaN(sec)){
						T.remove(cd);
						return cd;
					}

					days = Math.floor(sec/86400);
					sec = sec%86400;
					hours = Math.floor(sec/3600);
					sec = sec%3600;
					min = Math.floor(sec/60);
					sec = Math.floor(sec%60);
					msec = Math.floor(msec%1000);

					cd.find('.d .n').text(T.pad(days,10));
					cd.find('.h .n').text(T.pad(hours,10));
					cd.find('.m .n').text(T.pad(min,10));
					cd.find('.s .n').text(T.pad(sec,10));
					cd.find('.ms .n').text(T.pad(msec,100));
				},
				showclock: function() {
					
					
				},
				remove: function(cd){
					var T = $.ProRadioMainObj.fn.countDown;
					cd.closest('.proradio-countdown__container').remove();
					if(T.qtClockInterval){
						clearInterval(T.qtClockInterval);
					}
				},
				init: function() {
					var T = $.ProRadioMainObj.fn.countDown,
						cd = $(".proradio-countdown");
					if(cd.length < 1){
						return;
					}
					cd.each(function(i,c){
						T.doClock( T, $(c) );
					});
					if(T.qtClockInterval){
						clearInterval(T.qtClockInterval);
					}
					T.qtClockInterval = setInterval(function(){
						cd.each(function(i,c){
							T.doClock( T, $(c) );
						});
					},107); // arbitrary delay for refresh to avoid js overload. 
				}
			},


			/* custom waypoints component
			====================================================================*/
			qtWaypoints: {
				items: [],
				isloaded: false,
				reinitialize: function(){
					this.prepare();
				},
				init: function(){
					var f = this;
					$.ProRadioMainObj.window.on( "load", function(){
						setTimeout(
							function(){
								f.prepare();
							}, 
						200);
					});
				},
				prepare: function(){
					var f = this; 
					f.wh = $(window).height();
					var itemid = 0;
					$('[data-qtwaypoints]').each(function(i,c){
						var item = [];
						item['id'] = itemid;
						item['el'] = $(c);
						item['offset'] = $(c).attr('data-qtwaypoints-offset') || 50; // default 50px offset
						item['addclass'] = $(c).attr('data-qtwaypoints-addclass') || 'proradio-active';
						item['rewind'] = $(c).attr('data-qtwaypoints-rewind') || false;
						item['itemtop'] =  Math.floor( parseInt( $(c).offset().top ) + parseInt( item['offset'] ) );
						if( item['itemtop'] < f.wh ){
							item['el'].addClass( item['addclass'] );
						} 
						f.items.push(item);
						itemid++;
					});
					this.isloaded = true;
					this.update(0);
				},
				update: function(st){
					if( false === this.isloaded ){
						return;
					}
					var timeout = false;
					var f = this;
					var item;
					var virwportBottom;
					var itemtop;
					var el, offset, addclass, rewind;
					if(timeout){
						clearTimeout(timeout);
					}
					timeout = setTimeout(function(o){
						virwportBottom = st + f.wh;
						$.each( f.items , function(i,c){
							el = c['el'];
							c['animating'] = 1;
							offset = c['offset'];
							rewind = c['rewind'];
							addclass = c['addclass'];
							itemtop = c['itemtop'];
							if( itemtop < virwportBottom ){
								if(!el.hasClass(addclass)){
									el.addClass(addclass);
								}
							} else {
								if(rewind){
									el.removeClass(addclass);
								}
							}
							f.items[i]['animating'] = 1;
						});
					}, 30);
				}
			},




			/* Scrollspy
			====================================================================*/
			qtScrollSpy: {
				init: function(){
					function qtScrollSpyInit(){
						var o = $.ProRadioMainObj,
							cando = o.fn.areClipPathShapesSupported(),
							b = o.body,
							intmenu = $('#proradio-sticky'),
							offset = 0,
							sh = o.stickyheader,
							adminbar = $("#wpadminbar"),
							sections = [],
							pagemiddle =  Math.floor( $(window).height() / 2 );
						o.scrollspycontainer = b.find("[data-proradio-scrollspy]");
						if(intmenu.length > 0 ){
							offset = offset + 70;
						}
						if(sh.length > 0 ){
							offset = offset + sh.find('#proradio-menu').outerHeight();
						}
						if(adminbar.length > 0 ){
							offset = offset + adminbar.outerHeight();
						}
						pagemiddle = Math.floor( pagemiddle + ( offset / 2) );
						b.attr('data-scrollspy-half',pagemiddle);
						o.scrollspycontainer.find("a[href^='#']").each(function(i,c){
							var link = $(c),
								to,
								hash = link.attr('href'),
								section = $(hash);
							if(section.length > 0){
								var top = Math.floor(section.offset().top),
									bottom = top + Math.floor(section.outerHeight()),
									middle = (top + ((bottom - top) / 2)),
									to = top - offset;
								section.attr('data-scrollspy-mid', middle);
								if(cando){ // No Edge
									link.unbind('click')
									.off('click')
									.on('click', function(e){
										e.preventDefault();
										window.scrollTo({
										  top: to,
										  left: 0,
										  behavior: 'smooth'
										});
										return false;			
									});
								}
							}
						});
					}
					var initScroll = setTimeout( qtScrollSpyInit ,600);
				},
				update: function(st){
					var o = $.ProRadioMainObj,
						b = o.body,
						hp = Number(b.attr('data-scrollspy-half')),
						s = $('[data-scrollspy-mid]'),
						d, a = [], link,
						timeout = false,
						menu = $("#proradio-stickycon");
					s.each(function(i,c){
						var t = $(c),
						d = Math.abs( ( Number(t.attr('data-scrollspy-mid')) - st) - hp );
						a.push(
							[d,t.attr('id')]
						);
					}); 
					a.sort(function(a,b) {
						return a[0]-b[0]
					});
					if(undefined !== a[0]){
						link = a[0][1];
						if(timeout){
							clearTimeout(timeout);
						}
						timeout = setTimeout(function(o){
							menu.find('.proradio-active').removeClass('proradio-active');
							menu.find('a[href="#'+link+'"]').addClass('proradio-active');
						}, 30);
					}
				}
			},


			/* Owl
			====================================================================*/
			bannerCarouselHasBeenInitialized: function(event) {
				// Provided by the core
				var element   = event.target;         // DOM element, in this example .owl-carousel
				var name      = event.type;           // Name of the event, in this example dragged
				var namespace = event.namespace;      // Namespace of the event, in this example owl.carousel
				var items     = event.item.count;     // Number of items
				var item      = event.item.index;     // Position of the current item
				// Provided by the navigation plugin
				var pages     = event.page.count;     // Number of pages
				var page      = event.page.index;     // Position of the current page
				var size      = event.page.size;      // Number of items per page
			},
			owlCarousel: function(targetContainer){
				
				if(!jQuery.fn.owlCarousel) {
					return;
				}
				if(undefined === targetContainer) {
					targetContainer = "body";
				}
				var that = $(this);

				$(targetContainer+' .proradio-owl-carousel').each( function(i,c){
					var T = $(c),
						idc = $(c).attr("id"),
						itemIndex,
						controllerTarget;
					if(!T.hasClass('proradio-carousel-created')){
						T.fadeTo(0, 0);
					}
					
					var selectorId =  '#'+T.attr('id');
					T.owlCarousel({
						loop: T.data('loop'),
						margin: T.data('gap'),
						nav: T.data('nav'),
						dots: T.data('dots'),
						navText: ['<i class="proradio-arrow proradio-arrow__l"></i>', '<i class="proradio-arrow proradio-arrow__r"></i>'],
						center: T.data('center'),
						stagePadding: T.data('stage_padding'),
						autoplay:  T.data('autoplay_timeout') > 0,
						autoplayTimeout: T.data('autoplay_timeout'),
						autoplayHoverPause: T.data('pause_on_hover'),
						callbacks: true,
						mouseDrag: true,
						touchDrag: false,
						responsive:{
							0:{
								items: T.data('items_mobile'),
								mouseDrag: false,
								touchDrag: true
							},
							420:{
								items: T.data('items_mobile_hori'),
								mouseDrag: false,
								touchDrag: true
							},
							600:{
								items: T.data('items_tablet'),
								mouseDrag: false,
								touchDrag: true
							},
							1025:{
								items: T.data('items'),
							},
							1200:{
								items: T.data('items'),
								mouseDrag: true,
								touchDrag: true
							}
						},
						onInitialized:function(){
							T.addClass('proradio-carousel-created');
							$(c).delay(250).fadeTo(250, 1);
							that[0].activatesComponent( selectorId );
						},
					});
					if( T.hasClass('proradio-multinav-main')) {
						controllerTarget = T.data('target');
						T.parent().find('.proradio-multinav__controller').find('a:first-child').addClass('current');
						T.on('changed.owl.carousel', function (e) {
							if (e.item) {
								itemIndex = T.find('.active [data-index]').data('index') + 1;
								var index = e.item.index,
									count = e.item.count;
								if (index > count) {
									index -= count;
								}
								if (index <= 0) {
									index += count;
								}
								T.parent().find('.proradio-multinav__controller .current').removeClass('current');
								T.parent().find('.proradio-multinav__controller').find('[data-multinav-controller="'+itemIndex+'"]').addClass('current');
							}
						});
					}
					T.on('click', "[data-multinav-controller]", function(e){
						e.preventDefault();
						var t = $(this),
							i = t.data("multinav-controller"),
							targ = t.data("multinav-target");
						$('#'+targ).trigger('stop.owl.autoplay', i);
						$('#'+targ).trigger('to.owl.carousel', i);
						T.parent().find('.proradio-multinav__controller .owl-item a').removeClass('current');
						t.addClass('current');
					});
				});
			},

			/*Display a single map (requires related js and plugin to work)
			====================================================================*/
			displayMap: function(){
				if( 'object' !== typeof( google )){ return; }
				if( 'object' !== typeof( google.maps )){ return; }
				if( 'function' !== typeof( google.maps.Map )){ return; }
				$('[data-proradio-mapcoord]').each(function(i,c){
					var that = $(c),
						coords = that.attr('data-proradio-mapcoord').split(','),
						mapcontainer = that,
						id = that.attr('id');
					if($.ProRadioMainObj.fn.isMobile()){
						that.height(400);
					} else {
						that.height(600);
					}
					var myLatlng = new google.maps.LatLng(coords[0], coords[1]);
					var mapOptions = {
					  zoom: 12,
					  center: myLatlng,
					};
					var themap = new google.maps.Map(document.getElementById(id),mapOptions);
					var marker = new google.maps.Marker({position: {lat: parseFloat(coords[0]), lng: parseFloat(coords[1])}, map: themap});
				});
			},

			/* Sticky sidebar
			====================================================================*/
			stickySidebar: function  (){
				if('function' === typeof( $.fn.ttgStickySidebar ) && false === $.ProRadioMainObj.fn.isMobile()){
					$('.proradio-stickycol').each(function(i,c){
						var that = $(c),
							contSelector = '.proradio-stickycont',
							container = that.closest( contSelector ),
							randid = $.ProRadioMainObj.fn.uniqId();
						if(!container.attr('id')){
							container.attr('id', randid);
						}
						contSelector = container.attr('id');
						that.ttgStickySidebar({
							containerSelector: contSelector,
							additionalMarginTop: 200,
							additionalMarginBottom: 20,
							updateSidebarHeight: true,
							minWidth: 678
						});
					});
				}
			},

			/**
			 * Water waves effect headers
			 */
			qtWaterwaveInit: function(){
				setTimeout(
					function(){
						$('.proradio-waterwave__canvas').each(function(i,c){
							var t = $(c);
							t.css({bottom: '-100%'});
							var wv = t.waterwave({
								parent: t.parent(),
								speed: t.data('waterwave-speed') || 1,
								color: t.data('waterwave-color') || '#ffffff',
								background:  t.data('waterwave-background') || '' // image
							}).delay(5).promise().done(function(){
								t.animate({bottom:"0%"}, 600);
							});
						});
					},
					100
				);
			},



			/**
			 * Custom styles from shortcodes
			 */
			customStylesHead: function(){
				var styles = '';
				$('[data-proradio-customstyles]').each(function(i,c){
					styles = styles + $(c).data('proradio-customstyles');
				});
				$('#proradio-customstyles').remove();
				$('head').append('<style id="proradio-customstyles">'+styles+'<style>');
				// Also, fix viewport as if scalable will break performance and 3d
				$('[name="viewport"]').attr('content', 'width=device-width, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0');
			},

			/**
			 * Close the off canvas menu
			 */
			resetOverlay: function(){
				$('.proradio-overlayopen').removeClass('proradio-overlayopen');
			},

			/**
			 * Close off canvas menu if clicking an internal link
			 */
			internalLinkClose : function(){
				$('#proradio-overlay .proradio-menu-tree a').on('click',function(e){
					var href = $(this).attr('href');
					// Since 2019 04 18 + support internal links
					var pageURL = $(location).attr("href"),
						pageURL_array = pageURL.split('#'),
						pageURL_naked = pageURL_array[0],
						href_array = href.split('#'),
						href_naked = href_array[0];

					if(href_naked === pageURL_naked) {
						$.ProRadioMainObj.fn.resetOverlay();
						return e;
					}
				})
				
			},

			/**====================================================================
			 *
			 *
			 *	Masonry templates (based on default Wordpress Masonry)
			 *
			 * 
			 ====================================================================*/
			qtMasonry: function(targetContainer){
				if(undefined === targetContainer) {
					targetContainer = "body";
				}
				$('.qt-masonry').imagesLoaded().then(
					function(){
						var $grid = $('.qt-masonry').masonry(
						 	{  
						 		itemSelector: '.qt-ms-item',  
						  		columnWidth: '.qt-ms-item',
							}
						);
					}
				);
				$('.gallery').each(function(){
					var gallery = $(this);
					if(gallery.parent().hasClass('elementor-image-gallery')){
						return;
					}
					gallery.imagesLoaded().then(
						function(){
							var $grid = $('.gallery').masonry(
							 {  itemSelector: '.gallery-item',  
							  columnWidth: '.gallery-item', 
							  gutter: 10
							} );
						}
					);
				});
				return true;
			},


			
			loadmore: function(){
				var ob = $.ProRadioMainObj,
					body = ob.body,
					f = ob.fn,
					container , // container
					paginationButton = '[data-proradio-loadmore]',
					selectorId,
					button,
					link,
					pagination,
					list;
				body.off('click',paginationButton);
				body.on('click',paginationButton, function(e){
					e.preventDefault();
					button = $(this);
					link = button.attr('href');
					selectorId = button.data("proradio-loadmore");
					button.find('i').show();
					container = $(selectorId);
					$.ajax({
						url: link,
						success:function(data) {
							list = $(selectorId, data);
							pagination = container.find('.proradio-wp-pagination');
							pagination.fadeTo(250, 0, function(){
								pagination.remove();
								container.append(list.html());
								f.qtWaypoints.reinitialize();
								f.qtWaypoints.update( $.ProRadioMainObj.scrolledTop );
								f.activatesComponent( selectorId );
								f.countDown.init();
								if( container.hasClass('qt-masonry') ){
									container.masonry('reloadItems').masonry({
								        itemSelector: '.qt-ms-item',
								        transitionDuration: 0
								    });
								}
							});
						},
						error: function () {
							window.location.replace(link);
						}
					});

					e.stopPropagation();// to be tested!
				});
			},

			popupLink: function(){
				
				$(".proradio-popupwindow, .qt-popupwindow").off("click").on("click", function(e){
					
					e.preventDefault();

			
				
					
					
					var settings, parameters, mysettings, b, a, winObj;
					// for overrideing the default settings
					var btn = $(this),
						destination = btn.attr("href"),
						name = btn.attr("data-name"),
						width= btn.attr("data-width"),
						height= btn.attr("data-height");

					// @since 1.4.3
					// Stop audio if open the popup
					if( /proradio\-popup/i.test(destination)){
						if('object' === typeof($.qtPlayerObj)){
							var o = $.qtPlayerObj;
							var p = o.uniPlayer;
							var i = o.interface;
							var b = i.btnPlay;
							var state = b.find("i").html();
							if(state === 'pause'){
								p.pause();
							}
						}
					}

					settings = {
						height:600, // sets the height in pixels of the window.
						width:600, // sets the width in pixels of the window.
						toolbar:0, // determines whether a toolbar (includes the forward and back buttons) is displayed {1 (YES) or 0 (NO)}.
						scrollbars:1, // determines whether scrollbars appear on the window {1 (YES) or 0 (NO)}.
						status:0, // whether a status line appears at the bottom of the window {1 (YES) or 0 (NO)}.
						resizable:1, // whether the window can be resized {1 (YES) or 0 (NO)}. Can also be overloaded using resizable.
						left:0, // left position when the window appears.
						top:0, // top position when the window appears.
						center:0, // should we center the window? {1 (YES) or 0 (NO)}. overrides top and left
						createnew:1, // should we create a new window for each occurance {1 (YES) or 0 (NO)}.
						location:0, // determines whether the address bar is displayed {1 (YES) or 0 (NO)}.
						menubar:0, // determines whether the menu bar is displayed {1 (YES) or 0 (NO)}.
						onUnload:null // function to call when the window is closed
					};
					if(width) {
						settings.width = width;
					}
					if(height) {
						settings.height = height;
					}
					// center the window
					if (settings.center == 1)
					{
						settings.top = (screen.height-(settings.height + 110))/2;
						settings.left = (screen.width-settings.width)/2;
					}

					parameters = "location=" + settings.location + ",menubar=" + settings.menubar + ",height=" + settings.height + ",width=" + settings.width + ",toolbar=" + settings.toolbar + ",scrollbars=" + settings.scrollbars  + ",status=" + settings.status + ",resizable=" + settings.resizable + ",left=" + settings.left  + ",screenX=" + settings.left + ",top=" + settings.top  + ",screenY=" + settings.top;
					winObj = window.open(destination, name, parameters);
				


					e.stopPropagation();
					return false;
				});
			},


			/**====================================================================
			 *
			 * 
			 *  Ajax elements refresh
			 *  
			 * 
			 ====================================================================*/
			widgetsRefresh: function(){
				if( $( 'body' ).hasClass( 'elementor-editor-active' ) ){
					return;
				}
				var that = $(this)[0];
				var originalContainer, newContent, oldContent;
				var link = window.location.href;
				var idsToRefresh = [];
				$( '[data-proradio-autorefresh]' ).each( function( i,c ){
					if( $(c).attr( 'id' ) ){
						idsToRefresh.push( $(c).attr( 'id' ) );
					}
				});
				if( idsToRefresh.length <= 0 ){
					return;
				}
				if('undefined' !== typeof( that.wrInterval ) ){
					clearInterval( that.wrInterval );
				}

				that.wrInterval = setInterval(
					function() {
						$.ajax({
							url: link,
							success: function( data ){
								$.each(idsToRefresh, function(i,id){
									var theselector = '#'+id;
									var item = $(theselector);
									var newData = $(data).find(theselector);
									if(newData){
										var newHtml = newData.html();
										item.animate({opacity: 0}, 150, function(){
											item.html( newHtml ).delay(10).promise().done(function(){
												that.switchClass(theselector);
												that.activatesComponent(theselector);
												that.tabsComponent(theselector);
												that.qtWaypoints.reinitialize();
												that.qtWaypoints.update( $.ProRadioMainObj.scrolledTop );
												that.owlCarousel(theselector);
												item.animate({opacity: 1}, 150);
											});
										});
									}
								});
							},
							error: function( e ){

							}
						});

					},
					120000 
				);
			},
			


			/* Theme clock: perform some actions at some interval
			====================================================================*/
			themeScroll: function(){
				var o = $.ProRadioMainObj,
					f = o.fn,
					st, 
					os,
					timer = o.clockTimer; 
				
				if( f.isMobile() ){
					timer = o.clockTimerMobile; 
				}

				if(o.clock !== false){
					clearInterval( o.clock );
				}
				o.body.attr('data-proradio-scrolled', 0);
				o.clock = setInterval(
					function(){
						f.scrolledTop(); 
						st = o.scrolledTop;
						os = o.oldScroll;
						if( os !== st  ){
							o.oldScroll = st;
							f.stickyBarLink(st);
							o.body.attr('data-proradio-scrolled', st);
							f.qtScrollSpy.update(st);
							f.qtWaypoints.update(st);
							if(st > (os + 50) ) {
								f.stickyMenu.pageScrolled(st, 'down');
							}
							if(st < (os - 50) && st < 400 ){
								f.stickyMenu.pageScrolled(st, 'up');
							}
						}
					},timer
				);
			},

			collapsibleWrapper: function(){
				if( 'function' === typeof( $.fn.collapsible ) ){
					$('.qt-collapsible').collapsible();
				}
			},




			/* Trigger custom functions on window resize, with a delay for performance enhacement
			====================================================================*/
			windowResized: function(f){
				var rst,
					w = f.window;
				f.wW = w.width();
				f.wH = w.height();
				w.on('resize', function(e) {
					clearTimeout(rst);
					rst = setTimeout(function() {
						f.qtScrollSpy.init();
						f.qtWaypoints.reinitialize();
						f.menuItemAlign();
						f.owlCarousel();
						f.qtWaterwaveInit();
						f.qtMasonry();
						if (w.height() != f.wH) {
							f.stickyBarLinkPrep();
							f.themeScroll();
						}
						if (w.width() != f.wW){
							f.stickyBarLinkPrep();
							f.YTreszr();
						}
					}, 500);
				});
			},

			/**
			 * ====================================================================
			 *  FPS counter
			 * ====================================================================
			 */
			countFps: function(proradioElementor){
				var that = this;
				var body = $("body");
				var debugOutput = ($("body").hasClass('proradio-jsdebug'))? 1 : 0;
				body.append('<output id="proradio-elementor-PerformanceCheck" style="position: fixed;bottom: 70px;left: auto; right:0;padding: 0 2px;opacity: '+debugOutput+';background:black;color:white;z-index:100; font-size: 10px;"></output>');
				var $out = $('#proradio-elementor-PerformanceCheck');
				that.countFPSf = (function () {
				  var lastLoop = (new Date()).getMilliseconds();
				  var count = 1;
				  var fps = 0;
				  return function () {
					var currentLoop = (new Date()).getMilliseconds();
					if (lastLoop > currentLoop) {
					  fps = count;
					  count = 1;
					} else {
					  count += 1;
					}
					lastLoop = currentLoop;
					proradioElementor.fps = fps;
					return fps;
				  };
				}());
				
				(function loop() {
					requestAnimationFrame(function () {
					  $out.html(that.countFPSf() + 'FPS');
					  loop();
					});
				}());
			},

			/**
			 * ====================================================================
			 *  3D elements append listeners
			 * ====================================================================
			 */
			fx3dElements: {
				init: function(proradio){
					var the3dElements = [
						$('.proradio-3dheader')
					];
					$.each(the3dElements, function(){$(this).each(function(){
							var t = $(this);
							t.off('onmouseenter.proradio3d').off('mouseleave.proradio3d')
							.on('mouseenter.proradio3d', function(){
								proradio.animation3D.target = t;
								proradio.animation3D.init( proradio );
							});
						});
					});
				},
			},

			/**
			 * ====================================================================
			 * Animation in 3D
			 * ====================================================================
			 */
			animation3D: {
				target: false,
				reset: function() {
					var old = $('.proradio-animating-3d');
					if( old.length > 0 ){
						var resetCss = {"transform": "matrix3d(1, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1, 1, 0, 0, 0, 1) translate(0, 0)", "transition" : 'all 1s ease' };
						$('.proradio-animating-3d .proradio-3dheader__contents__caption, .proradio-animating-3d .proradio-3dheader__bg--1, .proradio-animating-3d .proradio-3dheader__bg--2').css(resetCss);
						old.removeClass('proradio-animating-3d');
					}
				},
				init: function( v ){
					var that = this,
						win = v.window,
						item = false, e, mouseXrel, mouseYrel,  moveX, moveY, matrix1, matrix2;
					that.reset();
					if( v.wW > 1190 && false !== that.target ){
						that.target.addClass('proradio-animating-3d');
						item 				= $('.proradio-animating-3d');
						var toMove 			= [];
						item['el'] 			= item;
						toMove['content'] 	= item.find('.proradio-3dheader__contents');
						toMove['bg1'] 		= item.find('.proradio-3dheader__bg--1');
						toMove['bg2'] 		= item.find('.proradio-3dheader__bg--2');
						e = v.mousePos;
						var centerX = item.offset().left + ( item.width() / 2 );
						var centerY = item.offset().top + ( item.height() / 2 );
						mouseXrel = (e.x - centerX) * - 1 / 100;
						mouseYrel = (e.y - centerY) * - 1 / 100;
						moveX = mouseXrel * 0.000013;
						moveY = mouseYrel * 0.000013;
						matrix1 = [[1, 0, 0, - moveX], [0, 1, 0, - moveY], [0, 0, 1, 1], [0, 0, 0, 1]];
						matrix2 = [[1, 0, 0, - moveX], [0, 1, 0, - moveY], [0, 0, 1, 1], [0, 0, 0, 1]];
						if(!that.target.hasClass('.proradio-animating-3d')){
							$('.proradio-animating-3d .proradio-3dheader__contents__caption').css({"transition" : 'all 0.15s ease', "transform": "matrix3d(" + matrix1.toString() + ") translate(" + mouseXrel *  -4 + "px, " + mouseYrel  * -4 + "px)"});
							$('.proradio-animating-3d .proradio-3dheader__bg--1').css({"transition" : 'all 0.2s ease', "transform": "translate(" + mouseXrel  * -4 + "px, " + mouseYrel * -4 + "px)"});
							$('.proradio-animating-3d .proradio-3dheader__bg--2').css({"transition" : 'all 0.2s ease', "transform": "translate(" + mouseXrel  * 2 + "px, " + mouseYrel * 2 + "px)"});
						}
						v.moverMouse = { 
							x: centerX,
							y: centerY
						};
						win.on('proradioMouseMoved.proradio3d', function(){
							// if( v.fps > 8 ){
								$(v.moverMouse).clearQueue();
								$(v.moverMouse).animate({
								  x: v.mousePos.x ,
								  y: v.mousePos.y
								}, {
								  	duration: 110,
								  	step: function() {
										mouseXrel = (v.moverMouse.x - centerX) * - 1 / 100;
										mouseYrel = (v.moverMouse.y - centerY) * - 1 / 100;
										moveX = mouseXrel * 0.000013;
										moveY = mouseYrel * 0.000013;
										matrix1 = [[1, 0, 0, - moveX], [0, 1, 0, - moveY], [0, 0, 1, 1], [0, 0, 0, 1]];
										matrix2 = [[1, 0, 0, - moveX], [0, 1, 0, - moveY], [0, 0, 1, 1], [0, 0, 0, 1]];
										// IMPORTANT: never replace $('.proradio-animating-3d') with a variable or the animation falls bad
										$('.proradio-animating-3d .proradio-3dheader__contents__caption').css({"transform": "matrix3d(" + matrix1.toString() + ") translate(" + mouseXrel *  -4 + "px, " + mouseYrel  * -4 + "px)", 'transition':'none'});
										$('.proradio-animating-3d .proradio-3dheader__bg--1').css({"transform": "translate(" + mouseXrel  * -4 + "px, " + mouseYrel * -4 + "px)", "transition" : 'none'});
										$('.proradio-animating-3d .proradio-3dheader__bg--2').css({"transform": "translate(" + mouseXrel  *  2 + "px, " + mouseYrel *  2 + "px)", "transition" : 'none'});
								  	}
								});
							// }
						});
					}
				},
			},

			/**
			 * ====================================================================
			 *  Mouse move binding
			 *  * Do not run on small screens
			 *  * Do not run if the FPS are too low, prevent browser stuck
			 * ====================================================================
			 */
			proradioMouseMove: {
				init: function( proradio ){
					var win = proradio.window;
					win.off('mousemove.proradiospace'); //proradiospace = aleatory namespace
					proradio.mousePos = { x: proradio.wW / 2, y: proradio.wH / 2 };
					win.trigger('proradioMouseMoved');
					proradio.mouseAnimation = false;
					if( win.width() > 1190 ){
						win.on('mousemove.proradiospace', function(e){ // stateful 
							proradio.mousePos = { 
								x: e.pageX,
								y: e.pageY
							};

							win.trigger('proradioMouseMoved');
						});
					}
				},
			},

			/**
			 * ====================================================================
			 *  offCanvasWypointFix
			 *  * Fix waypoint items added in the OffCanvas element
			 * ====================================================================
			 */
			offCanvasWypointFix: function(){

				$('#proradio-sidebar-offcanvas [data-qtwaypoints]').addClass('proradio-active');
			},


			/**====================================================================
			 *
			 *	After ajax page initialization
			 * 	Used by QT Ajax Pageloader. 
			 * 	MUST RETURN TRUE IF ALL OK.
			 * 
			 ====================================================================*/
			initializeAfterAjax: function(){
				var f = this;
				f.proradioMouseMove.init( f );
				f.customStylesHead();
				f.resetOverlay();
				f.qtWaterwaveInit();
				f.countDown.init();
				f.YTreszr();
				f.switchClass();//
				f.activatesComponent();//
				f.ipadBgFix();
				f.fx3dElements.init(f);
				f.qtParallax();
				f.qtVcVideobg();
				f.qtScrollSpy.init();
				f.tabsComponent();
				f.stickySidebar();
				f.displayMap();
				f.transformlinks();
				f.collapsibleWrapper();
				f.qtMasonry();
				f.loadmore();
				f.qtWaypoints.reinitialize();
				f.offCanvasWypointFix();
				f.owlCarousel();//
				f.widgetsRefresh();
				if("function" === typeof($.fn.qtChartvoteInit)) {
					$.fn.qtChartvoteInit();
				}
				if("function" === typeof($.qtSwipeboxFunction)) {
					$.qtSwipeboxFunction();
				}
				if("function" === typeof jQuery.vdl_Init){
					jQuery.vdl_Init();
				}
				
				if("function" === typeof $.fn.qtDynamicMaps){
					$.fn.qtDynamicMaps();
				}
				if("function" === typeof $.fn.qtPlacesInit){
					$.fn.qtPlacesInit();
				}
				return true;
			},
			/**====================================================================
			 *
			 * 
			 *  Functions to run once on first page load
			 *  
			 *
			 ====================================================================*/
			init: function() {
				var f = this;
				if( f.isSafari() ){
					$('body').addClass('isSafari');
				}
				// f.countFps(f);
				$('html').removeClass('no-js');
				f.treeMenu();
				f.stickyBarLinkPrep();
				f.stickyMenu.init();
				f.themeScroll();
				f.initializeAfterAjax(f);
				f.areClipPathShapesSupported();
				f.menuItemAlign();
				f.internalLinkClose();
				f.popupLink();
				f.windowResized(f);// Always last
			},
		}
		/**
		 * ======================================================================================================================================== |
		 * 																																			|
		 * 																																			|
		 * END SITE FUNCTIONS 																														|
		 * 																																			|
		 *																																			|
		 * ======================================================================================================================================== |
		 */
	};
	/**====================================================================
	 *
	 *	Page Ready Trigger
	 * 
	 ====================================================================*/
	jQuery(document).ready(function() {
		$.ProRadioMainObj.fn.init();	
	});


})(jQuery);


