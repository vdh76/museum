<?php

/**
 * @file site-map.tpl.php
 *
 * Theme implementation to display the site map.
 *
 * Available variables:
 * - $message:
 * - $rss_legend:
 * - $front_page:
 * - $blogs:
 * - $books:
 * - $menus:
 * - $faq:
 * - $taxonomys:
 * - $additional:
 *
 * @see template_preprocess()
 * @see template_preprocess_site_map()
 */
?>

                    <div class="page-header">      
                        <h1><?php print t('Site map')?></h1>
                    </div>
                    <div class="page-detail-wrapper">
                       
						<div id="site-map">
			
						  <?php if($menus): ?>
						    <div class="site-map-menus">
						      <?php print $menus; ?>
						    </div>
						  <?php endif; ?>
						
						
						</div>
						
	</div>

