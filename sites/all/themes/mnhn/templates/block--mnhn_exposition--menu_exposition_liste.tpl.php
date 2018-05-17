<?php 
global $language;
//$class_a_venir='activ';
//$class_en_cours='activ';
//$class_passees='activ';
switch(arg(1)){
	case 'en-cours':
		$class_a_venir='';
		$class_passees='';
		break;
		
	case 'a-venir':
		$class_en_cours='';
		$class_passees='';
		break;

	case 'passees':
		$class_a_venir='';
		$class_en_cours='';
		break;	
}

drupal_add_js(
'jQuery(document).ready(function() {
	jQuery("ul.menu-vertical > li").click(function(){
			jQuery("ul.menu-vertical > li").removeClass("activ");
			jQuery(this).addClass("activ");
			jQuery("#wrapper-exposition").html("").height("400px").addClass("loading");
			
			var type_expo=jQuery(this).find("a").attr("rel")
			jQuery.ajax({
				  url: "/'.$language->language.'/ajax/expositions/"+type_expo,
				  type: "GET",
				  success: function(data){
					jQuery("#wrapper-exposition").height("auto").removeClass("loading").html(data);
				  }
				});
		
		});
});
',
'inline'
)
?>

<h2><?php print t("The exhibitions") ?></h2>
<ul class="menu-vertical">
	<?php $exposition_a_venir=mnhn_exposition_menu_xl('a-venir');
	if($exposition_a_venir){ ?>
	<li class="<?php print $class_a_venir ?>"><a rel="a-venir" href="javascript:;" title="<?php print t("Coming exhibitions");?>"><?php print t("Coming");?></a></li>
	<?php } ?>
	<?php $exposition_en_cours=mnhn_exposition_menu_xl('en-cours');
	if($exposition_en_cours){ ?>
	<li class="<?php print $class_en_cours ?>"><a rel="en-cours" href="javascript:;" title="<?php print t("Current exhibitions");?>"><?php print t("Current");?></a></li>
	<?php } ?>
	 <?php $exposition_passees=mnhn_exposition_menu_xl('passees');
		if($exposition_passees){ ?>
	<li class="<?php print $class_passees ?>"><a rel="passees" href="javascript:;" title="<?php print t("Past exhibitions");?>"><?php print t("Past");?></a></li>
	<?php } ?>
</ul>