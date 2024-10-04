<?php
/*
Plugin Name: Easy Video Player
Version: 1.2.1
Plugin URI: https://noorsplugin.com/wordpress-video-plugin/
Author: naa986
Author URI: https://noorsplugin.com/
Description: Easily embed videos into your WordPress blog
Text Domain: easy-video-player
Domain Path: /languages
 */

if (!defined('ABSPATH')) {
    exit;
}
if (!class_exists('EASY_VIDEO_PLAYER')) {

    class EASY_VIDEO_PLAYER {

        var $plugin_version = '1.2.1';
        var $player_version = '3.6.2';

        function __construct() {
            define('EASY_VIDEO_PLAYER_VERSION', $this->plugin_version);
            $this->plugin_includes();
        }

        function plugin_includes() {
            add_action('plugins_loaded', array($this, 'plugins_loaded_handler'));
            add_action('wp_enqueue_scripts', 'easy_video_player_enqueue_scripts');
            add_action('admin_menu', array($this, 'easy_video_player_add_options_menu'));
            //add_action('wp_head', 'easy_video_player_header');
            add_shortcode('evp_embed_video', 'evp_embed_video_handler');
            //allows shortcode execution in the widget, excerpt and content
            add_filter('widget_text', 'do_shortcode');
            add_filter('the_excerpt', 'do_shortcode', 11);
            add_filter('the_content', 'do_shortcode', 11);
        }

        function plugin_url() {
            if ($this->plugin_url)
                return $this->plugin_url;
            return $this->plugin_url = plugins_url(basename(plugin_dir_path(__FILE__)), basename(__FILE__));
        }
        
        function plugins_loaded_handler()
        {
            load_plugin_textdomain('easy-video-player', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/'); 
        }

        function easy_video_player_add_options_menu() {
            if (is_admin()) {
                add_options_page(__('Easy Video Player', 'easy-video-player'), __('Easy Video Player', 'easy-video-player'), 'manage_options', 'easy-video-player-settings', array($this, 'easy_video_player_options_page'));
            }
            add_action('admin_init', array(&$this, 'easy_video_player_add_settings'));
        }

        function easy_video_player_add_settings() {
            register_setting('easy-video-player-settings-group', 'evp_enable_jquery');
        }

        function easy_video_player_options_page() {
            $url = "https://noorsplugin.com/wordpress-video-plugin/";
            $link_text = sprintf(wp_kses(__('For detailed documentation please visit the plugin homepage <a target="_blank" href="%s">here</a>.', 'easy-video-player'), array('a' => array('href' => array(), 'target' => array()))), esc_url($url));          
            ?>
            <div class="wrap">
                <h1>Easy Video Player - v<?php echo $this->plugin_version; ?></h1>
                <div class="update-nag"><?php echo $link_text;?></div>
                    <h2 class="title"><?php _e('General Settings', 'easy-video-player')?></h2>		
                        <form method="post" action="options.php">
                            <?php settings_fields('easy-video-player-settings-group'); ?>
                            <table class="form-table">
                                <tr valign="top">
                                    <th scope="row"><?php _e('Enable jQuery', 'easy-video-player')?></th>
                                    <td><input type="checkbox" id="evp_enable_jquery" name="evp_enable_jquery" value="1" <?php echo checked(1, get_option('evp_enable_jquery'), false) ?> /> 
                                        <p><i><?php _e('By default this option should always be checked.', 'easy-video-player')?></i></p>
                                    </td>
                                </tr>
                            </table>

                            <p class="submit">
                                <input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
                            </p>		
                        </form>
            </div>
            <?php
        }

    }

    $GLOBALS['easy_video_player'] = new EASY_VIDEO_PLAYER();
}

function easy_video_player_enqueue_scripts() {
    if (!is_admin()) {
        $plugin_url = plugins_url('', __FILE__);
        $enable_jquery = get_option('evp_enable_jquery');
        if ($enable_jquery) {
            wp_enqueue_script('jquery');
        }
        wp_register_style('plyr-css', $plugin_url . '/lib/plyr.css');
        wp_enqueue_style('plyr-css');
        wp_register_script('plyr-js', $plugin_url . '/lib/plyr.min.js');
        wp_enqueue_script('plyr-js');
    }
}

function easy_video_player_header() {
    if (!is_admin()) {
        $fp_config = '<!-- This content is generated with the Easy Video Player plugin v' . EASY_VIDEO_PLAYER_VERSION . ' - http://noorsplugin.com/wordpress-video-plugin/ -->';
        $fp_config .= '<!-- Easy Video Player plugin -->';
        echo $fp_config;
    }
}

function evp_embed_video_handler($atts) {
    $atts = shortcode_atts(array(
        'url' => '',
        'width' => '',
        'height' => '',
        'ratio' => '16:9',
        'autoplay' => 'false',
        'poster' => '',
        'loop' => '',
        'muted' => '',
        'preload' => 'metadata',
        'share' => 'true',
        'video_id' => '',
        'class' => '',
        'template' => '',
    ), $atts);
    $atts = array_map('sanitize_text_field', $atts);
    extract($atts);
    //check if mediaelement template is specified
    if($template=='mediaelement'){
        $attr = array();
        $attr['src'] = $url;
        if(is_numeric($width)){
            $attr['width'] = $width;
        }
        if(is_numeric($height)){
            $attr['height'] = $height;
        }
        if ($autoplay == "true"){
            $attr['autoplay'] = 'on';
        }
        if ($loop == "true"){
            $attr['loop'] = 'on';
        }
        if (!empty($poster)){
            $attr['poster'] = $poster;
        }
        if (!empty($preload)){
            $attr['preload'] = $preload;
        }
        return wp_video_shortcode($attr);
    }
    //width
    if(!empty($width)){
        $width = ' style="max-width:'.$width.'px;"';
    }
    else{
        $width = '';
    }
    //custom video id
    if(!empty($video_id)){
        $video_id = ' id="'.$video_id.'"';
    }
    //autoplay
    if ($autoplay == "true") {
        $autoplay = " autoplay";
    } else {
        $autoplay = "";
    }
    //loop
    if ($loop == "true") {
        $loop= " loop";
    }
    else{
        $loop= "";
    }
    //muted
    if($muted == "true"){
        $muted = " muted";
    }
    else{
        $muted = "";
    }
    //poster
    if(!empty($poster)){
        $poster = ' data-poster="'.$poster.'"';
    }
    else{
        $poster = '';
    }
    //ratio only allows 16:9/4:3
    if($ratio == "4:3"){
        $ratio = "4:3";
    }
    else{
        $ratio = "16:9";
    }
    //class
    if(!empty($class)){
        $class = ' class="'.$class.'"';
    }
    else{
        $class = '';
    }
    $video_id = "plyr" . uniqid(); 
    $output = <<<EOT
    <div{$width}>        
    <video id="{$video_id}"{$autoplay}{$loop}{$muted}{$poster}{$class}>
       <source src="$url" type="video/mp4" />
    </video>
    </div>        
    <script>
        const evplayer{$video_id} = new Plyr(document.getElementById('$video_id'));
        evplayer{$video_id}.ratio = '{$ratio}';         
    </script>
EOT;
       
    return $output;
}
