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

		if ($_GET['page'] === 'material-theme-options') {
			# Enqueue material design
	    	add_action('admin_enqueue_scripts', 'materialwp_scripts');
			# Add custom styles to admin page
			add_action('admin_enqueue_scripts', __CLASS__ . '::addCustomAdminStylesAndScripts');
			# Add admin print scripts
			add_action('admin_print_scripts', __CLASS__ . '::addCustomAdminPrintScripts');
			add_action('admin_print_styles', __CLASS__ . '::addCustomAdminPrintStyles');
		}
		
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
    		$backgroundColor     = $_POST['background-color'];
    		$customStyles        = $_POST['custom-styles'];
    		$customScripts       = $_POST['custom-scripts'];
    		$customFooter        = $_POST['custom-footer'];
    		$customClassHeader   = $_POST['custom-class-header'];
    		$customMenuAlign     = $_POST['custom-menu-align'];
    		$customMenuLogoUrl   = $_POST['custom-menu-logo-url'];
    		$customMenuBrandText = $_POST['custom-menu-brand-text'];

		    update_option('materialwp-materialwp_background-color', $backgroundColor);
		    update_option('materialwp-materialwp_custom-styles', htmlentities(stripslashes($customStyles)));
		    update_option('materialwp-materialwp_custom-scripts', htmlentities(stripslashes($customScripts)));
		    update_option('materialwp-materialwp_custom-footer', htmlentities(stripslashes($customFooter)));
		    update_option('materialwp-materialwp_custom-class-header', $customClassHeader);
		    update_option('materialwp-materialwp_custom-menu-align', $customMenuAlign);
		    update_option('materialwp-materialwp_custom-menu-logo-url', $customMenuLogoUrl);
		    update_option('materialwp-materialwp_custom-menu-brand-text', $customMenuBrandText);

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
	        	<a href="#" class="btn btn-success btn-fab btn-raised mdi-content-save" id="floating-save"></a>
		        <form id="material-theme-options" class="form-horizontal" method="POST" action="">
				    <fieldset>
				        <legend>
				        	<h2>Bootstrap Material Design Theme Options</h2>
			        	</legend>
			        	<legend>
			        		<h4>General Options</h4>
			        	</legend>
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
				        <legend>
				        	<h4>Header/Menu</h4>
			        	</legend>
			        	<div class="form-group">
				            <label for="custom-menu-logo-url" class="col-md-2 control-label">Logo</label>
				            <div class="col-md-10">
				                <input  type="text" 
				                		class="form-control" 
				                		id="custom-menu-logo-url" 
				                		name="custom-menu-logo-url" 
				                		value="<?php echo ($gearimage) ? $gearimage: get_option('materialwp-materialwp_custom-menu-logo-url'); ?>">
				                <input id="upload_image_button" type="button" value="Media image" />
				            </div>
				        </div>
				        <div class="form-group">
				        	<label for="custom-menu-brand-text" class="col-md-2 control-label">Brand Text</label>
				        	<div class="col-md-10">
				                <input  type="text" 
				                		class="form-control" 
				                		id="custom-menu-brand-text" 
				                		name="custom-menu-brand-text" 
				                		<?php if ($brandText = get_option('materialwp-materialwp_custom-menu-brand-text')) : ?>
				                			value="<?php echo $brandText; ?>"
				                		<?php else : ?>
				                			value="<?php bloginfo('name'); ?>"
			                			<?php endif; ?>
				                		>
	                		</div>
                		</div>
				        <div class="form-group">
				        	<label for="custom-class-header" class="col-md-2 control-label">Header type</label>
				        	<div class="col-md-5 radios-container">
				        		<?php $customClassHeader = get_option('materialwp-materialwp_custom-class-header'); ?>
				        		<?php foreach (self::getHeaderTypesArray() as $class => $name) : ?>
				        			<div class="radio radio-<?php echo $class; ?>">
								    	<label>
								      		<input type="radio" name="custom-class-header" value="navbar-<?php echo $class; ?>" <?php echo ('navbar-' . $class === $customClassHeader) ? 'checked=""' : ''; ?>>
								      		<?php echo $name; ?>
							    		</label>
								  	</div>	
				        		<?php endforeach; ?>
				        	</div>
				        </div>
				        <div class="form-group">
				        	<label for="custom-menu-align" class="col-md-2 control-label">Custom Menu Align</label>
				        	<div class="col-md-5">
				        		<?php $customMenuAlign = get_option('materialwp-materialwp_custom-menu-align'); ?>
				        		<div class="radio radio-success">
							    	<label>
							      		<input type="radio" name="custom-menu-align" value="navbar-left" <?php echo ('navbar-left' === $customMenuAlign) ? 'checked=""' : ''; ?>>
							      		Left
						    		</label>
							  	</div>
							  	<div class="radio radio-success">
							    	<label>
							      		<input type="radio" name="custom-menu-align" value="navbar-right" <?php echo ('navbar-right' === $customMenuAlign) ? 'checked=""' : ''; ?>>
							      		Right
						    		</label>
							  	</div>
				        	</div>
				        </div>
				        <div class="form-group">
				        	<label for="editor-custom-footer" class="col-md-2 control-label">Custom Footer</label>
				        	<div class="col-md-10">
				        		<!--<textarea 
				        				class="form-control" 
			        					id="editor-custom-footer" 
			        					name="custom-footer" 
			        					data-hint="Content or copyright of Footer."
			        					rows="5"></textarea>-->
	        					<pre id="editor-custom-footer"><?php echo get_option('materialwp-materialwp_custom-footer'); ?></pre>
			        		</div>
				        </div>
				        <input type="hidden" name="update_settings" value="Y">
				        <div class="form-group">
				            <div class="col-md-10 col-md-offset-2">
				                <button type="submit" class="btn btn-success">Update options</button>
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

    static function addCustomAdminStylesAndScripts()
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

    static function addCustomAdminPrintScripts()
    {
    	wp_enqueue_script('media-upload');
		wp_enqueue_script('thickbox');
		wp_enqueue_script('jquery');
    }

    static function addCustomAdminPrintStyles()
    {
    	wp_enqueue_style('thickbox');
    }

    static function addCustomStylesAndScriptsFrontend()
    {
    	# Custom styles
    	wp_register_style('material_design_theme_options_custom_styles', PLUGIN_URI . '/css/custom-frontend.css', false, '1.0.0' );
    	wp_enqueue_style('material_design_theme_options_custom_styles');
    	# Font Awesome
    	wp_register_style('font_awesome', PLUGIN_URI . '/css/font-awesome.min.css', false, '4.3.0' );
    	wp_enqueue_style('font_awesome');
    }

    static function getHeaderTypesArray()
    {
    	# Class => Name
    	return array(
    		'black'       => 'Navbar black',
    		'danger'      => 'Navbar danger',
    		'inverse'     => 'Navbar inverse',
    		'success'     => 'Navbar success',
    		'transparent' => 'Navbar transparent',
    		'warning'     => 'Navbar warning',
    		'white'       => 'Navbar white',
		);
    }

}
