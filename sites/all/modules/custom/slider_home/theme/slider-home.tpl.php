<?php
drupal_add_js(drupal_get_path('module', 'slider_home') . '/js/slider_home.js');
$nb_item = count($items);
?>

<?php  $j = 0; foreach ($items as $item): ?>
    <div class="diapos">
        <div class="diapo current">
            <img src="<?php print $item['visuel']; ?>">
            <div class="bkg_expo_home"></div>
            <div class="text">
                <h3><a href="<?php print $item['link']; ?>"><?php print $item['cat'] ?></a></h3>
                <h2><a href="<?php print $item['link']; ?>"><?php print $item['title']; ?></a></h2>

                <?php if($item['date_d']): ?>
                <p class="date">
                    <?php
                    print $item['date_d'];
                    if($item['date_d'] != $item['date_f']){
                        print ' - ' . $item['date_f'];
                    }
                    ?>
                </p>
                <?php endif; ?>

                <p class="resume">
                    <?php print $item['desc']; ?>
                </p>

                <a class="link_gallery" href="<?php print $item['link']; ?>">En savoir plus</a>

                <!-- NAV SLIDER -->
                <div class="nav">
                    <?php for($i = 0; $i<= ($nb_item-1); $i++): ?>
                        <a href="#" class="nav_slider <?php if ($i == $j) {print 'active'; } ?> " data-index="<?php print $i; ?>">&nbsp;&nbsp;&nbsp;</a>
                    <?php endfor; ?>
                </div>

            </div>
        </div>

    </div>

<?php $j++; endforeach; ?>