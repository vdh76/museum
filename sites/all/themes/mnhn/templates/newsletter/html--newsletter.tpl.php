<?php

/**
 * @file
 * Zen theme's implementation to display the basic html structure of a single
 * Drupal page.
 *
 * Variables:
 * - $css: An array of CSS files for the current page.
 * - $language: (object) The language the site is being displayed in.
 *   $language->language contains its textual representation. $language->dir
 *   contains the language direction. It will either be 'ltr' or 'rtl'.
 * - $rdf_namespaces: All the RDF namespace prefixes used in the HTML document.
 * - $grddl_profile: A GRDDL profile allowing agents to extract the RDF data.
 * - $head_title: A modified version of the page title, for use in the TITLE
 *   tag.
 * - $head_title_array: (array) An associative array containing the string parts
 *   that were used to generate the $head_title variable, already prepared to be
 *   output as TITLE tag. The key/value pairs may contain one or more of the
 *   following, depending on conditions:
 *   - title: The title of the current page, if any.
 *   - name: The name of the site.
 *   - slogan: The slogan of the site, if any, and if there is no title.
 * - $head: Markup for the HEAD section (including meta tags, keyword tags, and
 *   so on).
 * - $styles: Style tags necessary to import all CSS files for the page.
 * - $scripts: Script tags necessary to load the JavaScript files and settings
 *   for the page.
 * - $jump_link_target: The HTML ID of the element that the "Jump to Navigation"
 *   link should jump to. Defaults to "main-menu".
 * - $page_top: Initial markup from any modules that have altered the
 *   page. This variable should always be output first, before all other dynamic
 *   content.
 * - $page: The rendered page content.
 * - $page_bottom: Final closing markup from any modules that have altered the
 *   page. This variable should always be output last, after all other dynamic
 *   content.
 * - $classes: String of classes that can be used to style contextually through
 *   CSS. It should be placed within the <body> tag. When selecting through CSS
 *   it's recommended that you use the body tag, e.g., "body.front". It can be
 *   manipulated through the variable $classes_array from preprocess functions.
 *   The default values can contain one or more of the following:
 *   - front: Page is the home page.
 *   - not-front: Page is not the home page.
 *   - logged-in: The current viewer is logged in.
 *   - not-logged-in: The current viewer is not logged in.
 *   - node-type-[node type]: When viewing a single node, the type of that node.
 *     For example, if the node is a Blog entry, this would be "node-type-blog".
 *     Note that the machine name of the content type will often be in a short
 *     form of the human readable label.
 *   The following only apply with the default sidebar_first and sidebar_second
 *   block regions:
 *     - two-sidebars: When both sidebars have content.
 *     - no-sidebars: When no sidebar content exists.
 *     - one-sidebar and sidebar-first or sidebar-second: A combination of the
 *       two classes when only one of the two sidebars have content.
 *
 * @see template_preprocess()
 * @see template_preprocess_html()
 * @see zen_preprocess_html()
 * @see template_process()
 */

$root_url_img = 'http://' . $_SERVER['SERVER_NAME'] . '/' . drupal_get_path('theme','mnhn') . '/img/newsletter';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php print $language->language; ?>" version="XHTML+RDFa 1.0" dir="<?php print $language->dir; ?>"<?php print $rdf_namespaces; ?>>

<head>
<?php print $head; ?>
<title><?php print $head_title; ?></title>

<style>
body{
  background: #F1E8DC;
  margin:0;
  padding:0;
  font-size:14px;
  font-family: Arial;
}

.link_museum{
  text-align: center;
}

img{
  display: block;
  border: 0;
  border: none;
}

table, td{
  margin: 0;
  padding: 0;
}

.content{
  width:626px;
  margin:0 auto;
}

h1{
  margin:0 0 5px 0;
  padding:0;
  font-size:22px;
  color:#FFFFFF
}

h2{
  background: #a0b757; 
  color: #fff;
  font-size: 18px;
  padding: 10px 20px;
  margin: 0 0 15px 0;
}

h2.blog{
  background: #212328;
  color: #9F9F9F;
  width: 140px;
}

h3{
  margin: 5px 0 0 10px;
  color: #4f4f4f;
  font-size: 22px;
  font-family: Arial;
}

p{
  margin:0;
  padding:0;
}

.chapo{
  font-size: 14px;
}

.header_news_2{
  background:url("<?php print $root_url_img; ?>/header_news_2.jpg");
  padding: 0px 10px 0px 45px;
  height:109px;
  width: 571px;
  vertical-align: top;
  color:#FFFFFF;
}

.body_news{
  background: #FFFFFF;
  width:600px;
  margin:15px 0 0 26px;
}

.col_left{
  width: 390px;
  margin: 0 0 0 16px;
  border-top: 1px solid #c1c0be;
  border-left: 1px solid #c1c0be;
  border-right: none;
}

h2.col_left{
  margin: 15px 0 0 0:
}

.inter_col_left{
 margin: 10px 10px 25px 10px;
}

.inter_col_left td{
  width: 410px;
  
}

.inter_col_left td p{
  margin: 0 10px;
}

.inter_col_left td p strong{
  font-size: 24px;
  font-family: Arial;
  color: #4f4f4f;
}

.expo{
  padding: 0 0 15px 0;
}

.visuel_expo{
  text-align: center;
}

.plus a{
  display:block;
  width:70px;
  padding: 5px;
  text-align:center;
  background: #000000;
  color: #FFFFFF;
  text-decoration: none;
  margin: 15px 0 0 10px;
  font-size:12px;
  text-decoration: none;
}

.plus_event a{
  display:block;
  width:70px;
  padding: 5px;
  text-align:center;
  background: #000000;
  color: #FFFFFF;
  text-decoration: none;
  margin: 5px 0 0 0;
  font-size:12px;
  text-decoration: none;
}

.infos{
  width:176px;
}

.infos img{
  display: block;
  width: 160px;
  margin: auto;
}

.inter_col_left td p.date_expo{
  color: #928d02;
  font-family: Arial, Helvetica, sans-serif;
  font-size: 15px;
  font-weight: bold;
  margin: 15px 0 0 10px;
}

.coups_coeur td{
  width:auto;
}

.coups_coeur td.visuel_event{
  width:180px;
}

.coups_coeur td.content_event{
  width: 230px;
}

.coups_coeur td p strong{
  font-size: 18px;
}

.col_right{
  padding: 9px 0 0 0;
  margin: 0;
  border: 1px solid #c1c0be;
  border-bottom: none;
  width: 170px;
}

.col_right h2{
  margin: 0 8px;
  text-align: left;
  padding: 10px;
}

.col_right p{
  font-size: 14px;
  margin: 0 8px;
  text-align: left;
  padding: 10px 10px 5px 10px;
  background: #6B8430;
  color: #FFFFFF;
}

.col_right p strong{
  font-size: 16px;
}

.agenda_colonne{
  margin: 10px;
}

.agenda_colonne strong{
  color: #294854;
  font-size: 18px;
}

.titre_blog{
  background: #212328;
  color: #FFFFFF;
  margin: 0 8px;
  padding: 0 0 5px 10px;
  width: 150px;
}

.titre_blog a{
  color: #FFFFFF;
  text-decoration: none;
}

.footer{
  background: #000000;
  width:600px;
  margin:0 0 0 26px;
  border-top: 1px solid #9F9F9F;
  color: #FFFFFF;
}

.footer a{
  color: #FFFFFF;
  text-decoration: none;
}

.footer .col_right{
  width:160px;
  margin: 0;
  border: none;
}

.footer .col_left{
  width: 390px;
  margin: 0 0 0 16px;
  border: none;
}
  
</style>

</head>
<body class="<?php print $classes; ?>" <?php print $attributes;?>>
<?php print $page; ?>
</body>
</html>
