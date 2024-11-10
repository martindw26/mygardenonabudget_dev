<!-- ##########################################  
     ############### Product Post (Filtered Table) ############ 
     ########################################## -->

     <style>
.filters-container {
    display: flex;
    flex-wrap: wrap;
    gap: 15px;
    margin: 20px 0;
    background-color: #f8f9fa;
    border: 1px solid #ced4da;
    padding: 20px;
    border-radius: 8px;
}

.filter-container {
    flex: 1;
    min-width: 220px;
}

.filter-container label {
    display: block;
    font-weight: 500;
    margin-bottom: 5px;
    color: #333;
}

.select-dropdown {
    width: 100%;
    padding: 8px;
    border: 1px solid #ced4da;
    border-radius: 5px;
    font-size: 14px;
    color: #495057;
    background-color: #fff;
    appearance: none;
    cursor: pointer;
}

.select-dropdown:focus {
    outline: none;
    border-color: #007bff;
    box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
}

.button-container {
    display: flex;
    justify-content: flex-start;
    margin-top: 15px;
}

.btn-primary {
    background-color: #007bff;
    color: #fff;
    border: 1px solid #007bff;
    border-radius: 5px;
    padding: 8px 16px;
    font-size: 14px;
    cursor: pointer;
    transition: background-color 0.2s ease;
}

.btn-primary:hover {
    background-color: #0056b3;
}

@media (max-width: 768px) {
    .filter-container {
        min-width: 100%;
    }
}
</style>

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
                echo "<select id='$id' class='select-dropdown' multiple>";
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
                <input type="number" id="filter-height" class="select-dropdown" placeholder="Enter min height">
            </div>

            <div class="filter-container">
                <label for="filter-width">Width (min)</label>
                <input type="number" id="filter-width" class="select-dropdown" placeholder="Enter min width">
            </div>

            <div class="filter-container">
                <label for="filter-length">Length (min)</label>
                <input type="number" id="filter-length" class="select-dropdown" placeholder="Enter min length">
            </div>

            <!-- Sort By Price -->
            <div class="filter-container">
                <label for="sort-price">Sort By Price</label>
                <select id="sort-price" class="select-dropdown">
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
                        <tr data-<?php foreach ($product as $key => $value) echo "$key='" . esc_attr($value) . "' "; ?>>
                            <?php foreach ($product as $value) echo "<td>" . esc_html($value) . "</td>"; ?>
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

    function filterTable() {
        const filters = Object.fromEntries(new FormData(form));
        let rows = originalRows;

        // Apply filters
        rows = rows.filter(row => {
            for (const [field, value] of Object.entries(filters)) {
                if (value && row.getAttribute(`data-${field}`) !== value) return false;
            }
            return true;
        });

        tableBody.innerHTML = '';
        rows.forEach(row => tableBody.append(row));
    }

    form.addEventListener('submit', (e) => { e.preventDefault(); filterTable(); });
});
</script>
<?php endif; ?>
