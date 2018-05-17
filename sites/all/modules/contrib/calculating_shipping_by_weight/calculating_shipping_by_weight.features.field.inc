<?php
/**
 * @file
 * calculating_shipping_by_weight.features.field.inc
 */

/**
 * Implements hook_field_default_fields().
 */
function calculating_shipping_by_weight_field_default_fields() {
  $fields = array();

  // Exported field: 'commerce_product-product-field_weight'
  $fields['commerce_product-product-field_weight'] = array(
    'field_config' => array(
      'active' => '1',
      'cardinality' => '1',
      'deleted' => '0',
      'entity_types' => array(),
      'field_name' => 'field_weight',
      'foreign keys' => array(),
      'indexes' => array(
        'weight' => array(
          0 => 'weight',
        ),
      ),
      'module' => 'physical',
      'settings' => array(),
      'translatable' => '0',
      'type' => 'physical_weight',
    ),
    'field_instance' => array(
      'bundle' => 'product',
      'default_value' => NULL,
      'deleted' => '0',
      'description' => '',
      'display' => array(
        'default' => array(
          'label' => 'above',
          'module' => 'physical',
          'settings' => array(),
          'type' => 'physical_weight_formatted',
          'weight' => 1,
        ),
        'line_item' => array(
          'label' => 'above',
          'settings' => array(),
          'type' => 'hidden',
          'weight' => 0,
        ),
        'node_teaser' => array(
          'label' => 'above',
          'settings' => array(),
          'type' => 'hidden',
          'weight' => 0,
        ),
      ),
      'entity_type' => 'commerce_product',
      'field_name' => 'field_weight',
      'label' => 'Weight',
      'required' => 0,
      'settings' => array(
        'user_register_form' => FALSE,
      ),
      'widget' => array(
        'active' => 1,
        'module' => 'physical',
        'settings' => array(
          'default_unit' => 'lb',
          'unit_select_list' => 1,
        ),
        'type' => 'physical_weight_textfield',
        'weight' => '36',
      ),
    ),
  );

  // Translatables
  // Included for use with string extractors like potx.
  t('Weight');

  return $fields;
}
