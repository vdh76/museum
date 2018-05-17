<?php
// Template Focus Produit Boutique
/**
 * @file focus-produit.tpl.php
 *
 *
 * Available variables:
 * - $node
 * 
 *
 * @see template_preprocess()
 * @see template_preprocess_block()
 */



global $language;

$product_id=$node->field_product_produit['und'][0]['product_id'];
$stock=mnhn_boutique_get_stock($product_id);
$stock<1?$class_stock='unavailable':$class_stock='';
if($product_id>0){
	$product=commerce_product_load($product_id);
	//print_r($product);
	
	
	$sku=$product->sku;
	$price=number_format($product->commerce_price['und'][0]['amount']/100,2,',','');
	$currency=$product->commerce_price['und'][0]['currency_code'];
	$promotion=$product->field_promotion['und'][0]['value'];
	$promotion_price=number_format($product->field_promotion_price['und'][0]['value'],2,',','');
}
$tid=$node->field_produit_categorie['und'][0]['tid'];
$theme=mnhn_content_get_term($tid);
$uri_visuel=$node->field_produit_image['und'][0]['uri'];
$uri_original=mnhn_content_uri_original($uri_visuel);
$visuel=theme('image_style', array('style_name' => 'produit_focus', 'path' => $uri_original));
$auteur=$node->field_produit_auteur['und'][0]['value'];
$credits=$node->field_produit_credits['und'][0]['value'];
$description=$node->field_produit_description['und'][0]['value'];
$editeur=$node->field_produit_editeur['und'][0]['value'];
$sstitre=$node->field_produit_sous_titre['und'][0]['value'];


?>
<div id="produit_phare">
                            <div id="produit_phareInner">
                                <h3 class="categorie"><?php print $theme?></h3>
                                <div class="illustr">
                                    <?php if(!empty($uri_visuel)){ print '<a href="/'.$language->language.'/'.drupal_get_path_alias('node/'.$node->nid).'">'.$visuel.'</a>'; } ?>                            
                                </div>
                                <div class="specif">
                                    <h2 class="titre_prdt"><a href="/<?php print $language->language;?>/<?php print drupal_get_path_alias('node/'.$node->nid)?>"><?php print $node->title; ?></a></h2>
                                    <h3 class="accroche"><?php print $sstitre; ?></h3>
                                   <p><?php print $description; ?></p>
                                   
                                </div>
                                <div class="pricing">
                                    <p class="price"><?php print $price ?> €</p>
                                    <?php if($promotion==1 && $promotion_price>0){ ?>
                                    <div class="old-price">
                                        <p class="old"><?php print $promotion_price ?> €</p>
                                        <p class="promo">Promotion</p>
                                    </div>
                                    <?php } ?>
                                    <p class="etat dispo <?php print $class_stock; ?>"><?php print t('in !strong_debut stock !strong_fin',array('!strong_debut'=>'<strong>','!strong_fin'=>'</strong>'))?></p>
                                    <p class="delai"><?php print t('48h !strong_debut delivery !strong_fin',array('!strong_debut'=>'<strong>','!strong_fin'=>'</strong>'))?></p>
                                    <div class="links">
                                        <a href="/<?php print $language->language;?>/<?php print drupal_get_path_alias('node/'.$node->nid)?>" class="link"><?php print t('See the product') ?></a>
                                        <?php if($stock>0){ ?>
                                        <a rel="<?php print $product_id.'/1/'.$tid?>" href="javascript:;" class="link link_add_cart"><?php print t('Add to cart')?><span></span></a>
										<?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
