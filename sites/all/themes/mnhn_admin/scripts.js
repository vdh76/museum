jQuery(document).ajaxComplete(function(){
	//jQuery("#admin-menu").hide();
	jQuery(".field-multiple-table tr").each(function(i){
		
		var wrapper=jQuery(this).find(".field-name-field-bloc-type").parent();
		wrapper.find(".field-name-field-bloc-visuel-texte,.field-name-field-bloc-paragraphe,.field-name-field-bloc-visuel,.field-name-field-bloc-file,.field-name-field-bloc-media,.field-name-field-bloc-link,.field-name-field-bloc-podcast,.field-name-field-bloc-video,.field-name-field-bloc-animation,.field-name-field-bloc-quiz").addClass("page_bloc_element").hide();
		var type=jQuery(this).find(".field-name-field-bloc-type select").val();
		
		if(type=='paragraphe' || type=='visuel' || type=='file' || type=='media' || type=='visuel-texte' || type=='link' || type=='podcast' || type=='video' || type=='animation' || type=='quiz'){
			wrapper.find(".field-name-field-bloc-"+type).show();
		}
		jQuery("#edit-field-page-bloc-und-"+i+"-field-bloc-titre-und-0-value").attr("maxlength",50);
	});	
	
	jQuery("#field-collection-oeuvre-values tr,#field-exposition-oeuvre-values tr").each(function(i){
		//jQuery(this).find(".group-oeuvre-detail").addClass("collapsed");
	});	
	
	jQuery(".node-type-exposition .field-name-field-oeuvre-chef,.node-type-exposition .field-name-field-oeuvre-description,.node-type-exposition .field-name-field-oeuvre-hd,.node-type-exposition #field_collection_item_field_collection_oeuvre_form_group_podcast").hide();

});

jQuery(document).ready(function() {
	
	
	jQuery("#edit-field-objet-visuel-homepage").hide();
	
	if(jQuery("#edit-field-object-collection-und").val()=='227'){
		jQuery("#edit-field-objet-visuel-homepage").show();
	}
	
	jQuery("#edit-field-object-collection-und").live("change",function(){
		jQuery("#edit-field-objet-visuel-homepage").hide();
		if(jQuery(this).val()=='227'){
			jQuery("#edit-field-objet-visuel-homepage").show();
		}
	});	
	
	jQuery(".node-type-exposition .field-name-field-oeuvre-chef,.node-type-exposition .field-name-field-oeuvre-description,.node-type-exposition .field-name-field-oeuvre-hd,.node-type-exposition #field_collection_item_field_collection_oeuvre_form_group_podcast").hide();
	//jQuery.datepicker.setDefaults(jQuery.datepicker.regional['']);
	//jQuery('#edit-field-event-date-und-0-show-todate').datepicker(jQuery.datepicker.regional['fr']);
	
	jQuery("#field-collection-oeuvre-values tr,#field-exposition-oeuvre-values tr").each(function(i){
		jQuery(this).find(".group-oeuvre-detail").addClass("collapsed");
	});	
	
	jQuery("#edit-field-exposition-oeuvre").hide();
	
	
	jQuery("#field-page-bloc-values tr").each(function(i){
		
		var wrapper=jQuery(this).find(".field-name-field-bloc-type").parent();
		wrapper.find(".field-name-field-bloc-visuel-texte,.field-name-field-bloc-paragraphe,.field-name-field-bloc-visuel,.field-name-field-bloc-file,.field-name-field-bloc-media,.field-name-field-bloc-link,.field-name-field-bloc-podcast,.field-name-field-bloc-video,.field-name-field-bloc-animation,.field-name-field-bloc-quiz").addClass("page_bloc_element").hide();
		var type=jQuery(this).find(".field-name-field-bloc-type select").val();
		
		if(type=='paragraphe' || type=='visuel' || type=='file' || type=='media' || type=='visuel-texte' || type=='link' || type=='podcast' || type=='video' || type=='animation' || type=='quiz'){
			wrapper.find(".field-name-field-bloc-"+type).show();
		}
		
		jQuery("#edit-field-page-bloc-und-"+i+"-field-bloc-titre-und-0-value").attr("maxlength",50);
	});	
	
	jQuery("#edit-field-event-type").find("select").click(function(){
		jQuery("#edit-field-exposition-oeuvre").hide();
		if(jQuery(this).val()==1){
			jQuery("#edit-field-exposition-oeuvre").show();
		}
	});
	
	jQuery(".field-name-field-bloc-type").find("select").click(function(){
		
		var wrapper=jQuery(this).parent().parent().parent();
		wrapper.find(".page_bloc_element").hide();
		if(jQuery(this).val()!='_none'){
			wrapper.find(".field-name-field-bloc-"+jQuery(this).val()).show();
		}
	});
	
	jQuery(".field-name-field-bloc-type").find("select").live("click", function(){
		
		var wrapper=jQuery(this).parent().parent().parent();
		wrapper.find(".page_bloc_element").hide();
		if(jQuery(this).val()!='_none'){
			wrapper.find(".field-name-field-bloc-"+jQuery(this).val()).show();
		}
		
	});
	
	
	jQuery(".comment .publish").click(function(){
		if(confirm("Êtes-vous sur de vouloir publier le commentaire ?")){
				var comment=jQuery(this).parent();
				jQuery.ajax({
					  url: '/blog/comment/publish/'+jQuery(this).attr("rel"),
					  type: 'POST',
					  dataType: "html",
					  success: function(data){
							comment.slideUp();	
					  }
				});
		}
		
	});
	
	jQuery(".comment .delete").click(function(){
		if(confirm("Êtes-vous sur de vouloir supprimer le commentaire ?")){
				var comment=jQuery(this).parent();
				jQuery.ajax({
					  url: '/blog/comment/delete/'+jQuery(this).attr("rel"),
					  type: 'POST',
					  dataType: "html",
					  success: function(data){
							comment.slideUp();	
					  }
				});
		}
		
	});

	
	/*
	if($().jquery!='1.2.6'){
		
		$("#edit-search-block-form-1-wrapper #autocomplete li.selected") .live("click", function(){
			//$("#search-block-form #edit-submit").trigger("click");
			$("#search-block-form .search_loading").show();
			
			document.forms["search-block-form"].submit();
		});
	}
	*/
});	

function limitText(limitField, limitNum) {
    if (jQuery(limitField).val().length > limitNum) {
    	jQuery(limitField).val(jQuery(limitField).val().substring(0, limitNum));
    } 
}