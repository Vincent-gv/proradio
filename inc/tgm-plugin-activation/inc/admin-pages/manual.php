<?php  

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}


/**
 * =============================================
 * THEME MANUAL
 * =============================================
 */
if ( ! function_exists( 'proradio_welcome_page_manual' ) ) {
	function proradio_welcome_page_manual() {
		if(!is_admin()){
			return;
		}
		?>
		<div class="proradio-welcome proradio-welcome__page">

			<div class="proradio-welcome__container">
				<div class="proradio-welcome__defaultcontainer">
					<h3>Knowledgebase search</h3>
					<p>Search directly in our Knowledgebase. For instance, try "radio"</p>
					<form class="proradio-welcome__search" role="form" target="_blank" method="post" action="https://pro.radio/shop/knowledgebase/search?f=wpa">
						<div class="kb-search">
							<div class="kb-search-wrapper pattern-bg-knowledgebase">
								<div class="input-group search-group">
									<input type="text" id="inputKnowledgebaseSearch" name="search" class="form-control input-lg" placeholder="How can we help today?" value="">
									<span class="input-group-btn">
										<button type="submit" id="btnKnowledgebaseSearch" class="proradio-btn button button-primary">Search</button>
									</span>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
			<?php  

			/**
			* ======================================
			* Inline help switch
			* ======================================
			*/
			if(function_exists('proradio_inline_help_switcher_form')){
				?>
				<div class="proradio-welcome__container" id="proradio-helper-control">
					<div class="proradio-welcome__defaultcontainer">
						<?php  
						proradio_inline_help_switcher_form();
						?>
					</div>
				</div>
				<?php  
			}

			?>

			<div class="proradio-welcome__container">
				<div class="proradio-welcome__defaultcontainer">
					<h3>Knowledgebase chapters | <a href="https://pro.radio/shop/knowledgebase/1/Pro-Radio-WordPress-Theme" target="_blank">Go to Manual</a></h3>
					<p>Each link opens in a new tab</p>
					<div class="proradio-kb">
						<a target="_blank" href="https://pro.radio/shop/knowledgebase/2/01.-Getting-started">01. Getting started (8)
						<p>Requirements and set up process</p>
						</a>
						<a target="_blank" href="https://pro.radio/shop/knowledgebase/3/02.-Updating-theme-and-plugins">02. Updating theme and plugins (2)
						<p>This section contains the updating procedures for your theme and plugin</p>
						</a>
						<a target="_blank" href="https://pro.radio/shop/knowledgebase/4/03.-Customizations">03. Customizations (18)
						<p>How to edit the global appearance of your radio station website</p>
						</a>
						<a target="_blank" href="https://pro.radio/shop/knowledgebase/5/04.-Pages">04. Pages (24)
						<p>Pages are the most basic structure of data of your website, along with blog posts and archives. </p>
						</a>
						<a target="_blank" href="https://pro.radio/shop/knowledgebase/6/05.-Blog">05. Blog (8)
						<p>How to create the news blog</p>
						</a>
						<a target="_blank" href="https://pro.radio/shop/knowledgebase/7/06.-Sponsors">06. Sponsors (4)
						<p>This theme allows to store and display Sponsors in your pages.</p>
						</a>
						<a target="_blank" href="https://pro.radio/shop/knowledgebase/8/07.-Music-charts">07. Music charts (7)
						<p>Create and manage music charts (top 10)</p>
						</a>
						<a target="_blank" href="https://pro.radio/shop/knowledgebase/9/08.-Team-Members">08. Team Members (7)
						<p></p>
						</a>
						<a target="_blank" href="https://pro.radio/shop/knowledgebase/10/09.-Podcasts">09. Podcasts (7)
						<p>This theme has a custom post type for Podcasts, which is recommended instead of using regular posts for your podcasting activity.</p>
						</a>
						<a target="_blank" href="https://pro.radio/shop/knowledgebase/11/10.-Events">10. Events (9)
						<p>An event is a custom post type that allows you to add some special fields like date, location, address, map and event detail.</p>
						</a>
						<a target="_blank" href="https://pro.radio/shop/knowledgebase/12/11.-Videos">11. Videos (4)
						<p>Create video pages and filterable video galleries</p>
						</a>
						<a target="_blank" href="https://pro.radio/shop/knowledgebase/13/12.-Radio-channels">12. Radio channels (13)
						<p>To add and play web radio streams with the player, you will need to create the Radio Channels using this dedicated post type.</p>
						</a>
						<a target="_blank" href="https://pro.radio/shop/knowledgebase/14/13.-Radio-shows-and-schedule">13. Radio shows and schedule (10)
						<p>The shows are custom post types used to compose a schedule.</p>
						</a>
						<a target="_blank" href="https://pro.radio/shop/knowledgebase/15/14.-Contact-pages-and-form">14. Contact pages and form (2)
						<p>How to add a contact form with the Pro.Radio WordPress theme</p>
						</a>
						<a target="_blank" href="https://pro.radio/shop/knowledgebase/16/15.-Donations">15. Donations (1)
						<p>Manage donation forms in your radio station website</p>
						</a>
						<a target="_blank" href="https://pro.radio/shop/knowledgebase/17/16.-Icons2Go-plugin">16. Icons2Go plugin (1)
						<p>Custom icons plugin for your website</p>
						</a>
						<a target="_blank" href="https://pro.radio/shop/knowledgebase/18/17.-Mega-footer">17. Mega footer (1)
						<p>Create and manage footers with Elementor</p>
						</a>
						<a target="_blank" href="https://pro.radio/shop/knowledgebase/19/18.-Music-player">18. Music player (1)
						<p>How the music player works, settings and features</p>
						</a>
						<a target="_blank" href="https://pro.radio/shop/knowledgebase/20/19.-Ajax-page-load">19. Ajax page load (1)
						<p>This plugin handles the ajax page loading allowing the musc to play across pages</p>
						</a>
						<a target="_blank" href="https://pro.radio/shop/knowledgebase/21/20.-Translating-theme-and-plugins">20. Translating theme and plugins (1)
						<p>This theme is very easy to translate as the .mo .po (pot) files are provided within the language sub folder of the theme.</p>
						</a>
						<a target="_blank" href="https://pro.radio/shop/knowledgebase/22/21.-Privacy-settings">21. Privacy settings (1)
						<p>This chapter provides general information about privacy and GDPR</p>
						</a>
					</div>
				</div>
			</div>
		</div>
		<?php  

	}
}

