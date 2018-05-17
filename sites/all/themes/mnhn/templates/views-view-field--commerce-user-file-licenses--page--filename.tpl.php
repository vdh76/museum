<?php
 /**
  * This template is used to print a single field in a view. It is not
  * actually used in default Views, as this is registered as a theme
  * function which has better performance. For single overrides, the
  * template is perfectly okay.
  *
  * Variables available:
  * - $view: The view object
  * - $field: The field handler object that can process the input
  * - $row: The raw SQL result that can be used
  * - $output: The processed output that will normally be used.
  *
  * When fetching output from the $row, this construct should be used:
  * $data = $row->{$field->field_alias}
  *
  * The above will guarantee that you'll always get the correct data,
  * regardless of any changes in the aliasing that might happen if
  * the view is modified.
  */

$line_item_id=db_query('select commerce_file_license_line_items_line_item_id from field_data_commerce_file_license_line_items where entity_id=:entity_id',array('entity_id' => $row->license_id))->fetchField();

$sku=db_query('select line_item_label from commerce_line_item where line_item_id=:line_item_id',array('line_item_id' => $line_item_id))->fetchField();

$product_id=db_query('select product_id from commerce_product where sku=:sku',array(':sku' => $sku))->fetchField();
$produit_id=db_query('select entity_id from field_data_field_product_produit where field_product_produit_product_id=:product_id',array(':product_id' => $product_id))->fetchField();
$produit_title=db_query('select title from node where nid=:nid',array(':nid' => $produit_id))->fetchField();
$produit_subtitle=db_query('select field_produit_sous_titre_value from field_data_field_produit_sous_titre  where entity_id=:nid',array(':nid' => $produit_id))->fetchField();

?>
<?php print $output; ?>
<?php print $produit_title.' - '.$produit_subtitle; ?><br/><br/>