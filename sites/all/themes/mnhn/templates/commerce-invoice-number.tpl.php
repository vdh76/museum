<?php

/**
 * @file
 */
global $language;
print_r($order);
$order_id=db_query('select order_id from commerce_invoice where invoice_number=:invoice_number',array(':invoice_number'=>$invoice_number))->fetchField();
$date=substr($invoice_number,0,4);

drupal_add_js('

			


				jQuery(function() {
					 jQuery(".component-type-flat-rate-frais-de-port .component-title").html("'.t('Shipping costs').'");
					 jQuery(".component-type-taxtva .component-title").html("'.t('VAT').'");
					 jQuery(".component-type-commerce-price-formatted-amount .component-title").html("'.t('Order total').'");
					 jQuery(".field-name-commerce-customer-billing .field-label").html("'.t('Billing information').'");
					 jQuery(".field-name-commerce-customer-shipping .field-label").html("'.t('Shipping information').'");
					
				

				
				
				});','inline');

?>

<a href="http://<?php print $_SERVER['SERVER_NAME']?>" title="Musée d'histoire naturelle du Havre"><img src="http://<?php print $_SERVER['SERVER_NAME']?>/sites/all/themes/mnhn/img/logo_mhnh.png" width="200" height="64" /></a>
<br/>
<br/>
<div class="museum_invoice">
<?php print nl2br(variable_get('mnhn_footer_adresse_'.$language->language, ''))?><br/>
<?php print nl2br(variable_get('mnhn_footer_contact_'.$language->language, ''))?>
</div>
<?php if ($invoice_number): ?>
  <div class="commerce-invoice-number">
   <strong><?php print t('Invoice N°')?> <?php print $date.$order_id; ?></strong>
  </div>
<?php endif; ?>
