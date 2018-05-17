jQuery(document).ready(function(){

	 jQuery(".link_add_cart").click(function(){
  		 var arg=jQuery(this).attr("rel");
  		 var loading=jQuery(this).find("span");
  		loading.addClass("loading_add_card");
			jQuery.ajax({
				  url: "/product/add/"+jQuery(this).attr("rel"),
				  type: "POST",
				  dataType: "html",
				  success: function(data){
						loading.removeClass("loading_add_card");
						jQuery(".message_add_cart").show();
						jQuery("#basket_info p strong").html(data);
						
				  }
			});	
    });
	 
	 jQuery(".message_add_cart .fancybox-close").click(function(){
		 jQuery(".message_add_cart").hide();
	 });
    
});







