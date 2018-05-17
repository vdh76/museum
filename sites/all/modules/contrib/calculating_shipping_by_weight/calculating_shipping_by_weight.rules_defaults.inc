<?php
/**
 * @file
 * calculating_shipping_by_weight.rules_defaults.inc
 */

/**
 * Implements hook_default_rules_configuration().
 */
function calculating_shipping_by_weight_default_rules_configuration() {
  $items = array();
  $items['rules_calculate_by_weight'] = entity_import('rules_config', '{ "rules_calculate_by_weight" : {
      "LABEL" : "Calculate by weight",
      "PLUGIN" : "reaction rule",
      "REQUIRES" : [ "rules", "commerce_line_item", "commerce_shipping" ],
      "ON" : [ "commerce_shipping_calculate_rate" ],
      "DO" : [
        { "LOOP" : {
            "USING" : { "list" : [ "commerce-line-item:order:commerce-line-items" ] },
            "ITEM" : { "line_item" : "Line Item" },
            "DO" : [
              { "component_rules_calculate_shipping_amount_by_weight_of_line_item" : {
                  "USING" : { "line_item" : [ "line_item" ] },
                  "PROVIDE" : { "shipping_for_line_item" : { "shipping_for_line_item" : "Shipping cost for line item" } }
                }
              },
              { "commerce_line_item_unit_price_add" : {
                  "commerce_line_item" : [ "commerce-line-item" ],
                  "amount" : [ "shipping-for-line-item" ],
                  "component_name" : "shipping",
                  "round_mode" : "1"
                }
              }
            ]
          }
        }
      ]
    }
  }');
  $items['rules_calculate_shipping_amount_by_weight_of_line_item'] = entity_import('rules_config', '{ "rules_calculate_shipping_amount_by_weight_of_line_item" : {
      "LABEL" : "Calculate shipping amount by weight of line item",
      "PLUGIN" : "rule",
      "REQUIRES" : [ "rules" ],
      "USES VARIABLES" : {
        "line_item" : { "label" : "Line Item", "type" : "commerce_line_item" },
        "shipping_for_line_item" : {
          "label" : "Shipping cost for line item",
          "type" : "decimal",
          "parameter" : false
        }
      },
      "IF" : [
        { "entity_has_field" : { "entity" : [ "line-item" ], "field" : "commerce_product" } },
        { "entity_has_field" : { "entity" : [ "line-item:commerce-product" ], "field" : "field_weight" } }
      ],
      "DO" : [
        { "data_calc" : {
            "USING" : {
              "input_1" : [ "line-item:commerce-product:field-weight:weight" ],
              "op" : "*",
              "input_2" : [ "line-item:quantity" ]
            },
            "PROVIDE" : { "result" : { "pounds_for_line_item" : "Pounds for line item" } }
          }
        },
        { "data_calc" : {
            "USING" : { "input_1" : [ "pounds-for-line-item" ], "op" : "*", "input_2" : "1000" },
            "PROVIDE" : { "result" : { "line_item_calculated_shipping_cost" : "Line Item Calculated Shipping Cost" } }
          }
        },
        { "data_set" : {
            "data" : [ "shipping-for-line-item" ],
            "value" : [ "line-item-calculated-shipping-cost" ]
          }
        }
      ],
      "PROVIDES VARIABLES" : [ "shipping_for_line_item" ]
    }
  }');
  return $items;
}
