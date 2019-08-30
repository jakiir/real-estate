<?php 
$inspectionreportdetail = $wpdb->prefix . 'inspectionreportdetail';
$get_inspectionreportdetail = $wpdb->get_results( "SELECT * FROM $inspectionreportdetail WHERE id=$saved AND inspectionId=$report_id", OBJECT );
$form_info = (!empty($get_inspectionreportdetail[0]->fieldTextHtml) ? $get_inspectionreportdetail[0]->fieldTextHtml : '');
$form_info_arr = json_decode($form_info, true);
$data_inspector_types = (!empty($get_inspection->inspector_type) ? explode(',',$get_inspection->inspector_type) : []);
$inspector_types = (!empty($form_info_arr['inspector_types']) ? $form_info_arr['inspector_types'] : $data_inspector_types);
$data_inspection_buyer_types = (!empty($get_inspection->inspection_buyer_type) ? explode(',',$get_inspection->inspection_buyer_type) : []);
$inspection_buyer_types = (!empty($form_info_arr['inspection_buyer_types']) ? $form_info_arr['inspection_buyer_types'] : $data_inspection_buyer_types);
$data_report_forwarded_tos = (!empty($get_inspection->report_forwarded_to) ? explode(',',$get_inspection->report_forwarded_to) : []);
$report_forwarded_tos = (!empty($form_info_arr['report_forwarded_tos']) ? $form_info_arr['report_forwarded_tos'] : $data_report_forwarded_tos);
$property_obstructed = (!empty($form_info_arr['property_obstructed']) ? $form_info_arr['property_obstructed'] : []);
$inaccessible_obstructed = (!empty($form_info_arr['inaccessible_obstructed']) ? $form_info_arr['inaccessible_obstructed'] : []);
$wood_destroying = (!empty($form_info_arr['wood_destroying']) ? $form_info_arr['wood_destroying'] : []);
$wood_include = (!empty($form_info_arr['wood_include']) ? $form_info_arr['wood_include'] : []);
$infestation_active1 = (!empty($form_info_arr['infestation_active1']) ? $form_info_arr['infestation_active1'] : []);
$infestation_active2 = (!empty($form_info_arr['infestation_active2']) ? $form_info_arr['infestation_active2'] : []);
$infestation_active3 = (!empty($form_info_arr['infestation_active3']) ? $form_info_arr['infestation_active3'] : []);
$infestation_active4 = (!empty($form_info_arr['infestation_active4']) ? $form_info_arr['infestation_active4'] : []);
$infestation_active5 = (!empty($form_info_arr['infestation_active5']) ? $form_info_arr['infestation_active5'] : []);

$infestation_previous1 = (!empty($form_info_arr['infestation_previous1']) ? $form_info_arr['infestation_previous1'] : []);
$infestation_previous2 = (!empty($form_info_arr['infestation_previous2']) ? $form_info_arr['infestation_previous2'] : []);
$infestation_previous3 = (!empty($form_info_arr['infestation_previous3']) ? $form_info_arr['infestation_previous3'] : []);
$infestation_previous4 = (!empty($form_info_arr['infestation_previous4']) ? $form_info_arr['infestation_previous4'] : []);
$infestation_previous5 = (!empty($form_info_arr['infestation_previous5']) ? $form_info_arr['infestation_previous5'] : []);
$treatment_previous1 = (!empty($form_info_arr['treatment_previous1']) ? $form_info_arr['treatment_previous1'] : []);
$treatment_previous2 = (!empty($form_info_arr['treatment_previous2']) ? $form_info_arr['treatment_previous2'] : []);
$treatment_previous3 = (!empty($form_info_arr['treatment_previous3']) ? $form_info_arr['treatment_previous3'] : []);
$treatment_previous4 = (!empty($form_info_arr['treatment_previous4']) ? $form_info_arr['treatment_previous4'] : []);
$treatment_previous5 = (!empty($form_info_arr['treatment_previous5']) ? $form_info_arr['treatment_previous5'] : []);
$preventive_treatment = (!empty($form_info_arr['preventive_treatment']) ? $form_info_arr['preventive_treatment'] : []);
$corrective_treatment = (!empty($form_info_arr['corrective_treatment']) ? $form_info_arr['corrective_treatment'] : []);
$mechanically_corrected = (!empty($form_info_arr['mechanically_corrected']) ? $form_info_arr['mechanically_corrected'] : []);
$subterranean_termites = (!empty($form_info_arr['subterranean_termites']) ? $form_info_arr['subterranean_termites'] : []);
$treating_drywood = (!empty($form_info_arr['treating_drywood']) ? $form_info_arr['treating_drywood'] : []);
$company_contract_warranty = (!empty($form_info_arr['company_contract_warranty']) ? $form_info_arr['company_contract_warranty'] : []);
$additional_comments = (!empty($form_info_arr['additional_comments']) ? $form_info_arr['additional_comments'] : []);
$notice_of_inspection = (!empty($form_info_arr['notice_of_inspection']) ? $form_info_arr['notice_of_inspection'] : []);

$licence_number=get_user_meta($user->ID,  'licence_number', true );
$phone_number=get_user_meta($user->ID,  'phone_number', true );
$inspector_name=get_user_meta($user->ID,  'first_name', true )." ".get_user_meta($user->ID,  'last_name', true );


?>
<link rel="stylesheet" href="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/fa/css/font-awesome.min.css" />
<div id="templateViewer">
  <!--bootstrap css-->
    <link rel="stylesheet" href="<?php echo esc_url( get_template_directory_uri() ); ?>/woodInspection/css/bootstrap.min.css" />
    <!--css for this template-->
	<?php $template_directory_uri = get_template_directory_uri(); ?>	
    <link rel="stylesheet" href="<?php echo esc_url( get_template_directory_uri() ); ?>/woodInspection/css/main.css" />
    <div class="tap__raw_form_body templateViewer">
      <div class="container">
        <h2 class="tap__form-title text-center">TEXAS OFFICIAL WOOD DESTROYING INSECT REPORT</h2>
        <div class="row tap__address area">
          <div class="col-sm-4">
            <p><?php echo !empty($get_inspection->report_identification) ? $get_inspection->report_identification : 'N/A'; ?> <span>Inspected Address</span></p>
          </div>
          <!-- End of col -->
          <div class="col-sm-4 text-center">
            <p><?php echo !empty($get_inspection->inspection_city) ? $get_inspection->inspection_city : 'N/A'; ?> <span>City</span></p>
          </div>
          <!-- End of col -->
          <div class="col-sm-4 text-right">
            <p><?php echo !empty($get_inspection->zip_code) ? $get_inspection->zip_code : 'N/A'; ?> <span>Zip Code</span></p>
          </div>
          <!-- End of col -->
        </div>
        <!-- End of row -->

        <!-- ================================
              End of Form header
        ===================================== -->

        <div class="tap__scope_instruction area">
          <h2 class="text-center">SCOPE OF INSPECTION</h2>
          <ol type="A">
            <li><span>This inspection covers only the multi-family structure, primary dwelling or place of business.</span> Sheds, detached garages, lean-tos, fences, guest houses or any other structure will not be included in this inspection report unless specifically noted in Section 5 of this report.</li>
            <li><span>This inspection is limited to those parts of the structure(s) that are visible and accessible at the time of the inspection.</span> Examples of inaccessible areas include but are not limited to (1) areas concealed by wall coverings, furniture, equipment and stored articles and (2) any portion of the structure in which inspection would necessitate removing or defacing any part of the structure(s) (including the surface appearance of the structure). <span>Inspection does not cover any condition or damage which was not visible in or on the structure(s) at time of inspection but which may be revealed in the course of repair or replacement work.</span></li>
            <li><span>Due to the characteristics and behavior of various wood destroying insects, it may not always be possible to determine the presence of infestation</span> without defacing or removing parts of the structure being inspected. Previous damage to trim, wall surface, etc., is frequently repaired prior to the inspection with putty, spackling, tape or other decorative devices. Damage that has been concealed or repaired may not be visible except by defacing the surface appearance. The WDI inspecting company cannot guarantee or determine that work performed by a previous pest control company, as indicated by visual evidence of previous treatment; has rendered the pest(s) inactive.</li>
            <li><span>If visible evidence of active or previous infestation of listed wood destroying insects is reported, it should be assumed that some degree of damage is present.</span></li>
            <li>If visible evidence is reported, it does not imply that damage should be repaired or replaced. Inspectors of the inspection company usually are not engineers or builders qualified to give an opinion regarding the degree of structural damage. Evaluation of damage and any corrective action should be performed by a qualified expert.</li>
            <li><span><b>THIS IS NOT A STRUCTURAL DAMAGE REPORT OR A WARRANTY AS TO THE ABSENCE OF WOOD DESTROYING INSECTS.</b></span></li>
            <li>If termite treatment (including pesticides, baits or other methods) has been recommended, the treating company must provide a diagram of the structure(s) inspected and proposed for treatment, label of pesticides to be used and complete details of warranty (if any). At a minimum, the warranty must specify which areas of the structure(s) are covered by warranty, renewal options and approval by a certified applicator in the termite category. Information regarding treatment and any warranties should be provided by the party contracting for such services to any prospective buyers of the property. The inspecting company has no duty to provide such information to any person other than the contracting party.</li>
            <li>There are a variety of termite control options offered by pest control companies. These options will vary in cost, efficacy, areas treated, warranties, treatment techniques and renewal options.</li>
            <li>There are some specific guidelines as to when it is appropriate for corrective treatment to be recommended. Corrective treatment may only be recommended if (1) there is visible evidence of an active infestation in or on the structure, (2) there is visible evidence of a previous infestation with no evidence of a prior treatment.</li>
            <li>If treatment is recommended based solely on the presence of conducive conditions, a preventive treatment or correction of conducive conditions may be recommended. The buyer and seller should be aware that there may be a variety of different strategies to correct the conducive condition(s). These corrective measures can vary greatly in cost and effectiveness and may or may not require the services of a licensed pest control operator. There may be instances where the inspector will recommend correction of the conducive conditions by either mechanical alteration or cultural changes. Mechanical alteration may be in some instances the most economical method to correct conducive conditions. If this inspection report recommends any type of treatment and you have any questions about this, you may contact the inspector involved, another licensed pest control operator for a second opinion, and/or the Structural Pest Control Board.</li>
          </ol>
        </div>

        <!-- ================================
              End of Scope Instruction
        ===================================== -->

        <div class="tap__form-content">
          <div class="row">
            <div class="col-sm-8">
              <div class="tap__input_set">
                <span class="input__no">1A.</span>
                <div class="tap__input_field">
                  <div class="input_control bold-text"><?php echo !empty($form_data->companyId) ? $form_data->companyId : 'N/A'; echo !empty($form_data->company_email) ? ' <span class="email-link">'.$form_data->company_email.'</span>' : 'N/A'; ?></div>
                  <label for="">Name of Inspection Company</label>
                </div>
              </div>
              <!-- End of input set -->
            </div>
            <!-- End of col -->
            <div class="col-sm-4">
              <div class="tap__input_set">
                <span class="input__no">1B.</span>
                <div class="tap__input_field">
                  <input type="text" class="input_control bold-text" value="<?php echo !empty($licence_number) ? 'TPCL # '.$licence_number : 'N/A'; ?>" readonly>
                  <label for="">SPCB Business License Number</label>
                </div>
              </div>
              <!-- End of input set -->
            </div>
            <!-- End of col -->
          </div>
          <!-- End of row -->

          <div class="row">
            <div class="col-sm-3">
              <div class="tap__input_set">
                <span class="input__no">1C.</span>
                <div class="tap__input_field">
                  <input type="text" class="input_control bold-text" value="<?php echo !empty($form_data->company_address) ? $form_data->company_address : 'N/A'; ?>" readonly>
                  <label for="">Address of Inspection Company</label>
                </div>
              </div>
              <!-- End of input set -->
            </div>
            <!-- End of col -->
            <div class="col-sm-9">
              <div class="row">
                <div class="col-sm-3">
                  <div class="tap__input_set">
                    <div class="tap__input_field">
                      <input type="text" class="input_control bold-text" value="<?php echo !empty($form_data->template_city) ? $form_data->template_city : 'N/A'; ?>" readonly>
                      <label for="">City</label>
                    </div>
                  </div>
                  <!-- End of input set -->
                </div>
                <!-- End of col -->
                <div class="col-sm-3">
                  <div class="tap__input_set">
                    <div class="tap__input_field">
                      <input type="text" class="input_control bold-text" value="<?php echo !empty($form_data->state) ? $form_data->state : 'N/A'; ?>" readonly>
                      <label for="">State</label>
                    </div>
                  </div>
                  <!-- End of input set -->
                </div>
                <!-- End of col -->
                <div class="col-sm-3">
                  <div class="tap__input_set">
                    <div class="tap__input_field">
                      <input type="text" class="input_control bold-text" value="<?php echo !empty($form_data->state_form) ? $form_data->state_form : 'N/A'; ?>" readonly>
                      <label for="">Zip</label>
                    </div>
                  </div>
                  <!-- End of input set -->
                </div>
                <!-- End of col -->
                <div class="col-sm-3">
                  <div class="tap__input_set">
                    <div class="tap__input_field">
                      <input type="text" class="input_control bold-text" value="<?php echo !empty($phone_number) ? $phone_number : 'N/A'; ?>" readonly>
                      <label for="">Telephone No.</label>
                    </div>
                  </div>
                  <!-- End of input set -->
                </div>
                <!-- End of col -->
              </div>
              <!-- End of inner row -->
            </div>
            <!-- End of col -->
          </div>
          <!-- End of row -->

          <div class="row">
            <div class="col-sm-6">
              <div class="tap__input_set">
                <span class="input__no">1D.</span>
                <div class="tap__input_field">
                  <input type="text" class="input_control bold-text" value="<?php echo !empty($inspector_name) ? $inspector_name : 'N/A'; ?>" readonly>
                  <label for="">Name of Inspector (Please Print)</label>
                </div>
              </div>
              <!-- End of input set -->
            </div>
            <!-- End of col -->
            <div class="col-sm-6">
              <div class="tap__input_set">
                <span class="input__no">1E.</span>
                <div class="tap__input_field checkbox">
                  <input type="checkbox" class="input_control" id="applicator" name="inspector_types" <?php echo (in_array('Certified Applicator', $inspector_types) ? 'checked=checked' : null); ?> value="Certified Applicator">
                  <label for="applicator">Certified Applicator</label>
                </div>
              </div>
              <!-- End of input set -->
              <div class="tap__input_set">
                <div class="tap__input_field checkbox">
                  <input type="checkbox" class="input_control" id="technician" name="inspector_types" <?php echo (in_array('Technician', $inspector_types) ? 'checked=checked' : null); ?> value="Technician">
                  <label for="technician">Technician</label>
                </div>
              </div>
              <!-- End of input set -->
            </div>
            <!-- End of col -->
          </div>
          <!-- End of row -->

          <div class="row">
            <div class="col-sm-6">
              <div class="tap__input_set">
                <span class="input__no">2.</span>
                <div class="tap__input_field">
                  <input type="text" class="input_control bold-text" value="<?php echo !empty($get_inspection->case_number) ? $get_inspection->case_number : 'N/A'; ?>" readonly>
                  <label for="">Case Number (VA/FHA/Other)</label>
                </div>
              </div>
              <!-- End of input set -->
            </div>
            <!-- End of col -->
            <div class="col-sm-6">
              <div class="tap__input_set">
                <span class="input__no">3.</span>
                <div class="tap__input_field">
                  <input type="text" class="input_control bold-text" value="<?php echo !empty($get_inspection->inpection_date) ? date('F j, Y', strtotime($get_inspection->inpection_date)) : 'N/A'; ?>" readonly>
                  <label for="">Inspection Date</label>
                </div>
              </div>
              <!-- End of input set -->
            </div>
            <!-- End of col -->
          </div>
          <!-- End of row -->

          <div class="row">
            <div class="col-sm-5">
              <div class="tap__input_set">
                <span class="input__no">4A.</span>
                <div class="tap__input_field">
                  <input type="text" class="input_control bold-text" value="<?php echo !empty($get_inspection->prepared_for) ? $get_inspection->prepared_for : 'N/A'; ?>" readonly>
                  <label for="">Name of Person Purchasing Inspection</label>
                </div>
              </div>
              <!-- End of input set -->
            </div>
            <!-- End of col -->
            <div class="col-sm-7">
              <div class="tap__input_set">
                <div class="tap__input_field checkbox inline-checkbox">
                  <input type="checkbox" class="input_control" id="Seller" name="inspection_buyer_types" <?php echo (in_array('Seller', $inspection_buyer_types) ? 'checked=checked' : null); ?> value="Seller">
                  <label for="Seller">Seller</label>
                </div>
                <div class="tap__input_field checkbox inline-checkbox">
                  <input type="checkbox" class="input_control" id="Agent" name="inspection_buyer_types" <?php echo (in_array('Agent', $inspection_buyer_types) ? 'checked=checked' : null); ?> value="Agent">
                  <label for="Agent">Agent</label>
                </div>
                <div class="tap__input_field checkbox inline-checkbox">
                  <input type="checkbox" class="input_control" id="Buyer" name="inspection_buyer_types" <?php echo (in_array('Buyer', $inspection_buyer_types) ? 'checked=checked' : null); ?> value="Buyer">
                  <label for="Buyer">Buyer</label>
                </div>
                <div class="tap__input_field checkbox inline-checkbox">
                  <input type="checkbox" class="input_control" id="Management" name="inspection_buyer_types" <?php echo (in_array('Management Co.', $inspection_buyer_types) ? 'checked=checked' : null); ?> value="Management Co.">
                  <label for="Management">Management Co.</label>
                </div>
                <div class="tap__input_field checkbox inline-checkbox">
                  <input type="checkbox" class="input_control" id="Other_purchase" name="inspection_buyer_types" <?php echo (in_array('Other', $inspection_buyer_types) ? 'checked=checked' : null); ?> value="Other">
                  <label for="Other_purchase">Other</label>
                </div>
              </div>			  
              <!-- End of input set -->
            </div>
            <!-- End of col -->
          </div>
          <!-- End of row -->

          <div class="row">
            <div class="col-sm-6">
              <div class="tap__input_set">
                <span class="input__no">4B.</span>
                <div class="tap__input_field">
                  <input type="text" class="input_control bold-text" value="<?php echo !empty($get_inspection->owner_type) ? $get_inspection->owner_type : 'N/A'; ?>" readonly>
                  <label for="">Owner/Seller</label>
                </div>
              </div>
              <!-- End of input set -->
            </div>
            <!-- End of col -->
            <div class="col-sm-12">
              <div class="tap__input_set">
                <span class="input__no">4C. REPORT FORWARDED TO:</span>
                <div class="tap__input_field checkbox inline-checkbox">
                  <input type="checkbox" class="input_control" id="Mortgagee" name="report_forwarded_tos" <?php echo (in_array('Title Company or Mortgage', $report_forwarded_tos) ? 'checked=checked' : null); ?> value="Title Company or Mortgage">
                  <label for="Mortgagee">Title Company or Mortgagee</label>
                </div>
                <div class="tap__input_field checkbox inline-checkbox">
                  <input type="checkbox" class="input_control" id="Purchaser_Service" name="report_forwarded_tos" <?php echo (in_array('Purchaser of Service', $report_forwarded_tos) ? 'checked=checked' : null); ?> value="Purchaser of Service">
                  <label for="Purchaser_Service">Purchaser of Service</label>
                </div>
                <div class="tap__input_field checkbox inline-checkbox">
                  <input type="checkbox" class="input_control" id="Seller2" name="report_forwarded_tos" <?php echo (in_array('Seller', $report_forwarded_tos) ? 'checked=checked' : null); ?> value="Seller">
                  <label for="Seller2">Seller</label>
                </div>
                <div class="tap__input_field checkbox inline-checkbox">
                  <input type="checkbox" class="input_control" id="Agent2" name="report_forwarded_tos" <?php echo (in_array('Agent', $report_forwarded_tos) ? 'checked=checked' : null); ?> value="Agent">
                  <label for="Agent2">Agent</label>
                </div>
                <div class="tap__input_field checkbox inline-checkbox">
                  <input type="checkbox" class="input_control" id="Buyer2" name="report_forwarded_tos" <?php echo (in_array('Buyer', $report_forwarded_tos) ? 'checked=checked' : null); ?> value="Buyer">
                  <label for="Buyer2">Buyer</label>
                </div>
                <div class="tap__input_field">
                  <label for="">(Under the Structural Pest Control regulations only the purchaser of the service is required to receive a copy) The structure(s) listed below were inspected in accordance with the official inspection procedures adopted by the Texas Structural Pest Control Board. This report is made subject to the conditions listed under the Scope of Inspection. A diagram must be attached including all structures inspected.</label>
                </div>
              </div>
              <!-- End of input set -->
            </div>
            <!-- End of col -->
            <div class="col-sm-12">
              <div class="tap__input_set">
                <span class="input__no">5.</span>
                <div class="tap__input_field">
                  <input type="text" class="input_control bold-text" value="<?php echo !empty($get_inspection->list_structure) ? $get_inspection->list_structure : 'N/A'; ?>" readonly>
                  <label for="">List structure(s) inspected that may include residence, detached garages and other structures on the property. (Refer to Part A, Scope of Inspection)</label>
                </div>
              </div>
              <!-- End of input set -->
              <div class="tap__input_set">
                <span class="input__no">6A. Were any areas of the property obstructed or inaccessible?</span>
                <div class="tap__input_field checkbox inline-checkbox">
                  <input type="checkbox" <?php echo (in_array('Yes', $property_obstructed) ? 'checked=checked' : null); ?> value="Yes" class="input_control" id="property_yes" name="property_obstructed">
                  <label for="property_yes">Yes</label>
                </div>
                <div class="tap__input_field checkbox inline-checkbox">
                  <input type="checkbox" <?php echo (in_array('No', $property_obstructed) ? 'checked=checked' : null); ?> value="No" class="input_control" id="property_no" name="property_obstructed">
                  <label for="property_no">No</label>
                  <span class="note">(Refer to Part B & C, Scope of Inspection) If “Yes” specify in 6B.</span>
                </div>
              </div>
              <!-- End of input set -->
            </div>
            <!-- End of col -->
            <div class="col-sm-12">
              <span class="input__no d__block">6B. The obstructed or inaccessible areas include but are not limited to the following:</span>
              <div class="row grid_checkbox_layout">
                <div class="col-sm-3">
                  <div class="tap__input_set">
                    <div class="tap__input_field checkbox">
                      <input type="checkbox" value="Attic" <?php echo (in_array('Attic', $inaccessible_obstructed) ? 'checked=checked' : null); ?> class="input_control" id="Attic" name="inaccessible_obstructed">
                      <label for="Attic">Attic</label>
                    </div>
                  </div>
                  <!-- End of input set -->
                  <div class="tap__input_set">
                    <div class="tap__input_field checkbox">
                      <input type="checkbox" value="Deck" <?php echo (in_array('Deck', $inaccessible_obstructed) ? 'checked=checked' : null); ?> class="input_control" id="Deck" name="inaccessible_obstructed">
                      <label for="Deck">Deck</label>
                    </div>
                  </div>
                  <!-- End of input set -->
                  <div class="tap__input_set">
                    <div class="tap__input_field checkbox">
                      <input type="checkbox" value="Soil Grade Too High" <?php echo (in_array('Soil Grade Too High', $inaccessible_obstructed) ? 'checked=checked' : null); ?> class="input_control" id="Soil_Grade" name="inaccessible_obstructed">
                      <label for="Soil_Grade">Soil Grade Too High</label>
                    </div>
                  </div>
                  <!-- End of input set -->
                  <div class="tap__input_set">
                    <div class="tap__input_field checkbox">
                      <input type="checkbox" value="Other" <?php echo (in_array('Other', $inaccessible_obstructed) ? 'checked=checked' : null); ?> class="input_control" id="Other_obstructed" name="inaccessible_obstructed" onclick="thisConnect6B(this)">
                      <label for="Other_obstructed">Other</label>
                    </div>
                  </div>
                  <!-- End of input set -->
                </div>
                <!-- End of col -->
                <div class="col-sm-3">
                  <div class="tap__input_set">
                    <div class="tap__input_field checkbox">
                      <input type="checkbox" value="Insulated area of attic" <?php echo (in_array('Insulated area of attic', $inaccessible_obstructed) ? 'checked=checked' : null); ?> class="input_control" id="Insulated_attic" name="inaccessible_obstructed">
                      <label for="Insulated_attic">Insulated area of attic</label>
                    </div>
                  </div>
                  <!-- End of input set -->
                  <div class="tap__input_set">
                    <div class="tap__input_field checkbox">
                      <input type="checkbox" value="Sub Floors" <?php echo (in_array('Sub Floors', $inaccessible_obstructed) ? 'checked=checked' : null); ?> class="input_control" id="Sub_Floors" name="inaccessible_obstructed">
                      <label for="Sub_Floors">Sub Floors</label>
                    </div>
                  </div>
                  <!-- End of input set -->
                  <div class="tap__input_set">
                    <div class="tap__input_field checkbox">
                      <input type="checkbox" value="Heavy Foliage" <?php echo (in_array('Heavy Foliage', $inaccessible_obstructed) ? 'checked=checked' : null); ?> class="input_control" id="Heavy_Foliage" name="inaccessible_obstructed">
                      <label for="Heavy_Foliage">Heavy Foliage</label>
                    </div>
                  </div>
                  <!-- End of input set -->
                  <div class="tap__input_set">
                    <?php /* ?><div class="tap__input_field checkbox">
                      <input type="checkbox" value="Specify" <?php echo (in_array('Specify', $inaccessible_obstructed) ? 'checked=checked' : null); ?> class="input_control" id="Specify:" name="inaccessible_obstructed">
                      <label for="Specify:">Specify</label>
                    </div><?php */ ?>
					<div class="tap__input_set inline__input_field inaccessible-specify" style="<?php echo (in_array('Other', $inaccessible_obstructed) ? 'display:block' : 'display:none'); ?>">
						<span class="input__no">Specify:</span>
						<div class="tap__input_field" style="padding: 0 0 0 50px;">
						  <input type="text" class="input_control bold-text" name="inaccessible_obstructed_text" value="<?php echo !empty($form_info_arr['inaccessible_obstructed_text'][0]) ? $form_info_arr['inaccessible_obstructed_text'][0] : 'N/A'; ?>">
						</div>
					 </div>
                  </div>
                  <!-- End of input set -->
                </div>
                <!-- End of col -->
                <div class="col-sm-3">
                  <div class="tap__input_set">
                    <div class="tap__input_field checkbox">
                      <input type="checkbox" value="Plumbing Areas" <?php echo (in_array('Plumbing Areas', $inaccessible_obstructed) ? 'checked=checked' : null); ?> class="input_control" id="Plumbing_Areas" name="inaccessible_obstructed">
                      <label for="Plumbing_Areas">Plumbing Areas</label>
                    </div>
                  </div>
                  <!-- End of input set -->
                  <div class="tap__input_set">
                    <div class="tap__input_field checkbox">
                      <input type="checkbox" value="Slab Joints" <?php echo (in_array('Slab Joints', $inaccessible_obstructed) ? 'checked=checked' : null); ?> class="input_control" id="Slab_Joints" name="inaccessible_obstructed">
                      <label for="Slab_Joints">Slab Joints</label>
                    </div>
                  </div>
                  <!-- End of input set -->
                  <div class="tap__input_set">
                    <div class="tap__input_field checkbox">
                      <input type="checkbox" value="Eaves" <?php echo (in_array('Eaves', $inaccessible_obstructed) ? 'checked=checked' : null); ?> class="input_control" id="Eaves" name="inaccessible_obstructed">
                      <label for="Eaves">Eaves</label>
                    </div>
                  </div>
                  <!-- End of input set -->
                </div>
                <!-- End of col -->
                <div class="col-sm-3">
                  <div class="tap__input_set">
                    <div class="tap__input_field checkbox">
                      <input type="checkbox" value="Planter box abutting structure" <?php echo (in_array('Planter box abutting structure', $inaccessible_obstructed) ? 'checked=checked' : null); ?> class="input_control" id="Planter_box" name="inaccessible_obstructed">
                      <label for="Planter_box">Planter box abutting structure</label>
                    </div>
                  </div>
                  <!-- End of input set -->
                  <div class="tap__input_set">
                    <div class="tap__input_field checkbox">
                      <input type="checkbox" value="Crawl Space" <?php echo (in_array('Crawl Space', $inaccessible_obstructed) ? 'checked=checked' : null); ?> class="input_control" id="Crawl_Space" name="inaccessible_obstructed">
                      <label for="Crawl_Space">Crawl Space</label>
                    </div>
                  </div>
                  <!-- End of input set -->
                  <div class="tap__input_set">
                    <div class="tap__input_field checkbox">
                      <input type="checkbox" value="Weep holes" <?php echo (in_array('Weep holes', $inaccessible_obstructed) ? 'checked=checked' : null); ?> class="input_control" id="Weep_holes" name="inaccessible_obstructed">
                      <label for="Weep_holes">Weep holes</label>
                    </div>
                  </div>
                  <!-- End of input set -->
                </div>
                <!-- End of col -->
              </div>
              <!-- End of inner row -->
            </div>
            <!-- End of col -->
			
			<div class="pagefooter" style="color:#7E7E7E;font-size:12px;text-align: center;clear:both;">
				<br/><br/><br/>Licensed and Regulated by the Texas Department of Agriculture<br/>
				P.O. Box 12847, Austin, Texas 78711-2847<br/>
				Phone 866-918-4481, Fax 888-232-2567<br/>
			</div>
			<br/>
            <div class="col-sm-12">
              <div class="tap__input_set">
                <span class="input__no">7A. Conditions conducive to wood destroying insect infestation:</span>
                <div class="tap__input_field checkbox inline-checkbox">
                  <input type="checkbox" value="Yes" <?php echo (in_array('Yes', $wood_destroying) ? 'checked=checked' : null); ?> class="input_control" id="wood_destroying_yes" name="wood_destroying">
                  <label for="wood_destroying_yes">Yes</label>
                </div>
                <div class="tap__input_field checkbox inline-checkbox">
                  <input type="checkbox" value="No" <?php echo (in_array('No', $wood_destroying) ? 'checked=checked' : null); ?> class="input_control" id="wood_destroying_no" name="wood_destroying">
                  <label for="wood_destroying_no">No</label>
                </div>
				<div class="note">(Refer to Part J, Scope of Inspection) If “Yes” specify in 7B.</div>
              </div>
              <!-- End of input set -->
            </div>
            <!-- End of col -->
            <div class="col-sm-12">
              <span class="input__no d__block">7B. Conducive Conditions include but are not limited to:</span>
              <div class="row grid_checkbox_layout grid_checkbox_layout_7b">
                <div class="col-sm-4">
                  <div class="tap__input_set">
                    <div class="tap__input_field checkbox">
                      <input type="checkbox" class="input_control" id="wood" name="wood_include" <?php echo (in_array('Wood to Ground Contact (G)', $wood_include) ? 'checked=checked' : null); ?> value="Wood to Ground Contact (G)" onClick="thisConnectB(this)">
                      <label for="wood">Wood to Ground Contact (G)</label>
                    </div>
                  </div>
                  <!-- End of input set -->
                  <div class="tap__input_set">
                    <div class="tap__input_field checkbox">
                      <input type="checkbox" class="input_control" id="Debris" name="wood_include" <?php echo (in_array('Debris under or around structure (K)', $wood_include) ? 'checked=checked' : null); ?> value="Debris under or around structure (K)" onClick="thisConnectB(this)">
                      <label for="Debris">Debris under or around structure (K)</label>
                    </div>
                  </div>
                  <!-- End of input set -->
                  <div class="tap__input_set">
                    <div class="tap__input_field checkbox">
                      <input type="checkbox" class="input_control" id="Planter" name="wood_include" <?php echo (in_array('Planter box abutting structure (O)', $wood_include) ? 'checked=checked' : null); ?> value="Planter box abutting structure (O)" onClick="thisConnectB(this)">
                      <label for="Planter">Planter box abutting structure (O)</label>
                    </div>
                  </div>
                  <!-- End of input set -->
                  <div class="tap__input_set">
                    <div class="tap__input_field checkbox">
                      <input type="checkbox" class="input_control" id="Insufficient_ventilation" name="wood_include" <?php echo (in_array('Insufficient ventilation (T)', $wood_include) ? 'checked=checked' : null); ?> value="Insufficient ventilation (T)" onClick="thisConnectB(this)">
                      <label for="Insufficient_ventilation">Insufficient ventilation (T)</label>
                    </div>
                  </div>
                  <!-- End of input set -->
                </div>
                <!-- End of col -->
                <div class="col-sm-4">
                  <div class="tap__input_set">
                    <div class="tap__input_field checkbox">
                      <input type="checkbox" class="input_control" id="boards" name="wood_include" <?php echo (in_array('Form boards left in place (l)', $wood_include) ? 'checked=checked' : null); ?> value="Form boards left in place (l)" onClick="thisConnectB(this)">
                      <label for="boards">Form boards left in place (l)</label>
                    </div>
                  </div>
                  <!-- End of input set -->
                  <div class="tap__input_set">
                    <div class="tap__input_field checkbox">
                      <input type="checkbox" class="input_control" id="Footing" name="wood_include" <?php echo (in_array('Footing too low or soil line too high (L)', $wood_include) ? 'checked=checked' : null); ?> value="Footing too low or soil line too high (L)" onClick="thisConnectB(this)">
                      <label for="Footing">Footing too low or soil line too high (L)</label>
                    </div>
                  </div>
                  <!-- End of input set -->
                  <div class="tap__input_set">
                    <div class="tap__input_field checkbox">
                      <input type="checkbox" class="input_control" id="Wood_Pile" name="wood_include" <?php echo (in_array('Wood Pile in Contact with Structure (Q)', $wood_include) ? 'checked=checked' : null); ?> value="Wood Pile in Contact with Structure (Q)" onClick="thisConnectB(this)">
                      <label for="Wood_Pile">Wood Pile in Contact with Structure (Q)</label>
                    </div>
                  </div>
                  <!-- End of input set -->
				  <div class="tap__input_set">
                    <div class="tap__input_field checkbox inline-checkbox">
                      <input type="checkbox" class="input_control" id="Other_conductive" name="wood_include" <?php echo (in_array('Other (C)', $wood_include) ? 'checked=checked' : null); ?> value="Other (C)" onClick="thisConnectB(this)">
                      <label for="Other_conductive">Other (C)</label>
					  <div class="tap__input_set pl-25 include-specify" style="<?php echo (in_array('Other (C)', $wood_include) ? 'display:block' : 'display:none'); ?>">
						<div class="tap__input_set inline__input_field">
							<span class="input__no" style="margin: -2px 0 0 10px;">Specify:</span>
							<div class="tap__input_field" style="padding: 0 0 0 105px;margin-top: -8px;">
							  <input type="text" class="input_control bold-text input_control_specify" name="wood_include_text" value="<?php echo !empty($form_info_arr['wood_include_text'][0]) ? $form_info_arr['wood_include_text'][0] : 'N/A'; ?>">
							</div>
						</div>
					  </div>
                    </div>
                  </div>
                  <!-- End of input set -->
                </div>
                <!-- End of col -->
                <div class="col-sm-4">
				  <div class="tap__input_set">
                    <div class="tap__input_field checkbox">
                      <input type="checkbox" class="input_control" id="Moisture" name="wood_include" <?php echo (in_array('Excessive Moisture (J)', $wood_include) ? 'checked=checked' : null); ?> value="Excessive Moisture (J)" onClick="thisConnectB(this)">
                      <label for="Moisture">Excessive Moisture (J)</label>
                    </div>
                  </div>
                  <!-- End of input set -->
                  <div class="tap__input_set">
                    <div class="tap__input_field checkbox">
                      <input type="checkbox" class="input_control" id="Wood_Rot" name="wood_include" <?php echo (in_array('Wood Rot (M)', $wood_include) ? 'checked=checked' : null); ?> value="Wood Rot (M)" onClick="thisConnectB(this)">
                      <label for="Wood_Rot">Wood Rot (M)</label>
                    </div>
                  </div>
                  <!-- End of input set -->
				  <div class="tap__input_set">
                    <div class="tap__input_field checkbox">
                      <input type="checkbox" class="input_control" id="Foliage" name="wood_include" <?php echo (in_array('Heavy Foliage (N)', $wood_include) ? 'checked=checked' : null); ?> value="Heavy Foliage (N)" onClick="thisConnectB(this)">
                      <label for="Foliage">Heavy Foliage (N)</label>
                    </div>
                  </div>
                  <!-- End of input set -->
                  <div class="tap__input_set">
                    <div class="tap__input_field checkbox">
                      <input type="checkbox" class="input_control" id="Fence" name="wood_include" <?php echo (in_array('Wooden Fence in Contact with the Structure (R)', $wood_include) ? 'checked=checked' : null); ?> value="Wooden Fence in Contact with the Structure (R)" onClick="thisConnectB(this)">
                      <label for="Fence">Wooden Fence in Contact with the Structure (R)</label>
                    </div>
                  </div>
                  <!-- End of input set -->
                </div>
                <!-- End of col -->
              </div>
              <!-- End of inner row -->
            </div>
            <!-- End of col -->
            <div class="col-sm-12">
              <h5 class="text-center"><b>TEXAS OFFICIAL WOOD DESTROYING INSECT REPORT</b></h5>
              <div class="row">
                <div class="col-sm-5">
                  <span class="input__no d__block m-0">8. Inspection Reveals Visible Evidence in or on the structure:</span>
                  <span class="input__no d__block m-0">8A. Subterranean Termites</span>
                  <span class="input__no d__block m-0">8B. Drywood Termites</span>
                  <span class="input__no d__block m-0">8C. Formosan Termites</span>
                  <span class="input__no d__block m-0">8D. Carpenter Ants</span>
                  <span class="input__no d__block m-0">8E. Other Wood Destroying Insects Specify:<div class="tap__input_field" style="display:inline-block;width:30%;padding:0 0 0 8px;"><input type="text" class="input_control bold-text" name="other_wood_destroying_text" value="<?php echo !empty($form_info_arr['other_wood_destroying_text'][0]) ? $form_info_arr['other_wood_destroying_text'][0] : 'N/A'; ?>">
				  </div>
				  </span>
                </div>
                <div class="col-sm-7 grid_checkbox_layout">
                  <div class="row">
                    <div class="col-sm-4">
                      <p class="text-center m-0">Active Infestation</p>
                      <div class="row">
                        <div class="col-sm-6">
                          <div class="tap__input_field checkbox inline-checkbox">
                            <input type="checkbox" value="Yes" class="input_control" id="Infestation_yes" name="infestation_active1" <?php echo (in_array('Yes', $infestation_active1) ? 'checked=checked' : null); ?>>
                            <label for="Infestation_yes">Yes</label>
                          </div>
                          <div class="tap__input_field checkbox inline-checkbox">
                            <input type="checkbox" value="Yes" class="input_control" id="Infestation_yes2" name="infestation_active2" <?php echo (in_array('Yes', $infestation_active2) ? 'checked=checked' : null); ?>>
                            <label for="Infestation_yes2">Yes</label>
                          </div>
                          <div class="tap__input_field checkbox inline-checkbox">
                            <input type="checkbox" value="Yes" class="input_control" id="Infestation_yes3" name="infestation_active3" <?php echo (in_array('Yes', $infestation_active3) ? 'checked=checked' : null); ?>>
                            <label for="Infestation_yes3">Yes</label>
                          </div>
                          <div class="tap__input_field checkbox inline-checkbox">
                            <input type="checkbox" value="Yes" class="input_control" id="Infestation_yes4" name="infestation_active4" <?php echo (in_array('Yes', $infestation_active4) ? 'checked=checked' : null); ?>>
                            <label for="Infestation_yes4">Yes</label>
                          </div>
                          <div class="tap__input_field checkbox inline-checkbox">
                            <input type="checkbox" value="Yes" class="input_control" id="Infestation_yes5" name="infestation_active5" <?php echo (in_array('Yes', $infestation_active5) ? 'checked=checked' : null); ?>>
                            <label for="Infestation_yes5">Yes</label>
                          </div>
                        </div>
                        <div class="col-sm-6">
                          <div class="tap__input_field checkbox inline-checkbox">
                            <input type="checkbox" value="No" class="input_control" id="Infestation_no" name="infestation_active1" <?php echo (in_array('No', $infestation_active1) ? 'checked=checked' : null); ?>>
                            <label for="Infestation_no">No</label>
                          </div>
                          <div class="tap__input_field checkbox inline-checkbox">
                            <input type="checkbox" value="No" class="input_control" id="Infestation_no2" name="infestation_active2" <?php echo (in_array('No', $infestation_active2) ? 'checked=checked' : null); ?>>
                            <label for="Infestation_no2">No</label>
                          </div>
                          <div class="tap__input_field checkbox inline-checkbox">
                            <input type="checkbox" value="No" class="input_control" id="Infestation_no3" name="infestation_active3" <?php echo (in_array('No', $infestation_active3) ? 'checked=checked' : null); ?>>
                            <label for="Infestation_no3">No</label>
                          </div>
                          <div class="tap__input_field checkbox inline-checkbox">
                            <input type="checkbox" value="No" class="input_control" id="Infestation_no4" name="infestation_active4" <?php echo (in_array('No', $infestation_active4) ? 'checked=checked' : null); ?>>
                            <label for="Infestation_no4">No</label>
                          </div>
                          <div class="tap__input_field checkbox inline-checkbox">
                            <input type="checkbox" value="No" class="input_control" id="Infestation_no5" name="infestation_active5" <?php echo (in_array('No', $infestation_active5) ? 'checked=checked' : null); ?>>
                            <label for="Infestation_no5">No</label>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <p class="text-center m-0">Previous Infestation</p>
                      <div class="row">
                        <div class="col-sm-6">
                          <div class="tap__input_field checkbox inline-checkbox">
                            <input type="checkbox" value="Yes" class="input_control" id="Previous_Infestation_yes" name="infestation_previous1" <?php echo (in_array('Yes', $infestation_previous1) ? 'checked=checked' : null); ?>>
                            <label for="Previous_Infestation_yes">Yes</label>
                          </div>
                          <div class="tap__input_field checkbox inline-checkbox">
                            <input type="checkbox" value="Yes" class="input_control" id="Previous_Infestation_yes2" name="infestation_previous2" <?php echo (in_array('Yes', $infestation_previous2) ? 'checked=checked' : null); ?>>
                            <label for="Previous_Infestation_yes2">Yes</label>
                          </div>
                          <div class="tap__input_field checkbox inline-checkbox">
                            <input type="checkbox" value="Yes" class="input_control" id="Previous_Infestation_yes3" name="infestation_previous3" <?php echo (in_array('Yes', $infestation_previous3) ? 'checked=checked' : null); ?>>
                            <label for="Previous_Infestation_yes3">Yes</label>
                          </div>
                          <div class="tap__input_field checkbox inline-checkbox">
                            <input type="checkbox" value="Yes" class="input_control" id="Previous_Infestation_yes4" name="infestation_previous4" <?php echo (in_array('Yes', $infestation_previous4) ? 'checked=checked' : null); ?>>
                            <label for="Previous_Infestation_yes4">Yes</label>
                          </div>
                          <div class="tap__input_field checkbox inline-checkbox">
                            <input type="checkbox" value="Yes" class="input_control" id="Previous_Infestation_yes5" name="infestation_previous5" <?php echo (in_array('Yes', $infestation_previous5) ? 'checked=checked' : null); ?>>
                            <label for="Previous_Infestation_yes5">Yes</label>
                          </div>
                        </div>
                        <div class="col-sm-6">
                          <div class="tap__input_field checkbox inline-checkbox">
                            <input type="checkbox" value="No" class="input_control" id="Previous_Infestation_no" name="infestation_previous1" <?php echo (in_array('No', $infestation_previous1) ? 'checked=checked' : null); ?>>
                            <label for="Previous_Infestation_no">No</label>
                          </div>
                          <div class="tap__input_field checkbox inline-checkbox">
                            <input type="checkbox" value="No" class="input_control" id="Previous_Infestation_no2" name="infestation_previous2" <?php echo (in_array('No', $infestation_previous2) ? 'checked=checked' : null); ?>>
                            <label for="Previous_Infestation_no2">No</label>
                          </div>
                          <div class="tap__input_field checkbox inline-checkbox">
                            <input type="checkbox" value="No" class="input_control" id="Previous_Infestation_no3" name="infestation_previous3" <?php echo (in_array('No', $infestation_previous3) ? 'checked=checked' : null); ?>>
                            <label for="Previous_Infestation_no3">No</label>
                          </div>
                          <div class="tap__input_field checkbox inline-checkbox">
                            <input type="checkbox" value="No" class="input_control" id="Previous_Infestation_no4" name="infestation_previous4" <?php echo (in_array('No', $infestation_previous4) ? 'checked=checked' : null); ?>>
                            <label for="Previous_Infestation_no4">No</label>
                          </div>
                          <div class="tap__input_field checkbox inline-checkbox">
                            <input type="checkbox" value="No" class="input_control" id="Previous_Infestation_no5" name="infestation_previous5" <?php echo (in_array('No', $infestation_previous5) ? 'checked=checked' : null); ?>>
                            <label for="Previous_Infestation_no5">No</label>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <p class="text-center m-0">Previous Treatment</p>
                      <div class="row">
                        <div class="col-sm-6">
                          <div class="tap__input_field checkbox inline-checkbox">
                            <input type="checkbox" value="Yes" class="input_control" id="Previous_Treatment_yes" name="treatment_previous1" <?php echo (in_array('Yes', $treatment_previous1) ? 'checked=checked' : null); ?>>
                            <label for="Previous_Treatment_yes">Yes</label>
                          </div>
                          <div class="tap__input_field checkbox inline-checkbox">
                            <input type="checkbox" value="Yes" class="input_control" id="Previous_Treatment_yes2" name="treatment_previous2" <?php echo (in_array('Yes', $treatment_previous2) ? 'checked=checked' : null); ?>>
                            <label for="Previous_Treatment_yes2">Yes</label>
                          </div>
                          <div class="tap__input_field checkbox inline-checkbox">
                            <input type="checkbox" value="Yes" class="input_control" id="Previous_Treatment_yes3" name="treatment_previous3" <?php echo (in_array('Yes', $treatment_previous3) ? 'checked=checked' : null); ?>>
                            <label for="Previous_Treatment_yes3">Yes</label>
                          </div>
                          <div class="tap__input_field checkbox inline-checkbox">
                            <input type="checkbox" value="Yes" class="input_control" id="Previous_Treatment_yes4" name="treatment_previous4" <?php echo (in_array('Yes', $treatment_previous4) ? 'checked=checked' : null); ?>>
                            <label for="Previous_Treatment_yes4">Yes</label>
                          </div>
                          <div class="tap__input_field checkbox inline-checkbox">
                            <input type="checkbox" value="Yes" class="input_control" id="Previous_Treatment_yes5" name="treatment_previous5" <?php echo (in_array('Yes', $treatment_previous5) ? 'checked=checked' : null); ?>>
                            <label for="Previous_Treatment_yes5">Yes</label>
                          </div>
                        </div>
                        <div class="col-sm-6">
                          <div class="tap__input_field checkbox inline-checkbox">
                            <input type="checkbox" value="No" class="input_control" id="Previous_Treatment_no" name="treatment_previous1" <?php echo (in_array('No', $treatment_previous1) ? 'checked=checked' : null); ?>>
                            <label for="Previous_Treatment_no">No</label>
                          </div>
                          <div class="tap__input_field checkbox inline-checkbox">
                            <input type="checkbox" value="No" class="input_control" id="Previous_Treatment_no2" name="treatment_previous2" <?php echo (in_array('No', $treatment_previous2) ? 'checked=checked' : null); ?>>
                            <label for="Previous_Treatment_no2">No</label>
                          </div>
                          <div class="tap__input_field checkbox inline-checkbox">
                            <input type="checkbox" value="No" class="input_control" id="Previous_Treatment_no3" name="treatment_previous3" <?php echo (in_array('No', $treatment_previous3) ? 'checked=checked' : null); ?>>
                            <label for="Previous_Treatment_no3">No</label>
                          </div>
                          <div class="tap__input_field checkbox inline-checkbox">
                            <input type="checkbox" value="No" class="input_control" id="Previous_Treatment_no4" name="treatment_previous4" <?php echo (in_array('No', $treatment_previous4) ? 'checked=checked' : null); ?>>
                            <label for="Previous_Treatment_no4">No</label>
                          </div>
                          <div class="tap__input_field checkbox inline-checkbox">
                            <input type="checkbox" value="No" class="input_control" id="Previous_Treatment_no5" name="treatment_previous5" <?php echo (in_array('No', $treatment_previous5) ? 'checked=checked' : null); ?>>
                            <label for="Previous_Treatment_no5">No</label>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- End of row -->
            </div>
            <!-- End of col -->
            <div class="col-sm-12">
              <div class="tap__input_set inline__input_field">
                <span class="input__no">8F. Explanation of signs of previous treatment (including pesticides, baits, existing treatment stickers or other methods) identified:</span>
                <div class="tap__input_field">
                  <input type="text" class="input_control bold-text" name="previous_treatment_text" value="<?php echo !empty($form_info_arr['previous_treatment_text'][0]) ? $form_info_arr['previous_treatment_text'][0] : 'N/A'; ?>">
                </div>
              </div>
              <!-- End of input set -->
              <div class="tap__input_set inline__input_field">
                <span class="input__no">8G. Visible evidence of:</span>
                <div class="tap__input_field">
                  <input type="text" class="input_control bold-text" name="visible_evidence_text" value="<?php echo !empty($form_info_arr['visible_evidence_text'][0]) ? $form_info_arr['visible_evidence_text'][0] : 'N/A'; ?>">
                </div>
              </div>
              <!-- End of input set -->
              <div class="tap__input_set inline__input_field">
                <span class="input__no">has been observed in the following areas:</span>
                <div class="tap__input_field">
                  <input type="text" class="input_control bold-text" name="observed_areas_text" value="<?php echo !empty($form_info_arr['observed_areas_text'][0]) ? $form_info_arr['observed_areas_text'][0] : 'N/A'; ?>">
                  <label for="">If there is visible evidence of active or previous infestation, it must be noted. The type of insect(s) must be listed in the first blank and all identified infested areas of the property inspected must be noted in the second blank. (Refer to Part D, E & F, Scope of Inspection)</label>
                </div>
              </div>
              <!-- End of input set -->
              <span class="input__no">The conditions conducive to insect infestation reported in 7A & 7B:</span>
            </div>
            <!-- End of col -->
            <div class="col-sm-12 grid_checkbox_layout">
              <div class="row">
                <div class="col-sm-9">
                  <div class="tap__input_set inline__input_field">
                    <span class="input__no">9. Will be or has been mechanically corrected by inspecting company:</span>
                    <div class="tap__input_field">
                      <input type="text" class="input_control bold-text" name="mechanically_corrected_text" value="<?php echo !empty($form_info_arr['mechanically_corrected_text'][0]) ? $form_info_arr['mechanically_corrected_text'][0] : 'N/A'; ?>">
                    </div>
                  </div>
                  <!-- End of input set -->
                </div>
                <div class="col-sm-3">
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="tap__input_field checkbox inline-checkbox">
                        <input type="checkbox" value="Yes" class="input_control" id="mechanically_corrected_yes" name="mechanically_corrected" <?php echo (in_array('Yes', $mechanically_corrected) ? 'checked=checked' : null); ?>>
                        <label for="mechanically_corrected_yes">Yes</label>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="tap__input_field checkbox inline-checkbox">
                        <input type="checkbox" value="No" class="input_control" id="mechanically_corrected_no" name="mechanically_corrected" <?php echo (in_array('No', $mechanically_corrected) ? 'checked=checked' : null); ?>>
                        <label for="mechanically_corrected_no">No</label>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <span class="input__no">If “Yes,” specify corrections:</span>
            </div>
            <!-- End of col -->
            <div class="col-sm-12 grid_checkbox_layout">
              <div class="row">
                <div class="col-sm-9">
                  <div class="tap__input_set inline__input_field">
                    <span class="input__no">9A. Corrective treatment recommended for active infestation or evidence of previous infestation with no prior treatment as <br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; identified in Section 8. (Refer to Part G, H, and I, Scope of Inspection)</span>
                  </div>
                  <!-- End of input set -->
                </div>
                <div class="col-sm-3">
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="tap__input_field checkbox inline-checkbox">
                        <input type="checkbox" value="Yes" class="input_control" id="Corrective_treatment_yes" name="corrective_treatment" <?php echo (in_array('Yes', $corrective_treatment) ? 'checked=checked' : null); ?>>
                        <label for="Corrective_treatment_yes">Yes</label>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="tap__input_field checkbox inline-checkbox">
                        <input type="checkbox" value="No" class="input_control" id="Corrective_treatment_no" name="corrective_treatment" <?php echo (in_array('No', $corrective_treatment) ? 'checked=checked' : null); ?>>
                        <label for="Corrective_treatment_no">No</label>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- End of col -->
            <div class="col-sm-12 grid_checkbox_layout">
              <div class="row">
                <div class="col-sm-9">
                  <div class="tap__input_set inline__input_field">
                    <span class="input__no">9B. A preventive treatment and/or correction of conducive conditions as identified in 7A & 7B is recommended as follows:</span>
                  </div>
                  <!-- End of input set -->
                </div>
                <div class="col-sm-3">
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="tap__input_field checkbox inline-checkbox">
                        <input type="checkbox" value="Yes" class="input_control" id="preventive_treatment_yes" name="preventive_treatment" <?php echo (in_array('Yes', $preventive_treatment) ? 'checked=checked' : null); ?>>
                        <label for="preventive_treatment_yes">Yes</label>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="tap__input_field checkbox inline-checkbox">
                        <input type="checkbox" value="No" class="input_control" id="preventive_treatment_no" name="preventive_treatment" <?php echo (in_array('No', $preventive_treatment) ? 'checked=checked' : null); ?>>
                        <label for="preventive_treatment_no">No</label>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- End of col -->
            <div class="col-sm-12">
              <div class="tap__input_set inline__input_field">
                <span class="input__no-">Specify reason: <span id="specifyReason">Wood to ground, debris, ventilation, soil too high, excessive moisture</span></span>
                <div class="tap__input_field-">
                  <!--<input type="text" class="input_control bold-text">-->
                  <label for="">(Refer to Scope of Inspection Part J)</label>
                </div>
              </div>
              <!-- End of tap input field -->
              <div class="tap__input_set inline__input_field">
                <span class="input__no">10A. This Company has treated or is treating the structure for the following wood destroying insects:</span>
                <div class="tap__input_field">
                  <input type="text" class="input_control bold-text" name="treated_treating_text" value="<?php echo !empty($form_info_arr['treated_treating_text'][0]) ? $form_info_arr['treated_treating_text'][0] : 'N/A'; ?>">
                </div>
              </div>
              <!-- End of tap input field -->
              <div class="tap__input_set">
                <span class="input__no">If treating for subterranean termites, the treatment was:</span>
                <div class="tap__input_field checkbox inline-checkbox">
                  <input type="checkbox" value="Partial" class="input_control" id="Partial" name="subterranean_termites" <?php echo (in_array('Partial', $subterranean_termites) ? 'checked=checked' : null); ?>>
                  <label for="Partial">Partial</label>
                </div>
                <div class="tap__input_field checkbox inline-checkbox">
                  <input type="checkbox" value="Spot" class="input_control" id="Spot" name="subterranean_termites" <?php echo (in_array('Spot', $subterranean_termites) ? 'checked=checked' : null); ?>>
                  <label for="Spot">Spot</label>
                </div>
                <div class="tap__input_field checkbox inline-checkbox">
                  <input type="checkbox" value="Bait" class="input_control" id="Bait" name="subterranean_termites" <?php echo (in_array('Bait', $subterranean_termites) ? 'checked=checked' : null); ?>>
                  <label for="Bait">Bait</label>
                </div>
                <div class="tap__input_field checkbox inline-checkbox">
                  <input type="checkbox" value="Other" class="input_control" id="Other" name="subterranean_termites" <?php echo (in_array('Other', $subterranean_termites) ? 'checked=checked' : null); ?>>
                  <label for="Other">Other</label>
                </div>
              </div>
              <!-- End of tap input field -->
              <div class="tap__input_set">
                <span class="input__no">If treating for drywood termites or related insects, the treatment was:</span>
                <div class="tap__input_field checkbox inline-checkbox">
                  <input type="checkbox" value="Full" class="input_control" id="Full" name="treating_drywood" <?php echo (in_array('Full', $treating_drywood) ? 'checked=checked' : null); ?>>
                  <label for="Full">Full</label>
                </div>
                <div class="tap__input_field checkbox inline-checkbox">
                  <input type="checkbox" value="Limited" class="input_control" id="Limited" name="treating_drywood" <?php echo (in_array('Full', $treating_drywood) ? 'checked=checked' : null); ?>>
                  <label for="Limited">Limited</label>
                </div>
              </div>
              <!-- End of tap input field -->
            </div>
            <!-- End of col -->
            <div class="row">
              <div class="col-sm-6">
                <div class="tap__input_set">
                <span class="input__no">10B.</span>
                <div class="tap__input_field">
                  <input type="text" class="input_control bold-text" name="date_of_treatment" value="<?php echo !empty($form_info_arr['date_of_treatment'][0]) ? $form_info_arr['date_of_treatment'][0] : 'N/A'; ?>">
                  <label for="">Date of Treatment by Inspecting Company</label>
                </div>
              </div>
              <!-- End of input set -->
              </div>
              <!-- End of col -->
              <div class="col-sm-3">
                <div class="tap__input_set">
                  <div class="tap__input_field">
                    <input type="text" class="input_control bold-text" name="common_name_of_insect" value="<?php echo !empty($form_info_arr['common_name_of_insect'][0]) ? $form_info_arr['common_name_of_insect'][0] : 'N/A'; ?>">
                    <label for="">Common Name of Insect</label>
                  </div>
                </div>
              <!-- End of input set -->
              </div>
              <!-- End of col -->
              <div class="col-sm-3">
                <div class="tap__input_set">
                  <div class="tap__input_field">
                    <input type="text" class="input_control bold-text" name="name_of_pesticide" value="<?php echo !empty($form_info_arr['name_of_pesticide'][0]) ? $form_info_arr['name_of_pesticide'][0] : 'N/A'; ?>">
                    <label for="">Name of Pesticide, Bait or Other Method</label>
                  </div>
                </div>
              <!-- End of input set -->
              </div>
              <!-- End of col -->
              <div class="col-sm-12">
                <span class="input__no">This company has a contract or warranty in effect for control of the following wood destroying insects:</span>
				<div class="input__no">
                <div class="tap__input_field checkbox inline-checkbox">
                  <input type="checkbox" value="Yes" class="input_control" id="company_contract_Yes" name="company_contract_warranty" <?php echo (in_array('Yes', $company_contract_warranty) ? 'checked=checked' : null); ?>>
                  <label for="company_contract_Yes">Yes</label>
                </div>
                <div class="tap__input_field checkbox inline-checkbox">
                  <input type="checkbox" value="No" class="input_control" id="company_contract_No" name="company_contract_warranty" <?php echo (in_array('No', $company_contract_warranty) ? 'checked=checked' : null); ?>>
                  <label for="company_contract_No">No</label>
                </div>
				</div>
				<div class="input__no">
                  <span class="input__no" style="padding-left: 10px;"> List Insects:</span>
                  <div class="tap__input_field" style="padding: 0 0 0 85px;">
                    <input type="text" class="input_control bold-text" name="list_insects" value="<?php echo !empty($form_info_arr['list_insects'][0]) ? $form_info_arr['list_insects'][0] : 'N/A'; ?>">
                  </div>
                </div>
                <span class="input__no">If “Yes”, copy (ies) of warranty and treatment diagram must be attached.</span>
              </div>
              <!-- End of col -->
            </div>
            <!-- End of row -->
			<div class="pagefooter" style="color:#7E7E7E;font-size:12px;text-align: center;clear:both;">
				<br/>
				<br/>
				<br/>
				<br/>
				<br/><br/>
				<br/><br/><br/><br/>
				Licensed and Regulated by the Texas Department of Agriculture<br/>
				P.O. Box 12847, Austin, Texas 78711-2847<br/>
				Phone 866-918-4481, Fax 888-232-2567
				<br/><br/><br/>
			</div>
            <div class="col-sm-12" style="margin-top:5px;">
              <h5 class="text-center"><b>Diagram of Structure(s) Inspected</b></h5>
              <span class="input__no">The inspector must draw a diagram including approximate perimeter measurements and indicate active or previous infestation and type of insect by using the following codes: E-Evidence of Infestation, A-Active; P-Previous; D-Drywood Termites; S-Subterranean Termites; F-Formosan Termites; C-Conducive Conditions; B-Wood Boring Beetles</span>
              <div class="tap__input_set inline__input_field">
                <span class="input__no">H-Carpenter Ants; Other(s) – Specify</span>
                <div class="tap__input_field">
                  <input type="text" class="input_control bold-text" name="carpenter_specify" value="<?php echo !empty($form_info_arr['carpenter_specify'][0]) ? $form_info_arr['carpenter_specify'][0] : 'N/A'; ?>">
                  <span class="">See section 7B. for conducive conditions letter codes</span>
                </div>
              </div>
              <!-- End of input field -->
              <div class="diagram_img">
				<div class="fileinput flex flexcenter hovereffect">	
				<div class="documentHides" style="position:absolute;top:-77px;border:1px solid #000;background:#fff;padding:3px;width: 164px;" ng-hide="imageFileMess">
					<a class="goToDrawing frontend-button mediaUploderClb" href="#"><i class="fa fa-picture-o" aria-hidden="true"></i> Open media <i class="fa fa-expand" aria-hidden="true"></i></a>
					<a class="goToDrawing annotate_upload_button_tem" dataurl="<?php echo home_url('/canvas-drawing/?report='.$report_id.'&item='.$template_id.'&hash='.$saved); ?>" targetUrl="#target={{control.url}}" href="#"><i class="fa fa-picture-o" aria-hidden="true"></i> Annotate Image <i class="fa fa-arrow-circle-right" aria-hidden="true"></i></a>
					<a class="goToDrawing survey_upload_button_tem" dataurl="<?php echo home_url('/design-draw/?report='.$report_id.'&item='.$template_id.'&hash='.$saved); ?>" targetUrl="" href="#"><i class="fa fa-picture-o" aria-hidden="true"></i> Survey Drawing <i class="fa fa-arrow-circle-right" aria-hidden="true"></i></a>
				</div>
				<i class="fa fa-folder-open"></i>
			  </div>
				<?php $woodImgItem = esc_url( get_template_directory_uri() ).'/woodInspection/img/Diagram.png'; ?>
                <img id="woodImgItem" src="<?php echo !empty($form_info_arr['woodImgItemInput'][0]) ? $form_info_arr['woodImgItemInput'][0] : $woodImgItem; ?>" alt="..." class="img-responsive">
				<input type="text" name="woodImgItemInput" id="woodImgItemInput" value="" style="display:none;">
              </div>
            </div>
            <!-- End of col -->			
            <div class="col-sm-12">
              <div class="tap__input_set">
                <span class="input__no">Additional Comments:</span>
				<div class="input__no understand_checkbox">
					<div class="tap__input_field checkbox inline-checkbox">
					  <input type="checkbox" value="Post tension slab" class="input_control" id="slab" name="additional_comments" <?php echo (in_array('Post tension slab', $additional_comments) ? 'checked=checked' : null); ?>>
					  <label for="slab">Post tension slab</label>
					</div>
					<div class="tap__input_field checkbox inline-checkbox">
					  <input type="checkbox" value="Slab on grade" class="input_control" id="grade" name="additional_comments" <?php echo (in_array('Slab on grade', $additional_comments) ? 'checked=checked' : null); ?>>
					  <label for="grade">Slab on grade</label>
					</div>
					<div class="tap__input_field checkbox inline-checkbox">
					  <input type="checkbox" value="Pier and Beam" class="input_control" id="Beam" name="additional_comments" <?php echo (in_array('Pier and Beam', $additional_comments) ? 'checked=checked' : null); ?>>
					  <label for="Beam">Pier and Beam</label>
					</div>
				</div>
                <span class="input__no">Neither I nor the company for which I am acting have had, presently have, or contemplate having any interest in the property. I do further state that neither I nor the company for which I am acting is associated in any way with any party to this transaction.</span>
              </div>
            </div>
            <!-- End of col -->
            <div class="row">
              <div class="col-sm-6">
                <span class="input__no d__block">Signatures:</span>
                <div class="tap__input_set">
                  <span class="input__no">11A.</span>
                  <div class="tap__input_field">
                    <input type="text" class="input_control bold-text input_control_12" value="<?php echo !empty($inspector_name) ? $inspector_name : 'N/A'; echo !empty($form_data->company_phone) ? ' TDA#'.$form_data->company_phone : 'N/A'; ?>" readonly><span class="input_no_right">12A.</span>
                    <label for="">Inspector</label>
                  </div>
                </div>
                <!-- End of input set -->
                <span class="input__no d__block">Approved:</span>
                <div class="tap__input_set">
                  <span class="input__no">11B.</span>
                  <div class="tap__input_field">
                    <input type="text" class="input_control bold-text input_control_12" value="<?php echo !empty($inspector_name) ? $inspector_name : 'N/A'; echo !empty($licence_number) ? ' TPCL#'.$licence_number : 'N/A'; ?>" readonly><span class="input_no_right">12B.</span>
                    <label for="">Certified Applicator and Certified Applicator License Number</label>
                  </div>
                </div>
                <!-- End of input set -->
              </div>
              <!-- End of col -->
              <div class="col-sm-6">
                <span class="input__no d__block">Notice of Inspection was posted at or near</span>
                <div class="tap__input_set">
                  <div class="tap__input_field checkbox inline-checkbox-">
                    <input type="checkbox" value="Electric Breaker Box" class="input_control" id="Breaker" name="notice_of_inspection" <?php echo (in_array('Electric Breaker Box', $notice_of_inspection) ? 'checked=checked' : null); ?>>
                    <label for="Breaker">Electric Breaker Box</label>
                  </div>
                </div>
                <!-- End of input set -->
                <div class="tap__input_set">
                  <div class="tap__input_field checkbox inline-checkbox-">
                    <input type="checkbox" value="Water Heater Closet" class="input_control" id="Heater" name="notice_of_inspection" <?php echo (in_array('Water Heater Closet', $notice_of_inspection) ? 'checked=checked' : null); ?>>
                    <label for="Heater">Water Heater Closet</label>
                  </div>
                </div>
                <!-- End of input set -->
                <div class="tap__input_set">
                  <div class="tap__input_field checkbox inline-checkbox-">
                    <input type="checkbox" value="Beneath the Kitchen Sink" class="input_control" id="Sink" name="notice_of_inspection" <?php echo (in_array('Beneath the Kitchen Sink', $notice_of_inspection) ? 'checked=checked' : null); ?>>
                    <label for="Sink">Beneath the Kitchen Sink</label>
                  </div>
                </div>
                <!-- End of input set -->
                <div class="tap__input_set">
                  <span class="input__no">Date Posted</span>
                  <div class="tap__input_field tap__date_posted">
                    <input type="text" class="input_control bold-text" value="<?php echo !empty($get_inspection->inpection_date) ? date('F j, Y', strtotime($get_inspection->inpection_date)) : 'N/A'; ?>" readonly>
                    <label for="">Date</label>
                  </div>
                </div>
                <!-- End of input set -->
              </div>
              <!-- End of col -->
            </div>
            <!-- End of inner row -->
            <div class="col-sm-12">
              <h5 class="text-center"><b>Statement of Purchaser</b></h5>
              <span class="input__no">I have received the original or a legible copy of this form. I have read and understand any recommendations made. I have also read and understand the “Scope of inspection.”</span>
              <div class="tap__input_set inline__input_field">
                <span class="input__no">I understand that my inspector may provide additional information as an addendum to this report. If additional information is attached, list number of pages:</span>
                <div class="tap__input_field">
                  <input type="text" class="input_control bold-text" name="understand_inspector" value="<?php echo !empty($form_info_arr['understand_inspector'][0]) ? $form_info_arr['understand_inspector'][0] : 'N/A'; ?>">
                </div>
              </div>
              <span class="input__no">I agree to receive email correspondence from Inspectors service group, related to this inspection and/or future pest control services, and/or discounts/offers.</span>
              <div class="row">
                <div class="col-sm-6">
                  <span class="input__no d__block m-0">Signature of Purchaser of Property or their Designee</span>
                  <input type="text" class="input_control bold-text" name="signature_purchaser" value="<?php echo !empty($form_info_arr['signature_purchaser'][0]) ? $form_info_arr['signature_purchaser'][0] : 'N/A'; ?>">
                </div>
                <div class="col-sm-6">
                  <span class="input__no d__block m-0">Date</span>
                  <input type="text" class="input_control bold-text" name="signature_date" value="<?php echo !empty($form_info_arr['signature_date'][0]) ? $form_info_arr['signature_date'][0] : 'N/A'; ?>">
                </div>
              </div>
            </div>
            <!-- End of col -->
          </div>
          <!-- End of row -->
          <div class="address_block text-center">
            <h4><?php echo !empty($form_data->companyId) ? $form_data->companyId : 'N/A'; ?></h4>
            <p>Administrative office and mailing address</p>
            <p><?php echo !empty($form_data->footer_html) ? $form_data->footer_html : ''; ?></p>
          </div>
		  <br/>
		  <div class="pagefooter" style="color:#7E7E7E;font-size:12px;text-align: center;clear:both;">
				Licensed and Regulated by the Texas Department of Agriculture<br/>
				P.O. Box 12847, Austin, Texas 78711-2847<br/>
				Phone 866-918-4481, Fax 888-232-2567
		  </div>
		  <div class="tinymceWoodMainDiv">			
			<textarea class="tinymceWoodIns" name="footer_html_area" id="footer_html_area"><?php echo !empty($form_info_arr['footer_html_area'][0]) ? $form_info_arr['footer_html_area'][0] : 'N/A'; ?></textarea>
		  </div>
		  <div id="previewContent"></div>
	  
        </div>
        <!-- End of tap__form content -->
      </div>
      <!-- End of container -->
    </div>
  </div> 
  <?php if($report_id){ ?>
    <div class="actions">
	  <div class="msg_show form-view-msg" style="display:inline-block;"></div>
	  <a href="javascript:void(0)" style="margin-bottom:10px;" class="btn-taptap saveChanges" onclick="woodInspectionSave()">
        <i class="fa fa-floppy-o" aria-hidden="true"></i> Save Changes
      </a>
	  <?php if(!empty($form_data->print_btn) && $form_data->print_btn == 'true'){ ?>
	  <a href="javascript:void(0)" onClick="printTemplateBtn()" class="printTemplateBtn btn-taptap"><i class="fa fa-print" aria-hidden="true"></i> Print / Save to PDF</a>
	  <?php } ?>
    </div>
	<?php } else { ?>
		<style>
		.fileinput{display:none;}
		.wysiwygpretend .button{display:none;}
		</style>
	<?php } ?>
  <?php get_footer('viewer'); ?>
  <script type="text/javascript">
	var ajax_url = '<?php echo admin_url('admin-ajax.php'); ?>';
	var template_id = <?php echo $template_id; ?>;	
	var inspection_id = <?php echo $report_id; ?>;
	var saved = <?php echo $saved; ?>;
	var site_url = '<?php echo home_url(); ?>';
</script> 
  <script src="<?php echo esc_url( get_template_directory_uri() ); ?>/woodInspection/js/jquery.js"></script>
  <script type="text/javascript" src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/js/bower_components/tinymce/tinymce.js"></script>
    <script src="<?php echo esc_url( get_template_directory_uri() ); ?>/woodInspection/js/bootstrap.min.js"></script>
	<script src="<?php echo esc_url( get_template_directory_uri() ); ?>/js/jQuery.print.js"></script>
	<script src="<?php echo esc_url( get_template_directory_uri() ); ?>/woodInspection/js/main.js"></script>
	<style>
		label{font-weight:normal;margin:0;padding-left:0px;}
	</style>