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
		add_action('admin_menu', __CLASS__ . '::addAppearanceMenu');
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
    	?>
    	<div class="wrap">
	        <?php screen_icon('themes'); ?> <h2>Front page elements</h2>

	        <form method="POST" action="">
	            <table class="form-table">
	                <tr valign="top">
	                    <th scope="row">
	                        <label for="num_elements">
	                            Number of elements on a row:
	                        </label> 
	                    </th>
	                    <td>
	                        <input type="text" name="num_elements" size="25" />
	                    </td>
	                </tr>
	            </table>
	        </form>
	    </div>
    	<?php
    }

}
