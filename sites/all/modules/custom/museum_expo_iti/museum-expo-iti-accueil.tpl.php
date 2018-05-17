<div class="page-header">
  <h3>Expositions itinérantes</h3>
</div>

<div class="page-detail-wrapper">

  <div class="sommaire"> 
  <?php foreach ($nodes as $node) : ?>
    
    <?php
    $visuel = array(
              'style_name' => 'menu', 
              'path' => $node->field_exposition_visuel['und'][0]['uri'],
              'alt' => $node->field_exposition_visuel['und'][0]['alt'],
              'attributes' => array('class'=> 'vignet','style' => 'border: 1px solid #d7d6ae;padding:4px;')
              );
    
    $url_file = file_create_url($node->field_exposition_file['und'][0]['uri']);
    
    ?>
   
    <div class="item">
      <?php print theme('image_style', $visuel); ?>
    
      <div class="text">
        <h4 style="color: #a0b757;"><?php print $node->title; ?></h4>
        <?php print $node->field_exposition_descrip['und'][0]['value']; ?>
        <?php print l('En savoir plus', $url_file, array('html' => TRUE, 'attributes' => array('class' => 'link', 'target' => '_blank'))); ?>
      </div>
      
    </div>
  
  <?php endforeach; ?>
  </div>
  
</div>