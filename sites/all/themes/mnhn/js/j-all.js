// jQuery
jQuery(document).ready(function() {
	(function(set) {
		if(!set) return;
		set.each(function(index , item) {
			movingBoxInit.init.call(item);
		});
	})(jQuery('.moving'));

	(function(set) {
		if(!set) return;
		set.each(function(index , item) {
			spacesInit.init.call(item);
		});
	})(jQuery('#spaces'));
});



/* ------------------------------------------------------------------------------------------------- INIT OBJ CONTENT */
var spacesInit = {
	// init
	init: function() {
		this.originalState = {
			height: this.offsetHeight
		}

		this.open = spacesInit.open;
		this.close = spacesInit.close;
	} ,

	// methods
	open: function(/* DOMElement */ element) {
		var jthis = jQuery(this);
		try { jthis.find('.expanded').get(0).collapse(); }
		catch(er) {}
		var margins = [];
		var options = {highest: 0};
		jthis.find('.moving').each(
			(function(element , margins , options) {
				return function(index , item) {
					var jitem = jQuery(item);
					var coordinates = element.grid[index].split('-');
					var x = parseInt(coordinates[0],16) * 96;
					var y = parseInt(coordinates[1],16) * 102;
					
					// animer avec css transitions
					/*jitem.css({
						left: x ,
						top: y
					});*/

					// animer avec javascript
					/* ## penser à désactiver les transition-duration dans le fichier CSS
					   ## sur #spaces et .moving */
					jitem.animate(
						{left: x , top: y} ,
						{duration:500 , queue:false}
					);

					if(y + item.offsetHeight > options.highest)
						options.highest = y + item.offsetHeight;
					if(item == element)
					{
						margins[0] = x;
						margins[1] = y;
					}
				};
			})(element , margins , options)
		);
		
		// animer avec css transitions
		//jQuery(this).css('minHeight' , options.highest).get(0).className = 'focus-on-' + element.id;
		
		// animer avec javascript
		/* ## penser à désactiver les transition-duration dans le fichier CSS
		   ## sur #spaces et .moving */
		jQuery(this).animate({minHeight: options.highest} , {duration:500 , queue:false}).get(0).className = 'focus-on-' + element.id;
		
		/* ## passer le block ouvert en position static pour que #spaces adapte automatiquement sa hauteur
		   ## si le le block ouvert est plus haut que la colonne des blocks fermés */
		setTimeout(
			(function(element , margins) {
				return function() {
					element.static(margins[0] , margins[1]);
				}
			})(element , margins) ,
			510
		);
	} ,

	close: function(element) {
		/* ## repasser le block ouvert en position absolue */
		element.absolute();
		jQuery(this).find('.moving').each(function(index , item) {

			// animer avec css transitions
			/*jQuery(item).css({
				left: item.originalState.left ,
				top: item.originalState.top ,
			});*/

			// animer avec javascript
			/* ## penser à désactiver les transition-duration dans le fichier CSS
			   ## sur #spaces et .moving */
			jQuery(item).animate(
				{left: item.originalState.left , top: item.originalState.top} ,
				{duration:500 , queue:false}
			);
		});

		// animer avec css transitions
		//jQuery(this).css('minHeight' , '').get(0).className = null;

		// animer avec javascript
		/* ## penser à désactiver les transition-duration dans le fichier CSS
		   ## sur #spaces et .moving */
		jQuery(this).animate({minHeight: this.originalState.height} , {duration:500 , queue:false}).get(0).className = null;
	}

	// event handlers
}



/* ------------------------------------------------------------------------------------------------- INIT OBJ MOVING BOX */
var movingBoxInit = {
	// init
	init: function() {
		jthis = jQuery(this);
		this.originalState = {
			width: this.offsetWidth ,
			height: this.offsetHeight ,
			left: this.offsetLeft ,
			top: this.offsetTop
		};
		
		/* ## quand un block moving s'ouvre, il lit sa position et celles des blocks fermés
		   ## dans son paramètre data-grid.
		   ## Dans cette page, l'espace est divisé en carrés de 96px de côté (width:88px + margin:4px) */
		this.grid = this.getAttribute('data-grid').split('_');

		this.contentBox = jthis.find('> div').get(0);

		this.expand = movingBoxInit.expand;
		this.collapse = movingBoxInit.collapse;
		this.toggle = movingBoxInit.toggle;
		this.static = movingBoxInit.static;
		this.absolute = movingBoxInit.absolute;
		
		jthis.find(".moins,.plus").click(movingBoxInit.handleClick);
		//jthis.click(movingBoxInit.handleClick);
		

	} ,

	// methods
	expand: function() {
		/* ## en partant du principe que le contenu du block a été chargé avant
		   ## pour pouvoir en récup. la hauteur. Pour l'exemple les hauteurs
		   ## des contenus ont été fixées arbitrairement dans le fichier CSS */
	
		document.getElementById('spaces').open(this);

		// animer avec css transitions
		//jQuery(this).addClass('expanded');

		// animer avec javascript
		/* ## penser à désactiver les transition-duration dans le fichier CSS
		   ## sur #spaces et .moving */
		jQuery(this).addClass('expanded').animate({width: 95*6 , height: this.contentBox.offsetHeight} , {duration:500 , queue:false});
		jQuery(this).find('.plus').removeClass('plus').addClass('moins'); // ajout David
		jQuery(this).find('.plie_aventure').fadeOut(400, function() {
    		jQuery(this).parent('.box').find('.deplie').fadeIn(400); // ajout David
		});
		jQuery(this).find('.coin').hide(200);
		var height=jQuery(this).find(".deplie").height();
		jQuery("#spaces").css("height",height);
		if(jQuery(this).attr("id")=="pars"){
			 jQuery(".wrap_quizz_ajax").html("");
			 jQuery(".aventure_step").hide();
			 jQuery("#aventure_step_0").show();	 			
		}
		
		return this;
	} ,

	collapse: function() {
		document.getElementById('spaces').close(this);

		// animer avec css transitions
		//jQuery(this).removeClass('expanded');

		// animer avec javascript
		/* ## penser à désactiver les transition-duration dans le fichier CSS
		   ## sur #spaces et .moving */
		jQuery(this).animate({width: this.originalState.width , height: this.originalState.height} , 500, false, function() {
		    jQuery(this).removeClass('expanded');
		});
        jQuery(this).find('.moins').removeClass('moins').addClass('plus'); // ajout David
        jQuery(this).find('.deplie').fadeOut(400, function() {
        	jQuery(this).parent().find('.plie_aventure').fadeIn(400); // ajout David
        });
		jQuery(this).parent().find('.coin').show(200);
		jQuery("#spaces").css("height","auto");
		return this;
	} ,

	toggle: function() {
		if(jQuery(this).hasClass('expanded'))
			return this.collapse();
		return this.expand();
	} ,

	static: function(left , top) {
		var jthis = jQuery(this);
		jthis.addClass('static');
		jthis.css({
			marginLeft: left ,
			marginTop: top
		});
	} ,

	absolute: function() {
		var jthis = jQuery(this);
		jthis.removeClass('static');
		jthis.css({
			marginLeft: '' ,
			marginTop: ''
		});
	} ,

	// event handlers
	handleClick: function(/* MouseEvent */ ev) {
		
		var parent=document.getElementById(jQuery(this).parent().attr("id"));
		if(jQuery(this).parent().hasClass('expanded'))
			return parent.collapse();
		return parent.expand();
	
	}
}


/* ------------------------------------------------------------------------------------------------- SUPPORT FUNCTIONS */