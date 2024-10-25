<style>

/* Filters container to align filters horizontally */
.filters-container {
    display: flex;
    flex-wrap: wrap;
    margin: 20px 0;
    background-color: #f8f9fa; /* Light background */
    border: 1px solid #ced4da; /* Light border color */
    padding: 10px;
}

/* Styling for the filter containers */
.filter-container {
    flex: 1;
    min-width: 200px;
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    padding: 10px;
    border-right: 1px solid #ced4da; /* Consistent border color */
    margin-bottom: 1rem; /* Adjust spacing as needed */
}

/* Remove border from the last item */
.filter-container:last-child {
    border-right: none;
}

/* Style the labels */
.filter-container label {
    display: block;
    font-weight: bold;
    font-size: 1rem; /* Unified font size for labels */
    margin-bottom: 0.5rem; /* Adjust spacing as needed */
    color: #343a40; /* Darker text color */
}

/* Style the dropdowns */
.filter-container select {
    width: 100%;
    padding: 0.5rem; /* Adjust padding as needed */
    font-size: 1rem; /* Unified font size for dropdowns */
    border: 1px solid #ccc; /* Light border color */
    background-color: #fff; /* White background */
    box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.1);
    color: #495057; /* Dark text color */
    box-sizing: border-box; /* Ensure padding and border are included in width */
    transition: border-color 0.3s ease, box-shadow 0.3s ease;
    cursor: pointer;
}

/* Dropdown focus and hover states */
.filter-container select:focus {
    border-color: #007bff; /* Blue border on focus */
    box-shadow: 0 0 0 3px rgba(0, 123, 255, 0.25);
    outline: none;
}

.filter-container select:hover {
    border-color: #adb5bd; /* Slightly darker border on hover */
}

/* Responsive adjustments */
@media (max-width: 600px) {
    .filters-container {
        flex-direction: column;
    }

    .filter-container {
        min-width: 100%;
        border-right: none; /* Remove border for small screens */
    }

    .filter-container label {
        font-size: 0.875rem;
    }

    .filter-container select {
        font-size: 0.875rem; /* Consistent font size on small screens */
    }

</style>

<div class="refine-search mb-4">
    <h2>Not seeing the results you want? Refine Your Search below</h2>
    <form id="refine-search-form" class="filters-container">
        <!-- Category Dropdown -->
        <div class="filter-container">
            <label for="search-category">
                <span class="screen-reader-text"><?php echo _x('Category:', 'label', 'textdomain'); ?></span>
            </label>
            <?php
            $categories = get_categories();
            echo '<select name="cat" id="search-category" class="search-category">';
            echo '<option value="">All Categories</option>';
            foreach ($categories as $category) {
                echo '<option value="' . esc_attr($category->term_id) . '">' . esc_html($category->name) . '</option>';
            }
            echo '</select>';
            ?>
        </div>

        <!-- Title Dropdown -->
        <div class="filter-container">
            <label for="search-title">
                <span class="screen-reader-text"><?php echo _x('Title:', 'label', 'textdomain'); ?></span>
            </label>
            <?php
            $posts = get_posts(array('numberposts' => -1));
            echo '<select name="title" id="search-title" class="search-title">';
            echo '<option value="">All Posts</option>';
            foreach ($posts as $post) {
                echo '<option value="' . esc_attr($post->ID) . '">' . esc_html($post->post_title) . '</option>';
            }
            echo '</select>';
            ?>
        </div>
    </form>
</div>


    <!-- Container for filtered posts -->
    <div id="post-results"></div>


<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('refine-search-form');
    const categoryDropdown = form.querySelector('.search-category');
    const titleDropdown = form.querySelector('.search-title');

    // Handle category dropdown change
    categoryDropdown.addEventListener('change', function() {
        const categoryId = this.value;
        if (categoryId) {
            fetchPostsByCategory(categoryId);
        } else {
            document.getElementById('post-results').innerHTML = ''; // Clear results if no category is selected
        }
    });

    // Handle title dropdown change
    titleDropdown.addEventListener('change', function() {
        const postId = this.value;
        if (postId) {
            window.open(`<?php echo get_permalink(); ?>?p=${postId}`, '_blank');
        }
    });

    function fetchPostsByCategory(categoryId) {
        fetch(`<?php echo admin_url('admin-ajax.php'); ?>?action=filter_posts&category_id=${categoryId}`)
            .then(response => response.json())
            .then(data => {
                const postResults = document.getElementById('post-results');
                if (data.html) {
                    postResults.innerHTML = data.html; // Update the HTML with filtered posts
                } else {
                    postResults.innerHTML = '<p>No posts found.</p>';
                }
            })
            .catch(error => console.error('Error:', error));
    }
});
</script>
