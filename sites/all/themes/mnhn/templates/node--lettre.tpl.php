

<?php 
global $language;
	if($language->language=='fr'){
		setlocale(LC_ALL, 'fr_FR.utf8', 'fra');
	}
	$mois=ucfirst(strftime('%B', $node->field_lettre_date['und'][0]['value']));
	$annee=date('Y',$node->field_lettre_date['und'][0]['value']);
	
	
?>

<table border="0" cellpadding="0" cellspacing="0" width="626" style="clear:both">
					<tr valign="top">
						<td height="118" width="626" colspan="2"><a href="http://<?php  print  $_SERVER['SERVER_NAME'] ?>"><img src="http://<?php  print  $_SERVER['SERVER_NAME'] ?>/sites/all/themes/mnhn/img/newsletter/topheaderlogo.jpg" alt="Muséum d'histoire naturelle du Havre" border="0" height="118" title="Muséum d'histoire naturelle du Havre" width="626" /></a></td>
					</tr>
                    <tr>
                        <td height="27" width="292"><img src="http://<?php  print  $_SERVER['SERVER_NAME'] ?>/sites/all/themes/mnhn/img/newsletter/middleheaderleft.gif" alt="" height="27" width="292" /></td>
                        <td class="titre"><h1>N&deg;<?php print $node->title?> - <?php print $mois.' '.$annee; ?></h1></td>
                    </tr>
				</table>

				<table border="0" cellpadding="0" cellspacing="0" width="626">
					<tr valign="top">
						<td height="19" width="626" colspan="3"><img src="http://<?php  print  $_SERVER['SERVER_NAME'] ?>/sites/all/themes/mnhn/img/newsletter/edito_top.gif" alt="" border="0" height="19" title="" width="626" /></td>
					</tr>
                    <tr valign="top">
						<td height="142" width="52"><img src="http://<?php  print  $_SERVER['SERVER_NAME'] ?>/sites/all/themes/mnhn/img/newsletter/edito_left.gif" alt="" border="0" height="142" title="" width="52" /></td>
                        <td height="142" width="547" class="edito">
                            <h2>Edito</h2>
                            <p><?php print nl2br($node->field_lettre_edito['und'][0]['value'])?></p>
                            <p class="author">L’équipe du Muséum</p>
                        </td>
						<td height="142" width="27"><img src="http://<?php  print  $_SERVER['SERVER_NAME'] ?>/sites/all/themes/mnhn/img/newsletter/edito_right.gif" alt="" border="0" height="142" title="" width="27" /></td>
                    </tr>
					<tr valign="top">
						<td height="8" width="626" colspan="3"><img src="http://<?php  print  $_SERVER['SERVER_NAME'] ?>/sites/all/themes/mnhn/img/newsletter/edito_bottom.gif" alt="" border="0" height="8" title="" width="626" /></td>
					</tr>
				</table>

				<table border="0" cellpadding="0" cellspacing="0" width="626">
					<tr valign="top">
						<td width="626" height="22"><img src="http://<?php  print  $_SERVER['SERVER_NAME'] ?>/sites/all/themes/mnhn/img/newsletter/spacer.gif" alt="" height="22" width="626" /></td>
					</tr>
				</table>



<table border="0" cellpadding="0" cellspacing="0" width="626">
					<tr valign="top">
						<td width="26"><img src="http://<?php  print  $_SERVER['SERVER_NAME'] ?>/sites/all/themes/mnhn/img/newsletter/spacer.gif" alt="" width="26" /></td>
						<td width="600">

            				<table border="0" cellpadding="0" cellspacing="0" width="600" class="layout">
            					<tr valign="top">
            						<td width="431" class="main">
                                        <?php 
										if($node->field_lettre_agenda['und'][0]['nid']>0){
										?>
                        				<table border="0" cellpadding="0" cellspacing="0" width="431">
                        					<tr valign="top">
                        						<td width="431" height="17"><img src="http://<?php  print  $_SERVER['SERVER_NAME'] ?>/sites/all/themes/mnhn/img/newsletter/spacer.gif" alt="" height="17" width="431" /></td>
                        					</tr>
                        					<tr valign="top">
                        						<td width="431" class="title_vert">
                                                    <h1>Agenda : ce mois-ci au Muséum</h1>
                        						</td>
                        					</tr>
                        					<tr valign="top">
                        						<td width="431" height="25"><img src="http://<?php  print  $_SERVER['SERVER_NAME'] ?>/sites/all/themes/mnhn/img/newsletter/spacer.gif" alt="" height="25" width="431" /></td>
                        					</tr>
                        				</table>
                        				
                        				<?php 	
										
										foreach($node->field_lettre_agenda['und'] as $key => $nid_agenda){
											
							
											$node_agenda=$node->field_lettre_agenda['und'][$key]['node'];
											if($node_agenda->status==1){
												$date_debut=$node_agenda->field_event_date['und'][0]['value'];
												$date_fin=$node_agenda->field_event_date['und'][0]['value2'];
												$date_medium=mnhn_content_format_date_medium($date_debut,$date_fin);
												$tid=$node_agenda->field_event_type['und'][0]['tid'];
												$theme_agenda=mnhn_content_get_term($tid);
												$tid_cible=$node_agenda->field_event_cible['und'][0]['tid'];
												
												$uri=$node_agenda->field_event_visuel['und'][0]['uri'];   
												if(!empty($uri)){
													$uri=mnhn_content_uri_original($uri);
													$image=theme('image_style', array('style_name' => 'agenda_newsletter', 'path' => $uri));
												}
												
												$horaire=$node->field_event_horaire['und'][0]['value'];
												$duree=$node_agenda->field_event_duree['und'][0]['value'];
												$tarif=$node_agenda->field_event_tarif['und'][0]['value'];
												$lieu=$node_agenda->field_event_lieu['und'][0]['value'];
												$animateur=$node_agenda->field_event_animateur['und'][0]['value'];
												
												$cible=mnhn_content_get_term($tid_cible);
												$description=mnhn_content_clean_teaser($node_agenda->field_event_description['und'][0]['value'],200);
												
												?>
												
												
											


                        				<table border="0" cellpadding="0" cellspacing="0" width="431">
                        					<tr valign="top">
                        						<td width="22"><img src="http://<?php  print  $_SERVER['SERVER_NAME'] ?>/sites/all/themes/mnhn/img/newsletter/spacer.gif" alt="" height="1" width="22" /></td>
                        						<td width="115" class="colleft">
                                                    <?php print $image; ?>
                                                    <p>
                                                    <?php print $date_medium; ?>
                                                    <?php if($horaire){ ?>
                                                    	<br /><?php print $horaire?>
                                                    <?php } ?>
                                                    <?php if($duree){ ?>
                                                    	<br/><?php print t("Length")?> : <?php print $duree?>
                                                    <?php } ?>
                                                    <?php if(!empty($tarif)){ ?>
													 	<br /><?php print t('Admission fees')?> : <?php print $tarif; ?><br/>
													<?php } ?>
													 
                                                    </p>
                                                    <a href="http://<?php  print  $_SERVER['SERVER_NAME'] ?>/<?php print drupal_get_path_alias('node/'.$node_agenda->nid);?>" class="link"><img src="http://<?php  print  $_SERVER['SERVER_NAME'] ?>/sites/all/themes/mnhn/img/newsletter/ensavoirplus.gif" alt="<?php print t('More details') ?>" width="115" /></a>
                        						</td>
                        						<td width="21"><img src="http://<?php  print  $_SERVER['SERVER_NAME'] ?>/sites/all/themes/mnhn/img/newsletter/spacer.gif" alt="" height="1" width="21" /></td>
                        						<td width="255" class="content">
                                                    <h4 class="tid_<?php print $tid?>"><?php print $theme_agenda; ?></h4>
                                                    <h3 class="tid_<?php print $tid?>">« <?php print $node_agenda->title?> »</h3>
                                                    <p><?php print $description; ?></p>
                        						</td>
                        						<td width="18"><img src="http://<?php  print  $_SERVER['SERVER_NAME'] ?>/sites/all/themes/mnhn/img/newsletter/spacer.gif" alt="" height="1" width="18" /></td>
                        					</tr>
                        					<tr valign="top">
                                                <td colspan="5" width="431"><img src="http://<?php  print  $_SERVER['SERVER_NAME'] ?>/sites/all/themes/mnhn/img/newsletter/separ.gif" alt="" /></td>
                                            </tr>
                        				</table>

                        					<?php  }
											} 
											
										}	?>
                        				
										<?php 

										
										$nid_expo=$node->field_lettre_expo['und'][0]['nid'];
										$node_expo=$node->field_lettre_expo['und'][0]['node'];
										if($nid_expo>0 && $node_expo->status==1){
										$sous_titre=$node_expo->field_exposition_sous_titre['und'][0]['value'];
										$date_debut=$node_expo->field_exposition_date['und'][0]['value'];
										$date_fin=$node_expo->field_exposition_date['und'][0]['value2'];
										$date_expo=mnhn_content_format_date_medium($date_debut,$date_fin);
										$description_expo=nl2br($node_expo->field_exposition_detail['und'][0]['value']);
										$uri=$node_expo->field_exposition_visuel['und'][0]['uri'];   
										if(!empty($uri)){
											$uri=mnhn_content_uri_original($uri);
											$image=theme('image_style', array('style_name' => 'expo_newsletter', 'path' => $uri));
										}
										?>
											<table border="0" cellpadding="0" cellspacing="0" width="431">
                        					<tr valign="top">
                        						<td width="431" height="64"><img src="http://<?php  print  $_SERVER['SERVER_NAME'] ?>/sites/all/themes/mnhn/img/newsletter/spacer.gif" alt="" height="64" width="431" /></td>
                        					</tr>
                        					<tr valign="top">
                        						<td width="431" class="title_vert">
                                                    <h1>L'expo du moment</h1>
                        						</td>
                        					</tr>
                        					<tr valign="top">
                        						<td width="431" height="33"><img src="http://<?php  print  $_SERVER['SERVER_NAME'] ?>/sites/all/themes/mnhn/img/newsletter/spacer.gif" alt="" height="33" width="431" /></td>
                        					</tr>
                        				</table>

                        				<table border="0" cellpadding="0" cellspacing="0" width="431">
                        					<tr valign="top">
                        						<td width="22"><img src="http://<?php  print  $_SERVER['SERVER_NAME'] ?>/sites/all/themes/mnhn/img/newsletter/spacer.gif" alt="" height="1" width="22" /></td>
                        						<td width="391" class="content">
                                                    <?php print $image; ?>
                                                    <h1><?php print $node_expo->title; ?></h1>
                                                    <h2><?php print $sous_titre; ?></h2>
                                                    <p class="date"><?php print $date_expo; ?></p>
                                                    <p class="chapo"><?php print mnhn_content_clean_teaser(strip_tags($description_expo),200); ?></p>
                                                    <a href="http://<?php print $_SERVER['SERVER_NAME'] ?>/<?php print drupal_get_path_alias('node/'.$nid_expo);?>" class="link"><img src="http://<?php  print  $_SERVER['SERVER_NAME'] ?>/sites/all/themes/mnhn/img/newsletter/ensavoirplus.gif" alt="<?php print t('More details') ?>" width="115" /></a>
                        						</td>
                        						<td width="18"><img src="http://<?php  print  $_SERVER['SERVER_NAME'] ?>/sites/all/themes/mnhn/img/newsletter/spacer.gif" alt="" height="1" width="18" /></td>
                        					</tr>
                        				</table>


									<?php } ?>
											
                        			<?php 
									if($node->field_lettre_rubrique['und']>0){
									
										foreach($node->field_lettre_rubrique['und'] as $key => $value){
											$bloc_libres[]=$value['value'];
										}
										
										$field_collection_item = entity_load('field_collection_item', $bloc_libres);
										
										foreach ($field_collection_item as $bloc_libre ) {
											$uri=$bloc_libre->field_lettre_rubrique_visuel['und'][0]['uri'];   
											if(!empty($uri)){
												$image=theme('image_style', array('style_name' => 'bloc_newsletter', 'path' => $uri,'attributes' => array('class'=> 'flotleft')));
											}
											
											?>
										
											
										<table border="0" cellpadding="0" cellspacing="0" width="431">
                        					<tr valign="top">
                        						<td width="431" height="64"><img src="http://<?php  print  $_SERVER['SERVER_NAME'] ?>/sites/all/themes/mnhn/img/newsletter/spacer.gif" alt="" height="64" width="431" /></td>
                        					</tr>
                        					<tr valign="top">
                        						<td width="431" class="title_vert">
                                                    <h1><?php print $bloc_libre->field_lettre_rubrique_titre['und'][0]['value'] ?></h1>
                        						</td>
                        					</tr>
                        					<tr valign="top">
                        						<td width="431" height="22"><img src="http://<?php  print  $_SERVER['SERVER_NAME'] ?>/sites/all/themes/mnhn/img/newsletter/spacer.gif" alt="" height="22" width="431" /></td>
                        					</tr>
                        				</table>

                        				<table border="0" cellpadding="0" cellspacing="0" width="431">
                        					<tr valign="top">
                        						<td width="22"><img src="http://<?php  print  $_SERVER['SERVER_NAME'] ?>/sites/all/themes/mnhn/img/newsletter/spacer.gif" alt="" height="1" width="22" /></td>
                        						<td width="391" class="content2">
                                                    <h1><?php print $bloc_libre->field_lettre_rubrique_stitre['und'][0]['value'] ?></h1>
                                                    <h2><?php print $bloc_libre->field_lettre_rubrique_sstitre['und'][0]['value'] ?></h2>
                                                    <?php print $image; ?>
                                                    <p class="chapo topless"><?php print $bloc_libre->field_lettre_rubrique_accroche['und'][0]['value'] ?></p>
                                                    <?php print $bloc_libre->field_lettre_rubrique_texte['und'][0]['value'] ?>
                                                    <?php if($bloc_libre->field_lettre_rubrique_lien['und'][0]['nid']>0){ ?>
                                                    	<a href="http://<?php print $_SERVER['SERVER_NAME'] ?>/<?php print drupal_get_path_alias('node/'.$bloc_libre->field_lettre_rubrique_lien['und'][0]['nid']);?>" class="link"><img src="http://<?php  print  $_SERVER['SERVER_NAME'] ?>/sites/all/themes/mnhn/img/newsletter/ensavoirplus.gif" alt="<?php print t('More details') ?>" width="115" /></a>
                        							<?php } ?>
                        						</td>
                        						<td width="18"><img src="http://<?php  print  $_SERVER['SERVER_NAME'] ?>/sites/all/themes/mnhn/img/newsletter/spacer.gif" alt="" height="1" width="18" /></td>
                        					</tr>
                        				</table>
											
											<?php 
										}	
									} 
									?>	

                        	

                        				<table border="0" cellpadding="0" cellspacing="0" width="431">
                        					<tr valign="top">
                        						<td width="431" height="45"><img src="http://<?php  print  $_SERVER['SERVER_NAME'] ?>/sites/all/themes/mnhn/img/newsletter/spacer.gif" alt="" height="45" width="431" /></td>
                        					</tr>
                        				</table>

                        				<table border="0" cellpadding="0" cellspacing="0" width="431">
                        					<tr valign="top">
                        						<td width="431" height="29" align="right"><a href="#"><img src="http://<?php  print  $_SERVER['SERVER_NAME'] ?>/sites/all/themes/mnhn/img/newsletter/top.gif" alt="" height="29" width="106" /></td>
                        					</tr>
                        				</table>

                        				<table border="0" cellpadding="0" cellspacing="0" width="431">
                        					<tr valign="top">
                        						<td width="431" height="45"><img src="http://<?php  print  $_SERVER['SERVER_NAME'] ?>/sites/all/themes/mnhn/img/newsletter/spacer.gif" alt="" height="45" width="431" /></td>
                        					</tr>
                        				</table>

                                        

            						</td>
            						<td width="166" class="sidebar">

									<?php $bloc_infos_pratiques = variable_get('mnhn_bloc_info_pratique_'.$language->language, array()); ?>
                        				<table border="0" cellpadding="0" cellspacing="0" width="160" class="bloc_mhnh">
                        					<tr valign="top">
                        						<td width="160" class="musee_pratik">
                                                    <a href="#"><img src="http://<?php  print  $_SERVER['SERVER_NAME'] ?>/sites/all/themes/mnhn/img/newsletter/carte.jpg" alt="" /></a>
                                                    <h3>Informations pratiques</h3>
                                            		<?php print $bloc_infos_pratiques['value']; ?>
                        						</td>
                        					</tr>
                        				</table>

                        				<table border="0" cellpadding="0" cellspacing="0" width="166">
                        					<tr valign="top">
                        						<td width="169" height="9"><img src="http://<?php  print  $_SERVER['SERVER_NAME'] ?>/sites/all/themes/mnhn/img/newsletter/separ_sidebar.gif" alt="" height="9" width="166" /></td>
                        					</tr>
                        				</table>
                        				
                        				<?php 
                        					
										$sql = 'SELECT n.nid FROM node n
										INNER JOIN field_data_field_blog_date b 
										on b.entity_id=n.nid 
										and n.status=:status and n.language=:language
										order by b.field_blog_date_value desc';
										$nid_blog=db_query($sql,array(':language' => $language->language, ':status' => 1))->fetchField();
								
										$blog=node_load($nid_blog);
										$blog_uri=$blog->field_blog_visuel['und'][0]['uri'];  
										if(!empty($blog_uri)){
											$blog_image=theme('image_style', array('style_name' => 'bloc_newsletter', 'path' => $blog_uri));
										}


                        				
                        				?>

                        				<table border="0" cellpadding="0" cellspacing="0" width="160" class="bloc_mhnh">
                        					<tr valign="top">
                        						<td width="160" class="blog">
                                                    <h3>Le blog :</h3>
                                                    <h2>«<?php print mnhn_content_clean_teaser($blog->title,30)?>»</h2>
                                                    <a href="http://<?php  print  $_SERVER['SERVER_NAME'] ?>/blog"><?php print $blog_image; ?></a>
                        						</td>
                        					</tr>
                        				</table>

                        				<table border="0" cellpadding="0" cellspacing="0" width="166">
                        					<tr valign="top">
                        						<td width="169" height="9"><img src="http://<?php  print  $_SERVER['SERVER_NAME'] ?>/sites/all/themes/mnhn/img/newsletter/separ_sidebar.gif" alt="" height="9" width="166" /></td>
                        					</tr>
                        				</table>
                    

                        				<table border="0" cellpadding="0" cellspacing="0" width="160" class="bloc_mhnh">
                        					<tr valign="top">
                        						<td height="129" width="160">
                                                    <a href="http://<?php  print  $_SERVER['SERVER_NAME'] ?>/boutique"><img src="http://<?php  print  $_SERVER['SERVER_NAME'] ?>/sites/all/themes/mnhn/img/newsletter/reservez.jpg" alt="Réservez vos places" title="Réservez vos places" height="129" width="160" /></a>
                        						</td>
                        					</tr>
                        				</table>

                        				<table border="0" cellpadding="0" cellspacing="0" width="166">
                        					<tr valign="top">
                        						<td width="169" height="9"><img src="http://<?php  print  $_SERVER['SERVER_NAME'] ?>/sites/all/themes/mnhn/img/newsletter/separ_sidebar.gif" alt="" height="9" width="166" /></td>
                        					</tr>
                        				</table>

            						</td>
            					</tr>
            				</table>

						
						</td>
					</tr>
					<tr>
						<td width="26"><img src="http://<?php  print  $_SERVER['SERVER_NAME'] ?>/sites/all/themes/mnhn/img/newsletter/spacer.gif" alt="" width="26" /></td>
                        <td width="600">

            				<table border="0" cellpadding="0" cellspacing="0" width="600" class="layout2">
            					<tr valign="top">
                                    <td class="footer">
                                    
                        				<table border="0" cellpadding="0" cellspacing="0" width="592">
                        					<tr valign="top">
                                                <td class="footerInner" width="10"><img src="http://<?php  print  $_SERVER['SERVER_NAME'] ?>/sites/all/themes/mnhn/img/newsletter/spacer.gif" alt="" height="1" width="10" /></td>
                                                <td class="footerInner" width="148">
                                                    <ul class="footer_links">
                                                        <li><a href="http://<?php print $_SERVER['SERVER_NAME']; ?>">Le site web du Muséum</a></li>
                                                        <li><a href="http://<?php print $_SERVER['SERVER_NAME']; ?>/blog">Le blog du Muséum</a></li>
                                                    </ul>
                                                </td>
                                                <td class="footerInner share" width="423">
                                                <?php
                                                	$flickr=variable_get('mnhn_bloc_en_ligne_flickr', '');
													$facebook=variable_get('mnhn_bloc_en_ligne_facebook', '');
													$twitter=variable_get('mnhn_bloc_en_ligne_twitter', '');
                                                 ?>
                                                  <a href="<?php print $facebook; ?>" title="Facebook" target="_blank"><img src="http://<?php  print  $_SERVER['SERVER_NAME'] ?>/sites/all/themes/mnhn/img/newsletter/facebook.gif" alt="Facebook" /></a>
                                                  <a href="<?php print $twitter; ?>" title="Twitter" target="_blank"><img src="http://<?php  print  $_SERVER['SERVER_NAME'] ?>/sites/all/themes/mnhn/img/newsletter/twitter.gif" alt="Twitter" /></a>
                                                  <a href="<?php print $flickr; ?>" title="Flickr" target="_blank"><img src="http://<?php  print  $_SERVER['SERVER_NAME'] ?>/sites/all/themes/mnhn/img/newsletter/flickr.gif" alt="Flickr" /></a>
                                                    <p>Copyright Muséum d'Histoire Naturelle du Havre <?php print date('Y')?></p>
                                                </td>
                                                <td class="footerInner" width="13"><img src="http://<?php  print  $_SERVER['SERVER_NAME'] ?>/sites/all/themes/mnhn/img/newsletter/spacer.gif" alt="" height="1" width="13" /></td>
                                            </tr>
                                        </table>

                                    </td>
                                </tr>
                            </table>

                        </td>
					</tr>
				</table>
