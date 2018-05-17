<div class="page-detail-wrapper museum">

<?php 
drupal_add_js('

jQuery(function(){
    
    jQuery(".event_date_multi h5").next("ul").css({"display":"none"});
    
    jQuery(".event_date_multi h5").toggle(
    function(){
        jQuery(this).next("ul").show(300);
        jQuery(this).addClass("open").removeClass("close");
    },
    function(){
        jQuery(this).next("ul").hide(300);
        jQuery(this).addClass("close").removeClass("open");
    }
    );
});

','inline');

//-------TITRE-----------
if($node->title){
    $output='<div class="clear page-header" style="height:3px"></div><div class="entete_event"><a href="/fr/agenda" class="retour" title="Retour" >retour</a></div><div class="clear page-header"><h3 style="padding:0">'.$node->title.'</h3></div>';
}

//-------VISUEL-----------
$uri=$node->field_event_visuel['und'][0]['uri'];
if(!empty($uri)){
    $photo = array(
            'style_name' => 'resultat_agenda_180x120', 
            'path' => $uri,
            'title' => $node->field_event_visuel['und'][0]['title'],
            'alt' => $node->field_event_visuel['und'][0]['alt'],
            'attributes' => array('class'=> 'img_event')
            );
    $output.= '<div class="event_visuel">'.theme('image_style', $photo).'</div>';
}

//-------TYPE-----------
$output .= '<div class="event_type"><ul>';
foreach($node->field_event_type['und'] as $key => $value){
    
    if($value['taxonomy_term']->name){
        $output.= '<li>'.$value['taxonomy_term']->name;
    }
    $last_key = end(array_keys($node->field_event_type['und']));
    if($key != $last_key && count($node->field_event_type['und']) > 1){$output.= ' - <li>';}else{$output.= '<li>';}
}
$output .= '</ul></div>';

//-------SOUS TITRE-----------
if(!empty($node->field_event_sub_title['und'][0]['value'])){
    $output.='<div class="event_sub_title">'.$node->field_event_sub_title['und'][0]['value'].'</div>';
}

//-------BODY-----------
if(!empty($node->body['und'][0]['value'])){
    $output.='<div class="event_body">'.$node->body['und'][0]['value'].'</div>';
}

//-------ANIMATEUR-----------
if(!empty($node->field_event_animateur['und'][0]['taxonomy_term']->name)){
    $output.='<div class="event_animateur"><span class="event_label">Animé par : </span>'.$node->field_event_animateur['und'][0]['taxonomy_term']->name.'</div>'; 
}

//-------LEGENDE VISUEL-----------
if(!empty($node->field_event_legende_visuel['und'][0]['value'])){
    $output.='<div class="event_legend_visuel">'.$node->field_event_legende_visuel['und'][0]['value'].'</div>'; 
}

//-------INFOS PRATIQUE-----------
$output .= '<div class="clearfix"></div><div class="event_infos"><h3>Informations pratiques</h3>';

//-------DATES-----------
setlocale (LC_TIME, 'fr_FR','fra');
if($node->field_event_dates['und'][0]['rrule'] == ""){
    if($node->field_event_dates['und'][0]['value'] == $node->field_event_dates['und'][0]['value2']){
        $date_event = strtotime($node->field_event_dates['und'][0]['value']);
        $output.='<div class="event_date"><span class="event_label">Date : </span><span class="date_color_arial">'.strftime("%d %B %Y", $date_event).'</span></div>';
    }else{
        $date_debut_timestamp = strtotime($node->field_event_dates['und'][0]['value']);
        $date_fin_timestamp = strtotime($node->field_event_dates['und'][0]['value2']);
        $output.='<div class="event_date"><span class="event_label">Date : </span><span class="date_color_arial"> du '.strftime("%d %B %Y", $date_debut_timestamp).' au '.strftime("%d %B %Y", $date_fin_timestamp).'</span></div>';
    }
}else{
    $output .= '<div class="event_date_multi"><h5 class="close"><span class="date_color">Les dates</span></h5><ul>';
    $count_event = 0;
    foreach($node->field_event_dates['und'] as $key => $value){
            
        $date_event = strtotime($value['value']);
        if($date_event >= strtotime("now")){
            $count_event++;
            $output .= '<li>'.strftime("%A %d %B %Y", $date_event).'</li>';
        }
        
        if($count_event == 0){
            //$output .= '<li style="color:#ccc;">'.strftime("%A %d %B %Y", $date_event).'</li>';
        }
    }
    $output .= '</ul></div>';
}


//-------MULTI SEANCES-----------
if($node->field_event_multi_seance['und'][0]['value'] != 0){
    $output.='<div class="event_multi_seance">Sur plusieurs séances, présence requise à toutes les dates</div>';
}

$output.= '<div class="event_heure">';
//-------HORAIRES-----------
if(!empty($node->field_event_horaires['und'][0]['taxonomy_term']->name)){
    $output.='<div class="event_horaire"><span class="event_label">Horaire(s) : </span>'.$node->field_event_horaires['und'][0]['taxonomy_term']->name.'</div>'; 
}

//-------DUREE-----------
if(!empty($node->field_event_duree['und'][0]['taxonomy_term']->name)){
    $output.='<div class="event_duree"><span class="event_label">Durée : </span>'.$node->field_event_duree['und'][0]['taxonomy_term']->name.'</div>'; 
}
$output.= '</div>';

//-------PUBLIC-----------
if(!empty($node->field_event_public['und'][0]['taxonomy_term']->name)){
    $output.='<div class="event_public"><span class="event_label">Public(s) : </span>'.$node->field_event_public['und'][0]['taxonomy_term']->name.'</div>'; 
}

//-------TARIFS-----------
if(!empty($node->field_event_tarif['und'][0]['value'])){
    $output.='<div class="event_tarif"><span class="event_label">Tarif(s) : </span>'.$node->field_event_tarif['und'][0]['value'].'</div>'; 
}

if($node->field_event_gratuit['und'][0]['value'] != 0){
    $output.='<div class="event_tarif"><span class="date_color_arial">Gratuit</span></div>';
}

//-------LIEU-----------
if(!empty($node->field_event_lieu['und'][0]['taxonomy_term']->name)){
    $output.='<div class="event_lieu"><span class="event_label">Lieu : </span>'.$node->field_event_lieu['und'][0]['taxonomy_term']->name.'</div>'; 
}

//-------RESERVATION-----------
if($node->field_event_reservation['und'][0]['value'] != 0){
    $output.='<div class="event_reservation">Places limitées ! Réservation obligatoire à l\'accueil du Muséum ou par téléphone au 02 35 41 37 28.</div>';
}

//-------SANS RESERVATION-----------
if($node->field_event_no_reservation['und'][0]['value'] != 0){
    $output.='<div class="event_reservation">Sans réservation, dans la limite des places disponibles.</div>';
}

//-------RESERVATION CONSEILLEE-----------
if($node->field_event_reservation_conseil['und'][0]['value'] != 0){
    $output.='<div class="event_reservation">Dans la limite des places disponibles, réservation conseillée au 02 35 41 37 28.</div>';
}

//-------PREVENTE-----------
if($node->field_event_prevente['und'][0]['value'] != 0){
    $output.='<div class="event_reservation">Tickets disponibles en prévente à l’accueil du Muséum.</div>';
}

//----INFOS PRATIQUE-----
$output .= '</div>';

//-------LINK--------------
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
    $output .= '<br/><br/><div class="join-title">Voir aussi :</div>';
}

$output.= $links;
$output.= mnhn_content_list_files($node->field_event_documents['und']);
$output.='<br/><br/>';
$output.= mnhn_content_list_keywords($node->field_field_event_keyword['und']);

print $output;

?>
</div>
<div class="clear"></div>
<br/><br/><br/>