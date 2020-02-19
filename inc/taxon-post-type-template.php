<?php
/**
 * Add "Taxon" template to page attirbute template section.
 */
function taxon_post_type_add_template_to_select( $post_templates, $wp_theme, $post, $post_type ) {

    // Add custom template named template-taxon.php to select dropdown 
    $post_templates['template-taxon.php'] = __('Taxon');

    return $post_templates;
}

add_filter( 'theme_page_templates', 'taxon_post_type_add_template_to_select', 10, 4 );


/**
 * Check if current page has our custom template. Try to load
 * template from theme directory and if not exist load it 
 * from root plugin directory.
 */
function taxon_post_type_load_plugin_template( $template ) {

    if(  get_page_template_slug() === 'template-taxon.php' ) {

        if ( $theme_file = locate_template( array( 'template-taxon.php' ) ) ) {
            $template = $theme_file;
        } else {
            $template = plugin_dir_path( __FILE__ ) . 'template-taxon.php';
        }
    }

    if ($template == '') {
        throw new \Exception('No template found');
    }

    return $template;
}

add_filter( 'template_include', 'taxon_post_type_load_plugin_template' );
