<?php

namespace MaterialWPThemeOptions;

/**
 * Material Design Theme options
 *
 * @author Ramón Serrano <ramon.calle.88@gmail.com>
 */
class ThemeOptions
{

	/**
	 * Initialize Theme Options
	 */
	static function init()
	{
		# Add submenu
		add_action('admin_menu', __CLASS__ . '::addAppearanceMenu');
		# Add custom styles to admin page
		add_action('admin_enqueue_scripts', __CLASS__ . '::addCustomStylesAndScripts');
		# Enqueue material design
    	add_action('admin_enqueue_scripts', 'materialwp_scripts');
    	# Enqueue material design custom
    	add_action( 'wp_enqueue_scripts', __CLASS__ . '::addCustomStylesAndScriptsFrontend' );
	}

	/**
	 * Add submenu to appearance menu
	 */
    static function addAppearanceMenu()
    {
        add_submenu_page( 'themes.php', 'Bootstrap Material Design Theme Options', 'Material Theme Options', 'manage_options', 'material-theme-options', __CLASS__ . '::showThemeOptionsPage');
    }

    /**
	 * Show Theme Options Form
	 */
    static function showThemeOptionsPage()
    {
    	if (isset($_POST["update_settings"])) {
    		$backgroundColor    = $_POST['background-color'];
    		$customStyles       = $_POST['custom-styles'];
    		$customScripts      = $_POST['custom-scripts'];
    		$customFooter       = $_POST['custom-footer'];
    		$customClassHeader  = $_POST['custom-class-header'];

		    update_option('materialwp-materialwp_background-color', $backgroundColor);
		    update_option('materialwp-materialwp_custom-styles', $customStyles);
		    update_option('materialwp-materialwp_custom-scripts', $customScripts);
		    update_option('materialwp-materialwp_custom-footer', htmlentities(stripslashes($customFooter)));
		    update_option('materialwp-materialwp_custom-class-header', $customClassHeader);

		    ?>
			    <div class="alert alert-dismissable alert-success options-updated">
				    <button type="button" class="close" data-dismiss="alert">×</button>
				    <strong>Options updated!</strong>.
				</div>
			<?php
		}
    	?>
    	<div class="wrap">
	        <div class="wqell bs-component">
		        <form id="material-theme-options" class="form-horizontal" method="POST" action="">
				    <fieldset>
				        <legend><h2>Bootstrap Material Design Theme Options</h2></legend>
				        <div class="form-group">
				            <label for="background-color" class="col-md-2 control-label">Background Color</label>
				            <div class="col-md-10">
				                <input 
				                		type="color" 
				                		class="form-control" 
				                		id="background-color" 
				                		name="background-color" 
				                		placeholder="Background color" 
				                		value="<?php echo get_option('materialwp-materialwp_background-color'); ?>">
				            </div>
				        </div>
				        <div class="form-group">
				        	<label for="editor-custom-styles" class="col-md-2 control-label">Custom CSS</label>
				        	<div class="col-md-10">
				        		<pre id="editor-custom-styles"><?php echo get_option('materialwp-materialwp_custom-styles'); ?></pre>
			        		</div>
				        </div>
				        <div class="form-group">
				        	<label for="editor-custom-scripts" class="col-md-2 control-label">Custom JS</label>
				        	<div class="col-md-10">
				        		<pre id="editor-custom-scripts"><?php echo get_option('materialwp-materialwp_custom-scripts'); ?></pre>
			        		</div>
				        </div>
				        <div class="form-group">
				        	<label for="custom-class-header" class="col-md-2 control-label">Header type</label>
				        	<div class="col-md-5 radios-container">
				        		<?php $customClassHeader = get_option('materialwp-materialwp_custom-class-header'); ?>
				        		<div class="radio radio-inverse">
							    	<label>
							      		<input type="radio" name="custom-class-header" value="navbar-inverse" <?php echo ('navbar-inverse' === $customClassHeader) ? 'checked=""' : ''; ?>>
							      		Navbar inverse
						    		</label>
							  	</div>
							  	<div class="radio radio-success">
							    	<label>
							      		<input type="radio" name="custom-class-header" value="navbar-success" <?php echo ('navbar-success' === $customClassHeader) ? 'checked=""' : ''; ?>>
							      		Navbar success
						    		</label>
							  	</div>
							  	<div class="radio radio-warning">
							    	<label>
							      		<input type="radio" name="custom-class-header" value="navbar-warning" <?php echo ('navbar-warning' === $customClassHeader) ? 'checked=""' : ''; ?>>
							      		Navbar warning
						    		</label>
							  	</div>
							  	<div class="radio radio-danger">
							    	<label>
							      		<input type="radio" name="custom-class-header" value="navbar-danger" <?php echo ('navbar-danger' === $customClassHeader) ? 'checked=""' : ''; ?>>
							      		Navbar danger
						    		</label>
							  	</div>
							  	<div class="radio radio-black">
							    	<label>
							      		<input type="radio" name="custom-class-header" value="navbar-black" <?php echo ('navbar-black' === $customClassHeader) ? 'checked=""' : ''; ?>>
							      		Navbar black
						    		</label>
							  	</div>
							  	<div class="radio radio-white">
							    	<label>
							      		<input type="radio" name="custom-class-header" value="navbar-white" <?php echo ('navbar-white' === $customClassHeader) ? 'checked=""' : ''; ?>>
							      		Navbar white
						    		</label>
							  	</div>
							  	<div class="radio radio-transparent">
							    	<label>
							      		<input type="radio" name="custom-class-header" value="navbar-transparent" <?php echo ('navbar-transparent' === $customClassHeader) ? 'checked=""' : ''; ?>>
							      		Navbar transparent
						    		</label>
							  	</div>
				        	</div>
				        </div>
				        <div class="form-group">
				        	<label for="editor-custom-footer" class="col-md-2 control-label">Custom Footer</label>
				        	<div class="col-md-10">
				        		<textarea 
				        				class="form-control" 
			        					id="editor-custom-footer" 
			        					name="custom-footer" 
			        					data-hint="Content or copyright of Footer."
			        					rows="5"><?php echo html_entity_decode(get_option('materialwp-materialwp_custom-footer')); ?></textarea>
			        		</div>
				        </div>
				        <input type="hidden" name="update_settings" value="Y">
				        <!--
				        <div class="form-group">
				            <label for="inputFile" class="col-md-2 control-label">File</label>
				            <div class="col-md-10">
				                <input type="text" readonly="" class="form-control floating-label" placeholder="Browse...">
				                <input type="file" id="inputFile" multiple="">
				            </div>
				        </div>
				        -->
				        <!--
				        <div class="form-group">
				            <label class="col-md-2 control-label">Radios</label>
				            <div class="col-md-10">
				                <div class="radio radio-primary">
				                    <label>
				                        <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked="">
				                        Option one is this
				                    </label>
				                </div>
				                <div class="radio radio-primary">
				                    <label>
				                        <input type="radio" name="optionsRadios" id="optionsRadios2" value="option2">
				                        Option two can be something else
				                    </label>
				                </div>
				            </div>
				        </div>
				        -->
				        <div class="form-group">
				            <div class="col-md-10 col-md-offset-2">
				                <button type="submit" class="btn btn-primary">Update options</button>
				            </div>
				        </div>
				    </fieldset>
				</form>
			</div>

	        <!--
	        <form method="POST" action="">
	            <div class="form-group">
	            	<input id="upload_image" type="text" size="36" name="upload_image" value="<?php //echo $gearimage; ?>" />
					<input id="upload_image_button" type="button" value="Upload Image" />
					<br />Enter an URL or upload an image for the banner.
	            </div>
	        </form>
	        -->
	    </div>
    	<?php
    }

    static function addCustomStylesAndScripts()
    {
    	# Custom styles
    	wp_register_style('material_design_theme_options_admin_styles', PLUGIN_URI . '/css/custom-admin.css', false, '1.0.0' );
    	wp_enqueue_style('material_design_theme_options_admin_styles');
    	# Custom scripts
    	wp_register_script('material_design_theme_options_admin_scripts', PLUGIN_URI . '/js/custom-admin.js', false, '1.0.0' );
    	wp_enqueue_script('material_design_theme_options_admin_scripts');
    	# ace editor
    	wp_register_script('ace_editor', PLUGIN_URI . '/js/plugins/ace/ace.js', false, '1.1.8' );
    	wp_enqueue_script('ace_editor');
    }

    static function addCustomStylesAndScriptsFrontend()
    {
    	# Custom styles
    	wp_register_style('material_design_theme_options_custom_styles', PLUGIN_URI . '/css/custom-frontend.css', false, '1.0.0' );
    	wp_enqueue_style('material_design_theme_options_custom_styles');
    }

}
