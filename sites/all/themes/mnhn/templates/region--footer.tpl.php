<?php
/**
 * @file
 * Zen theme's implementation to display a region.
 *
 * Available variables:
 * - $content: The content for this region, typically blocks.
 * - $classes: String of classes that can be used to style contextually through
 *   CSS. It can be manipulated through the variable $classes_array from
 *   preprocess functions. The default values can be one or more of the following:
 *   - region: The current template type, i.e., "theming hook".
 *   - region-[name]: The name of the region with underscores replaced with
 *     dashes. For example, the page_top region would have a region-page-top class.
 * - $region: The name of the region variable as defined in the theme's .info file.
 *
 * Helper variables:
 * - $classes_array: Array of html class attribute values. It is flattened
 *   into a string within the variable $classes.
 * - $is_admin: Flags true when the current user is an administrator.
 * - $is_front: Flags true when presented in the front page.
 * - $logged_in: Flags true when the current user is a logged-in member.
 *
 * @see template_preprocess()
 * @see template_preprocess_region()
 * @see zen_preprocess_region()
 * @see template_process()
 */
global $language;
?>

<div class="content">
			<div class="footerInner">
	
			<?php 
			$menu=menu_tree_all_data("menu-footer");
			
			$items_1 = array();
			$items_1['attributes']['class']='footer_links';
			
			$items_2 = array();
			$items_2['attributes']['class']='footer_links';
			$w=0;
				foreach($menu as $item){
					
					if($item['link']['language']==$language->language){
						if($w<7){
							$items_1['items'][] = l($item['link']['link_title'],$item['link']['link_path']);
						}else{
							$items_2['items'][] = l($item['link']['link_title'],$item['link']['link_path']);	
						}
						$w++;
					}
			  
			}
	

			print  theme('item_list', $items_1);
			print  theme('item_list', $items_2);
			$flickr=variable_get('mnhn_bloc_en_ligne_flickr', '');
			$facebook=variable_get('mnhn_bloc_en_ligne_facebook', '');
			$twitter=variable_get('mnhn_bloc_en_ligne_twitter', '');
			$daylimotion=variable_get('mnhn_bloc_en_ligne_daylimotion', '');
			$netvibes=variable_get('mnhn_bloc_en_ligne_netvibes', '');
			?>
			
			 <div class="contacts footer_pratik">
                    <h3><?php print t('Contact us')?></h3>
                    <p><?php print nl2br(variable_get('mnhn_footer_contact_'.$language->language, ''))?></p>
                </div>

                <div class="footer_pratik">
                    <h3><?php print t('Hours')?></h3>
                    <p><?php print nl2br(variable_get('mnhn_footer_horaire_'.$language->language, ''))?></p>
                    <h3><?php print t('Closing')?></h3>
                    <p><?php print nl2br(variable_get('mnhn_footer_fermeture_'.$language->language, ''))?></p>
                </div>

                <div class="contacts footer_pratik">
                    <h3><?php print t('Address')?></h3>
                    <p><?php print nl2br(variable_get('mnhn_footer_adresse_'.$language->language, ''))?></p>
                    <h3><?php print t('Location and maps')?></h3>
                    <p><?php print nl2br(variable_get('mnhn_footer_map_'.$language->language, ''))?></p>
                </div>
		
			<div class="footer_share_2">
                    
                    <ul>
                        <li class="lehavre"><a href="http://lehavre.fr/" target="_blank"><img src="/sites/all/themes/mnhn/pics/logos/le_havre.gif" alt="Ville du Havre" /></a></li>
<!--                        <li class="flickr"><a href="--><?php //print $flickr ?><!--" target="_blank"><span>Flickr</span></a></li>-->
                        <li class="facebook"><a href="<?php print $facebook ?>" target="_blank"><span>Facebook</span></a></li>
                        <li class="twitter"><a href="<?php print $twitter ?>" target="_blank"><span>Twitter</span></a></li>
                    </ul>
			</div>
		
	</div>
</div>



