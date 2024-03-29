<?php

function mnhn_content_field_attach_presave($entity_type, $entity) {
  // Clear the item_id on the field collection entity before saving in order to force creation of a new field
  // collection rather than overwriting the original
  if (empty($entity->is_new)) {
    if ($entity_type == 'field_collection_item') {
      if (isset($entity->item_id)) {
        $entity->item_id = '';
        $entity->save(TRUE);
      }
    }
  }
}