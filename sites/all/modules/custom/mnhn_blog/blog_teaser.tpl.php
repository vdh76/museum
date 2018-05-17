<?php
// Template Blog teaser
/**
 * @file blog_teaser.tpl.php
 *
 *
 * Available variables:
 * - $nid
 * - $title
 * - $date
 * - $visuel
 * - $text 
 *
 */

?>
<div class="blog_teaser">
<h2><?php print $title?></h2>
<div class="date"><?php print $date?></div>
<?php print $image?>
<div class="accroche"><?php print $text?></div>
<div class="link"><a href="/<?php print drupal_get_path_alias('node/'.$nid)?>" title="Consulter l'article">Consulter l'article</a></div>
<div class="footer_blog">0 commentaires</div>
</div>