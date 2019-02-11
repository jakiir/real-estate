jQuery(document).ready(function(){
	jQuery('#template-data').DataTable();
	jQuery('#inspection-data').DataTable();
	
	/*jQuery( ".trigger_popup_fricc" ).on( "click", function() {
		var template_id = jQuery(this).attr('data-template');
		jQuery("#get_template_id").val(template_id);
       jQuery('.hover_bkgr_fricc').show();
    });*/
    /*jQuery('.hover_bkgr_fricc').click(function(){
        jQuery('.hover_bkgr_fricc').hide();
    });*/
    jQuery('.popupCloseButton').click(function(){
        jQuery('.hover_bkgr_fricc').hide();
    });	
});
function trigger_popup_fricc(thisItem){
	var template_id = jQuery(thisItem).attr('data-template');
	jQuery("#get_template_id").val(template_id);
   jQuery('.hover_bkgr_fricc').show();
}