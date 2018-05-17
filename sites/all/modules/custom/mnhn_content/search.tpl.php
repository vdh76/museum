<?php
// Template Résultat recherche
/**
 * @file search.tpl.php
 *
 *
 * Available variables:
 * - $result
 * 
 * 
 *
 * @see template_preprocess()
 * @see template_preprocess_block()
 */
$node=$result['node'];
// print_r($result);
// exit;
$description=$result['snippet'];
$breacrumb=array();
global $language;
switch($node->type){
	
	case 'collection':
		//$breadcrumb[]=l('Collections', 'collections');
		//$breadcrumb[]=l(t('Artworks in context'), 'collections/oeuvres-commentees');
		$breadcrumb[]='Collections';
		$uri=$node->field_collection_visuel['und'][0]['uri'];
		$description=mnhn_content_clean_teaser($node->field_collection_chapo['und'][0]['value'],220);
		break;
		
	case 'blog':
		//$breadcrumb[]=l('Blog', 'blog');
		$breadcrumb[]='Blog';
		$uri=$node->field_blog_visuel['und'][0]['uri'];
		$description=mnhn_content_clean_teaser($node->field_blog_accroche['und'][0]['value'],220);
		//$description=$node->field_blog_accroche['und'][0]['value'];
		break;	
		
	case 'ressource':
		//$breadcrumb[]=l('Blog', 'blog');
		$breadcrumb[]=t('Numérithèque');
		$uri=$node->field_ressource_image['und'][0]['uri'];
		$description=mnhn_content_clean_teaser($node->field_ressource_description['und'][0]['value'],220);
		//$description=$node->field_blog_accroche['und'][0]['value'];
		break;		
		
	case 'page':
		$type='Page';
		
		$sql = 'SELECT mlid,p1,p2,p3 from menu_links where link_path=:link_path';
		$result=db_query($sql,array('link_path'=>'node/'.$node->nid));	
			foreach($result as $row){
				
				if($row->p1>0 && $row->p1!=$row->mlid){
					$title_1=db_query('select link_title from menu_links  where mlid=:mlid',array(':mlid'=> $row->p1))->fetchField();
					$link_1=db_query('select link_path from menu_links  where mlid=:mlid',array(':mlid'=> $row->p1))->fetchField();
					//$breadcrumb[]=l($title_1, $link_1);
					$breadcrumb[]=$title_1;
				}
				
				if($row->p2>0 && $row->p2!=$row->mlid){
					$title_2=db_query('select link_title from menu_links  where mlid=:mlid',array(':mlid'=> $row->p2))->fetchField();
					$link_2=db_query('select link_path from menu_links  where mlid=:mlid',array(':mlid'=> $row->p2))->fetchField();
					//$breadcrumb[]=l($title_2, $link_2);
					$breadcrumb[]=$title_2;
				}
				
				if($row->p3>0 && $row->p3!=$row->mlid){
					$title_3=db_query('select link_title from menu_links  where mlid=:mlid',array(':mlid'=> $row->p3))->fetchField();
					$link_3=db_query('select link_path from menu_links  where mlid=:mlid',array(':mlid'=> $row->p3))->fetchField();
					//$breadcrumb[]=l($title_3, $link_3);
					$breadcrumb[]=$title_3;
				}
				
			}	
		$uri=$node->field_page_visuel['und'][0]['uri'];
		if(!empty($uri)){
			$uri=mnhn_content_uri_original($uri);
		}
		$description=mnhn_content_clean_teaser($node->field_page_chapo['und'][0]['value'],220);
		break;

	case 'event':
		//$breadcrumb[]=l(t('Calendar'), 'agenda');
		$breadcrumb[]=t('Calendar');
		$uri=$node->field_event_visuel['und'][0]['uri'];
		if(!empty($uri)){
			$uri=mnhn_content_uri_original($uri);
		}
		$description=mnhn_content_clean_teaser($node->field_event_description['und'][0]['value'],220);
		$anchor='#detail';
		break;	

	case 'exposition':
		//$breadcrumb[]=l(t('Exhibitions'), 'expositions');
		$breadcrumb[]=t('Exhibitions');
		$uri=$node->field_exposition_visuel['und'][0]['uri'];
		if(!empty($uri)){
			$uri=mnhn_content_uri_original($uri);
		}
		$description=mnhn_content_clean_teaser($node->field_exposition_detail['und'][0]['value'],220);
		break;	

	case 'lettre':
		$breadcrumb[]=t('E-news');
		//$breadcrumb[]=l(t('E-news'),'la-lettre-du-muséum');
		$uri=$node->field_lettre_visuel_archive['und'][0]['uri'];
		$description=mnhn_content_clean_teaser($node->field_lettre_resume['und'][0]['value'],220);
		$node->title='N° '.$node->title;
		break;	
		
		
	case 'object':
			$nid_collection=$node->field_object_collection['und'][0]['nid'];
			$title_collection=db_query('select title from node where nid=:nid',array(':nid'=>$nid_collection))->fetchField();
			$breadcrumb[]='Objet collection : '.$title_collection;
			//$breadcrumb[]=l(t('E-news'),'la-lettre-du-muséum');
			$uri=$node->field_object_visuel['und'][0]['uri'];
			$description=mnhn_content_clean_teaser($node->field_object_chapo['und'][0]['value'],220);
			break;
		
	
		
		break;			
}

if(empty($description)){
	//$description=$result['snippet'];
}
if($uri!=''){
	$image=theme('image_style', array('style_name' => 'search', 'path' => $uri,'attributes'=>array('class'=>'vignet')));
}


?>
<div class="item">
	     <?php print $image; ?>
	     <div class="text">
	          <h4><a href="/<?php print $language->language ?>/<?php print drupal_get_path_alias('node/'.$node->nid) ?><?php print $anchor?>" title="<?php print $node->title?>"><?php print $node->title?></a></h4>
	          <h5><?php print implode(' » ', $breadcrumb)?></h5>
	          <p><?php print $description; ?></p>
	          <a href="/<?php print $language->language;?>/<?php print drupal_get_path_alias('node/'.$node->nid);?>" class="link"><?php print t('More details') ?></a>
	   </div>
	</div>


