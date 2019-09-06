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

namespace Arvernus\Apple_Maps_Block;
//  Exit if accessed directly.
defined('ABSPATH') || exit;

$plugin_data = get_file_data(__FILE__, array('Version' => 'Version'), false);
$plugin_version = $plugin_data['Version'];

define('BLOCK_CURRENT_VERSION', $plugin_version);

add_action('plugins_loaded', __NAMESPACE__ . '\arvernus_load_textdomain');
function arvernus_load_textdomain()
{
    load_plugin_textdomain(__NAMESPACE__ . '-block', false, basename(dirname(__FILE__)) . '/languages/');
}

/**
 * Gets this plugin's absolute directory path.
 *
 * @since  2.1.0
 * @ignore
 * @access private
 *
 * @return string
 */
function _get_plugin_directory()
{
    return __DIR__;
}

/**
 * Gets this plugin's URL.
 *
 * @since  2.1.0
 * @ignore
 * @access private
 *
 * @return string
 */
function _get_plugin_url()
{
    static $plugin_url;
    if (empty($plugin_url)) {
        $plugin_url = plugins_url(null, __FILE__);
    }
    return $plugin_url;
}

define('PLUGIN_ROOT', _get_plugin_url(__FILE__));


add_action('init', __NAMESPACE__ . '\register_block_assets');
function register_block_assets()
{

    $block_path = '/build/index.js';
    $script_deps_path = _get_plugin_directory() . '/build/editor.deps.json';
    $script_dependencies = file_exists($script_deps_path)
        ? json_decode(file_get_contents($script_deps_path))
        : array();
    wp_register_script(
        __NAMESPACE__ . '-block',
        PLUGIN_ROOT . $block_path,
        array_merge($script_dependencies, ['apple-mapkit-js']),
        BLOCK_CURRENT_VERSION
    );

    $style_path = '/style.css';
    wp_register_style(
        __NAMESPACE__ . '-block-styles',
        PLUGIN_ROOT . $style_path,
        [],
        BLOCK_CURRENT_VERSION
    );

    $editor_style_path = '/editor.css';
    wp_register_style(
        __NAMESPACE__ . '-block-editor-styles',
        PLUGIN_ROOT . $editor_style_path,
        [],
        BLOCK_CURRENT_VERSION
    );

    register_block_type('arvernus/apple-maps-block', array(
        'editor_script' => __NAMESPACE__ . '-block',
        'editor_style' => __NAMESPACE__ . '-block-editor-styles',
        'style' => __NAMESPACE__ . '-block-styles',
    ));
}
