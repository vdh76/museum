<?php
// Template Commande 
/**
 * @file commande.tpl.php
 *
 *
 * Available variables:
 * - $order_id
 * - $status
 * - $date
 * 
 *
 * @see template_preprocess()
 * @see template_preprocess_block()
 */



global $language;

$order = commerce_order_load($order_id);

$total=number_format(($order->commerce_order_total['und'][0]['amount']/100), 2, ',', '');
$ht=number_format(($order->commerce_order_total['und'][0]['data']['components'][0]['price']['amount']/100), 2, ',', '');
$tva=number_format(($order->commerce_order_total['und'][0]['data']['components'][1]['price']['amount']/100), 2, ',', '');
$frais_port=number_format(($order->commerce_order_total['und'][0]['data']['components'][2]['price']['amount']/100), 2, ',', '');
if($frais_port>0){
	
	$profile_id_shipping=db_query('SELECT commerce_customer_shipping_profile_id
	FROM field_data_commerce_customer_shipping
	where entity_id=:entity_id',array('entity_id' => $order_id))->fetchField();
	$shipping=commerce_customer_profile_load($profile_id_shipping);
	
	//print_r($shipping);
	//exit;
	
	if(!empty($shipping->commerce_customer_address['und'][0]['organisation_name'])){
		$shipping_organization=$shipping->commerce_customer_address['und'][0]['organisation_name'].'<br/>';
	}
	$shipping_first_name=$shipping->commerce_customer_address['und'][0]['first_name'];
	$shipping_last_name=$shipping->commerce_customer_address['und'][0]['last_name'];
	$shipping_adress_1=$shipping->commerce_customer_address['und'][0]['thoroughfare'];
	$shipping_adress_2=$shipping->commerce_customer_address['und'][0]['premise'];
	if(!empty($shipping_adress_2)){
		$shipping_adress_2.='<br/>'.$shipping_adress_2;
	}
	$shipping_cp=$shipping->commerce_customer_address['und'][0]['postal_code'];
	$shipping_city=$shipping->commerce_customer_address['und'][0]['locality'];
	if(!empty($shipping->commerce_customer_address['und'][0]['state'])){
		$shipping_state=$shipping->commerce_customer_address['und'][0]['state'].' ';
	}
	$shipping_country=$shipping_state.$countries[$shipping->commerce_customer_address['und'][0]['country']];
	
}

?>
                   <div class="commande">
                                <h3 class="date-commande"><?php print t('Order n°')?><?php print date('Y',$date).$order_id ?> - <?php print t('Completed the !date',array('!date'=>date('d/m/Y',$date)))?></h3> 
                                <?php if($order->status=='completed'){ 
                                	$facture_id=db_query('SELECT invoice_id FROM commerce_invoice where order_id=:order_id',array('order_id' => $order_id))->fetchField();
                                	print '<a href="/'.$language->language.'/user/'.arg(1).'/invoices/'.$facture_id.'" class="link" target="_blank">'.t('See the invoice').'</a>';  	
                                }?>
                                <?php 
                                
                                $table_header = array(
							    // Column 1
							    'type' => array(
							      'data' => 'Type article',
							      'class' => 'type',
							    ),
							    // Column 2
							    'art' => array(
							      'data' => t('Article'),
							      'class' => 'art',
							    ),
							    // Column 3
							    'prix' => array(
							      'data' => t('Prix'),
							      'class' => 'prix',
							    ),
							     // Column 3
							    'qte' => array(
							      'data' => t('Qté.'),
							      'class' => 'qte',
							    ),
							     // Column 3
							    'total' => array(
							      'data' => t('Total'),
							      'class' => 'total',
							    ),
							  );
                                 $table_rows = array();
                                 
                                 $sql = 'SELECT ct.field_produit_categorie_tid as tid,
                                 st.field_produit_sous_titre_value as sous_titre,
                                 pr.commerce_price_amount as prix,
                                 p.title,
                                 l.quantity as qte 
                                 FROM commerce_line_item l
                                 INNER JOIN commerce_product p on l.line_item_label=p.sku and l.order_id=:order_id
                                 INNER JOIN field_data_commerce_price pr on p.product_id=pr.entity_id
                                 INNER JOIN field_data_field_produit_sous_titre st on l.line_item_id=st.entity_id and st.entity_type=:entity_type
                                 INNER JOIN field_data_field_produit_categorie ct on l.line_item_id=ct.entity_id and ct.entity_type=:entity_type';
                                
								$result=db_query($sql,array(':order_id'=> $order_id,':entity_type'=> 'commerce_line_item'));
								
								foreach($result as $row){
									$categorie=mnhn_content_get_term($row->tid);
									$price=number_format(($row->prix/100), 2, ',', '');;
									//$total+=$row->qte*$price;
									
									$table_rows[] = array(
								      'data' => array(
									        // Column 1
									        'type' => array(
									          'data' => $categorie,
									          'class' => 'type',
									        ),
									        // Column 2
										    'art' => array(
										      'data' => $row->title.' - '.$row->sous_titre,
										      'class' => 'art',
										    ),
										    // Column 3
										    'prix' => array(
										      'data' => $price.'  €',
										      'class' => 'prix',
										    ),
										     // Column 3
										    'qte' => array(
										      'data' => round($row->qte),
										      'class' => 'qte',
										    ),
										     // Column 3
										    'total' => array(
										      'data' => $row->qte*$price.'  €',
										      'class' => 'total',
										    ),
									    ),
									  );
									  
								}
								
                                print theme('table', array(
								    'header' => $table_header,
								    'rows' => $table_rows,
                                	'attributes' => array('class' => array('table_panier', 'panier_recap')),
								  ));?>
                               

                                <div class="actions clearfix">
                                	<h3 class="prix_component"><strong><?php print t('Subtotal')?> :</strong> <?php print $ht?> €</h3>
                                	<h3 class="prix_component"><strong><?php print t('VAT')?> :</strong> <?php print $tva?> €</h3>
                                	<?php if($frais_port>0){?>
                                		<h3 class="prix_component"><strong><?php print t('Shipping costs')?> :</strong> <?php print $frais_port?> €</h3>
                                	<?php } ?>
                                    <h3 class="prix_total"><?php print t('Order total')?> : <?php print $total?> €</h3>
                                </div>
                                <?php if($frais_port>0){?>
                                <p class="livraison"><strong><?php print t('Shipping information')?> :</strong><br />
                                <?php print $shipping_organization.$shipping_first_name.' '.$shipping_last_name.'<br />'.$shipping_adress_1.$shipping_adress_2.'<br />'.$shipping_cp.' '.$shipping_city.'<br />'.$shipping_country ?>
                                </p>
                                <?php } ?>
                            </div>
                            <div class="clearfix"></div>