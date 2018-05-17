<?php

/**
 * @file
 * Default theme implementation to present all user profile data.
 *
 * This template is used when viewing a registered member's profile page,
 * e.g., example.com/user/123. 123 being the users ID.
 *
 * Use render($user_profile) to print all profile items, or print a subset
 * such as render($user_profile['user_picture']). Always call
 * render($user_profile) at the end in order to print all remaining items. If
 * the item is a category, it will contain all its profile items. By default,
 * $user_profile['summary'] is provided, which contains data on the user's
 * history. Other data can be included by modules. $user_profile['user_picture']
 * is available for showing the account picture.
 *
 * Available variables:
 *   - $user_profile: An array of profile items. Use render() to print them.
 *   - Field variables: for each field instance attached to the user a
 *     corresponding variable is defined; e.g., $account->field_example has a
 *     variable $field_example defined. When needing to access a field's raw
 *     values, developers/themers are strongly encouraged to use these
 *     variables. Otherwise they will have to explicitly specify the desired
 *     field language, e.g. $account->field_example['en'], thus overriding any
 *     language negotiation rule that was previously applied.
 *
 * @see user-profile-category.tpl.php
 *   Where the html is handled for the group.
 * @see user-profile-item.tpl.php
 *   Where the html is handled for each item in the group.
 * @see template_preprocess_user_profile()
 */
global $user;
global $language;
if(arg(1)==$user->uid){
	$uid=$user->uid;
	$prenom=ucfirst(strtolower($user_profile['field_user_prenom']['#items'][0]['value']));
	$nom=ucfirst(strtolower($user_profile['field_user_nom']['#items'][0]['value']));
	$mail=$user->mail;
}else{
	$user_profile = user_load(arg(1));
	$uid=arg(1);
	$prenom=ucfirst(strtolower($user_profile->field_user_prenom['und'][0]['value']));
	$nom=ucfirst(strtolower($user_profile->field_user_nom['und'][0]['value']));
	$mail=$user_profile->mail;
	
}




drupal_add_js('

	jQuery(function() {
	    jQuery("ul.menu-vertical li:eq(0)").addClass("activ");
	   });
	 ','inline');  

module_load_include('inc', 'commerce_addressbook', 'commerce_addressbook.user');
$profile_type='billing';
?>



                    <div class="compte-detail-wrapper">
					<?php
						if(arg(1)==$user->uid){
							print mnhn_boutique_header_user(t('My account details'));
			
						}else{ 
							print '<h1>'.t('Details').'</h1><h2'.t('Account details').' '.$user_profile->name.'</h2><br/><br/<br/>';
						} ?>
					   <?php ?>                        
                        <div class="infos_compte">
                            <h2 class="greytitle"><?php print t('Account details')?></h2>
                            <p class="info"><?php print t('User\'s name')?> : <strong>  <?php print $prenom ?> <?php print $nom ?></strong></p>
                            <p class="info"><?php print t('Email')?> : <strong> <?php print $mail ?></strong></p>
                            <a href="/<?php print $language->language; ?>/user/<?php print $uid?>/edit" class="link_black"><?php print t('Update your personnal details')?></a>
                        </div>
                        
                        <div class="infos_compte">
                            <h2 class="greytitle"><?php print t('Recorded addresses')?></h2>
                         	<?php 
                         	$output = '';
                         	$output .= '<div id="commerce-addressbook-' . $profile_type . '-default">' . views_embed_view('commerce_addressbook_defaults', 'default', $uid, $profile_type) . '</div>';
                         	$output .= '<div id="commerce-addressbook-' . $profile_type . '-list">' . views_embed_view('commerce_addressbook', 'default', $uid, $profile_type) . '</div>';
                         	print $output;
                         	?>
                        </div>
                        
                       

                    </div>


