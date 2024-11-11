<?php
// Load style sheets
function load_css() {
    wp_register_style('bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css', array(), '1.0', 'all');
    wp_enqueue_style('bootstrap'); 

    wp_register_style('main', get_template_directory_uri() . '/css/main.css', array(), '1.0', 'all');
    wp_enqueue_style('main'); 
}
add_action('wp_enqueue_scripts', 'load_css');

// Load Scripts
function load_js() {
    wp_enqueue_script('jquery');
    wp_register_script('bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', array('jquery'), '1.0', true);
    wp_enqueue_script('bootstrap'); 
}
add_action('wp_enqueue_scripts', 'load_js');


// Enqueue Dashicons
function enqueue_dashicons() {
    wp_enqueue_style('dashicons');
}
add_action('wp_enqueue_scripts', 'enqueue_dashicons');

/* ------------------------------------------------
   *  Excerpt limit
--------------------------------------------------- */
function excerpt($limit) {
    $excerpt = explode(' ', get_the_excerpt(), $limit);
    if (count($excerpt) >= $limit) {
        array_pop($excerpt);
        $excerpt = implode(" ", $excerpt) . '...';
    } else {
        $excerpt = implode(" ", $excerpt);
    } 
    $excerpt = preg_replace('`\[[^\]]*\]`', '', $excerpt);
    return $excerpt;
}



// Custom Image Sizes
function custom_image_sizes() {
    add_image_size('post-featured-image', 9999, 9999, true); 
}
add_action('after_setup_theme', 'custom_image_sizes');

// Register Custom Block Category
function custom_register_block_category($categories, $post) {
    return array_merge(
        array(
            array(
                'slug'  => 'custom-blocks',
                'title' => __('Custom Blocks', 'technologie'),
                'icon'  => 'admin-generic',
            ),
        ),
        $categories
    );
}
add_filter('block_categories_all', 'custom_register_block_category', 10, 2);

/* Duplicate posts */
function rd_duplicate_post_as_draft() {
    global $wpdb;

    if (! (isset($_GET['post']) || isset($_POST['post']) || (isset($_REQUEST['action']) && 'rd_duplicate_post_as_draft' == $_REQUEST['action']))) {
        wp_die('No post to duplicate has been supplied!');
    }

    // Nonce verification
    if (!isset($_GET['duplicate_nonce']) || !wp_verify_nonce($_GET['duplicate_nonce'], basename(__FILE__))) {
        return;
    }

    // Get the original post id
    $post_id = (isset($_GET['post']) ? absint($_GET['post']) : absint($_POST['post']));

    // Get original post data
    $post = get_post($post_id);
    $current_user = wp_get_current_user();
    $new_post_author = $current_user->ID;

    if (isset($post) && $post != null) {
        $args = array(
            'comment_status' => $post->comment_status,
            'ping_status'    => $post->ping_status,
            'post_author'    => $new_post_author,
            'post_content'   => $post->post_content,
            'post_excerpt'   => $post->post_excerpt,
            'post_name'      => $post->post_name,
            'post_parent'    => $post->post_parent,
            'post_password'  => $post->post_password,
            'post_status'    => 'draft',
            'post_title'     => $post->post_title . ' (Copy)',
            'post_type'      => $post->post_type,
            'to_ping'        => $post->to_ping,
            'menu_order'     => $post->menu_order
        );

        // Insert the post by wp_insert_post() function
        $new_post_id = wp_insert_post($args);

        // Get all current post terms and set them to the new post draft
        $taxonomies = get_object_taxonomies($post->post_type);
        foreach ($taxonomies as $taxonomy) {
            $post_terms = wp_get_object_terms($post_id, $taxonomy, array('fields' => 'slugs'));
            wp_set_object_terms($new_post_id, $post_terms, $taxonomy, false);
        }

        // Duplicate all post meta
        $post_meta_infos = $wpdb->get_results("SELECT meta_key, meta_value FROM $wpdb->postmeta WHERE post_id=$post_id");
        if (count($post_meta_infos) != 0) {
            $sql_query_sel = [];
            $sql_query = "INSERT INTO $wpdb->postmeta (post_id, meta_key, meta_value) ";
            foreach ($post_meta_infos as $meta_info) {
                $meta_key = $meta_info->meta_key;
                if ($meta_key == '_wp_old_slug') continue;
                $meta_value = addslashes($meta_info->meta_value);
                $sql_query_sel[] = "SELECT $new_post_id, '$meta_key', '$meta_value'";
            }
            $sql_query .= implode(" UNION ALL ", $sql_query_sel);
            $wpdb->query($sql_query);
        }

        // Redirect to the edit post screen for the new draft
        wp_redirect(admin_url('post.php?action=edit&post=' . $new_post_id));
        exit;
    } else {
        wp_die('Post creation failed, could not find original post: ' . $post_id);
    }
}
add_action('admin_action_rd_duplicate_post_as_draft', 'rd_duplicate_post_as_draft');

function rd_duplicate_post_link($actions, $post) {
    if (current_user_can('edit_posts')) {
        $actions['duplicate'] = '<a href="' . wp_nonce_url('admin.php?action=rd_duplicate_post_as_draft&post=' . $post->ID, basename(__FILE__), 'duplicate_nonce') . '" title="Duplicate this item" rel="permalink">Duplicate</a>';
    }
    return $actions;
}
add_filter('post_row_actions', 'rd_duplicate_post_link', 10, 2);
add_filter('page_row_actions', 'rd_duplicate_post_link', 10, 2);

/* Adds post publish status to posts edit page */
// Add custom column to posts list
function add_custom_post_status_column($columns) {
    $columns['post_status'] = __('Status');
    return $columns;
}
add_filter('manage_posts_columns', 'add_custom_post_status_column');

// Populate custom column with post status
function display_custom_post_status_column($column, $post_id) {
    if ($column == 'post_status') {
        $post_status = get_post_status($post_id);
        echo ucfirst($post_status); // Capitalize the first letter for better readability
    }
}
add_action('manage_posts_custom_column', 'display_custom_post_status_column', 10, 2);

// Make the custom post status column sortable
function make_custom_post_status_column_sortable($columns) {
    $columns['post_status'] = 'post_status';
    return $columns;
}
add_filter('manage_edit-post_sortable_columns', 'make_custom_post_status_column_sortable');


/* ACF settings */



function my_theme_setup() {
    add_theme_support('post-thumbnails');
    // Other theme setup code
}
add_action('after_setup_theme', 'my_theme_setup');


/* Search */

add_action('wp_ajax_filter_posts', 'filter_posts');
add_action('wp_ajax_nopriv_filter_posts', 'filter_posts');

function filter_posts() {
    if (!isset($_GET['category_id'])) {
        wp_send_json(array('html' => '<p>Invalid request.</p>'));
        return;
    }

    $category_id = intval($_GET['category_id']);

    $args = array(
        'post_type' => 'post',
        'posts_per_page' => -1,
        'cat' => $category_id,
    );

    $query = new WP_Query($args);

    if ($query->have_posts()) {
        $html = '';
        while ($query->have_posts()) {
            $query->the_post();
            
            // Get category link
            $categories = get_the_category();
            $category = !empty($categories) ? $categories[0] : null;
            $category_link = $category ? get_category_link($category->term_id) : '';

            $html .= '<div class="post-item">';
            
            if ($category) {
                $html .= '<div class="post-category" style="color:darkgreen; font-weight: 500;">
                    <a href="' . esc_url($category_link) . '" style="color:darkgreen; font-weight: 500; text-decoration:none;">
                        ' . esc_html($category->name) . '
                    </a>
                </div>';
            }

            $html .= '<h5 class="mt-2"><a href="' . get_permalink() . '" style="text-decoration:none; color:black;">' . get_the_title() . '</a></h5>';
            $html .= '<div class="post-excerpt">' . get_the_excerpt() . '</div>';
            $html .= '<p class="text-secondary mt-2">' . get_the_date() . ' | By ' . get_the_author() . '</p><hr>';
            $html .= '</div>';
        }
        $html .= '';
    } else {
        $html = '<p>No posts found.</p>';
    }

    wp_reset_postdata();
    
    wp_send_json(array('html' => $html));
}


/* products */

// Add this code to your theme's functions.php file or a custom plugin
function display_products_awin() {
    global $wpdb; // Use the WordPress database access abstraction class

    // Fetch data from the products_awin table
    $results = $wpdb->get_results("SELECT * FROM products_awin");

    // Start output buffering to capture the output
    ob_start();

    // Check if there are results
    if ($results) {
        echo '<table style="width:100%; border-collapse: collapse;">';
        echo '<thead>';
        echo '<tr>';
        echo '<th>Product Name</th>';
        echo '<th>Brand Name</th>';
        echo '<th>Merchant Category</th>';
        echo '<th>Awin Deep Link</th>';
        echo '<th>Image URL</th>';
        echo '<th>Search Price</th>';
        echo '<th>Currency</th>';
        echo '<th>Description</th>';
        echo '</tr>';
        echo '</thead>';
        echo '<tbody>';

        foreach ($results as $row) {
            echo '<tr>';
            echo '<td>' . esc_html($row->Product_name) . '</td>';
            echo '<td>' . esc_html($row->brand_name) . '</td>';
            echo '<td>' . esc_html($row->merchant_category) . '</td>';
            echo '<td><a href="' . esc_url($row->aw_deep_link) . '" target="_blank">Link</a></td>';
            echo '<td><img src="' . esc_url($row->aw_image_url) . '" alt="Image" style="width:100px;"></td>';
            echo '<td>' . esc_html($row->search_price) . '</td>';
            echo '<td>' . esc_html($row->currency) . '</td>';
            echo '<td>' . esc_html($row->description) . '</td>';
            echo '</tr>';
        }

        echo '</tbody>';
        echo '</table>';
    } else {
        echo '<p>No products found.</p>';
    }

    // Return the buffered output
    return ob_get_clean();
}

// Register the shortcode
add_shortcode('products_awin', 'display_products_awin');

/* ------------------------------------------------
   *  Hide gutenberg
--------------------------------------------------- */

// Disable Gutenberg editor for specific post IDs from ACF Options Page
function disable_gutenberg_for_acf_post_ids($is_enabled, $post) {
    // Check if the post object is valid
    if (!$post instanceof WP_Post) {
        return $is_enabled;
    }

    // Get the list of disabled post IDs from ACF Options Page
    $disabled_post_ids = get_field('disabled_post_ids', 'option'); // ACF field name 'disabled_post_ids'

    // Ensure we have an array of IDs
    if (is_array($disabled_post_ids) && !empty($disabled_post_ids)) {
        // Check if the current post ID is in the list
        if (in_array($post->ID, $disabled_post_ids)) {
            return false; // Disable Gutenberg editor for this post
        }
    }

    return $is_enabled;
}

add_filter('use_block_editor_for_post', 'disable_gutenberg_for_acf_post_ids', 10, 2);

