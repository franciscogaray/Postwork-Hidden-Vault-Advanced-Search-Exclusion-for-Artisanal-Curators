<?php
add_action('admin_menu', 'hv_register_settings_page');

function hv_register_settings_page() {
    add_options_page(
        'Hidden Vault Management', 
        'Hidden Vault', 
        'manage_options', 
        'hidden-vault', 
        'hv_settings_page_html'
    );
}

function hv_settings_page_html() {
    if (isset($_POST['restore_ids']) && check_admin_referer('hv_bulk_restore')) {
        foreach ($_POST['restore_ids'] as $id) {
            update_post_meta($id, HIDDEN_VAULT_META_KEY, '0');
        }
        echo '<div class="updated"><p>Visibility restored to selected items.</p></div>';
    }

    $hidden_items = new WP_Query([
        'post_type' => ['post', 'page', 'product'],
        'meta_key' => HIDDEN_VAULT_META_KEY,
        'meta_value' => '1',
        'posts_per_page' => -1
    ]);
    ?>
    <div class="wrap">
        <h1>Hidden Vault: Bulk Management</h1>
        <form method="post">
            <?php wp_nonce_field('hv_bulk_restore'); ?>
            <table class="wp-list-table widefat fixed striped">
                <thead>
                    <tr>
                        <th class="manage-column column-cb check-column"><input type="checkbox"></th>
                        <th>Title</th>
                        <th>Type</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($hidden_items->have_posts()) : while ($hidden_items->have_posts()) : $hidden_items->the_post(); ?>
                        <tr>
                            <td><input type="checkbox" name="restore_ids[]" value="<?php the_ID(); ?>"></td>
                            <td><strong><?php the_title(); ?></strong></td>
                            <td><?php echo strtoupper(get_post_type()); ?></td>
                            <td><span class="dashicons dashicons-hidden"></span> Hidden</td>
                        </tr>
                    <?php endwhile; wp_reset_postdata(); else : ?>
                        <tr><td colspan="4">No items are currently hidden.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
            <?php submit_button('Restore Selected Items'); ?>
        </form>
    </div>
    <?php
}