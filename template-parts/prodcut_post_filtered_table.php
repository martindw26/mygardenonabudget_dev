<?php
// Initialize an array to store products
$products = array();

// Check if the repeater field 'list' has rows
if (have_rows('list')) :

    // Loop through the rows of the repeater field
    while (have_rows('list')) : the_row();

        // Push each product's data into the products array
        $products[] = array(
            'position'         => get_sub_field('product_position'),
            'name'             => get_sub_field('product_name'),
            'price'            => get_sub_field('product_price'),
            'currency'         => get_sub_field('product_price_currency'),
            'season'           => get_sub_field('season'),
            'planting_position' => get_sub_field('planting_position'),
            'soil_type'        => get_sub_field('soil_type'),
            'plant_type'       => get_sub_field('plant_type'),
        );

    endwhile;

    // Get URL parameters
    $urlParams = array();
    parse_str($_SERVER['QUERY_STRING'], $urlParams);

    // Get price range min and max values for the numeric inputs
    $prices = array_column($products, 'price');
    $minPrice = min($prices);
    $maxPrice = max($prices);

    // Sort by position
    $positions = array_column($products, 'position');
    sort($positions); // Sort the positions in ascending order
?>
  
<!-- Filters for Table Columns -->
<div class="refine-search mb-4">
    <form id="refine-search-form">
        <!-- Filters Container -->
        <div class="filters-container">
            <!-- Product Name Dropdown Filter -->
            <div class="filter-container">
                <label for="filter-name" class="form-label">Product Name</label>
                <select id="filter-name" class="form-select" multiple aria-label="Filter by Product Name">
                    <?php
                    $names = array_unique(array_column($products, 'name'));
                    foreach ($names as $name) : ?>
                        <option value="<?php echo esc_attr($name); ?>"
                            <?php echo isset($urlParams['name']) && in_array($name, explode(',', $urlParams['name'])) ? 'selected' : ''; ?>>
                            <?php echo esc_html($name); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <!-- Sort By Price Dropdown Filter -->
            <div class="filter-container">
                <label for="sort-price" class="form-label">Sort By Price</label>
                <select name="sort_price" id="sort-price" class="form-select" aria-label="Sort products by price">
                    <option value="">Select Price</option>
                    <option value="asc" <?php echo isset($urlParams['sort_price']) && $urlParams['sort_price'] == 'asc' ? 'selected' : ''; ?>>
                        Price: Low to High
                    </option>
                    <option value="desc" <?php echo isset($urlParams['sort_price']) && $urlParams['sort_price'] == 'desc' ? 'selected' : ''; ?>>
                        Price: High to Low
                    </option>
                </select>
            </div>
        </div>
        <!-- Button Container -->
        <div class="button-container">
            <button type="submit" class="btn btn-primary">Apply Filters</button>
            <button type="button" id="reset-filters" class="btn btn-secondary">Reset Filters</button>
        </div>
    </form>
</div>

<!-- Table to display the products -->
<div class="table-responsive">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Position</th>
                <th>Name</th>
                <th>Price</th>
                <th>Planting Position</th>
                <th>Soil Type</th>
                <th>Plant Type</th>
            </tr>
        </thead>
        <tbody id="product-table-body">
            <?php
            foreach ($positions as $position) {
                foreach ($products as $product) {
                    if ($product['position'] == $position) {
                        ?>
                        <tr data-name="<?php echo esc_attr($product['name']); ?>" data-currency="<?php echo esc_attr($product['currency']); ?>" data-price="<?php echo esc_attr($product['price']); ?>">
                            <td><?php echo esc_html($product['position']); ?></td>
                            <td><?php echo esc_html($product['name']); ?></td>
                            <td><?php echo esc_html($product['price']); ?></td>
                            <td><?php echo esc_html($product['planting_position']); ?></td>
                            <td><?php echo esc_html($product['soil_type']); ?></td>
                            <td><?php echo esc_html($product['plant_type']); ?></td>
                        </tr>
                        <?php
                    }
                }
            }
            ?>
        </tbody>
    </table>
</div>

<?php
endif;
?>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('refine-search-form');
    const nameSelect = form.querySelector('#filter-name');
    const sortPriceDropdown = form.querySelector('#sort-price');
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
        return params.toString();
    }

    function updateURL() {
        const queryParams = getQueryParams();
        window.history.replaceState(null, '', `${window.location.pathname}?${queryParams}`);
    }

    function filterTable() {
        const selectedNames = Array.from(nameSelect.selectedOptions).map(option => option.value);
        const sortPriceOrder = sortPriceDropdown.value;

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

        if (sortPriceOrder) {
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
        if (event.target === nameSelect || event.target === sortPriceDropdown) {
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
        }

        filterTable(); // Apply the filters based on URL parameters
    }

    // Initial setup: sort dropdown options and apply filters from URL
    sortDropdownOptions();
    applyFiltersFromURL();
});
</script>
