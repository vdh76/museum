<?php
// Template Evenement
/**
 * @file evenement.tpl.php
 *
 *
 * Available variables:
 * - $node 
 * - $template 
 * 
 *
 * @see template_preprocess()
 * @see template_preprocess_block()
 */

/*
				{
					id: 307,
					title: "Birthday Party",
					body: "lorem ipsum dolor sit amet",
					start: new Date(y, m, d+1, 19, 0),
					end: new Date(y, m, d+2, 22, 30),
					className:"tid-6"	,
					url: "http://www.google.com"
				},
*/
global $user;
global $language;


// recupération field entity bloc_link
$sql = 'SELECT field_bloc_link_value from field_data_field_bloc_link where entity_type=:node and entity_id=:nid order by delta';
$result=db_query($sql,array(':node'=>'node',':nid'=> $node->nid));
foreach($result as $row){
	if($row->field_bloc_link_value>0){
		$tab_links[]=$row->field_bloc_link_value;
		
	}
}

if(sizeof($tab_links)>0){
	$field_link = entity_load('field_collection_item', $tab_links);
	$links=mnhn_content_list_links($field_link,0);
}


$date_debut=$node->field_event_date['und'][0]['value'];
$date_fin=$node->field_event_date['und'][0]['value2'];
$tid=$node->field_event_type['und'][0]['tid'];
$theme=mnhn_content_get_term($tid);
$date_medium=mnhn_content_format_date_medium($date_debut,$date_fin);
$uri=$node->field_event_visuel['und'][0]['uri'];
$horaire=$node->field_event_horaire['und'][0]['value'];
if($template=='js'){
$uri=mnhn_content_uri_original($uri);
if(!empty($uri)){
	$image=theme('image_style', array('style_name' => 'event_hover', 'path' => $uri));
}
if(!empty($horaire)){
	$horaire_event=t('Hours').' : '.$horaire;
}
?>{id: <?php print $node->nid ?>,horaire: "<?php print $horaire_event ?>",title: "<?php print $theme ?>",title_event: "<?php print mnhn_content_clean_teaser($node->title,40) ?>",start: "<?php print date('Y-m-d',$date_debut)?>",<?php if($date_fin>$date_debut){?>end: "<?php print date('Y-m-d',$date_fin)?>",<?php } ?>image: '<?php print $image; ?>',date_medium: "<?php print $date_medium;?>",description: "<?php print mnhn_content_teaser($node->field_event_sous_titre['und'][0], 90);?>",className:"tid-<?php print $tid?>"},<?php  }else{
	
($date_debut==$date_fin)? $class_event='single_event':$class_event='';

$date_short_debut=mnhn_content_format_date_short($date_debut);


$duree=$node->field_event_duree['und'][0]['value'];
$tarif=$node->field_event_tarif['und'][0]['value'];
$lieu=$node->field_event_lieu['und'][0]['value'];
$animateur=$node->field_event_animateur['und'][0]['value'];
$public=$node->field_event_public['und'][0]['value'];
$description=$node->field_event_description['und'][0]['value'];



if(!empty($uri)){
	$screenshot=file_create_url($uri);
	$image='<img src="'.file_create_url($uri).'" width="180" height="120" alt="'.$node->field_event_visuel['und'][0]['alt'].'">';
}else{
	$image='<img src="/'.drupal_get_path('theme','mnhn').'/images/img.jpg" width="180" height="120">';
}

?>
<div class="calendar-event tid-<?php print $tid ?>">
	<div class="fc-event-over-date">
		<div><span class="day"><?php print $date_short_debut['d']?></span><br><span class="month"><?php print $date_short_debut['m']?></span><br><span class="year"><?php print $date_short_debut['y']?></span></div>
		<?php if($date_fin>$date_debut){
			$date_short_fin=mnhn_content_format_date_short($date_fin);
		?>
		<div class="between"><span>></span></div>
		<div><span class="day"><?php print $date_short_fin['d']?></span><br><span class="month"><?php print $date_short_fin['m']?></span><br><span class="year"><?php print $date_short_fin['y']?></span></div>
		<?php  } ?>
	</div>
	<div class="fc-event-over-content <?php print $class_event?>" id="event-<?php print $node->nid;?>">
		<span class="theme"><?php print $theme;?>&nbsp;:&nbsp;</span><span class="title"><?php print mnhn_content_clean_teaser($node->title,80)?></span>
		<span class="date"><?php print $date_medium; ?></span>
		<p class="body"><?php print mnhn_content_teaser($node->field_event_description['und'][0], 140)?></p>
	</div>
	<a href="/<?php print $node->path;?>" onclick="return false;"></a>
	<div class="fc-event-over-content-body">
		<div class="tid-<?php print $tid ?>">
			<div class="theme"><?php print $theme ?></div>
			<div class="title"><?php print $node->title;?></div>
			<?php print $image; ?>
			<div class="event_info">
				<div class="event_detail"><?php print $date_medium; ?><div class="filet"></div></div>
				
				<div class="event_detail">
					<?php if(!empty($horaire)){ ?>
						<?php print t('Hours')?> : <?php print $horaire; ?><br/>
					<?php } ?>
					<?php if(!empty($duree)){ ?>
						<?php print t('Length')?> : <?php print $duree; ?>
					<?php } ?>
					<?php if(!empty($horaire) || !empty($duree)){ ?>
					<div class="filet"></div>
					<?php } ?>
				</div>
				
				<?php if(!empty($lieu)){ ?>
					<div class="event_detail"><?php print t('Location')?> : <?php print $lieu; ?></div>
				<?php } ?>
			</div>
			<div class="clearfix"></div>
			<div class="event_detail">
			<?php if(!empty($tarif)){ ?>
				<?php print t('Admission fee')?> : <?php print $tarif; ?><br/>
			<?php } ?>
			<?php if(!empty($public)){ ?>
						<?php print t('Audience')?> : <?php print $public; ?><br/>
			<?php } ?>
			
			<?php if(!empty($animateur)){ ?>
				<?php print t('Hosted by')?> : <?php print $animateur; ?><br/> 
			<?php } ?>
			</div>
		<div class="edit"><a href="javascript:;" class="addthis_button_compact share_event" id="share_event_<?php print $node->nid; ?>" addthis:url="http://<?php print $_SERVER['SERVER_NAME'] ?>/<?php print $language->language;  ?>/<?php print drupal_get_path_alias('node/'.$node->nid); ?>" addthis:title="<?php print $node->title;?>" addthis:screenshot="<?php print $screenshot;?>"><?php print t('Bookmarks & Share')?></a></div>
		
		
		<div class="clear"></div>
		<?php if(array_key_exists(RID_EDITEUR,$user->roles) || array_key_exists(RID_ADMIN,$user->roles) || array_key_exists(RID_SUPERADMIN,$user->roles)){ ?>
			<br/><div class="edit"><a href="/<?php print $language->language;?>/node/<?php print $node->nid ?>/edit">Editer</a></div>
			<div class="clear"></div>
		<?php } ?>
		<?php 
		/*
		if(($date_fin-60*60*24*7)>time()){ ?>
			<div class="edit"><a href="/<?php print $language->language;?>/alerte/<?php print $node->nid ?>">Être alerté sur l'événement</a></div>
			<div class="clear"></div>
		<?php }*/
		 ?>
		
		<div class="body"><?php print $description; ?></div>
		
		<?php print $links; ?>
		<br />
		<br />
		<?php print mnhn_content_list_files($node->field_event_file['und']); ?>
		<br />
		<br />
		<?php print mnhn_content_list_keywords($node->field_keyword['und']); ?>
		<br />
		<br />
			
		</div>	
	</div>	
</div>
<?php } ?>