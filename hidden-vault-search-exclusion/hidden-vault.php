<?php
/**
 * Plugin Name: Hidden Vault: Advanced Search Exclusion
 * Description: Exclude specific posts, pages, and products from search results for The Copper & Grain Collective.
 * Version: 1.0.0
 * Author: Francisco Garay
 */

if (!defined('ABSPATH')) exit;

// Define plugin constants
define('HIDDEN_VAULT_PATH', plugin_dir_path(__FILE__));
define('HIDDEN_VAULT_META_KEY', '_hv_hide_from_search');

// Include requirements
require_once HIDDEN_VAULT_PATH . 'admin/meta-box.php';
require_once HIDDEN_VAULT_PATH . 'admin/settings-page.php';
require_once HIDDEN_VAULT_PATH . 'includes/query-logic.php';