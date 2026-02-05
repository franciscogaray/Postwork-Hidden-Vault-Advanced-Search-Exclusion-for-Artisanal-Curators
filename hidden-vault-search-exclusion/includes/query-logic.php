<?php
add_action('pre_get_posts', 'hv_exclude_hidden_items_from_search');

function hv_exclude_hidden_items_from_search($query) {
    // Only modify the main search query on the frontend
    if (!is_admin() && $query->is_main_query() && $query->is_search()) {
        
        // Retrieve IDs of all posts where exclusion is active
        $hidden_ids = get_posts([
            'post_type' => ['post', 'page', 'product'],
            'meta_query' => [[
                'key' => HIDDEN_VAULT_META_KEY,
                'value' => '1',
            ]],
            'fields' => 'ids',
            'posts_per_page' => -1,
        ]);

        if (!empty($hidden_ids)) {
            $query->set('post__not_in', $hidden_ids);
        }
    }
}