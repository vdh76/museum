<?php
//print $_SERVER['REQUEST_URI'];
//exit;
/*
 * @file
 * Zen theme's implementation to display a single Drupal page.
 *
 * Available variables:
 *
 * General utility variables:
 * - $base_path: The base URL path of the Drupal installation. At the very
 *   least, this will always default to /.
 * - $directory: The directory the template is located in, e.g. modules/system
 *   or themes/garland.
 * - $is_front: TRUE if the current page is the front page.
 * - $logged_in: TRUE if the user is registered and signed in.
 * - $is_admin: TRUE if the user has permission to access administration pages.
 *
 * Site identity:
 * - $front_page: The URL of the front page. Use this instead of $base_path,
 *   when linking to the front page. This includes the language domain or
 *   prefix.
 * - $logo: The path to the logo image, as defined in theme configuration.
 * - $site_name: The name of the site, empty when display has been disabled
 *   in theme settings.
 * - $site_slogan: The slogan of the site, empty when display has been disabled
 *   in theme settings.
 *
 * Navigation:
 * - $main_menu (array): An array containing the Main menu links for the
 *   site, if they have been configured.
 * - $secondary_menu (array): An array containing the Secondary menu links for
 *   the site, if they have been configured.
 * - $secondary_menu_heading: The title of the menu used by the secondary links.
 * - $breadcrumb: The breadcrumb trail for the current page.
 *
 * Page content (in order of occurrence in the default page.tpl.php):
 * - $title_prefix (array): An array containing additional output populated by
 *   modules, intended to be displayed in front of the main title tag that
 *   appears in the template.
 * - $title: The page title, for use in the actual HTML content.
 * - $title_suffix (array): An array containing additional output populated by
 *   modules, intended to be displayed after the main title tag that appears in
 *   the template.
 * - $messages: HTML for status and error messages. Should be displayed
 *   prominently.
 * - $tabs (array): Tabs linking to any sub-pages beneath the current page
 *   (e.g., the view and edit tabs when displaying a node).
 * - $action_links (array): Actions local to the page, such as 'Add menu' on the
 *   menu administration interface.
 * - $feed_icons: A string of all feed icons for the current page.
 * - $node: The node object, if there is an automatically-loaded node
 *   associated with the page, and the node ID is the second argument
 *   in the page's path (e.g. node/12345 and node/12345/revisions, but not
 *   comment/reply/12345).
 *
 * Regions:
 * - $page['help']: Dynamic help text, mostly for admin pages.
 * - $page['highlighted']: Items for the highlighted content region.
 * - $page['content']: The main content of the current page.
 * - $page['sidebar_first']: Items for the first sidebar.
 * - $page['sidebar_second']: Items for the second sidebar.
 * - $page['header']: Items for the header region.
 * - $page['footer']: Items for the footer region.
 * - $page['bottom']: Items to appear at the bottom of the page below the footer.
 *
 * @see template_preprocess()
 * @see template_preprocess_page()
 * @see zen_preprocess_page()
 * @see template_process()
 */

if(arg(0)=='quizz' || arg(2)=='invoices'){
	// Affichage quiz lightbox
	$output.=render($page['content']);
	print $output;
}else{

?>
<div id="logo_print"></div>
<div id="transparent"></div>
<div id="page">
	<div id="header">
		
			<?php if($page['header']): ?>
				<div id="header-top-menu">
					<div class="content">
						<?php print render($page['header']); ?>
					</div>
				</div>
			<?php endif; ?>
			
			<?php if($page['menu']): ?>
			<div id="header-wrapper">
				<div class="content">
					<?php print render($page['menu']); ?>
				</div>
			</div>
			<?php endif; ?>	
	</div>
	
	<?php if($page['menu_xl']): ?>
			
		<div id="header-subwrapper">
				<div class="content">
					<?php print render($page['menu_xl']); ?>
				</div>
		</div>
			
	<?php endif; ?>
	
	<div id="page-wrapper">
		<div class="content">

 			 <?php if($page['sidebar_first']): ?>
 			 	<div class="left-column"><?php print render($page['sidebar_first']); ?></div>
 			 <?php endif; ?>
 			 
 			 <?php if ($page['content']): ?>
			  <div class="center-column">
				  <?php print $breadcrumb; ?>
			      <?php print mnhn_content_share(); ?>
			     <div class="clearfix"></div>
			     
			     <?php if(arg(0)=='blog' || mnhn_content_get_content_type(arg(1))=='blog' || mnhn_content_get_content_type(arg(1))=='page_blog'): ?>
			      <a class="rss_blog" title="RSS" target="_blank" href="/fr/rss-blog.xml">Flux RSS</a>
			      <?php endif; ?>
			      
			      <?php print $messages; ?>
			      
			      <?php if ($tabs = render($tabs)): ?>
			        <div class="tabs admintabs"><?php print $tabs; ?></div>
			      <?php endif; ?>
			      
			    <?php print render($page['content']); ?>
			    
			  </div>
			<?php endif; ?>
			
      <?php if($page['sidebar_second'] || $page['content']['system_main']['nodes'][arg(1)]['#bundle'] == 'new_event' || arg(0) == 'expositions-itinerantes'): ?>
        <div class="right-column"><?php print render($page['sidebar_second']); ?></div>
      <?php endif; ?>

      <?php if(arg(0)!='quizz'): ?>
        <a class="toppage" href="#">
          <span><?php print t('Up') ?></span>
        </a>
      <?php endif; ?>
      
		</div>
	</div>
	
	<div id="footer">
		<?php print render($page['footer']); ?>
	</div>
	
</div>
<div id="push"></div> <!-- sticky footer -->
<?php } ?>
<img src="https://secure.adnxs.com/seg?add=8819631&t=2" width="1" height="1" />
<img src="https://secure.adnxs.com/px?id=863473&seg=8819642&t=2" width="1" height="1" />
