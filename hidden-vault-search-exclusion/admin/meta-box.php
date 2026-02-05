<?php
add_action('add_meta_boxes', 'hv_add_exclusion_meta_box');
add_action('save_post', 'hv_save_exclusion_meta_data');

function hv_add_exclusion_meta_box() {
    $screens = ['post', 'page', 'product'];
    foreach ($screens as $screen) {
        add_meta_box(
            'hv_search_exclude', 
            'Search Visibility', 
            'hv_meta_box_callback', 
            $screen, 
            'side', 
            'high'
        );
    }
}

function hv_meta_box_callback($post) {
    $value = get_post_meta($post->ID, HIDDEN_VAULT_META_KEY, true);
    wp_nonce_field('hv_save_meta', 'hv_meta_nonce');
    ?>
    <label>
        <input type="checkbox" name="hv_hide_from_search" value="1" <?php checked($value, '1'); ?>>
        <strong>Hide from Search</strong>
    </label>
    <p class="description">Exclude this item from frontend search results.</p>
    <?php
}

function hv_save_exclusion_meta_data($post_id) {
    if (!isset($_POST['hv_meta_nonce']) || !wp_verify_nonce($_POST['hv_meta_nonce'], 'hv_save_meta')) return;
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;

    $is_hidden = isset($_POST['hv_hide_from_search']) ? '1' : '0';
    update_post_meta($post_id, HIDDEN_VAULT_META_KEY, $is_hidden);
}