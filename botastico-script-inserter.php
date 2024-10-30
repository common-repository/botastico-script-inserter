<?php
/*
* Plugin Name: Botastico Script Inserter
* Description: Allows you to effortlessly embed the Botastico script, using your specific app id, directly into the head section of the HTML document.
* Version: 1.0.0
* Author: Botastico
* Author URI: https://www.botasti.co/
*/

// create a submenu page under the "Settings" menu in the WordPress admin dashboard
function add_script_inserter_to_menu() {
    add_submenu_page( 'options-general.php', "Botastico Script Inserter", "Botastico Script Inserter", 'manage_options', "botastico-script-inserter", "script_inserter_settings_page");
}
add_action('admin_menu', 'add_script_inserter_to_menu');

function script_inserter_settings_page() {
    if (!current_user_can('manage_options')) {
        wp_die(__('You do not have sufficient permissions to access this page.'));
    }

    if (isset($_POST['submit'])) {
        // save the entered app id to WP options
        $app_id = sanitize_text_field($_POST['app_id']);
        update_option('botastico_app_id', $app_id);
        echo '<div class="notice notice-success"><p>Settings saved.</p></div>';
    }
    
    // get the current app id from options
    $current_app_id = get_option('botastico_app_id');

    wp_enqueue_style('botastico-script-style', plugins_url('media/css/settings.css', __FILE__));

    include_once(plugin_dir_path( __FILE__ ) . '/views/settings.php' );
}

function insert_botastico_script() {
    $app_id = get_option('botastico_app_id');
    
    if (!empty($app_id)) {
        echo '<script>
            window.botasticoAppSettings = {
                appId: \'' . esc_js($app_id) . '\',
            };
            var script = document.createElement(\'script\');
            script.src = \'https://chatapps.botasti.co/main.js\';
            script.async = true;
            document.head.appendChild(script);
        </script>';
    }
}

add_action('wp_head', 'insert_botastico_script');
?>