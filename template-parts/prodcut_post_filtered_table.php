<style>
/* Add your custom styles for the filters and table */
.refine-search .filters-container {
    display: flex;
    flex-wrap: wrap;
    gap: 1rem;
}

.filter-container {
    flex: 1;
    min-width: 200px;
}

.filter-container label {
    display: block;
    margin-bottom: 0.5rem;
}

.filter-container select, .filter-container input {
    width: 100%;
}

.table-container {
    margin-top: 2rem;
}

.table {
    width: 100%;
    border-collapse: collapse;
}

.table th, .table td {
    border: 1px solid #ddd;
    padding: 8px;
    text-align: left;
}

.table th {
    background-color: #f4f4f4;
}

.price-output {
    display: inline-block;
    margin-top: 0.5rem;
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
            'rating'     => get_sub_field('rating'),
            'price'      => get_sub_field('product_price'),
            'currency'   => get_sub_field('product_price_currency'),
            'season'     => get_sub_field('season'),
            'specs'      => get_sub_field('specs'),
            'height'     => get_sub_field('height'),
            'width'      => get_sub_field('width'),
            'length'     => get_sub_field('length'),
            'stock_status' => get_sub_field('stock_status'),
            'planting_position' => get_sub_field('planting_position'),
            'soil_type'  => get_sub_field('soil_type'),
            'plant_type' => get_sub_field('plant_type'),
            'material'   => get_sub_field('material'),
            'description' => get_sub_field('description'), // Added description field
        );

    endwhile;

    // Get URL parameters
    $urlParams = array();
    parse_str($_SERVER['QUERY_STRING'], $urlParams);

    // Get price range min and max values for the numeric inputs
    $prices = array_column($products, 'price');
    $minPrice = min($prices);
    $maxPrice = max($prices);

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
            <!-- Sort By Rating Dropdown Filter -->
            <div class="filter-container">
                <label for="sort-rating" class="form-label">Sort By Rating</label>
                <select name="sort_rating" id="sort-rating" class="form-select" aria-label="Sort products by rating">
                    <option value="">Select Rating</option>
                    <option value="asc" <?php echo isset($urlParams['sort_rating']) && $urlParams['sort_rating'] == 'asc' ? 'selected' : ''; ?>>
                        Rating: Low to High
                    </option>
                    <option value="desc" <?php echo isset($urlParams['sort_rating']) && $urlParams['sort_rating'] == 'desc' ? 'selected' : ''; ?>>
                        Rating: High to Low
                    </option>
                </select>
            </div>
            <!-- Price Range Filter -->
            <div class="filter-container">
                <label for="price-range" class="form-label">Price Range</label>
                <input type="range" class="form-range" id="price-range" min="<?php echo esc_attr($minPrice); ?>" max="<?php echo esc_attr($maxPrice); ?>" step="1"
                    value="<?php echo isset($urlParams['price_range']) ? esc_attr($urlParams['price_range']) : $maxPrice; ?>">
                <output id="price-output" class="price-output">
                    <?php echo esc_html(isset($urlParams['price_range']) ? $urlParams['price_range'] : $maxPrice); ?>
                </output>
            </div>
        </div>
        <!-- Submit Button Container -->
        <div class="button-container">
            <button type="submit" class="btn btn-primary">Apply Filters</button>
            <button type="reset" class="btn btn-secondary">Reset Filters</button>
        </div>
    </form>
</div>

<!-- Table to display the products -->
<div class="table-container">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Position</th>
                <th>Name</th>
                <th>Rating</th>
                <th>Price</th>
                <th>Season</th> <!-- Add heading for Season -->
                <th>Description</th> <!-- Add heading for Description -->
                <th>Height</th> <!-- Add heading for Height -->
                <th>Width</th> <!-- Add heading for Width -->
                <th>Length</th> <!-- Add heading for Length -->
                <th>Planting Position</th> <!-- Add heading for Planting Position -->
                <th>Soil Type</th> <!-- Add heading for Soil Type -->
                <th>Plant Type</th> <!-- Add heading for Plant Type -->
                <th>Material</th> <!-- Add heading for Material -->
            </tr>
        </thead>
        <tbody id="product-table-body">
            <?php
            foreach ($positions as $position) {
                foreach ($products as $product) {
                    if ($product['position'] == $position) {
                        ?>
                        <tr data-name="<?php echo esc_attr($product['name']); ?>" data-currency="<?php echo esc_attr($product['currency']); ?>" data-price="<?php echo esc_attr($product['price']); ?>" data-rating="<?php echo esc_attr($product['rating']); ?>">
                            <td><?php echo esc_html($product['position']); ?></td>
                            <td><?php echo esc_html($product['name']); ?></td>
                            <td><?php echo esc_html($product['rating']); ?></td>
                            <td><?php echo esc_html($product['price']); ?></td>
                            <td>
                                <?php 
                                echo is_array($product['season']) ? esc_html(implode(', ', $product['season'])) : esc_html($product['season']);
                                ?>
                            </td>
                            <td>
                                <?php 
                                echo is_array($product['description']) ? esc_html(implode(', ', $product['description'])) : esc_html($product['description']);
                                ?>
                            </td>
                            <td>
                                <?php 
                                echo is_array($product['height']) ? esc_html(implode(', ', $product['height'])) : esc_html($product['height']);
                                ?>
                            </td>
                            <td>
                                <?php 
                                echo is_array($product['width']) ? esc_html(implode(', ', $product['width'])) : esc_html($product['width']);
                                ?>
                            </td>
                            <td>
                                <?php 
                                echo is_array($product['length']) ? esc_html(implode(', ', $product['length'])) : esc_html($product['length']);
                                ?>
                            </td>
                            <td><?php echo esc_html($product['planting_position']); ?></td>
                            <td><?php echo esc_html($product['soil_type']); ?></td>
                            <td><?php echo esc_html($product['plant_type']); ?></td>
                            <td><?php echo esc_html($product['material']); ?></td>
                        </tr>
                        <?php
                    }
                }
            }
            ?>
        </tbody>
    </table>
</div>

<script>
// JavaScript for updating filters and table dynamically
document.querySelectorAll('.filter-container select, .filter-container input').forEach(function(filter) {
    filter.addEventListener('change', updateFilters);
});

document.getElementById('price-range').addEventListener('input', function() {
    document.getElementById('price-output').textContent = this.value;
});

function updateFilters() {
    var formData = new FormData(document.querySelector('#refine-search-form'));
    var urlParams = new URLSearchParams(window.location.search);

    // Append form data to the URL parameters
    formData.forEach(function(value, key) {
        if (value) {
            urlParams.set(key, value);
        } else {
            urlParams.delete(key);
        }
    });

    // Update the URL without reloading the page
    window.history.pushState({}, '', '?' + urlParams.toString());

    // Optionally, trigger an AJAX request to update the product table here
    filterTable();
}

function filterTable() {
    var urlParams = new URLSearchParams(window.location.search);
    var filteredProducts = document.querySelectorAll('#product-table-body tr');

    filteredProducts.forEach(function(row) {
        var showRow = true;

        // Get the filter values from URL parameters
        var nameFilter = urlParams.get('name');
        var priceFilter = urlParams.get('price_range');
        var ratingFilter = urlParams.get('sort_rating');

        // Apply filter logic to determine which rows to show
        if (nameFilter && !row.dataset.name.includes(nameFilter)) {
            showRow = false;
        }
        if (priceFilter && parseFloat(row.dataset.price) > parseFloat(priceFilter)) {
            showRow = false;
        }
        if (ratingFilter && (ratingFilter === 'asc' ? parseFloat(row.dataset.rating) < 3 : parseFloat(row.dataset.rating) > 3)) {
            showRow = false;
        }

        row.style.display = showRow ? '' : 'none';
    });
}

document.querySelector('#refine-search-form').addEventListener('submit', function(e) {
    e.preventDefault(); // Prevent the form from reloading the page
    updateFilters(); // Trigger the filter update
});
</script>
