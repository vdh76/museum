<?php
// Template Compte utilisateur
/**
 * @file account.tpl.php
 *
 *

 * 
 *
 * @see template_preprocess()
 * @see template_preprocess_block()
 */
 global $language;
 global $user;
 
  
     
 $ouverture_boutique=variable_get('mnhn_boutique', '');
 $nb_article=mnhn_boutique_nb_article();

if($user->uid==0){
	if($ouverture_boutique==1){
		print l(t('Log in'), 'user/login', array('attributes' => array('class' =>  array('login')))); 
		print l(t('My cart'), 'cart', array('attributes' => array('class' => array('mybasket')))); ?>
			                    <div class="tooltip tip_basket" id="basket_info">
			                        <img src="/sites/all/themes/mnhn/pics/puces/tooltip.png" alt="" />
			                        <p><strong><?php print $nb_article;?></strong> <?php print t('items') ?></p>
			                         <?php  print l(t('Empty'), 'cart/empty'); ?>
			                    </div>
	<?php }
 }else{

	drupal_add_js('

	jQuery(function() {
		jQuery(".login").tooltip({ effect: "slide", tipClass: "tip_login", relative: true, position: "bottom center", offset: [20, 0], delay: 400});
		 var tiploginW = jQuery(".tip_login").width();
    	jQuery(".tip_login img").css("left", (tiploginW /2) - 6 + "px");
	})','inline');
	
$account = user_load($user->uid);
$prenom=ucfirst(strtolower($account->field_user_prenom['und'][0]['value']));
$nom=ucfirst(strtolower($account->field_user_nom['und'][0]['value']));	
	?>
			<?php print l(t('My account'), 'user', array('attributes' => array('class' =>  array('login')))); ?>
			<div class="tooltip tip_login">
                 <img src="/sites/all/themes/mnhn/pics/puces/tooltip.png" alt="" />
                 <p><?php print $prenom ?> <?php print $nom ?></p>
                 <?php  print l(t('Log out'), 'user/logout'); ?>
            </div>
            <?php print l(t('My cart'), 'cart', array('attributes' => array('class' => array('mybasket')))); ?>
			                    <div class="tooltip tip_basket" id="basket_info">
			                        <img src="/sites/all/themes/mnhn/pics/puces/tooltip.png" alt="" />
			                        <p><strong><?php print $nb_article;?></strong> <?php print t('items') ?></p>
			                         <?php  print l(t('Empty'), 'cart/empty'); ?>
			                    </div>
<?php }?>

                    
                    
                   
	                   
                  
                    