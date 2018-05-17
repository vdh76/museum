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

global $language;
$link_enews=l(t('here'),'node/'.arg(1));
?>





<table width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td align="center">
			
				<table border="0" cellpadding="0" cellspacing="0" width="100%">
					<tr>
						<td class="link_online" height="20"><?php print t('click !link if you can\'t see the e-news',array('!link'=>$link_enews))?></td>
					</tr>
				</table>
				<?php if ($tabs = render($tabs)): ?>
					<div class="tabs"><?php print $tabs; ?></div>
				<?php endif; ?>
				 <?php print render($page['content']); ?>
		
				<table border="0" cellpadding="0" cellspacing="0" width="626">
					<tr>
						<td width="26"><img src="http://<?php  print  $_SERVER['SERVER_NAME'] ?>/sites/all/themes/mnhn/img/newsletter/spacer.gif" alt="" width="26" /></td>
					    <td align="left" class="desabo" width="600">
							<p>Conformément à la loi informatique et libertés du 6 janvier 1978, vous disposez d'un droit d'accès, de rectification et d'opposition aux données personnelles vous concernant. <a href="http://<?php  print  $_SERVER['SERVER_NAME'] ?>/la-lettre-du-museum/desinscription"><?php print t('Click here')?></a> pour ne plus recevoir de mail de la part du Muséum d’histoire naturelle du Havre.</p>
						</td>
					</tr>
					<tr>
						<td height="10">&nbsp;</td>
					</tr>
				</table>
			

				
			</td>
		</tr>
</table>





 

 
 

	
  
	      
		    
	
		   
	




