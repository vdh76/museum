<?php
$root_url_img = 'http://' . $_SERVER['SERVER_NAME'] . '/' . drupal_get_path('theme','mnhn') . '/img/newsletter';
$flickr=variable_get('mnhn_bloc_en_ligne_flickr', '');
$facebook=variable_get('mnhn_bloc_en_ligne_facebook', '');
$twitter=variable_get('mnhn_bloc_en_ligne_twitter', '');
?>
<table cellpadding="0" cellspacing="0" border="0">
  <tr>
    <td><img src="<?php print $root_url_img; ?>/header_news_1.jpg"></td>
  </tr>
  <tr>
    <td class="header_news_2">
      <h1><?php print $node->title; ?></h1>
      <div class="chapo"><?php print $node->field_chapo['und'][0]['value']; ?></div>
    </td>
  </tr>
</table>

<table cellpadding="0" cellspacing="0" border="0" class="body_news">
  <tr>
    <td class="col_left" valign="top"><!-- LEFT -->
      
      <table class="inter_col_left" cellpadding="0" cellspacing="0" border="0">
        <?php if(isset($node->field_expositions['und'][0])): ?>
          <!-- EXPOSITIONS -->
          <tr>
            <td>
              <?php
                if(isset($node->field_expositions['und'][1])){ print '<h2>Expositions</h2>'; }
                else{ print '<h2>Exposition</h2>'; }
              ?>
            </td>
          </tr>
          <?php foreach ($node->field_expositions['und'] as $key => $value) : ?>
            <?php
            $expo = $value['node'];
            $url = image_style_url('expo_newsletter', $expo->field_exposition_visuel['und'][0]['uri']);
            $date_debut=$expo->field_exposition_date['und'][0]['value'];
            $date_fin=$expo->field_exposition_date['und'][0]['value2'];
            $date_expo=mnhn_content_format_date_medium($date_debut,$date_fin);
            ?>
          <tr>
            <td>
                <div class="visuel_expo">
                  <img src="<?php print $url; ?>">
                </div>
                <h3><?php print $expo->title; ?></h3>
                <p><strong><?php print $expo->field_exposition_sous_titre['und'][0]['value']; ?></strong></p>
                <p><?php print $expo->field_exposition_chapo['und'][0]['value']; ?></p>
                <p class="date_expo"><?php print $date_expo; ?></p>
              
            </td>
          </tr>
          <tr>
            <td align="right">
              <div class="expo">
              <div class="plus"><?php print '<a href="http://'.$_SERVER['SERVER_NAME'].'/fr/'.drupal_get_path_alias('node/'.$expo->nid).'" title="'.$expo->title.'">En savoir +</a>'; ?></div>
              </div><hr/>
              <div style="margin: 0 0 15px 0"></div>
            </td>
          </tr>
          <?php endforeach; ?>
        <?php endif; ?>
        <!-- COUPS DE COEUR -->
        <tr>
          <td>
            <h2 style="margin: 0 0 15px 0">Nos coups de coeur du mois</h2>
          </td>
        </tr>
        <?php foreach ($node->field_event_coeur['und'] as $key => $value) : ?>
          <?php
          $coups_coeur = $value['node'];
          $url = image_style_url('resultat_agenda_180x120', $coups_coeur->field_event_visuel['und'][0]['uri']);
          ?>
        <tr>
          <td>
            <table class="coups_coeur" cellpadding="0" cellspacing="0" border="0">
              <tr>
                <td class="visuel_event" valign="top">
                  <img src="<?php print $url; ?>">
                </td>
                <td class="content_event" valign="top">
                  <p><strong><?php print $coups_coeur->title; ?></strong><br/>
                    <?php print $coups_coeur->field_event_sub_title['und'][0]['value']; ?><br/>
                    <?php print return_time_stamp($coups_coeur->field_event_dates['und']); ?><br/>
                    <?php print taxonomy_term_load($coups_coeur->field_event_horaires['und'][0]['tid'])->name; ?><br/>
                    <?php print taxonomy_term_load($coups_coeur->field_event_public['und'][0]['tid'])->name; ?><br/>
                    
                  </p>
                </td>
              </tr>
              <tr>
                <td></td>
                <td align="right"><div class="plus_event"><?php print '<a href="http://'.$_SERVER['SERVER_NAME'].'/fr/'.drupal_get_path_alias('node/'.$coups_coeur->nid).'" title="'.$coups_coeur->title.'">En savoir +</a>'; ?></div></td>
              </tr>
            </table>
            <hr/>
          </td>
        </tr>
        <?php endforeach; ?>
        
        <!-- BLOC LIBRE -->
        <?php if($node->field_titre_bloc_libre['und'][0]['value'] != ''){ ?>
        <tr>
          <td>
            <h2 style="margin: 15px 0 15px 0"><?php print $node->field_titre_bloc_libre['und'][0]['value']; ?></h2>
          </td>
        </tr>
         <?php $url = image_style_url('resultat_agenda_180x120', $node->field_visuel_bloc_libre['und'][0]['uri']); ?>
        <tr>
          <td>
            <table class="coups_coeur" cellpadding="0" cellspacing="0" border="0">
              <tr>
                <td class="visuel_event" valign="top">
                  <img src="<?php print $url; ?>">
                </td>
                <td class="content_event" valign="top">
                  <p><strong><?php print $node->field_sous_titre_bloc_libre['und'][0]['value']; ?></strong><br/>
                    <?php print $node->field_body_bloc_libre['und'][0]['value']; ?>  
                  </p>
                </td>
              </tr>
            </table>
            <hr/>
          </td>
        </tr>
        <?php } ?>
      </table>
      
    </td>
    
    <td class="col_right" valign="top"><!-- RIGHT -->

      <div><!-- AGENDA -->
        <h2>Agenda</h2>
        <div class="agenda_colonne">
          <?php foreach ($node->field_agenda_colonne['und'] as $key => $value) : ?>
            <?php 
              $agenda_colonne = $value['node'];
            ?>
            <strong><?php print $agenda_colonne->title; ?></strong><br/>
            <?php print $agenda_colonne->field_event_sub_title['und'][0]['value']; ?><br/>
            <div class="plus_event"><?php print '<a href="http://'.$_SERVER['SERVER_NAME'].'/fr/'.drupal_get_path_alias('node/'.$agenda_colonne->nid).'" title="'.$agenda_colonne->title.'">En savoir +</a>'; ?></div>
            <hr/>
          <?php endforeach; ?>
        </div>
      </div>
      
      <hr/>
      
      <div class="infos"><!-- INFOS PRATIQUE -->
        <img src="<?php print $root_url_img; ?>/carte.jpg">
        <?php
          $block = variable_get('mnhn_bloc_info_pratique_fr', array());
          print $block['value'];
        ?>
      </div>
      
      <hr/>
      
      <div><!-- BLOG -->
        <?php 
          $last_blog = last_blog(); 
          $url_last_blog = image_style_url('bloc_newsletter', $last_blog->field_blog_visuel['und'][0]['uri']);
          
        ?>
        <h2 class="blog">Le Blog</h2>
        <div class="titre_blog">
          <a href="<?php print 'http://'.$_SERVER['SERVER_NAME'].'/fr/'.drupal_get_path_alias('node/'.$last_blog->nid); ?>">
          <?php print $last_blog->title; ?>
          </a>
        </div>
        <div class="infos" style="margin: 0 0 10px 0">
          <a href="<?php print 'http://'.$_SERVER['SERVER_NAME'].'/fr/'.drupal_get_path_alias('node/'.$last_blog->nid); ?>">
            <img src="<?php print $url_last_blog; ?>" >
          </a>
        </div>
      </div>
    </td>
  </tr>
</table>

<!-- FOOTER -->
<!-- LINKS -->
<table class="footer" cellpadding="0" cellspacing="0" border="0">
  <tr>
    <td class="col_left" valign="top">
      <div style="margin:10px">
        <a href="http://www.museum-lehavre.fr/">Le site web du muséum</a><br/>
        <a href="http://www.museum-lehavre.fr/fr/blog">Le blog du muséum</a>
      </div>
    </td>
    <!-- RS -->
    <td class="col_right" align="right" valign="top">
      <div style="margin:10px">
        <table>
          <tr>
            <td><a href="<?php print $facebook; ?>"><img src="<?php print $root_url_img; ?>/facebook.png" title="Facebook"></a></td>
            <td><a href="<?php print $twitter; ?>"><img src="<?php print $root_url_img; ?>/twitter.png" title="Twitter"></a></td>
            <td><a href="<?php print $flickr; ?>"><img src="<?php print $root_url_img; ?>/flickr.png" title="Flickr"></a></td>
          </tr>
        </table>
      </div>
      <!-- LOGO VDH -->
      <div style="margin:10px 10px 0 0"><a href="http://lehavre.fr"><img src="<?php print $root_url_img; ?>/le_havre.gif" title="Le Havre.fr"></a></div>
    </td>
  </tr>
</table>
<br/>



<?php
function return_time_stamp($dates){
  $now = time();
  foreach ($dates as $key => $date) {
    $date_event = strtotime($date['value']);
    if($date_event > $now){
      return 'Le ' . strftime("%d %B %Y", $date_event);
      break;
    };
  }
}

function last_blog(){
  //-- EXPO EN LIGNE
  $last_blog_query = db_select('node', 'n')
      ->condition('type', 'blog')
      ->fields('n')
      ->orderBy('n.nid', 'DESC')
      ->execute()
      ->fetchField();
  
   $last_blog = node_load($last_blog_query);   
  
  return $last_blog;
}
?>


