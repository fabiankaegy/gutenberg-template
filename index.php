<?php

/**
 * Plugin Name: Gutenberg Template
 * Description: A template for building Gutenberg blocks.
 * Author: fabiankaegy
 * Author URI: https://fabian-kaegy.de
 * Text Domain: gutenberg-template
 * Domain Path: /languages
 * Version: 1.0.0
 */

$plugin_data = get_file_data(__FILE__, ['Version' => 'Version'], false);
$plugin_version = $plugin_data['Version'];
define( "PLUGIN_VERSION", $plugin_version );

add_action('init',  'register_block_assets');
function register_block_assets()
{

    $block_path = 'build/index.js';
    $script_deps_path = plugins_url('build/index.deps.json', __FILE__);
    $script_dependencies = file_exists($script_deps_path)
        ? json_decode(file_get_contents($script_deps_path))
        : [];
    wp_register_script(
        'example-block',
        plugins_url($block_path, __FILE__ ),
        array_merge($script_dependencies, []),
        PLUGIN_VERSION
    );

    $style_path = 'style.css';
    wp_register_style(
        'example-block-styles',
        plugins_url($style_path, __FILE__ ),
        [],
        PLUGIN_VERSION
    );

    $editor_style_path = 'editor.css';
    wp_register_style(
        'example-block-editor-styles',
        plugins_url($editor_style_path, __FILE__ ),
        [],
        PLUGIN_VERSION
    );

    register_block_type('fabiankaegy/example', [
        'editor_script' =>  'example-block',
        'style' =>  'example-block-styles',
        'editor_style' =>  'example-block-editor-styles',
    ]);
}
