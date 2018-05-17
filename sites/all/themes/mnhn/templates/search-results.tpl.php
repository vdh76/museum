<?php

/**
 * @file
 * Default theme implementation for displaying search results.
 *
 * This template collects each invocation of theme_search_result(). This and
 * the child template are dependent to one another sharing the markup for
 * definition lists.
 *
 * Note that modules may implement their own search type and theme function
 * completely bypassing this template.
 *
 * Available variables:
 * - $search_results: All results as it is rendered through
 *   search-result.tpl.php
 * - $module: The machine-readable name of the module (tab) being searched, such
 *   as "node" or "user".
 *
 *
 * @see template_preprocess_search_results()
 */

?>


                    <div class="clearfix"></div>
                    <div class="page-detail-wrapper">
                    	<div class="sommaire">
                    	 	
                    <?php if ($search_results): ?>
                    	<?php print $search_results; ?>
                    	  <?php print $pager; ?>
                    <?php else : ?>
  						<br/><br/><?php print t('Your search yielded no results');?>.
  
						<?php endif; ?>
                       
                        </div>
                   </div>
              
   



