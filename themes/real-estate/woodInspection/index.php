  <div id="templateViewerdd">
  <!--bootstrap css-->
    <link rel="stylesheet" href="<?php echo esc_url( get_template_directory_uri() ); ?>/woodInspection/css/bootstrap.min.css" />
    <!--css for this template-->
	<?php $template_directory_uri = get_template_directory_uri(); ?>	
	<link rel="stylesheet" href="<?php echo esc_url( $template_directory_uri . '/woodInspection/css/main-template.css"' ); ?>" />
    <link rel="stylesheet" href="<?php echo esc_url( get_template_directory_uri() ); ?>/woodInspection/css/main.css" />
	<link rel="stylesheet" href="<?php echo esc_url( get_template_directory_uri() ); ?>/woodInspection/css/custom.css">
    <div class="tap__raw_form_body templateViewer">
      <div class="container">
        <h2 class="tap__form-title text-center">TEXAS OFFICIAL WOOD DESTROYING INSECT REPORT</h2>
        <div class="row tap__address area">
          <div class="col-sm-4">
            <p>1319 Lansford Ave <span>Inspected Address</span></p>
          </div>
          <!-- End of col -->
          <div class="col-sm-4 text-center">
            <p>Dallas <span>City</span></p>
          </div>
          <!-- End of col -->
          <div class="col-sm-4 text-right">
            <p>75244 <span>Zip Code</span></p>
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
            <div class="col-sm-9">
              <div class="tap__input_set">
                <span class="input__no">1A.</span>
                <div class="tap__input_field">
                  <input type="text" class="input_control">
                  <label for="">Name of Inspection Company</label>
                </div>
              </div>
              <!-- End of input set -->
            </div>
            <!-- End of col -->
            <div class="col-sm-3">
              <div class="tap__input_set">
                <span class="input__no">1B.</span>
                <div class="tap__input_field">
                  <input type="text" class="input_control">
                  <label for="">SPCB Business License Number</label>
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
                <span class="input__no">1C.</span>
                <div class="tap__input_field">
                  <input type="text" class="input_control">
                  <label for="">Address of Inspection Company</label>
                </div>
              </div>
              <!-- End of input set -->
            </div>
            <!-- End of col -->
            <div class="col-sm-7">
              <div class="row">
                <div class="col-sm-3">
                  <div class="tap__input_set">
                    <div class="tap__input_field">
                      <input type="text" class="input_control">
                      <label for="">City</label>
                    </div>
                  </div>
                  <!-- End of input set -->
                </div>
                <!-- End of col -->
                <div class="col-sm-3">
                  <div class="tap__input_set">
                    <div class="tap__input_field">
                      <input type="text" class="input_control">
                      <label for="">State</label>
                    </div>
                  </div>
                  <!-- End of input set -->
                </div>
                <!-- End of col -->
                <div class="col-sm-3">
                  <div class="tap__input_set">
                    <div class="tap__input_field">
                      <input type="text" class="input_control">
                      <label for="">Zip</label>
                    </div>
                  </div>
                  <!-- End of input set -->
                </div>
                <!-- End of col -->
                <div class="col-sm-3">
                  <div class="tap__input_set">
                    <div class="tap__input_field">
                      <input type="text" class="input_control">
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
                  <input type="text" class="input_control">
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
                  <input type="checkbox" class="input_control" id="applicator" name="Inspector">
                  <label for="applicator">Certified Applicator</label>
                </div>
              </div>
              <!-- End of input set -->
              <div class="tap__input_set">
                <div class="tap__input_field checkbox">
                  <input type="checkbox" class="input_control" id="technician" name="Inspector">
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
                  <input type="text" class="input_control">
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
                  <input type="text" class="input_control">
                  <label for="">Inspection Date</label>
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
                <span class="input__no">4A.</span>
                <div class="tap__input_field">
                  <input type="text" class="input_control">
                  <label for="">Name of Person Purchasing Inspection</label>
                </div>
              </div>
              <!-- End of input set -->
            </div>
            <!-- End of col -->
            <div class="col-sm-6">
              <div class="tap__input_set">
                <div class="tap__input_field checkbox inline-checkbox">
                  <input type="checkbox" class="input_control" id="Seller" name="Inspector">
                  <label for="Seller">Seller</label>
                </div>
                <div class="tap__input_field checkbox inline-checkbox">
                  <input type="checkbox" class="input_control" id="Agent" name="Inspector">
                  <label for="Agent">Agent</label>
                </div>
                <div class="tap__input_field checkbox inline-checkbox">
                  <input type="checkbox" class="input_control" id="Buyer" name="Inspector">
                  <label for="Buyer">Buyer</label>
                </div>
                <div class="tap__input_field checkbox inline-checkbox">
                  <input type="checkbox" class="input_control" id="Management" name="Inspector">
                  <label for="Management">Management Co.</label>
                </div>
                <div class="tap__input_field checkbox inline-checkbox">
                  <input type="checkbox" class="input_control" id="Other_purchase" name="Inspector">
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
                  <input type="text" class="input_control">
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
                  <input type="checkbox" class="input_control" id="Mortgagee" name="Inspector">
                  <label for="Mortgagee">Title Company or Mortgagee</label>
                </div>
                <div class="tap__input_field checkbox inline-checkbox">
                  <input type="checkbox" class="input_control" id="Purchaser_Service" name="Inspector">
                  <label for="Purchaser_Service">Purchaser of Service</label>
                </div>
                <div class="tap__input_field checkbox inline-checkbox">
                  <input type="checkbox" class="input_control" id="Seller2" name="Inspector">
                  <label for="Seller2">Seller</label>
                </div>
                <div class="tap__input_field checkbox inline-checkbox">
                  <input type="checkbox" class="input_control" id="Agent2" name="Inspector">
                  <label for="Agent2">Agent</label>
                </div>
                <div class="tap__input_field checkbox inline-checkbox">
                  <input type="checkbox" class="input_control" id="Buyer2" name="Inspector">
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
                  <input type="text" class="input_control">
                  <label for="">List structure(s) inspected that may include residence, detached garages and other structures on the property. (Refer to Part A, Scope of Inspection)</label>
                </div>
              </div>
              <!-- End of input set -->
              <div class="tap__input_set">
                <span class="input__no">6A. Were any areas of the property obstructed or inaccessible?</span>
                <div class="tap__input_field checkbox inline-checkbox">
                  <input type="checkbox" class="input_control" id="property_yes" name="Inspector">
                  <label for="property_yes">Yes</label>
                </div>
                <div class="tap__input_field checkbox inline-checkbox">
                  <input type="checkbox" class="input_control" id="property_no" name="Inspector">
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
                      <input type="checkbox" class="input_control" id="Attic" name="Inspector">
                      <label for="Attic">Attic</label>
                    </div>
                  </div>
                  <!-- End of input set -->
                  <div class="tap__input_set">
                    <div class="tap__input_field checkbox">
                      <input type="checkbox" class="input_control" id="Deck" name="Inspector">
                      <label for="Deck">Deck</label>
                    </div>
                  </div>
                  <!-- End of input set -->
                  <div class="tap__input_set">
                    <div class="tap__input_field checkbox">
                      <input type="checkbox" class="input_control" id="Soil_Grade" name="Inspector">
                      <label for="Soil_Grade">Soil Grade Too High</label>
                    </div>
                  </div>
                  <!-- End of input set -->
                  <div class="tap__input_set">
                    <div class="tap__input_field checkbox">
                      <input type="checkbox" class="input_control" id="Other_obstructed" name="Inspector">
                      <label for="Other_obstructed">Other</label>
                    </div>
                  </div>
                  <!-- End of input set -->
                </div>
                <!-- End of col -->
                <div class="col-sm-3">
                  <div class="tap__input_set">
                    <div class="tap__input_field checkbox">
                      <input type="checkbox" class="input_control" id="Insulated_attic" name="Inspector">
                      <label for="Insulated_attic">Insulated area of attic</label>
                    </div>
                  </div>
                  <!-- End of input set -->
                  <div class="tap__input_set">
                    <div class="tap__input_field checkbox">
                      <input type="checkbox" class="input_control" id="Sub_Floors" name="Inspector">
                      <label for="Sub_Floors">Sub Floors</label>
                    </div>
                  </div>
                  <!-- End of input set -->
                  <div class="tap__input_set">
                    <div class="tap__input_field checkbox">
                      <input type="checkbox" class="input_control" id="Heavy_Foliage" name="Inspector">
                      <label for="Heavy_Foliage">Heavy Foliage</label>
                    </div>
                  </div>
                  <!-- End of input set -->
                  <div class="tap__input_set">
                    <div class="tap__input_field checkbox">
                      <input type="checkbox" class="input_control" id="Specify:" name="Inspector">
                      <label for="Specify:">Specify</label>
                    </div>
                  </div>
                  <!-- End of input set -->
                </div>
                <!-- End of col -->
                <div class="col-sm-3">
                  <div class="tap__input_set">
                    <div class="tap__input_field checkbox">
                      <input type="checkbox" class="input_control" id="Plumbing_Areas" name="Inspector">
                      <label for="Plumbing_Areas">Plumbing Areas</label>
                    </div>
                  </div>
                  <!-- End of input set -->
                  <div class="tap__input_set">
                    <div class="tap__input_field checkbox">
                      <input type="checkbox" class="input_control" id="Slab_Joints" name="Inspector">
                      <label for="Slab_Joints">Slab Joints</label>
                    </div>
                  </div>
                  <!-- End of input set -->
                  <div class="tap__input_set">
                    <div class="tap__input_field checkbox">
                      <input type="checkbox" class="input_control" id="Eaves" name="Inspector">
                      <label for="Eaves">Eaves</label>
                    </div>
                  </div>
                  <!-- End of input set -->
                </div>
                <!-- End of col -->
                <div class="col-sm-3">
                  <div class="tap__input_set">
                    <div class="tap__input_field checkbox">
                      <input type="checkbox" class="input_control" id="Planter_box" name="Inspector">
                      <label for="Planter_box">Planter box abutting structure</label>
                    </div>
                  </div>
                  <!-- End of input set -->
                  <div class="tap__input_set">
                    <div class="tap__input_field checkbox">
                      <input type="checkbox" class="input_control" id="Crawl_Space" name="Inspector">
                      <label for="Crawl_Space">Crawl Space</label>
                    </div>
                  </div>
                  <!-- End of input set -->
                  <div class="tap__input_set">
                    <div class="tap__input_field checkbox">
                      <input type="checkbox" class="input_control" id="Weep_holes" name="Inspector">
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
            <div class="col-sm-12">
              <div class="tap__input_set">
                <span class="input__no">7A. Conditions conducive to wood destroying insect infestation:</span>
                <div class="tap__input_field checkbox inline-checkbox">
                  <input type="checkbox" class="input_control" id="wood_destroying_yes" name="Inspector">
                  <label for="wood_destroying_yes">Yes</label>
                </div>
                <div class="tap__input_field checkbox inline-checkbox">
                  <input type="checkbox" class="input_control" id="wood_destroying_no" name="Inspector">
                  <label for="wood_destroying_no">No</label>
                  <span class="note">(Refer to Part J, Scope of Inspection) If “Yes” specify in 7B.</span>
                </div>
              </div>
              <!-- End of input set -->
            </div>
            <!-- End of col -->
            <div class="col-sm-12">
              <span class="input__no d__block">7B. Conducive Conditions include but are not limited to:</span>
              <div class="row grid_checkbox_layout">
                <div class="col-sm-3">
                  <div class="tap__input_set">
                    <div class="tap__input_field checkbox">
                      <input type="checkbox" class="input_control" id="wood" name="Inspector">
                      <label for="wood">Wood to Ground Contact (G)</label>
                    </div>
                  </div>
                  <!-- End of input set -->
                  <div class="tap__input_set">
                    <div class="tap__input_field checkbox">
                      <input type="checkbox" class="input_control" id="Debris" name="Inspector">
                      <label for="Debris">Debris under or around structure (K)</label>
                    </div>
                  </div>
                  <!-- End of input set -->
                  <div class="tap__input_set">
                    <div class="tap__input_field checkbox">
                      <input type="checkbox" class="input_control" id="Planter" name="Inspector">
                      <label for="Planter">Planter box abutting structure (O)</label>
                    </div>
                  </div>
                  <!-- End of input set -->
                  <div class="tap__input_set">
                    <div class="tap__input_field checkbox">
                      <input type="checkbox" class="input_control" id="Insufficient_ventilation" name="Inspector">
                      <label for="Insufficient_ventilation (T)">Insufficient ventilation (T)</label>
                    </div>
                  </div>
                  <!-- End of input set -->
                </div>
                <!-- End of col -->
                <div class="col-sm-3">
                  <div class="tap__input_set">
                    <div class="tap__input_field checkbox">
                      <input type="checkbox" class="input_control" id="boards" name="Inspector">
                      <label for="boards">Form boards left in place (l)</label>
                    </div>
                  </div>
                  <!-- End of input set -->
                  <div class="tap__input_set">
                    <div class="tap__input_field checkbox">
                      <input type="checkbox" class="input_control" id="Footing" name="Inspector">
                      <label for="Footing">Footing too low or soil line too high (L)</label>
                    </div>
                  </div>
                  <!-- End of input set -->
                  <div class="tap__input_set">
                    <div class="tap__input_field checkbox">
                      <input type="checkbox" class="input_control" id="Wood_Pile" name="Inspector">
                      <label for="Wood_Pile">Wood Pile in Contact with Structure (Q)</label>
                    </div>
                  </div>
                  <!-- End of input set -->
                  <div class="tap__input_set">
                    <div class="tap__input_field checkbox">
                      <input type="checkbox" class="input_control" id="Moisture" name="Inspector">
                      <label for="Moisture">Excessive Moisture (J)</label>
                    </div>
                  </div>
                  <!-- End of input set -->
                </div>
                <!-- End of col -->
                <div class="col-sm-3">
                  <div class="tap__input_set">
                    <div class="tap__input_field checkbox">
                      <input type="checkbox" class="input_control" id="Wood_Rot" name="Inspector">
                      <label for="Wood_Rot">Wood Rot (M)</label>
                    </div>
                  </div>
                  <!-- End of input set -->
                  <div class="tap__input_set">
                    <div class="tap__input_field checkbox">
                      <input type="checkbox" class="input_control" id="Fence" name="Inspector">
                      <label for="Fence">Wooden Fence in Contact with the Structure (R)</label>
                    </div>
                  </div>
                  <!-- End of input set -->
                  <div class="tap__input_set">
                    <div class="tap__input_field checkbox">
                      <input type="checkbox" class="input_control" id="Foliage" name="Inspector">
                      <label for="Foliage">Heavy Foliage (N)</label>
                    </div>
                  </div>
                  <!-- End of input set -->
                </div>
                <!-- End of col -->
                <div class="col-sm-3">
                  <div class="tap__input_set">
                    <div class="tap__input_field checkbox">
                      <input type="checkbox" class="input_control" id="Other_conductive" name="Inspector">
                      <label for="Other_conductive">Other (C)</label>
                    </div>
                  </div>
                  <!-- End of input set -->
                  <div class="tap__input_set pl-25">
                    <span class="input__no">Specify:</span>
                    <input type="text" class="input_control">
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
                  <span class="input__no d__block m-0">8E. Other Wood Destroying Insects Specify:</span>
                  <input type="text" class="input_control">
                </div>
                <div class="col-sm-7 grid_checkbox_layout">
                  <div class="row">
                    <div class="col-sm-4">
                      <p class="text-center m-0">Active Infestation</p>
                      <div class="row">
                        <div class="col-sm-6">
                          <div class="tap__input_field checkbox">
                            <input type="checkbox" class="input_control" id="Infestation_yes" name="Inspector">
                            <label for="Infestation_yes">Yes</label>
                          </div>
                          <div class="tap__input_field checkbox">
                            <input type="checkbox" class="input_control" id="Infestation_yes2" name="Inspector">
                            <label for="Infestation_yes2">Yes</label>
                          </div>
                          <div class="tap__input_field checkbox">
                            <input type="checkbox" class="input_control" id="Infestation_yes3" name="Inspector">
                            <label for="Infestation_yes3">Yes</label>
                          </div>
                          <div class="tap__input_field checkbox">
                            <input type="checkbox" class="input_control" id="Infestation_yes4" name="Inspector">
                            <label for="Infestation_yes4">Yes</label>
                          </div>
                          <div class="tap__input_field checkbox">
                            <input type="checkbox" class="input_control" id="Infestation_yes5" name="Inspector">
                            <label for="Infestation_yes5">Yes</label>
                          </div>
                        </div>
                        <div class="col-sm-6">
                          <div class="tap__input_field checkbox">
                            <input type="checkbox" class="input_control" id="Infestation_no" name="Inspector">
                            <label for="Infestation_no">No</label>
                          </div>
                          <div class="tap__input_field checkbox">
                            <input type="checkbox" class="input_control" id="Infestation_no2" name="Inspector">
                            <label for="Infestation_no2">No</label>
                          </div>
                          <div class="tap__input_field checkbox">
                            <input type="checkbox" class="input_control" id="Infestation_no3" name="Inspector">
                            <label for="Infestation_no3">No</label>
                          </div>
                          <div class="tap__input_field checkbox">
                            <input type="checkbox" class="input_control" id="Infestation_no4" name="Inspector">
                            <label for="Infestation_no4">No</label>
                          </div>
                          <div class="tap__input_field checkbox">
                            <input type="checkbox" class="input_control" id="Infestation_no5" name="Inspector">
                            <label for="Infestation_no5">No</label>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <p class="text-center m-0">Previous Infestation</p>
                      <div class="row">
                        <div class="col-sm-6">
                          <div class="tap__input_field checkbox">
                            <input type="checkbox" class="input_control" id="Previous_Infestation_yes" name="Inspector">
                            <label for="Previous_Infestation_yes">Yes</label>
                          </div>
                          <div class="tap__input_field checkbox">
                            <input type="checkbox" class="input_control" id="Previous_Infestation_yes2" name="Inspector">
                            <label for="Previous_Infestation_yes2">Yes</label>
                          </div>
                          <div class="tap__input_field checkbox">
                            <input type="checkbox" class="input_control" id="Previous_Infestation_yes3" name="Inspector">
                            <label for="Previous_Infestation_yes3">Yes</label>
                          </div>
                          <div class="tap__input_field checkbox">
                            <input type="checkbox" class="input_control" id="Previous_Infestation_yes4" name="Inspector">
                            <label for="Previous_Infestation_yes4">Yes</label>
                          </div>
                          <div class="tap__input_field checkbox">
                            <input type="checkbox" class="input_control" id="Previous_Infestation_yes5" name="Inspector">
                            <label for="Previous_Infestation_yes5">Yes</label>
                          </div>
                        </div>
                        <div class="col-sm-6">
                          <div class="tap__input_field checkbox">
                            <input type="checkbox" class="input_control" id="Previous_Infestation_no" name="Inspector">
                            <label for="Previous_Infestation_no">No</label>
                          </div>
                          <div class="tap__input_field checkbox">
                            <input type="checkbox" class="input_control" id="Previous_Infestation_no2" name="Inspector">
                            <label for="Previous_Infestation_no2">No</label>
                          </div>
                          <div class="tap__input_field checkbox">
                            <input type="checkbox" class="input_control" id="Previous_Infestation_no3" name="Inspector">
                            <label for="Previous_Infestation_no3">No</label>
                          </div>
                          <div class="tap__input_field checkbox">
                            <input type="checkbox" class="input_control" id="Previous_Infestation_no4" name="Inspector">
                            <label for="Previous_Infestation_no4">No</label>
                          </div>
                          <div class="tap__input_field checkbox">
                            <input type="checkbox" class="input_control" id="Previous_Infestation_no5" name="Inspector">
                            <label for="Previous_Infestation_no5">No</label>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <p class="text-center m-0">Previous Treatment</p>
                      <div class="row">
                        <div class="col-sm-6">
                          <div class="tap__input_field checkbox">
                            <input type="checkbox" class="input_control" id="Previous_Treatment_yes" name="Inspector">
                            <label for="Previous_Treatment_yes">Yes</label>
                          </div>
                          <div class="tap__input_field checkbox">
                            <input type="checkbox" class="input_control" id="Previous_Treatment_yes2" name="Inspector">
                            <label for="Previous_Treatment_yes2">Yes</label>
                          </div>
                          <div class="tap__input_field checkbox">
                            <input type="checkbox" class="input_control" id="Previous_Treatment_yes3" name="Inspector">
                            <label for="Previous_Treatment_yes3">Yes</label>
                          </div>
                          <div class="tap__input_field checkbox">
                            <input type="checkbox" class="input_control" id="Previous_Treatment_yes4" name="Inspector">
                            <label for="Previous_Treatment_yes4">Yes</label>
                          </div>
                          <div class="tap__input_field checkbox">
                            <input type="checkbox" class="input_control" id="Previous_Treatment_yes5" name="Inspector">
                            <label for="Previous_Treatment_yes5">Yes</label>
                          </div>
                        </div>
                        <div class="col-sm-6">
                          <div class="tap__input_field checkbox">
                            <input type="checkbox" class="input_control" id="Previous_Treatment_no" name="Inspector">
                            <label for="Previous_Treatment_no">No</label>
                          </div>
                          <div class="tap__input_field checkbox">
                            <input type="checkbox" class="input_control" id="Previous_Treatment_no2" name="Inspector">
                            <label for="Previous_Treatment_no2">No</label>
                          </div>
                          <div class="tap__input_field checkbox">
                            <input type="checkbox" class="input_control" id="Previous_Treatment_no3" name="Inspector">
                            <label for="Previous_Treatment_no3">No</label>
                          </div>
                          <div class="tap__input_field checkbox">
                            <input type="checkbox" class="input_control" id="Previous_Treatment_no4" name="Inspector">
                            <label for="Previous_Treatment_no4">No</label>
                          </div>
                          <div class="tap__input_field checkbox">
                            <input type="checkbox" class="input_control" id="Previous_Treatment_no5" name="Inspector">
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
                  <input type="text" class="input_control">
                </div>
              </div>
              <!-- End of input set -->
              <div class="tap__input_set inline__input_field">
                <span class="input__no">8G. Visible evidence of:</span>
                <div class="tap__input_field">
                  <input type="text" class="input_control">
                </div>
              </div>
              <!-- End of input set -->
              <div class="tap__input_set inline__input_field">
                <span class="input__no">has been observed in the following areas:</span>
                <div class="tap__input_field">
                  <input type="text" class="input_control">
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
                      <input type="text" class="input_control">
                    </div>
                  </div>
                  <!-- End of input set -->
                </div>
                <div class="col-sm-3">
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="tap__input_field checkbox">
                        <input type="checkbox" class="input_control" id="mechanically_corrected_yes" name="Inspector">
                        <label for="mechanically_corrected_yes">Yes</label>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="tap__input_field checkbox">
                        <input type="checkbox" class="input_control" id="mechanically_corrected_no" name="Inspector">
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
                    <span class="input__no">9A. Corrective treatment recommended for active infestation or evidence of previous infestation with no prior treatment as identified in Section 8. (Refer to Part G, H, and I, Scope of Inspection)</span>
                  </div>
                  <!-- End of input set -->
                </div>
                <div class="col-sm-3">
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="tap__input_field checkbox">
                        <input type="checkbox" class="input_control" id="Corrective_treatment_yes" name="Inspector">
                        <label for="Corrective_treatment_yes">Yes</label>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="tap__input_field checkbox">
                        <input type="checkbox" class="input_control" id="Corrective_treatment_no" name="Inspector">
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
                      <div class="tap__input_field checkbox">
                        <input type="checkbox" class="input_control" id="preventive_treatment_yes" name="Inspector">
                        <label for="preventive_treatment_yes">Yes</label>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="tap__input_field checkbox">
                        <input type="checkbox" class="input_control" id="preventive_treatment_no" name="Inspector">
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
                <span class="input__no">Specify reason: Wood to ground, debris, ventilation, soil too high, excessive moisture</span>
                <div class="tap__input_field">
                  <input type="text" class="input_control">
                  <label for="">(Refer to Scope of Inspection Part J)</label>
                </div>
              </div>
              <!-- End of tap input field -->
              <div class="tap__input_set inline__input_field">
                <span class="input__no">10A. This Company has treated or is treating the structure for the following wood destroying insects:</span>
                <div class="tap__input_field">
                  <input type="text" class="input_control">
                </div>
              </div>
              <!-- End of tap input field -->
              <div class="tap__input_set">
                <span class="input__no">If treating for subterranean termites, the treatment was:</span>
                <div class="tap__input_field checkbox inline-checkbox">
                  <input type="checkbox" class="input_control" id="Partial" name="Inspector">
                  <label for="Partial">Partial</label>
                </div>
                <div class="tap__input_field checkbox inline-checkbox">
                  <input type="checkbox" class="input_control" id="Spot" name="Inspector">
                  <label for="Spot">Spot</label>
                </div>
                <div class="tap__input_field checkbox inline-checkbox">
                  <input type="checkbox" class="input_control" id="Bait" name="Inspector">
                  <label for="Bait">Bait</label>
                </div>
                <div class="tap__input_field checkbox inline-checkbox">
                  <input type="checkbox" class="input_control" id="Other" name="Inspector">
                  <label for="Other">Other</label>
                </div>
              </div>
              <!-- End of tap input field -->
              <div class="tap__input_set">
                <span class="input__no">If treating for drywood termites or related insects, the treatment was:</span>
                <div class="tap__input_field checkbox inline-checkbox">
                  <input type="checkbox" class="input_control" id="Full" name="Inspector">
                  <label for="Full">Full</label>
                </div>
                <div class="tap__input_field checkbox inline-checkbox">
                  <input type="checkbox" class="input_control" id="Limited" name="Inspector">
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
                  <input type="text" class="input_control">
                  <label for="">Date of Treatment by Inspecting Company</label>
                </div>
              </div>
              <!-- End of input set -->
              </div>
              <!-- End of col -->
              <div class="col-sm-3">
                <div class="tap__input_set">
                  <div class="tap__input_field">
                    <input type="text" class="input_control">
                    <label for="">Common Name of Insect</label>
                  </div>
                </div>
              <!-- End of input set -->
              </div>
              <!-- End of col -->
              <div class="col-sm-3">
                <div class="tap__input_set">
                  <div class="tap__input_field">
                    <input type="text" class="input_control">
                    <label for="">Name of Pesticide, Bait or Other Method</label>
                  </div>
                </div>
              <!-- End of input set -->
              </div>
              <!-- End of col -->
              <div class="col-sm-12">
                <span class="input__no">This company has a contract or warranty in effect for control of the following wood destroying insects:</span>
                <div class="tap__input_field checkbox inline-checkbox">
                  <input type="checkbox" class="input_control" id="wood_destroying_Yes" name="Inspector">
                  <label for="wood_destroying_Yes">Yes</label>
                </div>
                <div class="tap__input_field checkbox inline-checkbox">
                  <input type="checkbox" class="input_control" id="wood_destroying_No" name="Inspector">
                  <label for="wood_destroying_No">No</label>
                </div>
                <div class="tap__input_set inline__input_field">
                  <span class="input__no">List Insects:</span>
                  <div class="tap__input_field">
                    <input type="text" class="input_control">
                  </div>
                </div>
                <span class="input__no">If “Yes”, copy (ies) of warranty and treatment diagram must be attached.</span>
              </div>
              <!-- End of col -->
            </div>
            <!-- End of row -->
            <div class="col-sm-12">
              <h5 class="text-center"><b>Diagram of Structure(s) Inspected</b></h5>
              <span class="input__no">The inspector must draw a diagram including approximate perimeter measurements and indicate active or previous infestation and type of insect by using the following codes: E-Evidence of Infestation, A-Active; P-Previous; D-Drywood Termites; S-Subterranean Termites; F-Formosan Termites; C-Conducive Conditions; B-Wood Boring Beetles</span>
              <div class="tap__input_set inline__input_field">
                <span class="input__no">H-Carpenter Ants; Other(s) – Specify</span>
                <div class="tap__input_field">
                  <input type="text" class="input_control">
                  <span class="">See section 7B. for conducive conditions letter codes</span>
                </div>
              </div>
              <!-- End of input field -->
              <div class="diagram_img">
                <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/woodInspection/img/Diagram.png" alt="..." class="img-responsive">
              </div>
            </div>
            <!-- End of col -->
            <div class="col-sm-12">
              <div class="tap__input_set">
                <span class="input__no">Additional Comments:</span>
                <div class="tap__input_field checkbox inline-checkbox">
                  <input type="checkbox" class="input_control" id="slab" name="Inspector">
                  <label for="slab">Post tension slab</label>
                </div>
                <div class="tap__input_field checkbox inline-checkbox">
                  <input type="checkbox" class="input_control" id="grade" name="Inspector">
                  <label for="grade">Slab on grade</label>
                </div>
                <div class="tap__input_field checkbox inline-checkbox">
                  <input type="checkbox" class="input_control" id="Beam" name="Inspector">
                  <label for="Beam">Pier and Beam</label>
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
                    <input type="text" class="input_control">
                    <label for="">Inspector</label>
                  </div>
                </div>
                <!-- End of input set -->
                <span class="input__no d__block">Approved:</span>
                <div class="tap__input_set">
                  <span class="input__no">11B.</span>
                  <div class="tap__input_field">
                    <input type="text" class="input_control">
                    <label for="">Certified Applicator and Certified Applicator License Number</label>
                  </div>
                </div>
                <!-- End of input set -->
              </div>
              <!-- End of col -->
              <div class="col-sm-6">
                <span class="input__no d__block">Notice of Inspection was posted at or near</span>
                <div class="tap__input_set">
                  <div class="tap__input_field checkbox">
                    <input type="checkbox" class="input_control" id="Breaker" name="Inspector">
                    <label for="Breaker">Electric Breaker Box</label>
                  </div>
                </div>
                <!-- End of input set -->
                <div class="tap__input_set">
                  <div class="tap__input_field checkbox">
                    <input type="checkbox" class="input_control" id="Heater" name="Inspector">
                    <label for="Heater">Water Heater Closet</label>
                  </div>
                </div>
                <!-- End of input set -->
                <div class="tap__input_set">
                  <div class="tap__input_field checkbox">
                    <input type="checkbox" class="input_control" id="Sink" name="Inspector">
                    <label for="Sink">Beneath the Kitchen Sink</label>
                  </div>
                </div>
                <!-- End of input set -->
                <div class="tap__input_set">
                  <span class="input__no">Date Posted</span>
                  <div class="tap__input_field">
                    <input type="text" class="input_control">
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
                  <input type="text" class="input_control">
                </div>
              </div>
              <span class="input__no">I agree to receive email correspondence from Inspectors service group, related to this inspection and/or future pest control services, and/or discounts/offers.</span>
              <div class="row">
                <div class="col-sm-6">
                  <span class="input__no d__block m-0">Signature of Purchaser of Property or their Designee</span>
                  <input type="text" class="input_control">
                </div>
                <div class="col-sm-6">
                  <span class="input__no d__block m-0">Date</span>
                  <input type="text" class="input_control">
                </div>
              </div>
            </div>
            <!-- End of col -->
          </div>
          <!-- End of row -->
          <div class="address_block text-center">
            <h4>Elite Inspection Group, LLC</h4>
            <p>Administrative office and mailing address</p>
            <p>PO Box 2205 Frisco, TX 75034</p>
            <a href="tel:4698185500">469-818-5500</a>
            <a href="mailto:admin@eiginspection.com">admin@eiginspection.com</a> <a href="www.eigdallas.com">www.eigdallas.com</a>
          </div>
        </div>
        <!-- End of tap__form content -->
      </div>
      <!-- End of container -->
    </div>
	<div id="editor"></div>
    <!-- End of raw form body -->
	<?php if($report_id){ ?>
    <div class="actions">
	  <div class="msg_show form-view-msg" style="display:inline-block;"></div>
	  <a href="javascript:void(0)" style="margin-bottom:10px;" class="btn-taptap saveChanges" ng-click="submitData(1,'','')">
        <i class="fa fa-floppy-o" aria-hidden="true"></i> Save Changes
      </a>
	  <?php if(!empty($form_data[0]->share_btn) && $form_data[0]->share_btn == 'true'){ ?>
	  <a href="javascript:void(0)" class="btn-taptap checkBoxSlected" data-toggle="modal" data-target="#shareFormView" disabled="disabled"><i class="fa fa-share"></i> Share this
      </a>
	  <?php } ?>
	  <?php /* ?><a target="_blank" href="<?php echo home_url('/form-viewer-print/?item='.$template_id.'&report='.$report_id.'&saved='.$saved.''); ?>" class="btn-taptap">
        <i class="fa fa-file"></i> Save as PDF
      </a><?php */?>
	  <?php if(!empty($form_data[0]->print_btn) && $form_data[0]->print_btn == 'true'){ ?>
	  <a target="_blank" href="javascript:void(0)" id="printTemplateBtn" class="btn-taptap"><i class="fa fa-print" aria-hidden="true"></i> Print / Save to PDF</a>
	  <?php } ?>
    </div>
	<?php } else { ?>
		<style>
		.fileinput{display:none;}
		.wysiwygpretend .button{display:none;}
		</style>
	<?php } ?>
  </div>
  
  <script src="<?php echo esc_url( get_template_directory_uri() ); ?>/woodInspection/js/jquery.js"></script>
  <script src="<?php echo esc_url( get_template_directory_uri() ); ?>/js/jspdf.min.js"></script>
    <script src="<?php echo esc_url( get_template_directory_uri() ); ?>/woodInspection/js/bootstrap.min.js"></script>
    <script src="<?php echo esc_url( get_template_directory_uri() ); ?>/woodInspection/js/main.js"></script>
	
	<?php 
		$form_data = shortcode_wdi($form_data);
		$get_template_name = (!empty($form_data[0]->name) ? $form_data[0]->name : '');
	?>
	<script>
		/*var cssUrl = "<?php echo esc_url( get_template_directory_uri() ); ?>/assets/css/print-wood-inspection.css";
		function printTemplateBtn(){
			//e.preventDefault();
			//$('.ng-not-empty').parent('.commentprompt').parent().removeClass('not_required_true');
			//$('.ng-empty').parent('.commentprompt').parent().addClass('not_required_true');
			var thisItem = $("#printTemplateBtn");
			thisItem.find('.fa').removeClass('fa-print').addClass('fa-refresh fa-spin');
			$("#templateViewer").printThis({
				importStyle: false,         // import style tags
				printContainer: true,
				//footer: $('#pagefooter'),
				loadCSS: cssUrl,
				importCSS: false,
				copyTagClasses: true,
				printDelay: 500,
				debug:false,
				header: null,               // prefix to html
				footer: null,               // postfix to html
			});
			setTimeout(function(){
				thisItem.find('.fa').removeClass('fa-refresh fa-spin').addClass('fa-print');
			},1000);
		}*/
		
		var doc = new jsPDF();
		var specialElementHandlers = {
			'#editor': function (element, renderer) {
				return true;
			}
		};
		var margin = {
		  top: 0,
		  left: 0,
		  right: 0,
		  bottom: 0
		};
		$('#printTemplateBtn').click(function () {
			doc.fromHTML($('#templateViewerdd').html(), 15, 15, {
				'width': 170,
					'elementHandlers': specialElementHandlers
			},
function(bla){doc.save('saveInCallback.pdf');},
margin);
		});
	
		window.setTimeout(function(){
			$('#incipitContent').css({'display':'none','opacity':'0'});
		}, 3000);
		document.title = '<?php echo $get_template_name; ?>';
	</script>
