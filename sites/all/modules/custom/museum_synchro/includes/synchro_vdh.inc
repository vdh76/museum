<?php

function visuel_uri_original($uri) {
  $ext = substr(strtolower(strrchr(basename($uri), ".")), 1);
  $uri_original = substr($uri, 0, strlen($uri) - 4) . '_0.' . $ext;
  $url_original = file_create_url($uri_original);
  $url_original_test = str_replace('http://' . $_SERVER['SERVER_NAME'] . '/', '', $url_original);
  if (file_exists($url_original_test)) {
    return $uri_original;
  }
  else {
    return $uri;
  }
}

function genere_flux_vdh() {
  $oneyearago = strtotime("now -1 year");

  $nids = db_select('node', 'n')
    ->fields('n', array('nid'))
    ->condition('n.type', 'new_event')
    ->condition('n.language', 'fr')
    ->condition('n.changed', $oneyearago, '>')
    ->condition('n.status', 1)
    ->orderBy('n.nid', 'DESC')
    ->execute()
    ->fetchCol();

  $nodes = node_load_multiple($nids);

  $items = '';
  foreach ($nodes as $node) {

    $node->link = url("node/$node->nid", array('absolute' => TRUE));

    // Dates
    $date_item = array();

    foreach ($node->field_event_dates['und'] as $key => $value) {
      $date_item[$key]['date_debut'] = strtotime($value['value']);
      $date_item[$key]['heure_debut'] = taxonomy_term_load($node->field_event_horaires['und'][0]['tid'])->name;
      $date_item[$key]['date_fin'] = strtotime($value['value2']);
      $date_item[$key]['lieu'] = 'Museum';
      $date_item[$key]['quartier'] = 'Le Havre Centre Ouest';
    }

    $date = array();
    foreach ($date_item as $key => $value) {
      $date[$key]['key'] = 'date';
      $date[$key]['value'] = $value;
    }

    // Categories
    $categorie = array();
    foreach ($node->field_event_type['und'] as $key => $value) {
      $categorie[$key]['key'] = 'categorie';
      $categorie[$key]['value'] = taxonomy_term_load($value['tid'])->name;
    }

    //reservation
    if ($node->field_event_reservation['und'][0]['value']) {
      $reservation = 'Places limitées ! Réservation obligatoire à l\'accueil du Muséum ou par téléphone au 02 35 41 37 28.';
    }
    else {
      if ($node->field_event_no_reservation['und'][0]['value']) {
        $reservation = 'Sans réservation, dans la limite des places disponibles.';
      }
      else {
        if ($node->field_event_reservation_conseil['und'][0]['value']) {
          $reservation = 'Dans la limite des places disponibles, réservation conseillée au 02 35 41 37 28.';
        }
        else {
          $reservation = '-';
        }
      }
    }

    $node->rss_elements = array(
      array(
        'key' => 'id',
        'value' => $node->nid,
      ),
      array(
        'key' => 'created',
        'value' => $node->created,
      ),
      array(
        'key' => 'changed',
        'value' => $node->changed,
      ),
      array(
        'key' => 'titre',
        'value' => $node->title,
      ),
      array(
        'key' => 'sous_titre',
        'value' => $node->field_event_sub_title[und][0][value],
      ),
      array(
        'key' => 'lien',
        'value' => $node->link,
      ),
      array(
        'key' => 'categories',
        'value' => $categorie,
      ),
      array(
        'key' => 'dates',
        'value' => $date,
      ),
      array(
        'key' => 'duree',
        'value' => taxonomy_term_load($node->field_event_duree['und'][0]['tid'])->name,
      ),
      array(
        'key' => 'tarif',
        'value' => $node->field_event_tarif['und'][0]['value'],
      ),
      array(
        'key' => 'cible',
        'value' => taxonomy_term_load($node->field_event_public['und'][0]['tid'])->name,
      ),
      array(
        'key' => 'animateur',
        'value' => taxonomy_term_load($node->field_event_animateur['und'][0]['tid'])->name,
      ),
      array(
        'key' => 'reservation',
        'value' => $reservation,
      ),
      array(
        'key' => 'gratuit',
        'value' => $node->field_event_gratuit['und'][0]['value'],
      ),
      array(
        'key' => 'detail',
        'value' => $node->body['und'][0]['value'],
      ),
      array(
        'key' => 'visuel',
        'value' => $url_ori = file_create_url(visuel_uri_original($node->field_event_visuel['und'][0]['uri'])),
        //file_create_url($node->field_event_visuel['und'][0]['uri']),
      ),
      array(
        'key' => 'visuel_legend',
        'value' => $node->field_event_legende_visuel['und'][0]['value'],
      ),
    );

    $items .= '<evenement>' . format_xml_elements($node->rss_elements) . '</evenement>';
  }

  drupal_add_http_header('Content-Type', 'text/xml; utf-8');

  return '<?xml version="1.0" encoding="UTF-8"?><evenements>' . $items . '</evenements>';
}
