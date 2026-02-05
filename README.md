# Hidden Vault: Advanced Search Exclusion for Artisanal Curators

**Hidden Vault** is a high-end WordPress plugin developed for *The Copper & Grain Collective*. It provides bespoke internal search curation, allowing admins to hide exclusive "members-only" previews, draft landing pages, and archival content without taking the pages offline.

## Installation

1. **Upload via WordPress Admin**: 
   - Navigate to **Plugins > Add New > Upload Plugin**.
   - Select the `hidden-vault-search-exclusion.zip` file and click **Install Now**.
2. **Manual Installation**:
   - Extract the plugin folder.
   - Upload the `hidden-vault-search-exclusion` directory to your `/wp-content/plugins/` folder via FTP/SFTP.
3. **Activation**:
   - Go to the **Plugins** menu in WordPress and click **Activate**.

## Usage Instructions

### Hiding Individual Items
The plugin provides per-page control for all Posts, Pages, and Products.
- Open any item in the WordPress editor.
- Locate the **Search Visibility** meta-box in the sidebar.
- Check the **"Hide from Search"** box.
- Update or Publish the page. The item is now excluded from frontend search results but remains accessible via a direct link.

### Bulk Visibility Management
To manage multiple hidden items at once, use the dedicated settings page.
- Navigate to **Settings > Hidden Vault** in the WordPress admin dashboard.
- View the list of all currently "hidden" items.
- Select the items you wish to make public again using the checkboxes.
- Click **Restore Visibility to Selected** to return them to the standard search results.

## Technical Architecture
- **Query Level Exclusion**: Uses the standard `pre_get_posts` hook to ensure compatibility with themes and third-party widgets.
- **High Performance**: Optimized to handle catalogs of 1,000+ items without increasing search latency.
- **Seamless Integration**: Logic is applied directly to the native WordPress search query.
