var monthNamesShort =  ["Jan","Fev","Mar","Avr","Mai","Juin","Juil","Août","Sept","Oct","Nov","Dec"];
var overTimeID;

jQuery(document).ready(function() {

	jQuery(document).mousemove(function(e){
      jQuery("#mousePos").html(e.pageX);
   }); 
	
	var date = new Date();
	var d = date.getDate();
	var m = date.getMonth();
	var y = date.getFullYear();
	
	jQuery("body").append('<div id="fc-event-over"></div>');
	jQuery("#fc-event-over").hover(function(){ clearTimeout(overTimeID);	}, function() { jQuery(this).html(""); } );
	jQuery("#fc-event-over").click(function(){ 
			jQuery("#"+jQuery(this).find("a").attr("rel")).trigger("click");
	});

	jQuery(".calendar-event").each(function(){
		var nWidth = jQuery(this).width() - jQuery(this).children(0).width() - jQuery(this).find(">a").width() - 20;
		jQuery(this).find(".fc-event-over-content").width(nWidth);
	});
	
	jQuery("#calendar").fullCalendar({
		
		monthNames: ["Janvier","Février","Mars","Avril","Mai","Juin","Juillet","Août","Septembre","Octobre","Novembre","Décembre"],
		monthNamesShort: monthNamesShort,
		dayNames: ["Dimanche","Lundi","Mardi","Mercredi","Jeudi","Vendredi","Samedi"],
		dayNamesShort: ["Dimanche","Lundi","Mardi","Mercredi","Jeudi","Vendredi","Samedi"],
		header: {
			left: "title",
			center: "", // ai enleve le "today" qui ne figure pas dans la maquette (David)
			right: "prev,next"
		},
		events: [
			{id: 36,title: "Exposition",title_event: "lorem ipsum dolor sit amet",start: "2012-03-15",end: "2012-04-25",className:"tid-1 tid-"},	
{id: 37,title: "Musique",title_event: "Donec ut dui nibh",start: "2012-04-10",className:"tid-7 tid-"},	
{id: 38,title: "Théâtre",title_event: "orem ipsum dolor sit amet, turpis pede...",start: "2012-07-20",className:"tid-8 tid-34"},	
{id: 39,title: "Danse",title_event: "Class aptent taciti",start: "2012-08-25",className:"tid-9 tid-"},	
{id: 40,title: "Visite",title_event: "Pellentesque habitant morbi",start: "2012-05-09",end: "2012-05-25",className:"tid-3 tid-"},	
{id: 41,title: "Musique",title_event: "Expo annuelle",start: "2012-02-09",end: "2012-11-10",className:"tid-7 tid-33"},	
{id: 42,title: "Conférence / Colloque",title_event: "Nam tincidunt justo nisl. ",start: "2012-01-07",end: "2012-11-23",className:"tid-5 tid-34"},	
{id: 47,title: "Exposition",title_event: "Etiam fermentum eros",start: "2012-05-02",className:"tid-1 tid-"},	
{id: 48,title: "Exposition",title_event: "Aliquam tempor dictum",start: "2012-06-15",end: "2012-07-28",className:"tid-1 tid-33"},	
{id: 49,title: "Exposition",title_event: "Aenean mattis consectetur velit blandit...",start: "2012-03-06",end: "2012-04-12",className:"tid-1 tid-"},	
{id: 153,title: "Théâtre",title_event: "Matrice",start: "2013-06-04",end: "2013-08-04",className:"tid-8 tid-"},	
{id: 157,title: "Exposition",title_event: "Titre Lion",start: "2012-07-03",end: "2012-07-16",className:"tid-1 tid-34"},	
{id: 164,title: "Exposition",title_event: "Exposition des enfants",start: "2012-07-05",end: "2012-07-18",className:"tid-1 tid-33"},	
{id: 166,title: "Danse",title_event: "Danse classique au MuMA",start: "2012-07-05",end: "2012-07-06",className:"tid-9 tid-34"},	
{id: 167,title: "Cinéma",title_event: "Rétrospective Francois Trufaut",start: "2012-07-05",end: "2013-02-10",className:"tid-6 tid-34"},	
{id: 175,title: "Cinéma",title_event: "Evenement unique",start: "2012-07-08",className:"tid-6 tid-33"},	
{id: 180,title: "Conférence / Colloque",title_event: "Byzantii erumpentem ornanemta armatum...",start: "2012-07-18",className:"tid-5 tid-34"},	

			
		],
		firstDay: 1,
		eventMouseover : setOverEvent,
		eventMouseout : setOutEvent,
		viewDisplay: SetMumaFormat
	});
	
	jQuery(".fc-button-next,.fc-button-prev,.fc-button-today").live("click",function() {
		jQuery(".calendar-events-list,#calendar-events-details").hide();
		jQuery(".calendar-events .loading").show();
		jQuery(".calendar-events").css("margin-left","0");
		
		var month = jQuery.fullCalendar.formatDate(jQuery("#calendar").fullCalendar("getDate"),"MM");
		var year = jQuery.fullCalendar.formatDate(jQuery("#calendar").fullCalendar("getDate"),"yyyy");
		if(jQuery("#event-"+month+"-"+year).length > 0){
			jQuery(".calendar-events .loading").hide();
			jQuery("#event-"+month+"-"+year).show();
			jQuery("#calendar-events-details").show();
		}else{
    		jQuery.ajax({
					  url: "/events/month/"+month+"/"+year,
					  type: "GET",
					  success: function(data){
					  	
					  	jQuery(".calendar-events .loading").hide();
					    jQuery(".calendar-events").prepend(data);
					    jQuery("#event-"+month+"-"+year+" .calendar-event").each(function(){
							var nWidth = jQuery(this).width() - jQuery(this).children(0).width() - jQuery(this).find(">a").width() - 20;
							jQuery(this).find(".fc-event-over-content").width(nWidth);
						});
					 	jQuery("#calendar-events-details").show();
					  }
					});
		}		
		
	});
	
	jQuery(".left-column ul li .bkg_calendar_legende").mouseover(function(){
			var class_tid=jQuery(this).parent().attr("class");
			
			
			jQuery(".fc-event").each(function(){
				if(!jQuery(this).hasClass(class_tid)){
					jQuery(this).fadeTo("fast", 0.3).addClass("unselect");
				}else{
					jQuery(this).fadeTo(1, 1).removeClass("unselect");
				}
			});
			
	});
	
	jQuery(".left-column ul li .bkg_calendar_legende").mouseout(function(){
			jQuery(".fc-event").fadeTo(1, 1).removeClass("unselect")	
	});
	
	
	
	
});
	
		

function SetMumaFormat(){

	var month = jQuery.fullCalendar.formatDate(jQuery("#calendar").fullCalendar("getDate"),"MM");
	var year = jQuery.fullCalendar.formatDate(jQuery("#calendar").fullCalendar("getDate"),"yyyy");
	var height_first_day = jQuery(".fc-border-separate td:eq(0)").height();
	
	jQuery(".fc-event-hori").each(function(){
		if(!jQuery(this).hasClass("fc-corner-left")){
			if((parseFloat(jQuery(this).css("left"))==0 && parseFloat(jQuery(this).css("top"))>(65+height_first_day))){
				jQuery(this).find(".fc-event-title").html("&nbsp;").css("background","none");
			}
		}
	});	
	
	jQuery(".fc-border-separate td").removeClass("fc-off");
	
	jQuery(".fc-border-separate td").each(function(){
		if(!jQuery(this).hasClass("fc-other-month")){
			var day=jQuery(this).find(".fc-day-number").html();
			if(day=="1" && month=="01"){
jQuery(this).addClass("fc-off");
}
if(day=="1" && month=="05"){
jQuery(this).addClass("fc-off");
}
if(day=="14" && month=="07"){
jQuery(this).addClass("fc-off");
}
if(day=="11" && month=="11"){
jQuery(this).addClass("fc-off");
}
if(day=="25" && month=="12"){
jQuery(this).addClass("fc-off");
}
if(day=="0" && month==""){
jQuery(this).addClass("fc-off");
}
if(day=="0" && month==""){
jQuery(this).addClass("fc-off");
}
if(day=="0" && month==""){
jQuery(this).addClass("fc-off");
}
if(day=="0" && month==""){
jQuery(this).addClass("fc-off");
}
if(day=="0" && month==""){
jQuery(this).addClass("fc-off");
}

		}	
	});	
	
	jQuery(".fc-border-separate tr td").each(function(){
		if(jQuery(this).index()==1){
			jQuery(this).addClass("fc-off");
		}
			
	});
	
	jQuery(".left-column ul li").removeClass("first").removeClass("last");
	jQuery(".left-column ul li").fadeTo(1, 1).hide();
	jQuery(".left-column ul li").each(function(){
		var class_theme=jQuery(this).attr("class");
		jQuery(".fc-event").each(function(){
			var class_event=jQuery(this).attr("class");
			if(countInstances(class_event,class_theme)>0){
				jQuery(".left-column ul li."+class_theme).show();
			}
			
		});
		
			
	});	
		
		
		

	
	
}

function countInstances(string, word) {
	   var substrings = string.split(word);
	   return substrings.length - 1;
}



function setOverEvent(event, element, view) {

	if(!jQuery(".fc-event."+event.className).hasClass("unselect")){
		
		
		
		var start, end;
	
		var date_template = '<div><span class="day">%s</span><br /><span class="month">%s</span><br /><span class="year">%s</span></div>';
		var over_template = '<div class="fc-event-over-date">%s %s</div><div class="fc-event-over-content"><span class="theme">%s</span><span class="title">%s</span></div><a href="javascript:;" rel="event-%s"></a><div class="event_over_bottom"></div>';
	
		start = jQuery.vsprintf(date_template, [event.start.getDate() , monthNamesShort[event.start.getMonth()].toUpperCase() , event.start.getFullYear()]);
		if(event.end) end = '<div class="between"><span>></span></div>'+jQuery.vsprintf(date_template, [event.end.getDate() , monthNamesShort[event.end.getMonth()].toUpperCase() , event.end.getFullYear()]);
	
		jQuery("#fc-event-over").html(jQuery.vsprintf(over_template, [start, end, event.title, event.title_event, event.id]));
	
		
		
		var pos_event=jQuery(this).offset();
		var top_event=pos_event.top+jQuery(this).height();
		var offset = jQuery(element.target).offset();
		
		//jQuery("#fc-event-over").offset({left: offset.left - 5, top:offset.top - (jQuery(element.target).hasClass("fc-event-title") ? 62 : 72)});	
		jQuery("#fc-event-over").offset({left: jQuery("#mousePos").html(), top:top_event-72});
		
		var classes_event = " "+event.className+" ";
		var arrayOfStrings = classes_event.split(",");
		jQuery("#fc-event-over").attr("class",  arrayOfStrings[0]);
		
		
		clearTimeout(overTimeID);
	}
	
}

function setOutEvent() {
	//return;
	overTimeID = setTimeout(function(){
		jQuery("#fc-event-over").html("");
	}, 500);
	
}
	
jQuery(function() {
  	jQuery(".bloc_muma .collapsible").toggle(function(){
  		jQuery(this).parent().parent().find(".bloc_bottom").removeClass("picto_bottom");
  		jQuery(this).parent().find(".bloc_content").show();		  			  
		jQuery(this).parent().addClass("open");		  
	},function(){  
		jQuery(this).parent().find(".bloc_content").hide();
		jQuery(this).parent().removeClass("open");
		jQuery(this).parent().parent().find(".bloc_bottom").addClass("picto_bottom");

	});
  	  	
});





	
jQuery(document).ready(function() {

	setMenu();
	
	
	if(exist("#focus")) setFocusBlock();
	
	//if(exist("#home-content")) setHomeBlock();

	if(exist(".calendar-events")) jQuery(".calendar-event").live("click",setEventLink);
	
	

	
	
	jQuery("ul.tab_expo > li").click(setTab);
	jQuery("ul.tab_expo > li.activ").click();
	
	
	
});



function setBkg(bkg){
	
		if(bkg){
			jQuery.loadImages(bkg,function() {
			jQuery("#page").css("background", "url("+bkg+") no-repeat center top");
			
		});
	}
}

function setTab() {
	jQuery("ul.tab_expo > li").removeClass('activ');
	jQuery(this).addClass('activ');
	var index = jQuery(this).index();
	jQuery("div.tab-content").hide();
	//$("div.tab-content:eq("+index+")").show();
	jQuery("div.tab-content:eq("+index+")").fadeIn();
}

function setEventLink() {
	//alert("test");
	//jQuery("#wrap_visite_detail").hide();
	jQuery(".calendar-events:visible").animate({marginLeft: "-590px"}, 500);
	jQuery("#wrap_visite_detail").animate({marginLeft: "-590px"}, 500);
	jQuery("#wrap_expo_detail").animate({marginLeft: "-590px"}, 500);
	var text = jQuery(this).find(".fc-event-over-content-body").html();
	jQuery("#calendar-events-details .calendar-events-details-body").html(text);
	//jQuery("body").stop().scrollTo( ".calendar-events", 500 );
	return false;
	
	
	
}

function setEventLinkDetail(nid) {
	
	//jQuery("#wrap_visite_detail").hide();
	jQuery(".calendar-events:visible").css({"marginLeft": "-590px"});
	var text = jQuery("#event-"+nid).parent().find(".fc-event-over-content-body").html();
	jQuery("#calendar-events-details .calendar-events-details-body").html(text);
	return false;
}

function backCalendarEventsList() {
	jQuery("#calendar-events-details .calendar-events-details-body").html("");
	jQuery(".calendar-events").animate({marginLeft: "0"}, 500);
	jQuery("#wrap_visite_detail").animate({marginLeft: "0"}, 500);
	jQuery("#wrap_expo_detail").animate({marginLeft: "0"}, 500);
	
	return false;
}

function setMenu() {

	var current;
	
	jQuery("#header-top-menu ul.menu li").mouseover(function(){
		jQuery(this).find("ul.menu").show();
	});
	
	jQuery("#header-top-menu ul.menu li").mouseout(function(){
		jQuery(this).find("ul.menu").hide();
	});
	
	jQuery("#header-subwrapper #menu-543 .oeuvres-commentees").insertBefore(jQuery("#header-subwrapper #menu-543 .col:eq(0)"));
	jQuery("#header-subwrapper #menu-543 .col:eq(2)").insertAfter(jQuery("#header-subwrapper #menu-543 .col:eq(4)")).css("margin-top","10");

	jQuery("#header-subwrapper #menu-909 .oeuvres-commentees").insertBefore(jQuery("#header-subwrapper #menu-909 .col:eq(0)"));
	jQuery("#header-subwrapper #menu-909 .col:eq(2)").insertAfter(jQuery("#header-subwrapper #menu-909 .col:eq(4)")).css("margin-top","10");
	
	jQuery("#header-wrapper ul.menu li").click(function(){
		
		
		var id = jQuery(this).find('a').attr('id');
		//if(id=='menu-545'){
		//	jQuery("#header-subwrapper").hide();
		//	var href = jQuery(this).find('a').attr('href');
		//	window.location.href=href;
		//	return false;
		//}
		
		
		
		
		if(!jQuery(this).hasClass("first")){
			
			
			jQuery("#header-subwrapper .cols").hide();
			jQuery("#header #header-subwrapper #close-subwrapper #agenda-link").hide();	
			jQuery("#header #header-subwrapper #close-subwrapper #collection-link").hide();	
			jQuery("#header #header-subwrapper #close-subwrapper #expositions-a-venir-link").hide();	
			jQuery("#header #header-subwrapper #close-subwrapper #expositions-en-cours-link").hide();	
			jQuery("#header #header-subwrapper #close-subwrapper #expositions-passees-link").hide();	
			jQuery("#header-subwrapper #"+id+"").show();
			jQuery("ul.menu li > a").removeClass('activ');
			jQuery(this).find('a').addClass('activ');
			
			if(!current || current == this ) jQuery("#header-subwrapper").slideToggle(function() { if(!jQuery("#header-subwrapper").is(':visible')) { current = null; jQuery("ul.menu li > a").removeClass('activ'); }} );
			current = this;
		}else{
			jQuery("#header-subwrapper").hide();
			
		}	
		
		if(id=='menu-543' || id=='menu-909'){
			jQuery("#header #header-subwrapper #close-subwrapper #collection-link").show();	
		}
		
		if(id=='menu-545' || id=='menu-894'){
			jQuery("#header #header-subwrapper #close-subwrapper #agenda-link").show();	
		}
		
		if(id=='menu-544' || id=='menu-900'){
			jQuery("#header #header-subwrapper #close-subwrapper #expositions-a-venir-link").show();
			jQuery("#header #header-subwrapper #close-subwrapper #expositions-en-cours-link").show();
			jQuery("#header #header-subwrapper #close-subwrapper #expositions-passees-link").show();

		}
		
	});
	
	jQuery("#header-subwrapper #close-subwrapper-link").click(function(){ jQuery("#header-subwrapper").slideUp(); current = null; jQuery("ul.menu li > a").removeClass('activ'); });
}

function setHomeBlock() {
	jQuery(".home-content-block .arrows .arrow").css("opacity", 0.5)
	jQuery(".home-content-block .arrows .arrow").hover(function(e){	jQuery(this).animate({ opacity: e.type == "mouseenter" ? 1 : 0.5 }, 500);	});
}

function setFocusBlock() {
	//gestion des onglets
	//jQuery("#focus .tabs > .tab").css("opacity", 0.7);
	//jQuery("#focus .tabs > .tab").hover(function(e){	if(jQuery(this).hasClass('activ')) return; jQuery(this).animate({ opacity: e.type == "mouseenter" ? 1 : 0.7 }, 500);	});
	jQuery("#focus .tabs > .tab").click(setFocusBlockContent);
	jQuery("#focus .tabs > .tab:eq(0)").css("opacity", 1);
	//gestion des flèches
	var nWidth = jQuery("#focus").width() + 1;
	var nHeight = jQuery("#focus").height() / 2;
	//jQuery("#focus").append('<div class="arrows" style="left:'+nWidth+'px"><div class="left arrow" id="slideshow_exposition_prev"><span><span></span></span></div><div class="right arrow" id="slideshow_exposition_next"><span><span></span></span></div></div>');
	jQuery("#focus .arrows .left span").height(nHeight-1);
	jQuery("#focus .arrows .right span").height(nHeight);
	//jQuery("#focus .arrows .arrow").css("opacity", 0.7);
	//jQuery("#focus .arrows .arrow").hover(function(e){	jQuery(this).animate({ opacity: e.type == "mouseenter" ? 1 : 0.7 }, 500);	});
	jQuery("#focus .arrows .arrow").click(setFocusBlockContentNav);
}

function setFocusBlockContent() {
	
	var rel_expo=jQuery(this).attr('rel');
	
	if(rel_expo=='exposition-en-cours'){
		jQuery('#slideshow_exposition').cycle(0); 
	}else{
		var nb_exposition=jQuery('#slideshow_exposition div.focus-content').length;
		var nb_exposition_a_venir=jQuery('#slideshow_exposition div.focus-content[rel="'+rel_expo+'"]').length;
		jQuery('#slideshow_exposition').cycle(nb_exposition-nb_exposition_a_venir); 
	}	
	 return false;
}

function setFocusBlockContentNav() {
	var id=jQuery(this).attr('id');
	
	if(id=="slideshow_exposition_prev"){
		jQuery('#slideshow_exposition').cycle('prev'); 
	}else{
		jQuery('#slideshow_exposition').cycle('next'); 
	}	
	 
}

function exist(page) {
	return jQuery(page).length > 0;
}

function limitText(limitField, limitNum) {
    if (jQuery(limitField).val().length > limitNum) {
    	jQuery(limitField).val(jQuery(limitField).val().substring(0, limitNum));
    } 
}




