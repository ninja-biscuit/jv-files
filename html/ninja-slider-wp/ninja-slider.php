<?php

/*
  Plugin Name: Ninja Slider
  Plugin URI: http://www.menucool.com/responsive-slider.aspx
  Description: Slider Component for WordPress
  Version: v2014.1.11
  Author: Menucool.com
  Author URI: http://www.menucool.com/
  License: Required
 */

//add JSs and CSS
add_action('wp_enqueue_scripts', 'nslider_scripts');
function nslider_scripts() {
    wp_register_style('nslider_css', plugins_url('ninja-slider.css', __FILE__));
    wp_enqueue_style('nslider_css');
    
    $option_video = get_option('mcns_video');
    if($option_video == 'on'){
        wp_register_script('ninjaVideoPlugin', plugins_url('ninjaVideoPlugin.js', __FILE__));
        wp_enqueue_script('ninjaVideoPlugin');
    }
    
    wp_register_script('nsliderjs_core', plugins_url('ninja-slider.js', __FILE__));//, array("ninjaVideoPlugin")
    wp_enqueue_script('nsliderjs_core');
}


//add HTML: The shorcode will be replaced by the callback return value
add_shortcode("NinjaSlider", "ninja_display_slider");
function ninja_display_slider() {//$attr, $content
    //extract(shortcode_atts(array('sliderId' => 'ninja-slider2'), $attr));
    $html = '<div id="ninja-slider">
    <ul>
        <li><div data-image="img/md/1.jpg"></div></li>
        <li><div data-image="img/md/2.jpg"></div></li>
        <li><div data-image="img/md/3.jpg"></div></li>
        <li><div data-image="img/md/4.jpg"></div></li>
        <li><div data-image="img/md/5.jpg"></div></li>
    </ul>
</div>';
    
    //transform "img/md/x.jpg" to "/wp-content/plugins/ninja-slider/img/md/x.jpg"
    $html = preg_replace('/(data-image\s*=\s*[\'"])(.+?)([\'"])/', "$1".plugins_url("$2", __FILE__)."$3", $html);
    return $html;
}


register_uninstall_hook( __FILE__, 'mcns_uninstall_hook' );
function mcns_uninstall_hook() {
    delete_option('mcns_video');
    delete_option('mcns_thumb');
}

//create a menu link on the admin panel for the plugin option settings page
add_action('admin_menu', 'mcns_add_menu');
function mcns_add_menu(){
    //create new top-level menu
    //add_menu_page( page_title, menu_title, capability, menu_slug, function, icon_url, position );
    add_menu_page('Ninja Slider Settings Page', 'Ninja Slider Settings', 'manage_options', 'McNS', 'mcns_settings_page', plugins_url( 'wordpress.png', __FILE__ ));
}
//create option settings page
add_action('admin_init', 'mcns_register_settings');
function mcns_register_settings(){
    //3 params: options group name; actual option name; callback function to sanitize the option values 
    register_setting( 'mcns-settings-group', 'mcns_video'); //, 'mcns_sanitize_settings' 
    register_setting( 'mcns-settings-group', 'mcns_thumb'); 
}

function mcns_settings_page(){
?>
<div class="wrap">
<h2>Ninja Slider Plugin Options</h2>
<form method="post" action="options.php">
    <?php settings_fields( 'mcns-settings-group' );
    $option_video = (get_option('mcns_video')=='on')?'checked':'';
    $option_thumb = (get_option('mcns_thumb')=='on')?'checked':''; ?>
    
    <label for="video" style="width:120px;display:inline-block;">Video:</label>
    <input type="checkbox" id="video" name="mcns_video" <?php echo $option_video ?> />
    <hr/>
    <label for="thumb" style="width:120px;display:inline-block;">Thumbnail:</label>
    <input type="checkbox" id="thumb" name="mcns_thumb" <?php echo $option_thumb ?> />

    <p class="submit"><input type="submit" value="Save Changes" /></p>
</form>
</div>
<?php } ?>