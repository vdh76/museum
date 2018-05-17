<?php
/**
 * @file
 * Zen theme's implementation to display a single Drupal page while offline.
 *
 * All the available variables are mirrored in html.tpl.php and page.tpl.php.
 * Some may be blank but they are provided for consistency.
 *
 * @see template_preprocess()
 * @see template_preprocess_maintenance_page()
 */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php print $language->language; ?>" lang="<?php print $language->language; ?>" dir="<?php print $language->dir; ?>">

<head>
  <title><?php print $head_title; ?></title>
  <?php print $head; ?>
  <?php print $styles; ?>
  <script type="text/javascript">
      WebFontConfig = {
        google: { families: [ 'Share:400,700' ] }
      };
      (function() {
        var wf = document.createElement('script');
        wf.src = ('https:' == document.location.protocol ? 'https' : 'http') +
            '://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js';
        wf.type = 'text/javascript';
        wf.async = 'true';
        var s = document.getElementsByTagName('script')[0];
        s.parentNode.insertBefore(wf, s);
      })();
    </script>
    <link href='http://fonts.googleapis.com/css?family=Share:400,700' rel='stylesheet' type='text/css'>
</head>
<body class="html not-front one-sidebar page-node page-node- node-type-page  museum article i18n-fr maintenance" >
 
   

<div id="page">
	<div id="header">
		
		
		
			<div id="header-top-menu">
					<div class="content">
						  
    

 

 
 

  <div class="header_menu">
    <ul class="menu"><li class="first expanded"><a href="/fr" title="">Groupes</a></li>
<li class="expanded"><a href="/fr" title="">Enseignants</a></li>
<li class="expanded"><a href="/fr" title="">Espace professionnel</a></li>
<li class="last expanded"><a href="/fr" title="">Tourisme</a></li>
</ul>  </div>

 

                    
                    



					</div>
				</div>
							
			<div id="header-wrapper">
				<div class="content">
					  
    <a class="logo_header" href="/fr"><span>Muséum d\'histoire naturelle du Havre</span></a>
 <ul class="mainmenu"><li id="menu_home" class=" first"><a href="/fr"><span>Accueil</span></a></li>
<li id="menu_museum" class=""><a href="/"  onclick="return false;" rel="menu-542"><strong>Le Muséum</strong></a></li>
<li id="menu_agenda" class=""><a href="/"  onclick="return false;" rel="menu-545"><strong>Agenda</strong></a></li>
<li id="menu_expos" class=""><a href="/"  onclick="return false;" rel="menu-544"><strong>Expositions</strong></a></li>
<li id="menu_collections" class=""><a href="/"  onclick="return false;" rel="menu-1422"><strong>Collections</strong></a></li>
<li id="menu_numeritheque" class=""><a href="/"  onclick="return false;" rel="menu-1252"><strong>Numérithèque</strong></a></li>
<li id="menu_boutique" class=""><a href="/"  onclick="return false;" rel="menu-1259"><strong>La boutique</strong></a></li>
<li id="menu_aventure" class=" last"><a class="titre_menu" title="Aventure Muséum" href="/"><span>&nbsp;</span></a></li>
</ul> 
				</div>
			</div>
				
	</div>
	
				

			

	<div id="page-wrapper">
		<div class="content">
			 
		     
		     
			
		
 			  			  			 
			  <div class="center-column">
				  <h2 class="element-invisible">Vous êtes ici</h2>





			     <div class="clearfix"></div>
			     

<div class="page-header">
<h1>Maintenance</h1></div>
<div class="page-detail-wrapper">
                    

<div class="bloc_page_wrapper"><div class="accordion"><div class="item"  style="display:block"><div class="text"><p><?php print t('Muséum Le Havre is currently under maintenance. We should be back shortly. Thank you for your patience.') ?></p>
<div style="height:400px"></div>
</div></div></div></div></div>



			    
			  </div>
						
			    			 	
 			  			 		 						
								</div>
	</div>

	<div id="footer">
		
<div class="content">
			<div class="footerInner">
	
			<ul class="footer_links"><li class=" first"><a href="/">Agenda</a></li>
<li><a href="/">Expositions</a></li>
<li><a href="/">Collections</a></li>
<li><a href="/">Numérithèque</a></li>
<li><a href="/">Aventure Muséum</a></li>
<li><a href="/">Le blog du Muséum</a></li>
<li class=" last"><a href="/fr">Plan du site</a></li>
</ul><ul class="footer_links"><li class=" first"><a href="/fr">Mentions légales</a></li>
<li><a href="/fr">Crédits</a></li>
<li class=" last"><a href="/fr">Contacts</a></li>
</ul>			
			 <div class="contacts footer_pratik">
                    <h3>Contacts</h3>
                    <p>Accueil : 02 35 41 37 28<br />
Réservation : 02 35 54 75 90<br />
museum@lehavre.fr <br />
</p>
                </div>

                <div class="footer_pratik">
                    <h3>Horaires</h3>
                    <p>Du mardi au samedi <br />
De 9h30 à 12h<br />
De 14h à 18h<br />
Fermé jeudi matin et lundi<br />
</p>
                    <h3>Fermeture</h3>
                    <p>25 décembre, 1er janvier<br />
1er et 8 mai<br />
14 juillet, 11 novembre<br />
</p>
                </div>

                <div class="contacts footer_pratik">
                    <h3>Adresse</h3>
                    <p>Place du Vieux Marché<br />
76600 Le Havre<br />
<br />
</p>
                    <h3>Accès</h3>
                    <p>Parking Place du Vieux Marché<br />
Bus n° 2 et 7 / Arrêt Marceilles<br />
</p>
                </div>
		
			<div class="footer_share_2">
                    
                    <ul>
                        <li class="lehavre"><a href="http://lehavre.fr/" target="_blank"><img src="/sites/all/themes/mnhn/pics/logos/le_havre.gif" alt="Ville du Havre" /></a></li>
                        <li class="flickr"><a href="http://www.flickr.com/MuseumLeHavre" target="_blank"><span>Flickr</span></a></li>
                        <li class="facebook"><a href="http://www.facebook.com/MuseumLeHavre" target="_blank"><span>Facebook</span></a></li>
                        <li class="twitter"><a href="http://www.twitter.com" target="_blank"><span>Twitter</span></a></li>
                    </ul>
			</div>
		
	</div>
</div>



	</div>
	
	
</div>
 <div id="push"></div> <!-- sticky footer -->


   
</body>
</html>
