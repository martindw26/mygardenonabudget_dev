<?php
$products = array();

if (have_rows('list')) :
    while (have_rows('list')) : the_row();
    $products[] = array(
        'position'          => get_sub_field('product_position'),
        'name'              => get_sub_field('product_name'),
        'rating'            => get_sub_field('rating'),
        'price'             => get_sub_field('product_price'),
        'season'            => is_array(get_sub_field('season')) ? implode(', ', get_sub_field('season')) : get_sub_field('season'),
        'specs'             => is_array(get_sub_field('specs')) ? implode(', ', get_sub_field('specs')) : get_sub_field('specs'),
        'height'            => get_sub_field('height'),
        'width'             => get_sub_field('width'),
        'length'            => get_sub_field('length'),
        'planting_position' => is_array(get_sub_field('planting_position')) ? implode(', ', get_sub_field('planting_position')) : get_sub_field('planting_position'),
        'soil_type'         => is_array(get_sub_field('soil_type')) ? implode(', ', get_sub_field('soil_type')) : get_sub_field('soil_type'),
        'plant_type'        => is_array(get_sub_field('plant_type')) ? implode(', ', get_sub_field('plant_type')) : get_sub_field('plant_type'),
        'material'          => is_array(get_sub_field('material')) ? implode(', ', get_sub_field('material')) : get_sub_field('material'),
    );
    
    endwhile;

    $urlParams = array();
    parse_str($_SERVER['QUERY_STRING'], $urlParams);
    $positions = array_column($products, 'position');
    sort($positions);
endif;

$enable_product_post_filtered_table = get_field('enable_product_post_filtered_table');
if ($enable_product_post_filtered_table === 'on') :
?>
<div class="refine-search mb-4">
    <form id="refine-search-form">
        <div class="filters-container">
            <?php 
            // Helper function to create dropdown filters
            function createFilterDropdown($id, $label, $options) {
                echo "<div class='filter-container'>";
                echo "<label for='$id'>$label</label>";
                echo "<select id='$id' name='$id' class='select-dropdown' multiple>";
                echo "<option value='' disabled selected>Select $label</option>";
                foreach ($options as $option) {
                    if ($option) {
                        echo "<option value='" . esc_attr($option) . "'>" . esc_html($option) . "</option>";
                    }
                }
                echo "</select></div>";
            }

            // Extract unique values for each field
            $fields = ['name', 'season','planting_position', 'soil_type', 'plant_type', 'material'];
            foreach ($fields as $field) {
                $uniqueValues = array_unique(array_column($products, $field));
                createFilterDropdown("filter-$field", ucfirst(str_replace('_', ' ', $field)), $uniqueValues);
            }
            ?>

            <!-- Numeric filters (height, width, length) -->
            <div class="filter-container">
                <label for="filter-height">Height (min)</label>
                <input type="number" id="filter-height" name="filter-height" class="select-dropdown" placeholder="Enter min height">
            </div>

            <div class="filter-container">
                <label for="filter-width">Width (min)</label>
                <input type="number" id="filter-width" name="filter-width" class="select-dropdown" placeholder="Enter min width">
            </div>

            <div class="filter-container">
                <label for="filter-length">Length (min)</label>
                <input type="number" id="filter-length" name="filter-length" class="select-dropdown" placeholder="Enter min length">
            </div>

            <!-- Sort By Price -->
            <div class="filter-container">
                <label for="sort-price">Sort By Price</label>
                <select id="sort-price" name="sort-price" class="select-dropdown">
                    <option value="" disabled selected>Select Price Order</option>
                    <option value="asc">Low to High</option>
                    <option value="desc">High to Low</option>
                </select>
            </div>
        </div>

        <div class="button-container">
            <button type="submit" class="btn btn-primary">Apply Filters</button>
        </div>
    </form>
</div>

<!-- Table Display -->
<div class="table-responsive">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Position</th>
                <th>Name</th>
                <th>Rating</th>
                <th>Price</th>
                <th>Season</th>
                <th>Specs</th>
                <th>Height</th>
                <th>Width</th>
                <th>Length</th>
                <th>Planting Position</th>
                <th>Soil Type</th>
                <th>Plant Type</th>
                <th>Material</th>
            </tr>
        </thead>
        <tbody id="product-table-body">
            <?php foreach ($positions as $position) :
                foreach ($products as $product) :
                    if ($product['position'] == $position) : ?>
                        <tr data-position="<?php echo esc_attr($product['position']); ?>"
                            data-name="<?php echo esc_attr($product['name']); ?>"
                            data-rating="<?php echo esc_attr($product['rating']); ?>"
                            data-price="<?php echo esc_attr($product['price']); ?>"
                            data-season="<?php echo esc_attr($product['season']); ?>"
                            data-specs="<?php echo esc_attr($product['specs']); ?>"
                            data-height="<?php echo esc_attr($product['height']); ?>"
                            data-width="<?php echo esc_attr($product['width']); ?>"
                            data-length="<?php echo esc_attr($product['length']); ?>"
                            data-planting_position="<?php echo esc_attr($product['planting_position']); ?>"
                            data-soil_type="<?php echo esc_attr($product['soil_type']); ?>"
                            data-plant_type="<?php echo esc_attr($product['plant_type']); ?>"
                            data-material="<?php echo esc_attr($product['material']); ?>">
                            <?php foreach ($product as $value) : ?>
                                <td><?php echo esc_html($value); ?></td>
                            <?php endforeach; ?>
                        </tr>
                    <?php endif;
                endforeach;
            endforeach; ?>
        </tbody>
    </table>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('refine-search-form');
    const tableBody = document.getElementById('product-table-body');
    const originalRows = Array.from(tableBody.children);

    // Function to apply filters
    function filterTable() {
        const formData = new FormData(form);
        let rows = originalRows;

        // Get filter values
        const selectedFilters = {
            name: formData.getAll('filter-name[]'),
            season: formData.getAll('filter-season[]'),
            planting_position: formData.getAll('filter-planting_position[]'),
            soil_type: formData.getAll('filter-soil_type[]'),
            plant_type: formData.getAll('filter-plant_type[]'),
            material: formData.getAll('filter-material[]'),
            height: formData.get('filter-height'),
            width: formData.get('filter-width'),
            length: formData.get('filter-length'),
            price: formData.get('sort-price')
        };

        // Apply filters
        rows = rows.filter(row => {
            // Check if row matches the selected filters
            for (const [filterKey, filterValues] of Object.entries(selectedFilters)) {
                if (filterValues.length > 0) {
                    if (Array.isArray(filterValues)) {
                        const rowValue = row.getAttribute(`data-${filterKey}`);
                        if (!filterValues.some(value => rowValue && rowValue.includes(value))) {
                            return false;
                        }
                    } else if (filterValues && row.getAttribute(`data-${filterKey}`) !== filterValues) {
                        return false;
                    }
                }
            }

            // Apply numeric filters (height, width, length)
            if (selectedFilters.height && parseFloat(row.getAttribute('data-height')) < parseFloat(selectedFilters.height)) {
                return false;
            }
            if (selectedFilters.width && parseFloat(row.getAttribute('data-width')) < parseFloat(selectedFilters.width)) {
                return false;
            }
            if (selectedFilters.length && parseFloat(row.getAttribute('data-length')) < parseFloat(selectedFilters.length)) {
                return false;
            }

            return true;
        });

        // Sort rows by price if "Sort By Price" is selected
        if (selectedFilters.price) {
            rows = rows.sort((a, b) => {
                const priceA = parseFloat(a.getAttribute('data-price'));
                const priceB = parseFloat(b.getAttribute('data-price'));
                if (selectedFilters.price === 'asc') {
                    return priceA - priceB;
                } else if (selectedFilters.price === 'desc') {
                    return priceB - priceA;
                }
                return 0;
            });
        }

        // Clear the table body and append the filtered rows
        tableBody.innerHTML = '';
        rows.forEach(row => tableBody.append(row));
    }

    // Add event listener to the form submit
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        filterTable();
    });
});
</script>

<?php endif; ?>
