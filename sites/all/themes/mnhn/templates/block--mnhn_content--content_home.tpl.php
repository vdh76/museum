<?php
drupal_add_js(drupal_get_path('theme', 'mnhn') . '/js/home.js');
global $language;
if ($language->language == 'fr') {
    setlocale(LC_ALL, 'fr_FR.utf8', 'fra');
}

$timestamp_aujourdhui = mktime(0, 0, 0, date('m'), date('d'), date('Y'));


$sql = 'SELECT n.nid FROM node n
INNER JOIN field_data_field_exposition_date e 
on e.entity_id=n.nid 
and n.status=:status and n.language=:language and n.promote=:promote
where e.field_exposition_date_value2>=:date
order by e.field_exposition_date_value asc';
$result = db_query($sql, array(':language' => $language->language, ':status' => 1, ':promote' => 1, ':date' => $timestamp_aujourdhui));

$expo = 1;
foreach ($result as $row) {

    $node = node_load($row->nid);
    $type = $node->field_exposition_type['und'][0]['value'];
    ($type == 'expo') ? $type_expo = t('Exhibition') : $type_expo = t('Event');

    $date_debut = $node->field_exposition_date['und'][0]['value'];
    $subtitle = $node->field_exposition_sous_titre['und'][0]['value'];
    $date_fin = $node->field_exposition_date['und'][0]['value2'];
    $date = mnhn_content_format_date_medium($date_debut, $date_fin);
    $uri = $node->field_exposition_visuel_homepage['und'][0]['uri'];
    $chapo = $node->field_exposition_chapo['und'][0]['value'];
    $image = '<img src="' . file_create_url($uri) . '" />';
    $date = mnhn_content_format_date_medium($date_debut, $date_fin, 1);
    $list_expos .= theme('expo_homepage', array('nid' => $node->nid, 'type' => $type_expo, 'title' => $node->title, 'subtitle' => $subtitle, 'date' => $date, 'image' => $image, 'chapo' => $chapo));
    $expos_tab .= '<li><a href="#" class="round3">' . $expo . '</a></li>';
    if ($subtitle != '') {
        $title .= '<br/> ' . $subtitle;
    }

    $expo++;

}

?>
<div id="home_expo">
    <div id="gallery_expo">

        <?php
        $block = module_invoke('slider_home', 'block_view', 'slider');
        print $block['content'];
        ?>

    </div>
    <!-- fin de la gallery -->

</div>
<?php $bloc_aventure = variable_get('mnhn_bloc_aventure_' . $language->language, $defaults); ?>
<div class="row2">
    <div id="home_museum">
        <h2><a href="<?php print $language->language ?>/<?php print drupal_get_path_alias('aventure-museum') ?>"
               title="<?php print t('Museum Adventure') ?>"><img
                        src="/sites/all/themes/mnhn/pics/titres/aventure_museum_<?php print $language->language; ?>.png"
                        alt="<?php print t('Museum Adventure') ?>" class="titre_img"/></a></h2>
        <?php print $bloc_aventure['value']; ?>
        <img src="/sites/all/themes/mnhn/pics/visuels/rat3.png" alt="" class="visuel"/>
    </div>
    <?php

    //=======BLOC AGENDA=======
    $timestamp_aujourdhui = date('Y-m-d 00:00:00');

    $result_event = db_select('field_data_field_event_dates', 'f')
        ->fields('f', array('entity_id', 'field_event_dates_value'))
        ->condition('field_event_dates_value', $timestamp_aujourdhui, '>=')
        ->orderBy('field_event_dates_value', 'ASC')
        ->execute()
        ->fetchAll();

    $event = 1;
    $list_events = '';

    foreach ($result_event as $key => $value) {
        //-------DATE-----------
        $date_event = strtotime($value->field_event_dates_value);
        $jour = strftime("%d", $date_event);
        $mois = strftime("%b", $date_event);
        $an = strftime("%Y", $date_event);

        $node = node_load($value->entity_id);

        //-------VISUEL-----------
        $uri_default = 'public://default_images/home_bloc_agenda_image_scarabe.png';
        $photo_default = array(
            'path' => $uri_default,
            'title' => $node->title,
            'alt' => $node->title,
            'attributes' => array('class' => 'img_event')
        );
        //-------TYPE-----------
        $type = '';
        foreach ($node->field_event_type['und'] as $key => $value) {
            if ($value['tid']) {
                $type .= taxonomy_term_load($value['tid'])->name;
            }
            $last_key = end(array_keys($node->field_event_type['und']));
            if ($key != $last_key && count($node->field_event_type['und']) > 1) {
                $type .= ', ';
            } else {
                $type .= '.';
            }
        }

        $list_events .= '<div class="event">';

        $list_events .= '<div class="date_event">';
        $list_events .= '<p class="jour">' . $jour . '</p>';
        $list_events .= '<p class="mois">' . $mois . '</p>';
        $list_events .= '<p class="year">' . $an . '</p>';
        $list_events .= '</div>';

        $list_events .= '<div class="text_event">';
        $list_events .= '<h4>' . l($type, drupal_get_path_alias('node/' . $node->nid), array('html' => TRUE, 'attributes' => array('class' => 'link_'))) . '</h4>';
        $list_events .= '<h3>' . l($node->title, drupal_get_path_alias('node/' . $node->nid), array('html' => TRUE, 'attributes' => array('class' => 'link_'))) . '</h3>';
        $list_events .= '<p>' . $node->field_event_sub_title['und'][0]['value'] . '</p>';
        $list_events .= '</div>';

        $list_events .= theme('image', $photo_default);

        $list_events .= '</div>';

        $event++;
    }


    ?>
    <div id="home_agenda">
        <h2><a href="/agenda/index.html"><?php print t('What\'s on ?') ?></a></h2>

        <?php if ($event > 1) : ?>

            <?php if ($event > 2) { ?>
                <a href="#" class="backward"></a>
                <a href="#" class="forward"></a>
            <?php } ?>

            <div class="events">
                <?php print $list_events; ?>
            </div>

        <?php else: ?>
            <div class="events">
                <div class="event">
                    <div class="text_event" style="width: 60%"><h3><?php print variable_get('home_no_event') ?></h3></div>
                    <?php
                    //-------VISUEL-----------
                    $uri_default = 'public://default_images/home_bloc_agenda_image_scarabe.png';
                    $photo_default = array(
                        'path' => $uri_default,
                        'attributes' => array('class' => 'img_event')
                    );
                    print theme('image', $photo_default);

                    ?>
                </div>
            </div>
        <?php endif; ?>

    </div>
</div>


<?php

$nid_collection_lesueur = variable_get('mnhn_collection_lesueur_' . $language->language, '');
$nid_collection_lesueur = mnhn_content_autocomplete_nid($nid_collection_lesueur);
$sql = 'SELECT n.nid FROM node n
INNER JOIN field_data_field_object_collection c on c.entity_id=n.nid and n.status=:status and n.language=:language and c.field_object_collection_nid=:nid_collection
order by n.title asc';
$result = db_query($sql, array(':language' => $language->language, ':status' => 1, ':nid_collection' => $nid_collection_lesueur));


foreach ($result as $row) {


    $node = node_load($row->nid);
    $uri = $node->field_objet_visuel_homepage['und'][0]['uri'];
    if (!empty($uri)) {
        $image = '<img src="' . file_create_url($uri) . '" />';
    } else {
        $image = '<img src="/sites/all/themes/mnhn/img/home/carnets.png" />';
    }
    $list_carnets .= theme('carnet_homepage', array('nid' => $row->nid, 'title' => $node->title, 'image' => $image));


}

?>
<div class="row3">

    <div id="home_carnets">
        <a href="#" class="backward"></a>
        <a href="#" class="forward"></a>
        <div class="carnets">
            <?php print $list_carnets; ?>
        </div>
    </div>
    <?php
    $sql = 'SELECT n.nid FROM node n
INNER JOIN taxonomy_index ti on n.nid=ti.nid and n.status=:status and n.language=:language and n.type=:type and ti.tid=:tid
order by ti.weight asc';
    $result = db_query($sql, array(':language' => $language->language, ':status' => 1, ':type' => 'collection', ':tid' => TID_CLASSEMENT_COLLECTION));

    foreach ($result as $row) {
        $image = '';
        $node = node_load($row->nid);
        $uri = $node->field_collection_visuel_homepage['und'][0]['uri'];
        if (!empty($uri)) {
            $image = '<img src="' . file_create_url($uri) . '" />';
        } else {
            $image = '<img src="/sites/all/themes/mnhn/img/img.jpg" width="182" height="130" />';
        }
        $list_collections .= theme('collection_homepage', array('nid' => $node->nid, 'title' => mnhn_content_clean_teaser($node->title, 20), 'image' => $image));

    }

    ?>
    <div id="home_collections">
        <a href="#" class="backward"></a>
        <a href="#" class="forward"></a>
        <div class="collects">
            <?php print $list_collections; ?>
        </div>
    </div>

    <div id="home_blog">
        <?php print  mnhn_content_bloc_content('bloc_blog') ?>
    </div>
</div>

<?php
//-- PARTENAIRES --
print mnhhn_part_return_part();
?>
<div class="clear"></div>
<div class="link_part_home">
    <a href="/fr/le-museum-soutenir-le-musee/ils-souteniennent-le-museum">En savoir plus sur le Mécénat</a>
</div>
      
                