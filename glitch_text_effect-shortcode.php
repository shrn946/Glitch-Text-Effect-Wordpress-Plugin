<?php
/**
 * Plugin Name: Glitch Text Effect
 * Description: Add a glitch text effect to your Elementor website using a shortcode. [glitch_text_effect text="Add Text"]
 * Version: 1.0
 * Author: Hassan Naqvi
 */
 
 
function enqueue_glitch_scripts_and_styles() {
    // Enqueue your custom stylesheet
    wp_enqueue_style('glitch-style', plugin_dir_url(__FILE__) . 'style.css', array(), '1.0');
}

add_action('wp_enqueue_scripts', 'enqueue_glitch_scripts_and_styles');

// Counter variable to keep track of the number of instances
static $glitch_instance = 0;

function glitch_text_effect_shortcode($atts) {
    global $glitch_instance;

    // Increment the counter
    $glitch_instance++;

    // Shortcode attributes
    $atts = shortcode_atts(
        array(
            'text' => 'GLITCH', // Default text
        ),
        $atts,
        'glitch_text_effect'
    );

    ob_start();
    ?>
    <div class="glitch glitch-<?php echo esc_attr($glitch_instance); ?>" data-text="<?php echo esc_attr($atts['text']); ?>"><?php echo esc_html($atts['text']); ?></div>
    <?php
    return ob_get_clean();
}

add_shortcode('glitch_text_effect', 'glitch_text_effect_shortcode');


// Register the settings menu
add_action('admin_menu', 'glitch_text_effect_settings_menu');

function glitch_text_effect_settings_menu() {
    add_options_page('Glitch Text Effect Settings', 'Glitch Text Effect', 'manage_options', 'glitch_text_effect_settings', 'glitch_text_effect_settings_page');
}

// Settings page content
function glitch_text_effect_settings_page() {
    ?>
    <div class="wrap">
        <h1>Glitch Text Effect Shortcode</h1>
               <h2>Instructions:</h2>
        <p>Use the shortcode <code>[glitch_text_effect text="Add Text"]</code> to add the glitch text effect to your content.</p>


Each shortcode will have its own class name, which you can style via CSS <code>.glitch-2, glitch-3,glitch-4....</code> 


        <h2>Video Tutorial</h2>
  
                <iframe width="560" height="315" src="https://www.youtube.com/embed/6aYvQnGjfjI?si=6jRv5GNL6y4wwtOr" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>


    </div>
    <?php
}