
<?php 



global $language;



$product_id=$node->field_product_produit['und'][0]['product_id'];
if($product_id>0){
	//$product_item = entity_load('field_collection_item', array($product_id));
	$product=commerce_product_load($product_id);
	
	$sku=$product->sku;
	$price=number_format($product->commerce_price['und'][0]['amount']/100,2,',','');
	$currency=$product->commerce_price['und'][0]['currency_code'];
	$promotion=$product->field_promotion['und'][0]['value'];
	$promotion_price=number_format($product->field_promotion_price['und'][0]['value'],2,',','');
	$stock=mnhn_boutique_get_stock($product_id);
	$stock<1?$class_stock='unavailable':$class_stock='';
	drupal_add_js('jQuery(function() {
	  
	});','inline');
	
	
}

$tid=$node->field_produit_categorie['und'][0]['tid'];
$term=taxonomy_term_load($tid);
$theme=i18n_taxonomy_term_name($term, $language->language);
$uri_visuel=$node->field_produit_image['und'][0]['uri'];
$auteur=$node->field_produit_auteur['und'][0]['value'];
$credits=$node->field_produit_credit['und'][0]['value'];
$description=$node->field_produit_description['und'][0]['value'];
$editeur=$node->field_produit_editeur['und'][0]['value'];
/*
$uri_fichier=$node->field_produit_fichier['und'][0]['uri'];
if(!empty($uri_fichier)){
 $url_fichier=file_create_url($uri_fichier);	
 $ext_fichier=substr(strtolower(strrchr(basename($url_fichier), ".")),1);;
 $poids_fichier=round($node->field_produit_fichier['und'][0]['filesize']/1000);
  if($poids_fichier>1000){
  	$poids_fichier=round($poids_fichier/1000,1);
  	$poids_fichier.=' Mo';
  }else{
  	$poids_fichier.=' Ko';
  }
 
}
*/
$sstitre=$node->field_produit_sous_titre['und'][0]['value'];

// print render($content['field_product_produit']);




if($teaser){
?>
 <div class="prdt nomarginleft">
 
 
  <h3><?php print $theme; ?></h3>
  <div class="thumb"><?php if(!empty($uri_visuel)){ print ' <a href="/'.$language->language.'/'.drupal_get_path_alias('node/'.$node->nid).'"><img src="'.file_create_url($uri_visuel).'" /></a>'; } ?></div>
 
  <h4 class="titre_prdt"> <a href="/<?php print $language->language;?>/<?php print drupal_get_path_alias('node/'.$node->nid)?>"><?php print $node->title; ?></a></h4>
  <h5 class="sstitre_prdt"><?php print $sstitre; ?></h5>
  <h6 class="type"><?php print $description; ?></h6>
   <p class="price"><?php print $price ?> €</p>
   <?php if($promotion==1 && $promotion_price>0){ ?>
    <div class="old-price">
           <p class="old"><?php print $promotion_price ?> €</p>
           <p class="promo">Promotion</p>
    </div>
    <?php } ?>
   <p class="etat dispo <?php print $class_stock;?>"><?php print t('in !strong_debut stock !strong_fin',array('!strong_debut'=>'<strong>','!strong_fin'=>'</strong>'))?></p>
   <p class="delai"><?php print t('48h !strong_debut delivery !strong_fin',array('!strong_debut'=>'<strong>','!strong_fin'=>'</strong>'))?></p>
  <a href="/<?php print $language->language;?>/<?php print drupal_get_path_alias('node/'.$node->nid)?>" class="link"><?php print t('See the product') ?></a>
  
 <?php if($stock>0){ ?>
  <a rel="<?php print $product_id.'/1/'.$tid?>" href="javascript:;" class="link link_add_cart"><?php print t('Add to cart') ?><span></span></a>
  <?php } ?>
</div>


<?php }else{ 
	
	drupal_add_js('jQuery(function() {
	
	jQuery(".link_add_cart").click(function(){
		var arg=jQuery(this).attr("rel");
		var loading=jQuery(this).find("span");
		loading.addClass("loading_add_card");
		jQuery.ajax({
			url: "/'.$language->language.'/product/add/"+jQuery(this).attr("rel"),
			type: "POST",
			dataType: "html",
			success: function(data){
				loading.removeClass("loading_add_card");
				jQuery(".message_add_cart").show();
				jQuery("#basket_info p strong").html(data);
	
			}
		});
	});
	
	 jQuery(".message_add_cart .fancybox-close").click(function(){
		 jQuery(".message_add_cart").hide();
	 });
			});','inline');
	
	drupal_add_js('jQuery(function() {
	   jQuery("ul.menu-vertical li[rel='.$tid.']").addClass("activ");
	});','inline');
	
	
	$sql = 'SELECT n.nid FROM node n
	INNER JOIN taxonomy_index ti on ti.nid=n.nid and ti.tid=:tid and n.language=:language and n.status=:status
	order by n.title asc';
	$result=db_query($sql,array(':language'=> $language->language,':tid'=> $tid,':status'=> 1));
	$nb_produit=0;
	foreach($result as $row){
		$tab_produit[]=array('value' => $row->nid);
		$nb_produit++;
	}
	
	
	if($nb_produit>1){
		foreach($tab_produit as $key => $value){
			//$link_objet_hide.='<a href="javascript:;" rel="'.$value['value'].'" id="'.$node->nid.'" class="link_objet_hide"></a>';
			if($node->nid==$value['value']){
				
				if($key<($nb_produit-1)){
					$next=$tab_produit[($key+1)]['value'];
					$next_title=db_query('select title from node where nid=:nid',array(':nid'=> $next))->fetchField();
					$next_link='/'.$language->language.'/'.drupal_get_path_alias('node/'.$next);
				}
				$num_produit=$key+1;		
				if($key>0){
					$prev=$tab_produit[($key-1)]['value'];
					$prev_title=db_query('select title from node where nid=:nid',array(':nid'=> $prev))->fetchField();
					$prev_link='/'.$language->language.'/'.drupal_get_path_alias('node/'.$prev);
				}
			}
			
		}
	}
	
	
	?>
	 <div class="message_add_cart">
		<div class="fancybox-close"></div>
		<?php print t('The item has been added to your cart.')?>
		 <a href="/<?php print $language->language.'/'.drupal_get_path_alias("cart") ?>" class="link_anim"><?php print t('See the cart')?></a>
		</div>
  <div class="boutique-header">
                    
                        <h1 class="title_m"><?php print $theme?></h1>

                    </div>
    
                    <div class="page-detail-wrapper">

                        <div class="entete">
                            <a href="/<?php print $language->language?>/<?php print drupal_get_path_alias('boutique/'.$tid);?>" class="retour"><span><?php print t('Back'); ?></span></a>
                            <div class="nav">
                            <?php if($nb_produit>1){ ?>
                                <?php if($prev>0){?>
							     	<a href="<?php print $prev_link ?>" class="prev" rel="<?php print $prev ?>" id="<?php print $node->nid?>" title="<?php print $prev_title?>"></a>
							     <?php } ?>
							     <p class="num"><?php print $num_produit.'/'.$nb_produit; ?></p>
							      <?php if($next>0){?>
							     	<a href="<?php print $next_link ?>" class="next" rel="<?php print $next ?>" id="<?php print $node->nid?>" title="<?php print $next_title?>"></a>
							     <?php } ?>
							   <?php } ?>   
                            </div>
                        </div>
                       
                        <div id="produit">
                            <div class="specif">
                                <h2 class="titre_prdt"><?php print $node->title?></h2>
                                <h3 class="sstitre_prdt"><?php print $sstitre?></h3>
                                <h4 class="type"><?php print $description?></h4>
                                <p>
                                <?php if(!empty($editeur)){?>
                                <strong><?php print t('Publisher')?> :</strong>
                                <br /><?php print $editeur?>
                                <?php } ?>
                                 <?php if(!empty($auteur)){?>
                                <br /><strong><?php print t('Author(s)')?> :</strong>
                                <br /><?php print $auteur?>
                                 <?php } ?>
                                 <?php if(!empty($credits)){?>
                                <br /><strong><?php print t('Credits')?> :</strong>
                                <br />&copy; <?php print $credits?>
                                 <?php } ?></p>
                            </div>
                            <div class="pricing">
                                <p class="price"><?php print $price ?> €</p>
                                
                                 <?php if($promotion==1 && $promotion_price>0){ ?>
							    <div class="old-price">
							           <p class="old"><?php print $promotion_price ?> €</p>
							           <p class="promo">Promotion</p>
							    </div>
							    <?php } ?>
                                <p class="etat dispo <?php print $class_stock ?>"><?php print t('in !strong_debut stock !strong_fin',array('!strong_debut'=>'<strong>','!strong_fin'=>'</strong>'))?></p>
                                <p class="delai"><?php print t('48h !strong_debut delivery !strong_fin',array('!strong_debut'=>'<strong>','!strong_fin'=>'</strong>'))?></p>
                                <?php if($stock>0){ ?>
                               <a rel="<?php print $product_id.'/1/'.$tid?>" href="javascript:;" class="link link_add_cart"><?php print t('Add to cart') ?><span></span></a>
								<?php } ?>
                            </div>
                        </div>
                        <?php 
							if($node->field_page_bloc['und'][0]['value']>0){
								foreach($node->field_page_bloc['und'] as $bloc_entity_id){
										$blocs[]=$bloc_entity_id['value'];
								}		
								$output.=mnhn_content_bloc_page($blocs,$ajax);
							}
									
						
							print $output;
						?>
						
						<?php print mnhn_boutique_liste_link($node->field_product_link['und']);?>
                     </div>   
<?php }?>