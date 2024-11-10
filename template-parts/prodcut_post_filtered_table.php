<!-- ########################################## 
     ############### Pricing Table ############ 
     ########################################## -->

<!-- Table to display the products -->
<?php
$table_type = get_field('table_type', 'option'); // Assuming 'option' is the correct context for your field
$hide_columns = ($table_type === 'plants');
?>

<style>
/* Main Filters Container */
.filters-container {
    display: flex;
    flex-wrap: wrap;
    gap: 15px; /* Spacing between form elements */
    margin: 20px 0;
    background-color: #f8f9fa; /* Light background */
    border: 1px solid #ced4da; /* Light border color */
    padding: 10px;
}

/* Individual Filter Container */
.filter-container {
    display: flex;
    flex-wrap: wrap;
    flex-direction: column;
    align-items: flex-start;
    flex: 1; /* Ensure equal spacing between containers */
    min-width: 200px; /* Adjust this width to fit your design */
    padding: 10px;
    border-right: 1px solid #ced4da; /* Light border */
    margin-bottom: 1rem; /* Adjust spacing as needed */
}

/* Remove border from the last filter */
.filter-container:last-child {
    border-right: none;
}

/* Style for disabled dropdowns */
.filter-container select[disabled] {
    background-color: #e9ecef; /* Light grey background */
    color: #6c757d; /* Grey text color */
    cursor: not-allowed;
}

/* Label styling */
.filter-container label {
    display: block;
    font-weight: bold;
    font-size: 1rem; /* Unified font size */
    margin-bottom: 0.5rem; /* Adjust spacing */
    color: #343a40; /* Darker text color */
}

/* Checkbox styling */
.filter-container input[type="checkbox"] {
    margin-right: 0.5rem;
}

/* Dropdown styling */
.filter-container select {
    width: 100%;
    min-width: 150px; /* Ensures dropdown fits smaller designs */
    padding: 0.5rem; /* Adjust padding */
    font-size: 1rem; /* Unified font size */
    border: 1px solid #ccc; /* Light border */
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

/* Numeric input styling */
.filter-container input[type="number"] {
    width: 100%;
    padding: 0.5rem; /* Adjust padding */
    font-size: 1rem; /* Unified font size */
    border: 1px solid #ccc; /* Light border */
    background-color: #fff; /* White background */
    box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.1);
    color: #495057; /* Dark text color */
    box-sizing: border-box; /* Ensure padding and border are included in width */
    transition: border-color 0.3s ease, box-shadow 0.3s ease;
}

/* Numeric input focus and hover states */
.filter-container input[type="number"]:focus {
    border-color: #007bff; /* Blue border on focus */
    box-shadow: 0 0 0 3px rgba(0, 123, 255, 0.25);
    outline: none;
}

.filter-container input[type="number"]:hover {
    border-color: #adb5bd; /* Slightly darker border on hover */
}

/* Responsive styling for mobile */
@media (max-width: 768px) {
    .filters-container {
        flex-direction: column;
        gap: 0px;
    }

    .filter-container {
        flex-direction: column;
        border-right: none; /* Remove borders on mobile */
    }

    .filter-container select {
        width: 100%; /* Full width on mobile */
    }

    .filter-container input[type="number"] {
        width: 100%; /* Full width for inputs on mobile */
    }
}

/* Button container styling */
.button-container {
    display: flex;
    justify-content: flex-start;
    margin-top: 10px;
}

/* Button styling */
.btn {
    margin-right: 10px; /* Space between buttons */
    font-size: 1rem;
    padding: 0.5rem 1rem;
}

.btn-primary {
    background-color: #007bff;
    color: #fff;
    border: 1px solid #007bff;
}

.btn-primary:hover {
    background-color: #0056b3;
    border-color: #004085;
}

.btn-secondary {
    background-color: #6c757d;
    color: #fff;
    border: 1px solid #6c757d;
}

.btn-secondary:hover {
    background-color: #5a6268;
    border-color: #545b62;
}

/* Hide specific columns when table type is 'plants' */
<?php if ($hide_columns): ?>
    .table th:nth-child(6),
    .table td:nth-child(6),
    .table th:nth-child(7),
    .table td:nth-child(7),
    .table th:nth-child(8),
    .table td:nth-child(8),
    .table th:nth-child(9),
    .table td:nth-child(9),
    .table th:nth-child(10),
    .table td:nth-child(10),
    .table th:nth-child(11),
    .table td:nth-child(11) {
        display: none;
    }
<?php endif; ?>
</style>

<?php
// Initialize an array to store products
$products = array();

// Check if the repeater field 'list' has rows
if (have_rows('list')) :

    // Loop through the rows of the repeater field
    while (have_rows('list')) : the_row();

        // Push each product's data into the products array
        $products[] = array(
            'position'              => get_sub_field('product_position'),
            'name'                  => get_sub_field('product_name'),
            'rating'                => get_sub_field('rating'),
            'price'                 => get_sub_field('product_price'),
            'currency'              => get_sub_field('product_price_currency'),
            'season'                => is_array(get_sub_field('season')) ? implode(', ', get_sub_field('season')) : get_sub_field('season'),
            'height'                => !empty(get_sub_field('height')) ? get_sub_field('height') : '-',
            'width'                 => !empty(get_sub_field('width')) ? get_sub_field('width') : '-',
            'length'                => !empty(get_sub_field('length')) ? get_sub_field('length') : '-',
            'planting_position'     => is_array(get_sub_field('planting_position')) ? implode(', ', get_sub_field('planting_position')) : get_sub_field('planting_position'),
            'soil_type'             => is_array(get_sub_field('soil_type')) ? implode(', ', get_sub_field('soil_type')) : get_sub_field('soil_type'),
            'plant_type'            => is_array(get_sub_field('plant_type')) ? implode(', ', get_sub_field('plant_type')) : get_sub_field('plant_type'),
            'material'              => is_array(get_sub_field('material')) ? implode(', ', get_sub_field('material')) : get_sub_field('material'),
        );

    endwhile;

    // Get URL parameters
    $urlParams = $_GET;

    // Filter products by name if selected
    if (isset($urlParams['name'])) {
        $selectedNames = explode(',', $urlParams['name']);
        $products = array_filter($products, function($product) use ($selectedNames) {
            return in_array($product['name'], $selectedNames);
        });
    }

    // Sort by rating if the sort_rating parameter is set
    if (isset($urlParams['sort_rating'])) {
        usort($products, function($a, $b) use ($urlParams) {
            $ratingA = $a['rating'];
            $ratingB = $b['rating'];
            if ($urlParams['sort_rating'] == 'asc') {
                return $ratingA <=> $ratingB;
            } else {
                return $ratingB <=> $ratingA;
            }
        });
    }

    // Sort by price if the sort_price parameter is set
    if (isset($urlParams['sort_price'])) {
        usort($products, function($a, $b) use ($urlParams) {
            $priceA = $a['price'];
            $priceB = $b['price'];
            if ($urlParams['sort_price'] == 'asc') {
                return $priceA <=> $priceB;
            } else {
                return $priceB <=> $priceA;
            }
        });
    }

endif;
?>

<!-- Table to display the products -->
<div class="table-responsive">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Position</th>
                <th>Name</th>
                <th>Rating</th>
                <th>Price</th>
                <th>Season</th>
                <th class="product-height">Height</th>
                <th class="product-width">Width</th>
                <th class="product-length">Length</th>
                <th>Planting Position</th>
                <th>Soil Type</th>
                <th>Plant Type</th>
                <th class="product-material">Material</th>
            </tr>
        </thead>
        <tbody id="product-table-body">
            <?php
            foreach ($products as $product) {
                ?>
                <tr data-name="<?php echo esc_attr($product['name']); ?>" data-currency="<?php echo esc_attr($product['currency']); ?>" data-price="<?php echo esc_attr($product['price']); ?>" data-rating="<?php echo esc_attr($product['rating']); ?>">
                    <td><?php echo esc_html($product['position']); ?></td>
                    <td><?php echo esc_html($product['name']); ?></td>
                    <td><?php echo esc_html($product['rating']); ?></td>
                    <td><?php echo esc_html($product['price']); ?></td>
                    <td><?php echo esc_html($product['season']); ?></td>
                    <td class="product-height"><?php echo esc_html($product['height']); ?></td>
                    <td class="product-width"><?php echo esc_html($product['width']); ?></td>
                    <td class="product-length"><?php echo esc_html($product['length']); ?></td>
                    <td><?php echo esc_html($product['planting_position']); ?></td>
                    <td><?php echo esc_html($product['soil_type']); ?></td>
                    <td><?php echo esc_html($product['material']); ?></td>
                </tr>
                <?php
            }
            ?>
        </tbody>
    </table>
</div>




<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('refine-search-form');
    const nameSelect = form.querySelector('#filter-name');
    const sortPriceDropdown = form.querySelector('#sort-price');
    const sortRatingDropdown = form.querySelector('#sort-rating');
    const tableBody = document.getElementById('product-table-body');
    const resetButton = document.getElementById('reset-filters');
    
    // Store original row order
    const originalRows = Array.from(tableBody.children);

    function getQueryParams() {
        const params = new URLSearchParams();
        const selectedNames = Array.from(nameSelect.selectedOptions).map(option => option.value);
        if (selectedNames.length > 0) {
            params.append('name', selectedNames.join(','));
        }
        if (sortPriceDropdown.value) {
            params.append('sort_price', sortPriceDropdown.value);
        }
        if (sortRatingDropdown.value) {
            params.append('sort_rating', sortRatingDropdown.value);
        }
        return params.toString();
    }

    function updateURL() {
        const queryParams = getQueryParams();
        window.history.replaceState(null, '', `${window.location.pathname}?${queryParams}`);
    }

    function toggleSortOptions() {
        if (sortPriceDropdown.value) {
            sortRatingDropdown.disabled = true;
        } else if (sortRatingDropdown.value) {
            sortPriceDropdown.disabled = true;
        } else {
            sortPriceDropdown.disabled = false;
            sortRatingDropdown.disabled = false;
        }
    }

    function filterTable() {
        const selectedNames = Array.from(nameSelect.selectedOptions).map(option => option.value);
        const sortPriceOrder = sortPriceDropdown.value;
        const sortRatingOrder = sortRatingDropdown.value;

        // Convert rows to an array for manipulation
        const rowsArray = Array.from(originalRows); // Use original rows

        // Filter rows based on selected names
        rowsArray.forEach(row => {
            const name = row.getAttribute('data-name');
            const isVisible = selectedNames.length === 0 || selectedNames.includes(name);
            row.style.display = isVisible ? '' : 'none';
        });

        // Sort filtered rows
        let sortedRows = rowsArray.filter(row => row.style.display !== 'none');

        if (sortRatingOrder) {
            sortedRows.sort((a, b) => {
                const ratingA = parseFloat(a.getAttribute('data-rating'));
                const ratingB = parseFloat(b.getAttribute('data-rating'));
                return sortRatingOrder === 'asc' ? ratingA - ratingB : ratingB - ratingA;
            });
        } else if (sortPriceOrder) {
            sortedRows.sort((a, b) => {
                const priceA = parseFloat(a.getAttribute('data-price'));
                const priceB = parseFloat(b.getAttribute('data-price'));
                return sortPriceOrder === 'asc' ? priceA - priceB : priceB - priceA;
            });
        } else {
            // Default to ascending order if no sort option selected
            sortedRows.sort((a, b) => {
                return originalRows.indexOf(a) - originalRows.indexOf(b);
            });
        }

        // Append sorted rows to the table body
        sortedRows.forEach(row => tableBody.appendChild(row));

        // Update URL with current filter parameters
        updateURL();
    }

    function sortDropdownOptions() {
        const options = Array.from(nameSelect.options);
        options.sort((a, b) => a.text.localeCompare(b.text));
        // Clear existing options
        nameSelect.innerHTML = '';
        // Append sorted options
        options.forEach(option => nameSelect.appendChild(option));
    }

    // Attach event listeners
    form.addEventListener('change', function(event) {
        if (event.target === nameSelect || event.target === sortPriceDropdown || event.target === sortRatingDropdown) {
            toggleSortOptions();
            filterTable();
        }
    });

    form.addEventListener('submit', function(e) {
        e.preventDefault();
        filterTable(); // Apply the filters and update the table
    });

    resetButton.addEventListener('click', function() {
        nameSelect.selectedIndex = -1;
        sortPriceDropdown.value = '';
        sortRatingDropdown.value = '';
        sortPriceDropdown.disabled = false;
        sortRatingDropdown.disabled = false;
        // Reset to original order
        originalRows.forEach(row => tableBody.appendChild(row));
        // Reset dropdown options to ascending order
        sortDropdownOptions();
        filterTable();
    });

    // Apply filters from URL on page load
    function applyFiltersFromURL() {
        const urlParams = new URLSearchParams(window.location.search);

        const names = urlParams.get('name');
        if (names) {
            const nameArray = names.split(',');
            Array.from(nameSelect.options).forEach(option => {
                option.selected = nameArray.includes(option.value);
            });
        }

        const sortPrice = urlParams.get('sort_price');
        if (sortPrice) {
            sortPriceDropdown.value = sortPrice;
            sortRatingDropdown.disabled = true;
        }

        const sortRating = urlParams.get('sort_rating');
        if (sortRating) {
            sortRatingDropdown.value = sortRating;
            sortPriceDropdown.disabled = true;
        }

        filterTable(); // Apply the filters based on URL parameters
    }

    // Initial setup: sort dropdown options and apply filters from URL
    sortDropdownOptions();
    applyFiltersFromURL();
});
</script>
