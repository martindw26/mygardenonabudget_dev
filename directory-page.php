<?php
/*
Template Name: Directory
*/
get_header('directory'); 
?>

<head>

<style>

    /* Exhibitor CSS */
    
    .grid-container {
        display: grid;
        grid-template-columns: repeat(4, 1fr); 
        gap: 20px;
        margin: 0 auto;
        margin-bottom: 10px; 
    }
    
    /* Media query for mobile devices */
    @media (max-width: 768px) {
        .grid-container {
            grid-template-columns: 1fr; 
        }
        
        .grid-container > * {
            width: 100%; 
        }
    }
    
    @media (min-width: 768px) { 
        .grid-item:hover {
            cursor: pointer;  
        }
    }
    
    .grid-item img {
        width: 100%;
        height: 200px;
        object-fit: scale-down;
        object-position: center;
        display: block;
        border-bottom: 1px solid #ddd;
        padding: 10px;
        margin: 0 auto;
    }

    @media (max-width: 480px) {
.grid-item img {
    width: 100%;
    height: 150px;
    object-fit: scale-down;
    object-position: center;
    display: block;
    border-bottom: 1px solid #ddd;
    padding: 10px;
    margin: 0 auto;
}
}
    
    .grid-item h3 {
        margin: 15px 0;
        font-size: 18px;
        color: #333;
    }
    

    .grid-item a:hover {
        text-decoration: none;
    }
    
    h3.exhibitor_name {
        font-size: larger;
    }
    
    h3.exhibitor_stand {
        font-size: small;
    }
    
    img.exhibitor_image {
        object-fit: scale-down;
    }
    
    /* Load More */
    
    /* Back to top */
    #backToTopBtn{
        background-color: white;
        color: black;
        border: none;
        padding: 10px 20px;
        cursor: pointer;
        font-size: 16px;
        border-radius: 5px;
        display: flex;
        margin: 0 auto;
        /* margin-top: 14px; */
        margin-top: 30px;
        margin-bottom: 10px;
    }



/* Filters CSS */


h2.eventpageheading_directory{
    margin-top: 15px;
}

/* Filters container to align filters horizontally */
.filters-container {
    display: flex;
    flex-wrap: wrap;
    background-color: #dee2e6; /* Light background */
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

    #clearFilters {
        margin-top: 20px;
        display: flex;
        justify-content: center;
        align-items: center;
        text-align: center;
        width: 100%;

    }
}

@media (min-width: 600px) {
    #clearFilters {
        width: 100%;
    }

    button#clearFilters {
        height: 104px;
        display: flex;
        justify-content: center;
        align-items: center;
        text-align: center; /* Ensures text is centered */
    }
}

/* Style the dropdown */
#companyDropdown {
    width: 100%;
    padding: 0.5rem; /* Adjust padding as needed */
    font-size: 1rem; /* Unified font size */
    border: 1px solid #ccc; /* Light border color */
    background-color: #fff; /* White background */
    box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.1);
    color: #495057; /* Dark text color */
    box-sizing: border-box; /* Ensure padding and border are included in width */
    transition: border-color 0.3s ease, box-shadow 0.3s ease;
    cursor: pointer;
}

/* Dropdown focus and hover states */
#companyDropdown:focus {
    border-color: #007bff; /* Blue border on focus */
    box-shadow: 0 0 0 3px rgba(0, 123, 255, 0.25);
    outline: none;
}

#companyDropdown:hover {
    border-color: #adb5bd; /* Slightly darker border on hover */
}

/* Styling for the selected option */
#companyDropdown option:checked {
    background-color: #007bff; /* Blue background for selected item */
    color: white; /* White text color for selected item */
}

/* Styling for all options */
#companyDropdown option {
    background-color: #fff; /* White background for options */
    color: #495057; /* Dark text color for options */
}

/* Style for clear filters button */
#clearFilters {
    background-color: #007bff; /* Blue background */
    color: #ffffff; /* White text color */
    border: none;
    padding: 10px 20px;
    cursor: pointer;
    font-size: 16px;

    transition: background-color 0.3s ease, box-shadow 0.3s ease;
}

#clearFilters:hover {
    background-color: #0056b3; /* Darker blue on hover */
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

</style>

</head>

<!-- Exhibitor Buttons Text -->
<?php $exhibitor_cta = get_field('exhibitor_cta_directory', 'option'); ?>
<?php $companyfilterheading = get_field( 'companyfilterheading', 'option'); ?>
<?php $categoryfilterheading = get_field( 'categoryfilterheading', 'option'); ?>
<?php $clearbuttontext = get_field( 'clearbuttontext', 'option'); ?>

<!-- Featured Exhibitor Text -->
<?php $Featured_directory_heading = get_field( 'Featured_directory_heading', 'option'); ?>


<?php get_template_part('includes/sections/trending'); ?>

<div class="custom-page">
    <h2 class="eventpageheading_directory"><?php echo esc_html(get_the_title()); ?></h1>
</div>

<div class="content">

    <?php if (get_the_content()): ?>
        <?php the_content(); ?>
    <?php endif; ?>

    <?php 
    // Check if the Exhibitor Block is enabled
    $exhibitor_block_on_directory = get_field('exhibitor_block_on_off'); 

    if ($exhibitor_block_on_directory === 'on'): 
    ?>
	
	<div id="button-anchor" class="button-anchor"></div>
    <div class="button-container"></div>

    <!-- Filters Container -->
    <div class="filters-container">
        <!-- Company Dropdown Filter -->
        <div class="filter-container">
            <label class="categoryDropdown" for="companyDropdown"><?php echo $companyfilterheading ;?></label>
            <select id="companyDropdown">
                <option value="all">All Companies</option>
                <?php
                // Collect unique company names for the dropdown
                $company_names_directory = [];
                if (have_rows('exhibitors_directory')):
                    while (have_rows('exhibitors_directory')): the_row();
                        $company_name_directory = get_sub_field('c_name_directory');
                        if ($company_name_directory && !in_array($company_name_directory, $company_names_directory)) {
                            $company_names_directory[] = $company_name_directory;
                            echo '<option value="' . esc_attr(strtolower($company_name_directory)) . '">' . esc_html($company_name_directory) . '</option>';
                        }
                    endwhile;
                endif;
                ?>
            </select>
        </div>

        <!-- Category Dropdown Filter -->
        <div class="filter-container">
            <label class="categoryDropdown" for="categoryDropdown"><?php echo $categoryfilterheading ;?></label>
            <select id="categoryDropdown">
                <option value="all">All Categories</option>
                <?php
                // Collect unique company names for the dropdown
                $category_names_directory = [];
                if (have_rows('exhibitors_directory')):
                    while (have_rows('exhibitors_directory')): the_row();
                        $category_name_directory = get_sub_field('categories_directory');
                        if ($category_name_directory && !in_array($category_name_directory, $category_names_directory)) {
                            $category_names_directory[] = $category_name_directory;
                            echo '<option value="' . esc_attr(strtolower($category_name_directory)) . '">' . esc_html($category_name_directory) . '</option>';
                        }
                    endwhile;
                endif;
                ?>
            </select>
        </div>

        <!-- Clear Search Button -->
        <div class="filter-clear">
            <button id="clearFilters" type="button"><?php echo $clearbuttontext ;?></button>
        </div>
    </div>

    <h2><?php echo $Featured_directory_heading;?></h2>
    <div class="featured_directory_section">
    <?php get_template_part('template-parts/directory_featured'); ?>
    </div>
    <div class="directory_section_divide"></div>
    <?php get_template_part('template-parts/directory'); ?>

    <button id="loadMoreBtn" style="display:none;">Load More</button>
    <br>
    <button id="backToTopBtn" style="display:block;">Back to Top &#8657;</button>

    <?php 
    endif; // Close the 'if' statement
    ?>

<?php get_footer(); ?>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var companyDropdown = document.getElementById('companyDropdown');
    var categoryDropdown = document.getElementById('categoryDropdown');
    var gridItems = document.querySelectorAll('.grid-item');
    var loadMoreBtn = document.getElementById('loadMoreBtn');
    var backToTopBtn = document.getElementById('backToTopBtn');
    
    var itemsPerPage = 16;
    var currentPage = 1;

    function filterItems() {
        var selectedCompany = companyDropdown.value.toLowerCase();
        var selectedCategory = categoryDropdown.value.toLowerCase();

        var visibleCount = 0;
        var totalVisible = itemsPerPage * currentPage;

        gridItems.forEach(function(item, index) {
            var name = item.getAttribute('data-name').toLowerCase();
            var category = item.getAttribute('data-category').toLowerCase();

            var showItem = (selectedCompany === 'all' || name === selectedCompany) &&
                           (selectedCategory === 'all' || category === selectedCategory);

            if (showItem && visibleCount < totalVisible) {
                item.style.display = 'block';
                visibleCount++;
            } else {
                item.style.display = 'none';
            }
        });

        // Always show the load more button, regardless of the number of visible items
        loadMoreBtn.style.display = 'block';

        // Show the back to top button only if there are visible items
        backToTopBtn.style.display = visibleCount > 0 ? 'block' : 'none';
    }

    // Load more items when the load more button is clicked
    loadMoreBtn.addEventListener('click', function() {
        currentPage++;
        filterItems();
    });

    // Scroll 55px above the anchor point when the back to top button is clicked
    backToTopBtn.addEventListener('click', function() {
        var anchorElement = document.getElementById('button-anchor');
        if (anchorElement) {
            var anchorPosition = anchorElement.getBoundingClientRect().top + window.scrollY;
            var offsetPosition = anchorPosition - 90;

            window.scrollTo({
                top: offsetPosition,
                behavior: 'smooth'
            });
        }
    });

    companyDropdown.addEventListener('change', function() {
        currentPage = 1;
        filterItems();
    });
    categoryDropdown.addEventListener('change', function() {
        currentPage = 1;
        filterItems();
    });

    document.getElementById('clearFilters').addEventListener('click', function() {
        companyDropdown.value = 'all';
        categoryDropdown.value = 'all';
        currentPage = 1;
        filterItems(); // Reapply filters after clearing
    });

    // Listen for window resize to adjust the back to top button visibility
    window.addEventListener('resize', filterItems);

    filterItems(); // Initial call to apply filters on page load
});
</script>
