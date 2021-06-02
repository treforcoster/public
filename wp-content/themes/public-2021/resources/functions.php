<?php

/**
 * Do not edit anything in this file unless you know what you're doing
 */

use Roots\Sage\Config;
use Roots\Sage\Container;

/**
 * Helper function for prettying up errors
 * @param string $message
 * @param string $subtitle
 * @param string $title
 */
$sage_error = function ($message, $subtitle = '', $title = '') {
    $title = $title ?: __('Sage &rsaquo; Error', 'sage');
    $footer = '<a href="https://roots.io/sage/docs/">roots.io/sage/docs/</a>';
    $message = "<h1>{$title}<br><small>{$subtitle}</small></h1><p>{$message}</p><p>{$footer}</p>";
    wp_die($message, $title);
};

/**
 * Ensure compatible version of PHP is used
 */
if (version_compare('7.1', phpversion(), '>=')) {
    $sage_error(__('You must be using PHP 7.1 or greater.', 'sage'), __('Invalid PHP version', 'sage'));
}

/**
 * Ensure compatible version of WordPress is used
 */
if (version_compare('4.7.0', get_bloginfo('version'), '>=')) {
    $sage_error(__('You must be using WordPress 4.7.0 or greater.', 'sage'), __('Invalid WordPress version', 'sage'));
}

/**
 * Ensure dependencies are loaded
 */
if (!class_exists('Roots\\Sage\\Container')) {
    if (!file_exists($composer = __DIR__.'/../vendor/autoload.php')) {
        $sage_error(
            __('You must run <code>composer install</code> from the Sage directory.', 'sage'),
            __('Autoloader not found.', 'sage')
        );
    }
    require_once $composer;
}

/**
 * Sage required files
 *
 * The mapped array determines the code library included in your theme.
 * Add or remove files to the array as needed. Supports child theme overrides.
 */
array_map(function ($file) use ($sage_error) {
    $file = "../app/{$file}.php";
    if (!locate_template($file, true, true)) {
        $sage_error(sprintf(__('Error locating <code>%s</code> for inclusion.', 'sage'), $file), 'File not found');
    }
}, ['helpers', 'setup', 'filters', 'admin']);

/**
 * Here's what's happening with these hooks:
 * 1. WordPress initially detects theme in themes/sage/resources
 * 2. Upon activation, we tell WordPress that the theme is actually in themes/sage/resources/views
 * 3. When we call get_template_directory() or get_template_directory_uri(), we point it back to themes/sage/resources
 *
 * We do this so that the Template Hierarchy will look in themes/sage/resources/views for core WordPress themes
 * But functions.php, style.css, and index.php are all still located in themes/sage/resources
 *
 * This is not compatible with the WordPress Customizer theme preview prior to theme activation
 *
 * get_template_directory()   -> /srv/www/example.com/current/web/app/themes/sage/resources
 * get_stylesheet_directory() -> /srv/www/example.com/current/web/app/themes/sage/resources
 * locate_template()
 * ├── STYLESHEETPATH         -> /srv/www/example.com/current/web/app/themes/sage/resources/views
 * └── TEMPLATEPATH           -> /srv/www/example.com/current/web/app/themes/sage/resources
 */
array_map(
    'add_filter',
    ['theme_file_path', 'theme_file_uri', 'parent_theme_file_path', 'parent_theme_file_uri'],
    array_fill(0, 4, 'dirname')
);
Container::getInstance()
    ->bindIf('config', function () {
        return new Config([
            'assets' => require dirname(__DIR__).'/config/assets.php',
            'theme' => require dirname(__DIR__).'/config/theme.php',
            'view' => require dirname(__DIR__).'/config/view.php',
        ]);
    }, true);


add_action('init', 'register_casestudies_post_type');

function register_casestudies_post_type()
{

    $cap_type       = 'post';
    $plural         = 'Casestudies';
    $single         = 'Casestudy';
    $cpt_name       = 'casestudy';
    $plugin_name    = 'public-casestudy';

    $opts['can_export']                             = true;
    $opts['capability_type']                        = $cap_type;
    $opts['description']                            = '';
    $opts['exclude_from_search']                    = false;
    $opts['has_archive']                            = true;
    $opts['hierarchical']                           = false;
    $opts['map_meta_cap']                           = true;
    $opts['menu_icon']                              = 'dashicons-portfolio';
    $opts['menu_position']                          = 25;
    $opts['public']                                 = true;
    $opts['publicly_querable']                      = true;
    $opts['query_var']                              = true;
    $opts['register_meta_box_cb']                   = '';
    $opts['rewrite']                                = array( 'slug' => 'casestudies','with_front' => false );
    $opts['show_in_admin_bar']                      = true;
    $opts['show_in_menu']                           = true;
    $opts['show_in_nav_menu']                       = true;
    $opts['show_ui']                                = true;
    $opts['supports']                               = array( 'title', 'editor', 'thumbnail', 'excerpt');
    $opts['taxonomies']                             = array('category' );

    $opts['capabilities']['delete_others_posts']    = "delete_others_{$cap_type}s";
    $opts['capabilities']['delete_post']            = "delete_{$cap_type}";
    $opts['capabilities']['delete_posts']           = "delete_{$cap_type}s";
    $opts['capabilities']['delete_private_posts']   = "delete_private_{$cap_type}s";
    $opts['capabilities']['delete_published_posts'] = "delete_published_{$cap_type}s";
    $opts['capabilities']['edit_others_posts']      = "edit_others_{$cap_type}s";
    $opts['capabilities']['edit_post']              = "edit_{$cap_type}";
    $opts['capabilities']['edit_posts']             = "edit_{$cap_type}s";
    $opts['capabilities']['edit_private_posts']     = "edit_private_{$cap_type}s";
    $opts['capabilities']['edit_published_posts']   = "edit_published_{$cap_type}s";
    $opts['capabilities']['publish_posts']          = "publish_{$cap_type}s";
    $opts['capabilities']['read_post']              = "read_{$cap_type}";
    $opts['capabilities']['read_private_posts']     = "read_private_{$cap_type}s";

    $opts['labels']['add_new']                      = esc_html__("Add New {$single}", $plugin_name);
    $opts['labels']['add_new_item']                 = esc_html__("Add New {$single}", $plugin_name);
    $opts['labels']['all_items']                    = esc_html__($plural, $plugin_name);
    $opts['labels']['edit_item']                    = esc_html__("Edit {$single}", $plugin_name);
    $opts['labels']['menu_name']                    = esc_html__($plural, $plugin_name);
    $opts['labels']['name']                         = esc_html__($plural, $plugin_name);
    $opts['labels']['name_admin_bar']               = esc_html__($single, $plugin_name);
    $opts['labels']['new_item']                     = esc_html__("New {$single}", $plugin_name);
    $opts['labels']['not_found']                    = esc_html__("No {$plural} Found", $plugin_name);
    $opts['labels']['not_found_in_trash']           = esc_html__("No {$plural} Found in Trash", $plugin_name);
    $opts['labels']['parent_item_colon']            = esc_html__("Parent {$plural} :", $plugin_name);
    $opts['labels']['search_items']                 = esc_html__("Search {$plural}", $plugin_name);
    $opts['labels']['singular_name']                = esc_html__($single, $plugin_name);
    $opts['labels']['view_item']                    = esc_html__("View {$single}", $plugin_name);

    $opts['rewrite']['ep_mask']                     = EP_PERMALINK;
    $opts['rewrite']['feeds']                       = false;
    $opts['rewrite']['pages']                       = true;
    $opts['rewrite']['slug']                        = esc_html__(strtolower($plural), $plugin_name);
    $opts['rewrite']['with_front']                  = false;

    //$opts = apply_filters( 'mypodium-gym-options', $opts );

    register_post_type(strtolower($cpt_name), $opts);
}


add_action( 'init', 'create_loactions_hierarchical_taxonomy', 0 );

function create_loactions_hierarchical_taxonomy() {

    $labels = array(
        'name' => _x( 'Format', 'taxonomy general name' ),
        'singular_name' => _x( 'Format', 'taxonomy singular name' ),
        'search_items' =>  __( 'Search Formats' ),
        'all_items' => __( 'All Formats' ),
        'parent_item' => __( 'Parent Format' ),
        'parent_item_colon' => __( 'Parent Format:' ),
        'edit_item' => __( 'Edit Format' ),
        'update_item' => __( 'Update Format' ),
        'add_new_item' => __( 'Add New Format' ),
        'new_item_name' => __( 'New Format Name' ),
        'menu_name' => __( 'Formats' ),
    );

    register_taxonomy('formats',array('post'), array(
        'hierarchical' => true,
        'labels' => $labels,
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'publicly_queryable' => false,
        'rewrite' => array( 'slug' => 'formats' ),
    ));

}




foreach( array( 'post', 'post-new' ) as $hook )
    add_action( "admin_footer-$hook.php", 'convert_cats_to_radio' );

function convert_cats_to_radio(){
    global $post;
    if( $post->post_type !== 'post') // select your desired Post Type
        return;

    ?>
    <script type="text/javascript">
        function makeRadioButtons(){
            jQuery("#formatschecklist input").each(function(){
                this.type = 'radio';
            });
            jQuery("#formats-adder").hide();
        }
        function newCategoryObserver(){
            // Example from developer.mozilla.org/en-US/docs/Web/API/MutationObserver
            var targetNode = document.getElementById('formatschecklist');
            var config = { attributes: true, childList: true, subtree: true };
            var callback = function(mutationsList) {
                for(var mutation of mutationsList) {
                    if (mutation.type == 'childList') {
                        makeRadioButtons();
                    }
                }
            };
            var observer = new MutationObserver(callback);
            observer.observe(targetNode, config);
        }
        newCategoryObserver();
        makeRadioButtons();
    </script>
    <?php
}


function my_acf_admin_head()
{
    ?>



    <style type="text/css">

        .acf-repeater .acf-row:nth-of-type(odd) .acf-row-handle.order {
            background: #e6e6e6 ;
        }

        .acf-repeater .acf-repeater .acf-table .acf-row:nth-of-type(odd) .acf-row-handle.order {
            background: #e6e6e6 ;
        }

        .acf-repeater .acf-repeater .acf-table .acf-row:nth-of-type(even) .acf-row-handle.order {
            background: #f4f4f4 ;
        }

        .acf-fields > .acf-field {
            margin: 0;
            padding: 15px 15px;
            border-top: #EEEEEE solid 1px;
            position: relative;

        }
        .acf-input {

        .select2-container {

            z-index:5000;


        }
        }
        .layout {
            margin: 10px 0 0;
            border: 5px solid #666 !important;
        }
        .layout .acf-fc-layout-controlls {
            position: absolute;
            top: 20px!important;
            right: 15px!important;
        }
        .layout .acf-fc-layout-handle {

            padding: 20px 20px!important;

        }

        .layout .acf-field-repeater{
            border:none;

        }

        .acf-radio-list li, ul.acf-checkbox-list li {
            font-size: 10px!important;

        }
        .acf-20-left {

            width: 20%;
            float: left !important;
            clear:both;
            border-left:0px solid!important;



        }
        .acf-80-right {

            width: 78%;
            float: right !important;
            clear:none !important;



        }
        .acf-50-clear-left {
            width: 50%;
            float: left !important;
            clear:both !important;

        }
        .acf-50-left {

            width: 50%;
            float: left !important;
            clear:none !important;



        }
        .acf-50-right {

            width: 50%;
            float: right !important;
            clear:none !important;
            min-height:0 !important;



        }
        .acf-30-left {

            width: 30%;
            float: left !important;
            clear:both;



        }

        .acf-70-right {

            width: 70%;
            float: right !important;
            clear:none !important;



        }
        .acf-70-left {

            width: 70%;
            float: left !important;
            border-top: none !important;
            clear:none !important;
            height: auto !important;


        }
        .acf-20-left {

            width: 20%;
            float: left !important;
            clear:both;

        }
        .acf-80-right {

            width: 80%;
            float: right !important;
            clear:none !important;



        }
        .acf-30-right {

            width: 30%;
            float: right !important;

            clear:none !important;
            min-height:0 !important;
            border-left:0px !important;
            border-top:0px !important;
        }
        .acf-80-left {

            width: 80%;
            float: left !important;
            border-top: none !important;
            clear:none !important;


        }
        .acf-20-right {

            width: 20%;
            float: right !important;

            clear:none !important;
            min-height:0 !important;
            border-left:0px !important;
            border-top:0px !important;
        }
        .acf-clear {

            clear:both !important;
        }
        .acf-clear-none {

            clear:none !important;
        }
        .acf-cta-text {
            background:#F1F1F1;

        }
        .acf-cta {
            background:#F1F1F1;
            height:110px;
        }
        .small-label {
            font-size:12px!important;
            padding: 10px 15px 12px 15px!important;
            color:#999;
            font-weight:normal!important;
        }
        .small-label .acf-label {
            margin: 0 0 2px!important;
        }

        .no-label .acf-label {
            display: none;
        }

        .no-label .acf-input {

            /*padding-top:10px;*/
        }

        .small-label .description {
            font-size:12px!important;
            padding: 5px 15px 5px 0px !important;
            color:#999;
            font-weight:normal!important;
        }

        .acf-field-group.acf-group-style {
            padding: 0!important;
        }

        .acf-field-group.acf-group-style .acf-fields.-border {
            border: 0!important;
        }

        .acf-field-group.acf-group-style > .acf-label:first-child {
            margin: 0;
        }

        .acf-field-group.acf-group-style > .acf-label:first-child label {
            font-size:12px!important;
            padding: 10px 15px 5px 15px !important;
            color:#999;
            font-weight:normal!important;
        }



        .acf-field .acf-label label {
            display: block;
            font-weight: normal!important;
            margin: 0 0 5px;
            padding: 0;
        }
        .acf-field-message .acf-input p{font-size:10px!important; color:#999; font-weight:normal!important; }

        .acf-link-40-left {

            width: 40%;
            float: left !important;
            border-top: none !important;
            clear:none !important;


        }

        .acf-image {
            height: auto!important;
            min-height: auto!important;
        }

        .acf-field-group.acf-group-style-no-label:first-child .acf-label label {
            display:none!important;
        }

        .acf-field-group.acf-group-style-no-label {
            padding: 0!important;
            border-bottom: 1px solid #eeeeee;
        }

        .acf-field-group.acf-group-style-no-label .acf-fields.-border {
            border: 0!important;
        }

        .acf-field-group.acf-group-style-no-label > .acf-label:first-of-type {
            display:none!important;
        }

        .acf-field-group.acf-group-style-no-label > .acf-label:first-child label {
            font-size:12px!important;
            padding: 10px 15px 5px 15px !important;
            color:#999;
            font-weight:normal!important;
        }

        .acf-field-group.acf-group-style-no-label:first-child .acf-label label {
            display:none!important;
        }

        .acf-field-group.acf-group-style-no-label .acf-input .acf-label label {
            display:block!important;
        }

        /*.section-group-style-no-label .acf-label:first-child label{
            display:none!important;
        }

        .section-group-style-no-label > .acf-label:first-child label{
            display:none!important;
        }

        .section-group-style-no-label .acf-input .acf-label label{
            display:block!important;
        }*/

        .acf-field-group.accordion-group-style-no-label {
            padding: 0!important;
            border-bottom: 0px solid #eeeeee;
        }

        .acf-field-group.accordion-group-style-no-label .acf-fields.-border {
            border: 0!important;
        }

        .acf-field-group.accordion-group-style-no-label > .acf-label:first-of-type {
            display:none!important;
        }

        .acf-field-group.accordion-group-style-no-label > .acf-label:first-child label {
            font-size:12px!important;
            padding: 10px 15px 5px 15px !important;
            color:#999;
            font-weight:normal!important;
        }

        .acf-field-group.acf-group-style-no-label:first-child .small-label .acf-label label {
            display: block!important;
        }




        #edittag {
            max-width: 100%;
        }

        .acf-color-swatch {
            margin-right: 10px;
            width: 70px;
            display: inline-block;
        }

        .acf-color-swatch:before {
            color: #FFF;
            content: "";
            width: 20px;
            height: 20px;
            display: inline-block;
            position: relative;
            top: 6px;
            margin-left: 5px;
            margin-right: 10px;
            border: 1px solid #ddd;
        }

        <?php $options = get_fields("options"); ?>

        .acf-bg-white:before {
            background-color: <?php echo $options["bg_white"];?>;
        }

        .acf-bg-black:before {
            background-color: <?php echo $options["bg_black"];?>;
        }

        .acf-bg-light:before {
            background-color: <?php echo $options["bg_light"];?>;
        }

        .acf-bg-dark:before {
            background-color: <?php echo $options["bg_dark"];?>;
        }

        .acf-bg-primary:before {
            background-color: <?php echo $options["bg_primary"];?>;
        }

        .acf-bg-primary-alt:before {
            background-color: <?php echo $options["bg_primary-alt"];?>;
        }

        .acf-bg-secondary:before {
            background-color: <?php echo $options["bg_secondary"];?>;
        }

        .acf-bg-secondary-alt:before {
            background-color: <?php echo $options["bg_secondary-alt"];?>;
        }

        .acf-text-white:before {
            background-color: <?php echo $options["text_white"];?>;
        }

        .acf-text-black:before {
            background-color: <?php echo $options["text_black"];?>;
        }

        .acf-text-light:before {
            background-color: <?php echo $options["text_light"];?>;
        }

        .acf-text-dark:before {
            background-color: <?php echo $options["text_dark"];?>;
        }



        [class^="icon-"] {
            font-size: 18px;
            position: relative;
            top: 4px
        }


        /* .bg-colour-white {
             background-color: var(--background-color-white);
         }

         .bg-colour-black {
             background-color: var(--background-color-black);
         }

         .bg-colour-light {
             background-color: var(--background-color-light);
         }

         .bg-colour-dark {
             background-color: var(--background-color-dark);
         }

         .bg-colour-primary {
             background-color: var(--background-color-primary);
         }

         .bg-colour-primary-alt {
             background-color: var(--background-color-primary-alt);
         }

         .bg-colour-secondary {
             background-color: var(--background-color-secondary);
         }

         .bg-colour-secondary-alt {
             background-color: var(--background-color-secondary-alt);
         }

         .text-black h1,
         .text-black h2,
         .text-black h3,
         .text-black h4,
         .text-black h5 {
             color: var(--text-color-black-headings) !important;
         }

         .text-black p,
         .text-black ol,
         .text-black ul,
         .text-black blockquote {
             color: var(--text-color-black-copy);
         }

         .text-black a {
             color: var(--text-color-black-links);
         }

         .text-black a:hover {
             color: var(--text-color-black-links-hover);
         }

         .text-black .text-seperator .seperator-inner:before {
             background: var(--text-color-black-copy);
         }

         .text-white h1,
         .text-white h2,
         .text-white h3,
         .text-white h4,
         .text-white h5 {
             color: var(--text-color-white-headings) !important;
         }

         .text-white p,
         .text-white ol,
         .text-white ul,
         .text-white blockquote {
             color: var(--text-color-white-copy);
         }

         .text-white a {
             color: var(--text-color-white-links);
         }

         .text-white a:hover {
             color: var(--text-color-white-links-hover);
         }

         .text-white .text-seperator .seperator-inner:before {
             background: var(--text-color-white-copy);
         }

         .text-dark h1,
         .text-dark h2,
         .text-dark h3,
         .text-dark h4,
         .text-dark h5 {
             color: var(--text-color-dark-headings) !important;
         }

         .text-dark p,
         .text-dark ol,
         .text-dark ul,
         .text-dark blockquote {
             color: var(--text-color-dark-copy);
         }

         .text-dark a {
             color: var(--text-color-dark-links);
         }

         .text-dark a:hover {
             color: var(--text-color-dark-links-hover);
         }

         .text-dark .text-seperator .seperator-inner:before {
             background: var(--text-color-dark-copy);
         }

         .text-light h1,
         .text-light h2,
         .text-light h3,
         .text-light h4,
         .text-light h5 {
             color: var(--text-color-light-headings) !important;
         }

         .text-light p,
         .text-light ol,
         .text-light ul,
         .text-light blockquote {
             color: var(--text-color-light-copy);
         }

         .text-light a {
             color: var(--text-color-light-links);
         }

         .text-light a:hover {
             color: var(--text-color-light-links-hover);
         }

         .text-light .text-seperator .seperator-inner:before {
             background: var(--text-color-light-copy);
         }


         .wp-block h1,
         .wp-block h2,
         .wp-block h3,
         .wp-block h4,
         .wp-block h5,
         .wp-block h6 {
             font-family: var(--font-headings);
         }

         .wp-block p,
         .wp-block ol,
         .wp-block ul {
             font-family: var(--font-copy);
         }

         .wp-block blockquote p {
             font-family: var(--font-quotes);
         }

         .wp-block blockquote cite {
             font-family: var(--font-cite);
         }*/



        .acf-field.acf-accordion .acf-label.acf-accordion-title {
            padding: 12px 12px 8px 12px;
            width: auto;
            float: none;
            width: auto;
            background: #f3f4f5;
        }

        .acf-accordion .acf-label.acf-accordion-title:hover {
            background: #f1f1f1;
        }

        /* ACF "half-repeater" class, display repeaters in horizontal columns */
        .half-repeater .acf-repeater tr.acf-row:not(.acf-clone)
        {
            display: inline-block !important;
            width: 50% !important;
        }

        .half-repeater .acf-repeater tr.acf-row:not(.acf-clone) td.acf-fields
        {
            width: 100%;
        }


    </style>

    <?php
}

add_action('acf/input/admin_head', 'my_acf_admin_head');

add_filter( 'wpseo_metabox_prio', function() { return 'low'; } );
