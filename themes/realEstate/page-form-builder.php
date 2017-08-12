<?php
/**
 * Template Name: Form Builder 
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

get_header(); ?>
	<link rel="stylesheet" href="https://cdn.rawgit.com/odra/ng-json-explorer/master/dist/angular-json-explorer.min.css">
  <link rel="stylesheet" href="https://unpkg.com/bootswatch@3.3.7/yeti/bootstrap.min.css" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
  <link rel="stylesheet" href="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/dist/ngFormBuilder-full.css" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" />
  
  <style>
  .browsehappy {
    display:block;
    width:100%;
    height:100px;
    background-color:#f2dede;
    margin: 0 0 10px;
    font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;
    font-size: 22px;
    line-height: 1.4;
    color: #333;
    padding-top: 15px;
    vertical-align:middle;
  }
  .browsehappy span {
    vertical-align:middle;
    margin:20px 20px 20px 20px;
    background:url("https://cdn.rawgit.com/alrra/browser-logos/master/internet-explorer/internet-explorer_64x64.png") no-repeat;
    height:64px;
    width:64px;
    display:inline-block;
  }

  .formbuilder {
    height: 600px;
  }

  .formcomponents {
    width: 30%;
  }

  .formarea {
    width: 70%;
  }

  .component-settings .nav-link {
    font-size: 0.6em;
  }

  .jsonviewer {
    max-height: 600px;
    overflow: scroll;
  }

  .form-type-select {
    display: inline-block;
    width: 100px;
    height: 28px;
    vertical-align: top;
  }
</style>
  
  <!-- PAGE HEADER -->
	<section id="page-header">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="section-title">
						<h1><?php the_title(); ?></h1>
						<span class="st-border"></span>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- /PAGE HEADER -->

<div class="page-content" ng-app="formioApp">
  <div class="container-fluid">
    <div>
      <div class="row">
        <div class="col-sm-8">
          <!--<h3 class="text-center text-muted">The <a href="https://github.com/formio/ngFormBuilder" target="_blank">Form Builder</a> allows you to build a <select class="form-control form-type-select" ng-model="form.display" ng-options="display.name as display.title for display in displays"></select></h3>-->
          <pre class="text-center bg-info"><h4><code>&lt;form-builder form="form"&gt;&lt;/form-builder&gt;</code></h4></pre>
          <div class="well" style="background-color: #fdfdfd;">
            <form-builder form="form"></form-builder>
          </div>
        </div>
        <div class="col-sm-4">
          <!--<h3 class="text-center text-muted">as JSON Schema</h3>-->
          <pre class="bg-info"><h4><code>$rootScope.form = </code></h4></pre>
          <div class="well jsonviewer">
            <json-explorer data="form" collapsed="jsonCollapsed"></json-explorer>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-8 col-sm-offset-2">
          <div class="well">
            <formio form="form" ng-if="renderForm"></formio>
          </div>
        </div>
        <div class="clearfix"></div>
      </div>
    </div>
  </div>
</div>


<?php get_footer(); ?>
<script src="https://cdn.ckeditor.com/4.5.11/standard/ckeditor.js"></script>
<script src="https://unpkg.com/signature_pad@1.5.3/signature_pad.min.js"></script>
<script src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/dist/ngFormBuilder-full.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/lodash.js/4.17.4/lodash.min.js"></script>
<script src="https://cdn.rawgit.com/odra/ng-json-explorer/master/dist/angular-json-explorer.min.js"></script>
<?php 
 global $wpdb;
 $template_detail = $wpdb->prefix . 'template_detail';
 $template_id = !empty($_GET['item']) ? $_GET['item'] : '';
 $get_templages = $wpdb->get_results( "SELECT * FROM $template_detail WHERE template_id=$template_id", OBJECT );
?>

<script type="text/javascript">
  angular
    .module("formBuilder", ["ui.bootstrap", "ui.select", "formio", "ngFormBuilder", "ngJsonExplorer"])
    .run([
      "$rootScope",
      'formioComponents',
      '$timeout',
      function(
        $rootScope,
        formioComponents,
        $timeout
      ) {
        $rootScope.displays = [{
          name: 'form',
          title: 'Form'
        }, {
          name: 'wizard',
          title: 'Wizard'
        }];
        $rootScope.form = {
          components: [{
            input: true,
            tableView: true,
            inputType: 'text',
            inputMask: '',
            label: 'First Name',
            key: 'firstName',
            placeholder: 'Enter your first name',
            prefix: '',
            suffix: '',
            multiple: false,
            defaultValue: '',
            protected: false,
            unique: false,
            persistent: true,
            validate: {
              required: false,
              minLength: '',
              maxLength: '',
              pattern: '',
              custom: '',
              customPrivate: false
            },
            conditional: {
              show: false,
              when: null,
              eq: ''
            },
            type: 'textfield'
          }, {
            input: true,
            tableView: true,
            inputType: 'text',
            inputMask: '',
            label: 'Last Name',
            key: 'lastName',
            placeholder: 'Enter your last name',
            prefix: '',
            suffix: '',
            multiple: false,
            defaultValue: '',
            protected: false,
            unique: false,
            persistent: true,
            validate: {
              required: false,
              minLength: '',
              maxLength: '',
              pattern: '',
              custom: '',
              customPrivate: false
            },
            conditional: {
              show: false,
              when: null,
              eq: ''
            },
            type: 'textfield'
          }, {
            type: 'select',
            validate: {
              required: false
            },
            clearOnHide: true,
            persistent: true,
            unique: false,
            protected: false,
            multiple: true,
            template: '<span>{{ item.label }}</span>',
            authenticate: false,
            filter: '',
            refreshOn: '',
            defaultValue: '',
            valueProperty: '',
            dataSrc: 'values',
            data: {
              custom: '',
              resource: '',
              url: '',
              json: '',
              values: [
                {
                  label: 'Raindrops on roses',
                  value: 'raindropsOnRoses'
                },
                {
                  label: 'Whiskers on Kittens',
                  value: 'whiskersOnKittens'
                },
                {
                  label: 'Bright copper kettles',
                  value: 'brightCopperKettles'
                },
                {
                  label: 'Warm woolen Mittens',
                  value: 'warmWoolenMittens'
                },
                [

                ]
              ]
            },
            placeholder: 'Select a few',
            key: 'favoriteThings',
            label: 'Favorite Things',
            tableView: true,
            input: true
          }, {
            input: true,
            tableView: true,
            label: 'Message',
            key: 'message',
            placeholder: 'What do you think?',
            prefix: '',
            suffix: '',
            rows: 3,
            multiple: false,
            defaultValue: '',
            protected: false,
            persistent: true,
            validate: {
              required: false,
              minLength: '',
              maxLength: '',
              pattern: '',
              custom: ''
            },
            type: 'textarea',
            conditional: {
              show: false,
              when: null,
              eq: ''
            }
          }, {
            type: 'button',
            theme: 'primary',
            disableOnInvalid: true,
            action: 'submit',
            block: false,
            rightIcon: '',
            leftIcon: '',
            size: 'md',
            key: 'submit',
            tableView: false,
            label: 'Submit',
            input: true
          }],
          display: 'form'
        };

        $rootScope.renderForm = true;
        $rootScope.$on('formUpdate', function(event, form) {
          angular.merge($rootScope.form, form);
          $rootScope.renderForm = false;
          setTimeout(function() {
            $rootScope.renderForm = true;
          }, 10);
        });

        var originalComps = _.cloneDeep($rootScope.form.components);
        originalComps.push(angular.copy(formioComponents.components.button.settings));
        $rootScope.jsonCollapsed = true;
        $timeout(function() {
          $rootScope.jsonCollapsed = false;
        }, 200);
        var currentDisplay = 'form';
        $rootScope.$watch('form.display', function(display) {
          if (display && (display !== currentDisplay)) {
            currentDisplay = display;
            if (display === 'form') {
              $rootScope.form.components = originalComps;
            } else {
              $rootScope.form.components = [{
                type: 'panel',
                input: false,
                title: 'Page 1',
                theme: 'default',
                components: originalComps
              }];
            }
          }
        });
      }
    ]);
</script>

<script type="text/javascript">
	//jQuery(function($) {
	  /*var fbTemplate = document.getElementById('build-wrap');
	
		options = {
		  formData: '<?php echo $get_templages[0]->field_text_html; ?>',
		  controlPosition: 'left',
		  disableFields: ['autocomplete', 'hidden'],
		  controlOrder: [
			'text',
			'paragraph',
			'checkbox-group',
			'file',
			'textarea',
			'instruction-text',
			'group-box',
			'standard-report-fields',
			'page-break',
		  ],
		   inputSets: [
			
				{
				  label: 'Instruction Text',
				  name: 'instruction-text',
				  className: 'icon-textarea',
				  fields: [
				  {
					type: 'header',
					subtype: 'h2',
					label: 'Instructions',
					className: 'header'
				  },
				  {
					type: 'paragraph',
					label: 'Leverage agile frameworks to provide a robust synopsis for high level overviews. Iterative approaches to corporate strategy foster collaborative thinking to further the overall value proposition. Organically grow the holistic world view of disruptive innovation via workplace diversity and empowerment.',
				  }
				]
				},
				{
				  label: 'Section',
				  name: 'section-area',
				  fields: [
				  {
					type: 'section',
					subtype: 'section',
					label: '',
					className: 'section'
				  }
				]
				},
				{
				  label: 'Group Box',
				  name: 'group-box',				  
				  fields: [
						{
						  type: 'checkbox-group',
						  label: 'Group Box',						  
						  values: [{
							label: 'not selected',
							value: 'not-selected',
							selected: false
						  }, {
							label: 'selected',
							value: 'selected',
							selected: true
						  }, {
							label: 'indeterminate',
							value: 'indeterminate',
							selected: false
						  }, {
							label: 'disabled',
							value: 'disabled',
							selected: false
						  }]
						}
					]
				},
			  {
				label: 'Standard Report Fields',
				name: 'standard-report-fields', // optional - one will be generated from the label if name not supplied
				showHeader: true, // optional - Use the label as the header for this set of inputs
				fields: [
						{
						  type: 'text',
						  label: 'Report Name',
						  className: 'form-control'
						},
						{
						  type: 'text',
						  label: 'Prepared For',
						  className: 'form-control'
						},
						{
						  type: 'text',
						  label: 'Prepared By',
						  className: 'form-control'
						},
						{
						  type: 'date',
						  label: 'Date',
						  className: 'form-control'
						},
						{
						  type: 'text',
						  label: 'Company',
						  className: 'form-control'
						},
						{
						  type: 'text',
						  label: 'Business License',
						  className: 'form-control'
						},
						{
						  type: 'text',
						  label: 'City',
						  className: 'form-control'
						},
						{
						  type: 'text',
						  label: 'State',
						  className: 'form-control'
						},
						{
						  type: 'number',
						  label: 'Zip',
						  className: 'form-control'
						}
					  ]
				  },
				 {
				  label: 'Page Break',
				  name: 'page-break',
				  fields: [
				  {
					type: 'br',					
					label: 'Page Break',
					className: 'page-break'
				  },
				  {
					type: 'paragraph',
					label: 'Leverage agile frameworks to provide a robust synopsis for high level overviews. Iterative approaches to corporate strategy foster collaborative thinking to further the overall value proposition. Organically grow the holistic world view of disruptive innovation via workplace diversity and empowerment.',
				  }
				]
				},
			  ]
		};
		
		var formBuilder = $(fbTemplate).formBuilder(options);
	 
	document.getElementById('getJSON1').addEventListener('click', function() {
		var form_data = new FormData();
		var template_id = jQuery('#template_id').val();
		var formJsonData = JSON.stringify(JSON.parse(formBuilder.actions.getData('json', true)));
		form_data.append('action', 'saveDynamicForm');
		form_data.append('template_id', template_id);
		form_data.append('formJsonData', formJsonData);
		
		$.ajax({					
			url: '<?php echo admin_url('admin-ajax.php'); ?>',
			type: 'post',
			contentType: false,
			processData: false,
			data: form_data,					
			success: function (data) {
			  var parsedJson = $.parseJSON(data);
			  console.log(parsedJson);
			  if(parsedJson.success == true){
				  alert(parsedJson.mess);
				  //window.location.href = "<?php echo home_url('/form-builder/?item='); ?>"+template_id;
			  } else {
				alert(parsedJson.mess);
			  }
			},
			error: function (errorThrown) {
				alert(errorThrown);
			}
		});
		
		//console.log(JSON.stringify(JSON.parse(formBuilder.actions.getData('json', true))));
	});
	document.getElementById('clearFields').onclick = function() {
		formBuilder.actions.clearFields();
	};
	  
	/*document.getElementById('getXML').addEventListener('click', function() {
		alert(formBuilder.actions.getData('xml'));
	});
	
	document.getElementById('getJS').addEventListener('click', function() {
		alert('check console');
		console.log(formBuilder.actions.getData());
	});*/

</script>
