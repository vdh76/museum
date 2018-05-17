<?php 
global $language;
$ajax=0;
if(arg(0)=='objet'){
	$ajax=1;
}
drupal_add_js('

	jQuery(function() {
	   
		

	});','inline');
$nid_collection=mnhn_collection_objet_collection(arg(1));
$nb_objets=mnhn_collection_objets_nb($nid_collection);
$title=$node->field_object_titre['und'][0]['value'];
if(empty($title)){
	$title=$node->title;
}
if(arg(0)=='node'){
	$back_url='/'.$language->language.'/'.drupal_get_path_alias('node/'.$nid_collection);
}else{
	$back_url='javascript:;';
}

	$sql = 'SELECT n.nid FROM node n
	INNER JOIN field_data_field_object_collection c 
	on c.entity_id=n.nid and n.language=:language
	and field_object_collection_nid=:nid
	and n.status=:status
	order by n.title asc';
	$result=db_query($sql,array(':language'=> $language->language,':nid'=> $nid_collection,':status'=> 1));
	
	foreach($result as $row){
		$tab_objet[]=array('value' => $row->nid);
		
	}
	
	foreach($tab_objet as $key => $value){
		$link_objet_hide.='<a href="javascript:;" rel="'.$value['value'].'" id="'.$node->nid.'" class="link_objet_hide"></a>';
		if($node->nid==$value['value']){
			
			if($key<($nb_objets-1)){
				$next=$tab_objet[($key+1)]['value'];
				$next_title=db_query('select title from node where nid=:nid',array(':nid'=> $next))->fetchField();
				$next_link='/'.$language->language.'/'.drupal_get_path_alias('node/'.$next);
			}
			$num_objet=$key+1;		
			if($key>0){
				$prev=$tab_objet[($key-1)]['value'];
				$prev_title=db_query('select title from node where nid=:nid',array(':nid'=> $prev))->fetchField();
				$prev_link='/'.$language->language.'/'.drupal_get_path_alias('node/'.$prev);
			}
		}
		
	}
	
	if(arg(0)=='objet'){
		$prev_link="javascript:;";
		$next_link="javascript:;";
	}

?>

<?php if($ajax==0){ ?>
<div class="page-detail-wrapper">
<?php }?>
<div class="fiche_objet" id="fiche_objet_<?php print $node->nid; ?>" rel="<?php print $node->nid; ?>">
<div class="entete">
    <h2><?php print $title?></h2>
    <div class="nav">
    <?php if($prev>0){?>
     	<a href="<?php print $prev_link ?>" class="prev" rel="<?php print $prev ?>" id="<?php print $node->nid?>" title="<?php print $prev_title?>"></a>
     <?php } ?>
     <p class="num"><?php print $num_objet.'/'.$nb_objets; ?></p>
      <?php if($next>0){?>
     	<a href="<?php print $next_link ?>" class="next" rel="<?php print $next ?>" id="<?php print $node->nid?>" title="<?php print $next_title?>"></a>
     <?php } ?>
     </div>
      <a href="<?php print $back_url;?>" class="retour" rel="<?php print $node->nid?>"><span><?php print t('Back') ?></span></a>
</div>
<?php if(array_key_exists(RID_EDITEUR,$user->roles) || array_key_exists(RID_ADMIN,$user->roles) || array_key_exists(RID_SUPERADMIN,$user->roles)){ ?>
		<div class="edit"><a href="/<?php print $language->language;?>/node/<?php print $node->nid ?>/edit">Editer</a></div>		
<?php } ?>

<?php 

	if($node->field_page_bloc['und'][0]['value']>0){
		foreach($node->field_page_bloc['und'] as $bloc_entity_id){
				$blocs[]=$bloc_entity_id['value'];
		}		
		$output.=mnhn_content_bloc_page($blocs,$ajax);
	}
			
	print $output;
?>
<?php print $link_objet_hide; ?>

	
<?php 

if($node->field_object_link['und'][0]['nid']>0){
 
$output='<div class="accordion">
<h2 class="title_accordion visible">'.t('Related objects').'</h2>
</div>';

	foreach($node->field_object_link['und'] as $objet){
			$objet=node_load($objet['nid']);
			$nid_objet_collection=mnhn_collection_objet_collection($objet->nid);
			
			if($nid_objet_collection==$nid_collection){
			$title=$objet->field_object_titre['und'][0]['value'];
			if(empty($title)){
				$title=$objet->title;
			}
			$chapo=$objet->field_object_chapo['und'][0]['value'];
			$uri=$objet->field_object_visuel['und'][0]['uri'];
			if(!empty($uri)){
				$image=theme('image_style', array('style_name' => 'objet_vignette', 'path' => $uri));
			}else{
				$image='<img src="/'.drupal_get_path('theme','mnhn').'/pics/fonds/blank.png" width="109" height="80">';
			}
			
			$output.=theme('objet-teaser', array('nid'=> $objet->nid,'image' => $image,'title'=> $title,'chapo'=> $chapo, 'ajax' => $ajax, 'objet' =>1));
 		}
	}
 	
 	print $output;
	
}?>
</div>
<?php if($ajax==0){?>
</div>
<?php }?>
	
