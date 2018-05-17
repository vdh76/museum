
<?php 


global $language;

$tid=$node->field_ressource_categorie['und'][0]['tid'];
$theme=mnhn_content_get_term($tid);

$uri_visuel=$node->field_ressource_image['und'][0]['uri'];
//$visuel=theme('image_style', array('style_name' => 'produit', 'path' => $uri_visuel));
$auteur=$node->field_ressource_auteur['und'][0]['value'];
$credits=$node->field_ressource_credits['und'][0]['value'];
$description=$node->field_ressource_description['und'][0]['value'];
$editeur=$node->field_ressource_editeur['und'][0]['value'];
$uri_fichier=$node->field_ressource_fichier['und'][0]['uri'];
if(!empty($uri_fichier)){
 $url_fichier=file_create_url($uri_fichier);	
 $ext_fichier=substr(strtolower(strrchr(basename($url_fichier), ".")),1);;
 $poids_fichier=round($node->field_ressource_fichier['und'][0]['filesize']/1000);
  if($poids_fichier>1000){
  	$poids_fichier=round($poids_fichier/1000,1);
  	$poids_fichier.=' Mo';
  }else{
  	$poids_fichier.=' Ko';
  }
 
}
$sstitre=$node->field_ressource_sous_titre['und'][0]['value'];



if($teaser){
?>
 <div class="prdt nomarginleft">
  <h3><?php print $theme; ?></h3>
  <div class="thumb"><?php if(!empty($uri_visuel)){ print '<a href="/'.$language->language.'/'.drupal_get_path_alias('node/'.$node->nid).'"><img src="'.file_create_url($uri_visuel).'" /></a>'; } ?></div>
 
  <h4 class="titre_prdt"><a href="/<?php print $language->language;?>/<?php print drupal_get_path_alias('node/'.$node->nid)?>"><?php print $node->title; ?></a></h4>
  <h5 class="sstitre_prdt"><?php print $sstitre; ?></h5>
  <h6 class="type"><?php print $description; ?></h6>
  <?php if(!empty($uri_fichier)){ ?>
   		<p class="info_fichier"><strong>Type : </strong> fichier <?php print strtoupper($ext_fichier)?><br/>
    		<strong>Poids : </strong><?php print $poids_fichier; ?>
    	</p>
  <?php } ?>
  <a href="/<?php print $language->language;?>/<?php print drupal_get_path_alias('node/'.$node->nid)?>" class="link"><?php print t('See the record') ?></a>
  <?php if(!empty($uri_fichier)){ ?><a href="<?php print $url_fichier; ?>" class="link"><?php print t('Download') ?></a><?php }?>
  <div class="clearfix"></div>
</div>


<?php }else{ 

	drupal_add_js('jQuery(function() {
	   jQuery("ul.menu-vertical li[rel='.$tid.']").addClass("activ");
	});','inline');
	
	
	$sql = 'SELECT n.nid FROM node n
	INNER JOIN taxonomy_index ti on ti.nid=n.nid and ti.tid=:tid and n.language=:language and n.status=:status
	order by n.title asc';
	$result=db_query($sql,array(':language'=> $language->language,':tid'=> $tid,':status'=> 1));
	$nb_ressource=0;
	foreach($result as $row){
		$tab_ressource[]=array('value' => $row->nid);
		$nb_ressource++;
	}
	

	
	if($nb_ressource>1){
		foreach($tab_ressource as $key => $value){
			//print $key.'-'.$value['value'].'<br/>';
			//$link_objet_hide.='<a href="javascript:;" rel="'.$value['value'].'" id="'.$node->nid.'" class="link_objet_hide"></a>';
			if($node->nid==$value['value']){
			
				if($key<($nb_ressource-1)){
					
					$next=$tab_ressource[($key+1)]['value'];
					$next_title=db_query('select title from node where nid=:nid',array(':nid'=> $next))->fetchField();
					$next_link='/'.$language->language.'/'.drupal_get_path_alias('node/'.$next);
					//print $next_title;
					//exit;
				}
				$num_ressource=$key+1;		
				if($key>0){
					$prev=$tab_ressource[($key-1)]['value'];
					$prev_title=db_query('select title from node where nid=:nid',array(':nid'=> $prev))->fetchField();
					$prev_link='/'.$language->language.'/'.drupal_get_path_alias('node/'.$prev);
				}
			}
			
		}
	}
	
	
	?>
  <div class="numeritheque-header">
                    
                        <h1 class="title_m"><?php print $theme?></h1>

                    </div>
    
                    <div class="page-detail-wrapper">

                        <div class="entete">
                            <a href="/<?php print $language->language?>/<?php print drupal_get_path_alias('numeritheque/'.$tid);?>" class="retour"><span><?print t('Back') ?></span></a>
                            <div class="nav">
                            <?php if($nb_ressource>1){ ?>
                                <?php if($prev>0){?>
							     	<a href="<?php print $prev_link ?>" class="prev" rel="<?php print $prev ?>" id="<?php print $node->nid?>" title="<?php print $prev_title?>"></a>
							     <?php } ?>
							     <p class="num"><?php print $num_ressource.'/'.$nb_ressource; ?></p>
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
                                 <?php if(!empty($credit)){?>
                                <br /><strong><?php print t('Copyright')?> :</strong>
                                <br />&copy; <?php print $credit?>
                                 <?php } ?></p>
                            </div>
                            <div class="pricing">
                                <img src="/sites/all/themes/mnhn/pics/boutons/icone_ressource_<?php print $tid?>.png"/>
                                <?php if(!empty($uri_fichier)){ ?>
							   		<p class=""><strong>Type : </strong> <?php print t('file');?> <?php print strtoupper($ext_fichier)?><br/>
							    		<strong><?php print t('weight');?> : </strong><?php print $poids_fichier; ?>
							    	</p>
  								<?php } ?>
                               <?php if(!empty($uri_fichier)){ ?><a href="<?php print $url_fichier; ?>" class="link" target="_blank"><?php print t('Download') ?></a><?php }?>

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
						
						<?php print mnhn_numeritheque_liste_link($node->field_ressource_link['und']);?>
                     </div>   
<?php }?>