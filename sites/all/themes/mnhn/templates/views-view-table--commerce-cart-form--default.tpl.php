<?php
/**
 * @file views-view-table.tpl.php
 * Template to display a view as a table.
 *
 * - $title : The title of this group of rows.  May be empty.
 * - $header: An array of header labels keyed by field id.
 * - $header_classes: An array of header classes keyed by field id.
 * - $fields: An array of CSS IDs to use for each field id.
 * - $classes: A class or classes to apply to the table, based on settings.
 * - $row_classes: An array of classes to apply to each row, indexed by row
 *   number. This matches the index in $rows.
 * - $rows: An array of row items. Each row is an array of content.
 *   $rows are keyed by row number, fields within rows are keyed by field ID.
 * - $field_classes: An array of classes to apply to each field, indexed by
 *   field id, then row number. This matches the index in $rows.
 * @ingroup views_templates
 */

global $language;
global $user;
$poids_total=mnhn_boutique_total_weight();
$poids_total_max=variable_get('mnhn_boutique_poids_max_'.$language->language, '0');
if($poids_total>$poids_total_max){
	$message_erreur=variable_get('mnhn_boutique_poids_max_message_'.$language->language, '');
	drupal_set_message($message_erreur,'error');
	$js_error='jQuery(".link_cart_checkout").hide();';
	
}
$nid_cond_vente=variable_get('mnhn_boutique_cgv_'.$language->language, '');
$nid_cond_vente=mnhn_content_autocomplete_nid($nid_cond_vente);
//if($user->uid>0){
	$js='jQuery("#edit-actions #edit-checkout").trigger("click");';
//}else{
	//$js='window.location.href ="/'.$language->language.'/cart/user";';
//}

	drupal_add_js('jQuery(function() {
			
		'.$js_error.'	
		jQuery(".link_cart_update").click(function(){
			jQuery("#edit-actions #edit-submit").trigger("click");
		});
		
		
		jQuery(".link_cart_checkout").click(function(){
			//if(jQuery("#accept_cgv").attr("value")==0){
				
			if(jQuery("span.checkbox").attr("style")=="background-position: 0px 0px;"){	
				alert("'.t('You have to agree to Conditions of use and sales to continue your order').'");
				return false;
			}
			'.$js.'
		});
		
		jQuery(".views-field-edit-quantity .delete").live("click",function(){
			jQuery(this).parent().parent().parent().find(".views-field-edit-delete input").trigger("click");
		});
		
	   jQuery(".total_basket span").html(jQuery(".line-item-total-raw").html());
	   
	    // add or minus quantity field
  		 jQuery(".add").click(function(){
        var newQty = +(jQuery(this).parent().find("input").val()) + 1;
        jQuery(this).parent().find("input").val(newQty);
        var total_panier=0
		jQuery(".views-field-edit-quantity input").each(function(){
			total_panier+=parseInt(jQuery(this).val());
		});			
		jQuery("#basket_info p strong").html(total_panier);	
		return false;		
    });
    jQuery(".minus").click(function(){
        var newQty = +(jQuery(this).parent().find("input").val()) - 1;
        if(newQty < 0) newQty = 0;
        jQuery(this).parent().find("input").val(newQty);
		 var total_panier=0
		jQuery(".views-field-edit-quantity input").each(function(){
			total_panier+=parseInt(jQuery(this).val());
		});			
		jQuery("#basket_info p strong").html(total_panier);				
        return false;
    });
    
   
    jQuery("span.checkbox").live("click",function(){
   		if(jQuery("#accept_cgv").attr("value")==0){
   			jQuery("#accept_cgv").attr("value",1);
   		}else{
   			jQuery("#accept_cgv").attr("value",0);
   		}
 	});
					
	 jQuery("span.checkbox").css("background-position","0 0");				
	   
	   
	});','inline');

?>
 <div class="page-header">
                    
                        <h1><?php print t('My !strong_debut cart !strong_fin',array('!strong_debut'=>'<strong>','!strong_fin'=>'</strong>'))?></h1>
                        
                        <ol id="steps" class="step1">
                            <li class="etape1 selected"><a href="/<?php print $language->language.'/'.drupal_get_path_alias('cart')?>" title="<?php print t('My cart')?>"><?php print t('My cart')?></a></li>
                            <li class="etape2"><?php print t('Log in !cart',array('!cart'=> ''))?></li>
                            <li class="etape3"><?php print t('Identification')?></li>
                            <li class="etape4"><?php print t('Payment')?></li>
                        </ol>

                    </div>
    
                    <div class="page-detail-wrapper">
                    
                        <h2 class="greytitle_lg"><?php print t('Your shopping cart')?></h2>
                        
<table border="0" cellspacing="0" cellpadding="0" class="table_panier panier_recap <?php print $classes?>" width="90%">
  <?php if (!empty($title)) : ?>
    <caption><?php print $title; ?></caption>
  <?php endif; ?>
  <?php if (!empty($header)) : ?>
    <thead>
      <tr>
        <?php foreach ($header as $field => $label): ?>
          <th <?php if ($header_classes[$field]) { print 'class="'. $header_classes[$field] . '" '; } ?>>
            <?php print $label; ?>
          </th>
        <?php endforeach; ?>
      </tr>
    </thead>
  <?php endif; ?>
  <tbody>
    <?php foreach ($rows as $row_count => $row): ?>
      <tr class="<?php print implode(' ', $row_classes[$row_count]); ?>">
        <?php foreach ($row as $field => $content): ?>
          <td <?php if ($field_classes[$field][$row_count]) { print 'class="'. $field_classes[$field][$row_count] . '" '; } ?><?php print drupal_attributes($field_attributes[$field][$row_count]); ?>>
            <?php print $content; ?>
          </td>
        <?php endforeach; ?>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>
<div class="progress"></div>
 <div class="actions">
                            <div class="clearfix">
                                <div class="bt_basket">
                                    <a href="javascript:;" class="link link_cart_update"><?php print t('Update your cart')?></a>
                                    <a href="/cart/empty" class="link"><?php print t('Empty your cart')?></a>
                                </div>
                                <h3 class="total_basket"><?php print t('Total !cart',array('!cart'=>''))?>:<br /><strong><span></span></strong></h3>
                            </div>
                            <div class="accept_cgv">
                                <h4><?php print t('You have to agree to Conditions of use and sales to continue your order')?></h4>
                                <input type="checkbox" name="accept_cgv" id="accept_cgv" class="styled" value="0"/>
                                <label for="accept_cgv"><?php print t('I agree with www.museum-lehavre.fr !url.', array('!url' => l(t('conditions of use and sales'), 'node/'.$nid_cond_vente)));?></label>
                            </div>
                            <div class="bt_continue">
                                <a href="/<?php print $language->language?>/<?php print drupal_get_path_alias("boutique")?>" class="link_back"><?php print t('Continue shopping')?></a>
                                <a href="javascript:;" class="link_black link_cart_checkout"><?php print t('Continue my order')?></a>
                            </div>
                        
                        </div>
                        
                    </div>