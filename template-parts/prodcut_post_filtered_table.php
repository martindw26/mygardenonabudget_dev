<!-- ########################################## 
     ############### Pricing Table ############ 
     ########################################## -->



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
            'position'   => get_sub_field('product_position'),
            'name'       => get_sub_field('product_name'),
            'price'      => get_sub_field('product_price'),
            'currency'   => get_sub_field('product_price_currency'),
            'plant_type' => get_sub_field('plant_type'), // Add plant type
            'soil_type'  => get_sub_field('soil_type'),  // Add soil type (this is an array)
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
            <!-- Plant Type Dropdown Filter -->
            <div class="filter-container">
                <label for="filter-plant-type" class="form-label">Plant Type</label>
                <select id="filter-plant-type" class="form-select" multiple aria-label="Filter by Plant Type">
                    <?php
                    $plantTypes = array_unique(array_column($products, 'plant_type'));
                    foreach ($plantTypes as $type) : ?>
                        <option value="<?php echo esc_attr($type); ?>"
                            <?php echo isset($urlParams['plant_type']) && in_array($type, explode(',', $urlParams['plant_type'])) ? 'selected' : ''; ?>>
                            <?php echo esc_html($type); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <!-- Soil Type Dropdown Filter -->
            <div class="filter-container">
                <label for="filter-soil-type" class="form-label">Soil Type</label>
                <select id="filter-soil-type" class="form-select" multiple aria-label="Filter by Soil Type">
                    <?php
                    // Assuming soil_type is an array
                    $soilTypes = array();
                    foreach ($products as $product) {
                        if (is_array($product['soil_type'])) {
                            $soilTypes = array_merge($soilTypes, $product['soil_type']);
                        }
                    }
                    $soilTypes = array_unique($soilTypes);
                    foreach ($soilTypes as $soil) : ?>
                        <option value="<?php echo esc_attr($soil); ?>"
                            <?php echo isset($urlParams['soil_type']) && in_array($soil, explode(',', $urlParams['soil_type'])) ? 'selected' : ''; ?>>
                            <?php echo esc_html($soil); ?>
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
                <th>Plant Type</th>
                <th>Soil Type</th> <!-- Add soil type column -->
            </tr>
        </thead>
        <tbody id="product-table-body">
            <?php
            foreach ($positions as $position) {
                foreach ($products as $product) {
                    if ($product['position'] == $position) {
                        ?>
                        <tr data-name="<?php echo esc_attr($product['name']); ?>" data-currency="<?php echo esc_attr($product['currency']); ?>" data-price="<?php echo esc_attr($product['price']); ?>" data-plant-type="<?php echo esc_attr($product['plant_type']); ?>" data-soil-type="<?php echo esc_attr(implode(', ', $product['soil_type'])); ?>">
                            <td><?php echo esc_html($product['position']); ?></td>
                            <td><?php echo esc_html($product['name']); ?></td>
                            <td><?php echo esc_html($product['price']); ?></td>
                            <td><?php echo esc_html($product['plant_type']); ?></td> <!-- Display plant type -->
                            <td><?php echo esc_html(implode(', ', $product['soil_type'])); ?></td> <!-- Display soil type -->
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
    const plantTypeSelect = form.querySelector('#filter-plant-type'); // Add plant type select
    const soilTypeSelect = form.querySelector('#filter-soil-type'); // Add soil type select
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
        const selectedPlantTypes = Array.from(plantTypeSelect.selectedOptions).map(option => option.value); // Get selected plant types
        if (selectedPlantTypes.length > 0) {
            params.append('plant_type', selectedPlantTypes.join(','));
        }
        const selectedSoilTypes = Array.from(soilTypeSelect.selectedOptions).map(option => option.value); // Get selected soil types
        if (selectedSoilTypes.length > 0) {
            params.append('soil_type', selectedSoilTypes.join(','));
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
        const selectedPlantTypes = Array.from(plantTypeSelect.selectedOptions).map(option => option.value); // Get selected plant types
        const selectedSoilTypes = Array.from(soilTypeSelect.selectedOptions).map(option => option.value); // Get selected soil types
        const sortPriceOrder = sortPriceDropdown.value;

        // Filter rows based on the selected filters
        const rowsArray = Array.from(tableBody.querySelectorAll('tr'));
        rowsArray.forEach(row => {
            const name = row.getAttribute('data-name');
            const plantType = row.getAttribute('data-plant-type');
            const soilTypes = row.getAttribute('data-soil-type').split(', ');
            const isVisible = 
                (selectedNames.length === 0 || selectedNames.includes(name)) &&
                (selectedPlantTypes.length === 0 || selectedPlantTypes.includes(plantType)) &&
                (selectedSoilTypes.length === 0 || selectedSoilTypes.some(soil => selectedSoilTypes.includes(soil))); // Compare selected soil types

            row.style.display = isVisible ? '' : 'none';
        });

        // Sort filtered rows
        let sortedRows = rowsArray.filter(row => row.style.display !== 'none');

        // Sort by price
        if (sortPriceOrder) {
            sortedRows.sort((a, b) => {
                const priceA = parseFloat(a.getAttribute('data-price'));
                const priceB = parseFloat(b.getAttribute('data-price'));
                return sortPriceOrder === 'asc' ? priceA - priceB : priceB - priceA;
            });
        }

        // Append sorted rows to the table body
        sortedRows.forEach(row => tableBody.appendChild(row));

        // Update URL with current filter parameters
        updateURL();
    }

    // Event listeners
    form.addEventListener('change', function() {
        filterTable();
    });

    resetButton.addEventListener('click', function() {
        nameSelect.value = '';
        plantTypeSelect.value = '';
        soilTypeSelect.value = '';
        sortPriceDropdown.value = '';
        filterTable();
    });

    filterTable(); // Initial call to display filtered and sorted products
});
</script>

