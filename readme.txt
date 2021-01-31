=== ProRadio ===
Contributors: Pro.Radio
Requires at least: WordPress 5.5.1
Requires PHP: 7.3
Tested up to: 5.6
Version: 1.5.9
Tags: two-columns, right-sidebar

== Description ==
ProRadio: Professional Radio Station WordPress theme

* Mobile-first, Responsive Layout
* Custom Colors
* Custom Header
* Social Links
* Post Formats
* The GPL v2.0 or later license. 

== Installation ==
1. In your admin panel, go to Appearance -> Themes and click the 'Add New' button.
2. Click "upload" and select the file proradio.zip within the subfolder "themes" of the product package, upload it
3. Click on the 'Activate' button to use your new theme right away.
4. Go to www.ProRadio.xyz/manuals/proradio/ for a guide on how to customize this theme.
5. Navigate to Appearance > Customize in your admin panel and customize to taste.


CPANEL Optimize Compression Settings: 
text/html text/plain text/xmltext/html text/plain text/xml application/javascript font/opentype image/svg+xml text/css text/javascript

== Copyright ==
Pro.Radio WordPress Theme, Copyright 2020 ProRadio.com

== Changelog ==
https://pro.radio/changelog/


1.5.9 [2021-01-24]

[X] Player updated to v PR.3.4.2
- [x] Added in Customiser Player Settings an option to hide also the back an forward arrows
- [x] Better mobile reactivity for iOS on Play button, removed delay/stuck player issue
- [x] Added preload caching spinner to let user know the audio is loading

[x] CSS improvemend: added material icons hack, show icons only after loading, prevent nasty labels from appearing
[x] Added any post type to WP Json REST API. Check docs for more info





1.5.8 [2021-01-05]
[x] ADDED radioBoss support TRAC: 511 REQUIRES Player version PR.3.4.0
[x] CSS updates fix logo transparency


1.5.7.1 [hotfixes]
[x] UPDATED menu.php Added to ads the class 'proradio-hide-on-large-and-down' to hide in mobile
[x] template-parts/shared/actions.php and template-parts/post/interactions.php added "__" to esc_attr "Share" label print

1.5.7 [2020-12-23]
[x] qtt-main.js update function tabsComponent

1.5.6 [2020-12-22]
[x] UPDATED theme-updated.php
[x] updated plugin Pro.Radio player
[x] updated plugin Pro.Radio Elementor Widgets
[x] updated plugin Pro.Radio Theme Core


1.5.5 [2020-12-21]
[x] CSS UPDATE - MegaFooter z-index change from 1 to 2
[X] ADDED custom elementor player template in the main product zip file


1.5.4 [2020-12-21]

New:
[x] ADDED to repository ProRadio Elementor  PR.2.1.4 
[x] ADDED to repository ProRadio Player  PR.3.3.5
[x] ADDED template ProRadio Canvas (no header, no footer, no menu, no player)
[x] ADDED popup link support in theme-function-button.php
[X] ADDED popup link support in Elementor button widget
[x] ADDED hidden player option in Customizer Player settings
[x] ADDED menu.php separated desktop menu bar template
[x] ADDED menu.php added new template option
[x] ADDED SecureSystems streaming server:  support 476
[x] ADDED RadioJar stream model: support 487
[x] ADDED Ads, shortcode or content slot in customizer for header
[x] ADDED spotify link for team and shows sections? Support 483
[x] ADDED New menu template on 2 rows

Fixes:
[x] FIXED related shows: support 485
[x] FIXED schedule menu with sticky menu padding top mobile and tablet
[x] FIXED mobile switch fix: support 485



1.5.3 [2020-12-13]
[x] FIX qtt-main.js added function offCanvasWypointFix to fix items with WayPoint in the off canvas bar
[x] FIX Updated ProRadio Widgets plugin to 1.0.1 [updated widget-upcomingshows.php]
[x] FIX Updated files theme-function-upcoming-shows-carousel.php and theme-function-upcoming-shows-slider.php (fixed upcoming shows for next day and removed duplicates)
[x] FIX and IMPROVED support for cross midnight shows 
Note: to use cross midnight shows, repeat the same show with same time on the 2 days, ex. 11pm to 02am, as last show on day 1 and first show on day 2
Example: if a show is on Saturday from 11:00PM to 02:00AM, repeat the same show as first item on Sunday with same time 11:00PM to 02:00AM


1.5.2 [2020-12-09:17.40CET]
[x] Added new ProRadio Swipebox Video and Gallery plugin V 5.6 to replace Easy Swipebox for WP 5.6
[x] QT Music Player plugin update to version PR.3.3.1
[x] qtt-main.js reinitialize Swipebox after ajax

1.5.1 [2020-12-09]
[x] Updated template-parts/pageheader/part-sociallinks-members.php

1.5.0 [2020-12-09]
[x] WP5.6 update inc/tgm-plugin-activation/conf.php added force easy swipebox deactivation

1.4.9 [2020-12-09]
[x] Solved duplicated current show label while using both OnAir banner and Upcoming Shows slider in theme-function-upcoming-shows-slider.php

1.4.8 [2020-12-09]
[x] theme-function-onair.php and slider__item--show.php updated to override db query cache
[x] extract-schedule-day.php added cache prevention (fetch new shows results)

1.4.7 [2020-12-08]
[x] ADDED Pl Translation
[x] FIXED show events list template-parts/single/show/part-single-show-events.php

1.4.6 [2020-12-02]
[x] WooCommerce colors customizer buttons and hover links - updated inc/proradio-core-setup/customizer/kirki-configuration/sections/buttons_section.php
[x] WooCommerce updated woocommerce.css - enabled cart icon on archives
[x] Caption item: increased line height to 1.3em, added overflow hidden (small design change, sharper design)
[x] ADDED related shows field in team members.
[x] Categories font size decreased from 13 to 11px
[x] Player Update  PR.3.3.0:  Added in customizer options to hide playlist and link to page icons
[x] ADDED Cover widget in Elementor (Beta feature)
[x] Update Proradio Elementor to PR.2.1.0

1.4.5 [2020-12-01]
[x] member-type.php added soundcloud and mixcloud icons

1.4.4 [2020-11-27]
[x] Carousels fix

1.4.3 [2020-11-26]
[x] ADDED: Optional sidebar for videos single page
[x] ADDED: popup volume
[x] ADDED: mobile CTA colors from customizer https://pro.radio/shop/mypradmin/supporttickets.php?action=view&id=183
[x] ADDED: full site wide background image in customizer
[x] ADDED: qtt-main.js:1311 stop audio if popup opens
[x] ADDED: Custom taxonomy custom slug https://pro.radio/shop/mypradmin/supporttickets.php?action=view&id=245
[x] ADDED: Custom slug for Videos
[x] ADDED: Radio king provider
[x] ADDED: Azuracast radio provider
[x] FIX: Current show fix in template-parts/slider/slider__item--show.php
[x] FIX: Fix scroll gesture on owl carousels https://pro.radio/shop/mypradmin/supporttickets.php?action=view&id=304
[x] FIX: Show pages hide sections if empty https://pro.radio/shop/mypradmin/supporttickets.php?action=view&id=322
[x] FIX: Chart vote (FILE inc/proradio-core-setup/theme-functions/theme-function-chart-tracklist.php:159 replaced $trackid with $event['trackid']): bug when reorder is enabled https://pro.radio/shop/mypradmin/supporttickets.php?action=view&id=293
[x] FIX: WOOCOMMERCE Fixed related caption design woocommerce/single-product/related.php
[x] FIX: WOOCOMMERCE disabled comments script from WP causing force reflow in product pages
[x] WooCOmmerce updates
[x] Update plugin player in repository (3.2.9)
[x] Update plugin Video galleries in repository
[x] Update plugin Theme Core in repository
[x] Update plugin Ajax Page Load
[x] Update plugin Chart Vote
[x] Demo content: use GUID reset and reexported


1.4.2 [2020-10-28]
[x] Load more pagination button fix in mobile
[x] pagination fix


1.4.1 [2020-10-14]
[x] Added related news posts to single show page template
[x] PRORADIO ELEMENTOR PLUGIN  added typography selector for chart titles size https://pro.radio/shop/mypradmin/supporttickets.php?action=view&id=124
[x] ADDED Elementor color picker for submenu hover and color


1.4.0 [2020-10-09]
[x] Image size performance improvement in shows, post and schedule slider templates
[x] PRORADIO ELEMENTOR PLUGIN Updated to PR.2.0.6
[x] PRORADIO ELEMENTOR PLUGIN Performance improvement for home pages
[x] PRORADIO ELEMENTOR PLUGIN Load widgets js only in Elementor editor
[x] NEW! CUSTOMIZER ADDED scrolled menu background color picker (ticket 82)
[x] NEW! CUSTOMIZER ADDED scrolled menu text color picker https://pro.radio/shop/mypradmin/supporttickets.php?action=view&id=82
[x] AJAX PLUGIN Updated plugin PR.3.4.7
[x] AJAX PLUGIN Added preloader colors options
[x] AJAX PLUGIN Added preloader between page change option
[x] AJAX PLUGIN Moved preloader to top layer z-index (above menu)
[x] RADIO PLAYER PLUGIN Updated plugin 3.2.6
[x] RADIO PLAYER PLUGIN Better performance
[x] RADIO PLAYER PLUGIN Minified js version added (optional checkbox in settings)
[x] RADIO PLAYER PLUGIN Added admin settings page
[x] Demo contents: updated contents


1.3.5 [2020-10-06]
[x] removed wp_reset_postdata from 3 files because it was apparently breaking the mega footer. no side effects detected. 
- inc/proradio-core-setup/theme-functions/theme-function-upcoming-shows-carousel.php
- inc/proradio-core-setup/theme-functions/theme-function-upcoming-shows-carousel.php
- inc/proradio-core-setup/custom-types/schedule/functions/extract-schedule-day.php


1.3.4 [2020-10-05]
[x] template-parts/footer/copyright-bar.php added qt-disableembedding
[x] template-parts/header/secondary-header.php added qt-disableembedding [fix support ticket 89]

1.3.3 [2020-09-23]
[x] Removed debug froom qtt-main.js [popupLink]
[x] Fixed double volume glitch while vol button is in the menu bar (updated player plugin)
[x] moved volume code always in header, added placeholder in footer
[x] RO language translation added
[x] Update Reaktions plugin to 4.0.7 
[x] Update plugin QTM Player to 3.2.5
[x] Fixed Icon colors in menu for mobile
[x] Translations updated to include new strings
[x] Translation label "now on air" in schedule


1.3.2 [2020-09-12]
[x] welcome-page.php remove status transient for udpate when added purchase code
[x] welcome-page.php removed theme version from title welcome box

1.3.1 [2020-09-12]
[x] inc/tgm-plugin-activation/conf.php updated plugin slug

1.3.0 [2020-09-09]
[x] Inline help switch added to Welcome page
[x] Theme updater moved to theme-updater.php from welcome-page.php
[x] remote.php deleted control on page || $_GET['page'] == 'proradio-welcome'
[x] inline helper PHP file renamed from index.php to inline-helper.php
[x] ADDED Audomatic theme backup System
[x] ADDED automatic theme backup before theme udpate
[x] CSS update of welcome page
[x] TGMPA Dismiss link removed 'dismiss'  => $this->dismissable 
[x] TGM REMOVED LINE 1111 class-tgmpa-plugin-activation.php // || get_user_meta( get_current_user_id(), 'tgmpa_dismissed_notice_' . $this->id, true ) 

1.2.8 [2020-09-07]
[x] added qt-disableembedding to the social icons
[x] UPDATED plugin Prodario Core to PR.4.0.4
[x] secondaryheader.scss fixed song title alignment
[x] Performance improvements: removed certain visual effects
[x] Fixed color controls on menu items
[x] Added background color for submenu items
[x] Inline manual in admin
[x] Upcoming post slider + carousel: Huge logic fix for upcoming shows extractions, cross midnight function fixed

1.2.7 [2020-08-18]
[x] Updated Server Check plugin version internal zip
[x] Updated ProRadio theme core plugin online repository

1.2.6 [2020-07-22]
[x] main.js update and added minified version

1.2.5
[x] WooCommerce update
[x] 3D updated
[x] Performance improvement
[x] Added new License Key validation
[x] Added Javascript Debug option in customizer advanced section