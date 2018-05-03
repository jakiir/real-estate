jQuery(document).ready(function(){
	jQuery('#template-data').DataTable();
	
    jQuery(".trigger_popup_fricc").click(function(){
		var template_id = jQuery(this).attr('data-template');
		jQuery("#get_template_id").val(template_id);
       jQuery('.hover_bkgr_fricc').show();
    });
    /*jQuery('.hover_bkgr_fricc').click(function(){
        jQuery('.hover_bkgr_fricc').hide();
    });*/
    jQuery('.popupCloseButton').click(function(){
        jQuery('.hover_bkgr_fricc').hide();
    });	
});