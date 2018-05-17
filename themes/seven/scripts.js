jQuery(document).ajaxComplete(function(){
	jQuery("#field-page-bloc-values tr").each(function(i){
		
		var wrapper=jQuery(this).find(".field-name-field-bloc-type").parent();
		wrapper.find(".field-name-field-bloc-paragraphe,.field-name-field-bloc-visuel,.field-name-field-bloc-file,.field-name-field-bloc-media").addClass("page_bloc_element").hide();
		var type=jQuery(this).find(".field-name-field-bloc-type select").val();
		
		if(type=='paragraphe' || type=='visuel' || type=='file' || type=='media'){
			wrapper.find(".field-name-field-bloc-"+type).show();
		}
	});	
	
	jQuery("#field-collection-oeuvre-values tr,#field-exposition-oeuvre-values tr").each(function(i){
		jQuery(this).find("fieldset").addClass("collapsed");
	});	
});

jQuery(document).ready(function() {
	
	
	//jQuery.datepicker.setDefaults(jQuery.datepicker.regional['']);
	//jQuery('#edit-field-event-date-und-0-show-todate').datepicker(jQuery.datepicker.regional['fr']);
	
	jQuery("#field-collection-oeuvre-values tr,#field-exposition-oeuvre-values tr").each(function(i){
		jQuery(this).find("fieldset").addClass("collapsed");
	});	
	
	jQuery("#edit-field-exposition-oeuvre").hide();
	
	
	jQuery("#field-page-bloc-values tr").each(function(i){
		
		var wrapper=jQuery(this).find(".field-name-field-bloc-type").parent();
		wrapper.find(".field-name-field-bloc-paragraphe,.field-name-field-bloc-visuel,.field-name-field-bloc-file,.field-name-field-bloc-media").addClass("page_bloc_element").hide();
		var type=jQuery(this).find(".field-name-field-bloc-type select").val();
		
		if(type=='paragraphe' || type=='visuel' || type=='file' || type=='media'){
			wrapper.find(".field-name-field-bloc-"+type).show();
		}	
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