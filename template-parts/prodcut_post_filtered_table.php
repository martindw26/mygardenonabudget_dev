<!-- ########################################## 
     ############### Product Post (Filtered Table) ############ 
     ########################################## -->

     <style>
/* Main Filters Container */
.filters-container {
    display: flex;
    flex-wrap: wrap;
    gap: 15px;
    margin: 20px 0;
    background-color: #f8f9fa;
    border: 1px solid #ced4da;
    padding: 10px;
}

.filter-container {
    display: flex;
    flex-direction: column;
    flex: 1;
    min-width: 200px;
    padding: 10px;
    border-right: 1px solid #ced4da;
}

.filter-container:last-child {
    border-right: none;
}

.filter-container select[disabled] {
    background-color: #e9ecef;
    color: #6c757d;
    cursor: not-allowed;
}

.filter-container label {
    font-weight: bold;
    margin-bottom: 0.5rem;
    color: #343a40;
}

.filter-container select,
.filter-container input[type="number"] {
    width: 100%;
    padding: 0.5rem;
    border: 1px solid #ccc;
    box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.1);
    transition: border-color 0.3s ease;
}

/* Button container styling */
.button-container {
    display: flex;
    justify-content: flex-start;
    margin-top: 10px;
}

.btn {
    margin-right: 10px;
}

.table-responsive {
    margin-top: 20px;
}
</style>

<?php
// Initialize an array to store products
$products = array();

if (have_rows('list')) :
    while (have_rows('list')) : the_row();
        $products[] = array(
            'position'          => get_sub_field('product_position'),
            'name'              => get_sub_field('product_name'),
            'rating'            => get_sub_field('rating'),
            'currency'          => get_sub_field('product_price_currency'),
            'price'             => get_sub_field('product_price'),
            'season'            => get_sub_field('season'),
            'specs'             => get_sub_field('specs'),
            'height'            => get_sub_field('height'),
            'width'             => get_sub_field('width'),
            'length'            => get_sub_field('length'),
            'stock_status'      => get_sub_field('stock_status'),
            'planting_position' => get_sub_field('planting_position'),
            'soil_type'         => get_sub_field('soil_type'),
            'plant_type'        => get_sub_field('plant_type'),
            'material'          => get_sub_field('material'),
        );
    endwhile;

    // Get URL parameters
    $urlParams = array();
    parse_str($_SERVER['QUERY_STRING'], $urlParams);

    $enable_product_post_filtered_table = get_field('enable_product_post_filtered_table');
    if ($enable_product_post_filtered_table === 'on') :
?>

<div class="refine-search mb-4">
    <form id="refine-search-form">
        <div class="filters-container">
            <!-- Product Name Filter -->
            <div class="filter-container">
                <label for="filter-name">Product Name</label>
                <select id="filter-name" multiple>
                    <?php
                    $names = array_unique(array_column($products, 'name'));
                    foreach ($names as $name) : ?>
                        <option value="<?php echo esc_attr($name); ?>" <?php echo isset($urlParams['name']) && in_array($name, explode(',', $urlParams['name'])) ? 'selected' : ''; ?>>
                            <?php echo esc_html($name); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- Season Filter -->
            <div class="filter-container">
                <label for="filter-season">Season</label>
                <select id="filter-season" multiple>
                    <?php
                    $seasons = array_unique(array_column($products, 'season'));
                    foreach ($seasons as $season) : ?>
                        <option value="<?php echo esc_attr($season); ?>"><?php echo esc_html($season); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>

        <div class="button-container">
            <button type="submit" class="btn btn-primary">Apply Filters</button>
            <button type="button" id="reset-filters" class="btn btn-secondary">Reset Filters</button>
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
                <th>Stock Status</th>
                <th>Planting Position</th>
                <th>Soil Type</th>
                <th>Plant Type</th>
                <th>Material</th>
            </tr>
        </thead>
        <tbody id="product-table-body">
            <?php foreach ($products as $product) : ?>
                <tr data-name="<?php echo esc_attr($product['name']); ?>" data-season="<?php echo esc_attr($product['season']); ?>">
                    <td><?php echo esc_html($product['position']); ?></td>
                    <td><?php echo esc_html($product['name']); ?></td>
                    <td><?php echo esc_html($product['rating']); ?></td>
                    <td><?php echo esc_html($product['price']); ?></td>
                    <td><?php echo esc_html($product['season']); ?></td>
                    <td><?php echo esc_html($product['specs']); ?></td>
                    <td><?php echo esc_html($product['height']); ?></td>
                    <td><?php echo esc_html($product['width']); ?></td>
                    <td><?php echo esc_html($product['length']); ?></td>
                    <td><?php echo esc_html($product['stock_status']); ?></td>
                    <td><?php echo esc_html($product['planting_position']); ?></td>
                    <td><?php echo esc_html($product['soil_type']); ?></td>
                    <td><?php echo esc_html($product['plant_type']); ?></td>
                    <td><?php echo esc_html($product['material']); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php
endif;
endif;
?>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('refine-search-form');
    const nameSelect = document.getElementById('filter-name');
    const seasonSelect = document.getElementById('filter-season');
    const tableBody = document.getElementById('product-table-body');
    const resetButton = document.getElementById('reset-filters');
    const originalRows = Array.from(tableBody.children);

    function filterTable() {
        const selectedNames = Array.from(nameSelect.selectedOptions).map(opt => opt.value);
        const selectedSeasons = Array.from(seasonSelect.selectedOptions).map(opt => opt.value);

        Array.from(tableBody.children).forEach(row => {
            const matchesName = selectedNames.length === 0 || selectedNames.includes(row.getAttribute('data-name'));
            const matchesSeason = selectedSeasons.length === 0 || selectedSeasons.includes(row.getAttribute('data-season'));

            row.style.display = matchesName && matchesSeason ? '' : 'none';
        });
    }

    form.addEventListener('change', filterTable);
    resetButton.addEventListener('click', () => {
        nameSelect.selectedIndex = -1;
        seasonSelect.selectedIndex = -1;
        filterTable();
    });
});
</script>
