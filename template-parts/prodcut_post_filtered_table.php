<!-- ########################################## 
     ############### Product Post (filtered table) ############ 
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

/* Individual Filter Container */
.filter-container {
    flex: 1;
    min-width: 200px;
    padding: 10px;
    border-right: 1px solid #ced4da;
}

/* Remove border from the last filter */
.filter-container:last-child {
    border-right: none;
}

/* Button container styling */
.button-container {
    display: flex;
    justify-content: flex-start;
    margin-top: 10px;
}

/* Button styling */
.btn-primary {
    background-color: #007bff;
    color: #fff;
    border: 1px solid #007bff;
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
            'currency'          => get_sub_field('product_price_currency'),
            'price'             => is_array(get_sub_field('product_price')) ? implode(', ', get_sub_field('product_price')) : get_sub_field('product_price'),
            'season'            => is_array(get_sub_field('season')) ? implode(', ', get_sub_field('season')) : get_sub_field('season'),
            'specs'             => is_array(get_sub_field('specs')) ? implode(', ', get_sub_field('specs')) : get_sub_field('specs'),
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

    $urlParams = array();
    parse_str($_SERVER['QUERY_STRING'], $urlParams);
    $positions = array_column($products, 'position');
    sort($positions);
endif;

$enable_product_post_filtered_table = get_field('enable_product_post_filtered_table');
if ($enable_product_post_filtered_table === 'on') :
?>
<!-- Filters for Table Columns -->
<div class="refine-search mb-4">
    <form id="refine-search-form">
        <div class="filters-container">
            <!-- Product Name Dropdown Filter -->
            <div class="filter-container">
                <label for="filter-name">Product Name</label>
                <select id="filter-name" multiple>
                    <?php
                    $names = array_unique(array_column($products, 'name'));
                    foreach ($names as $name) : ?>
                        <option value="<?php echo esc_attr($name); ?>"><?php echo esc_html($name); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- Sort By Price -->
            <div class="filter-container">
                <label for="sort-price">Sort By Price</label>
                <select id="sort-price">
                    <option value="">Select Price</option>
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
                <th>Height</th>
                <th>Width</th>
                <th>Length</th>
            </tr>
        </thead>
        <tbody id="product-table-body">
            <?php foreach ($positions as $position) :
                foreach ($products as $product) :
                    if ($product['position'] == $position) : ?>
                        <tr data-name="<?php echo esc_attr($product['name']); ?>" data-price="<?php echo esc_attr($product['price']); ?>" data-rating="<?php echo esc_attr($product['rating']); ?>">
                            <td><?php echo esc_html($product['position']); ?></td>
                            <td><?php echo esc_html($product['name']); ?></td>
                            <td><?php echo esc_html($product['rating']); ?></td>
                            <td><?php echo esc_html($product['price']); ?></td>
                            <td><?php echo esc_html($product['season']); ?></td>
                            <td><?php echo esc_html($product['height']); ?></td>
                            <td><?php echo esc_html($product['width']); ?></td>
                            <td><?php echo esc_html($product['length']); ?></td>
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
    const nameSelect = document.getElementById('filter-name');
    const sortPriceDropdown = document.getElementById('sort-price');
    const tableBody = document.getElementById('product-table-body');
    const originalRows = Array.from(tableBody.children);

    function filterTable() {
        const selectedNames = Array.from(nameSelect.selectedOptions).map(opt => opt.value);
        const sortPriceOrder = sortPriceDropdown.value;

        let filteredRows = originalRows.filter(row => {
            const name = row.getAttribute('data-name');
            return selectedNames.length === 0 || selectedNames.includes(name);
        });

        if (sortPriceOrder) {
            filteredRows.sort((a, b) => {
                const priceA = parseFloat(a.getAttribute('data-price'));
                const priceB = parseFloat(b.getAttribute('data-price'));
                return sortPriceOrder === 'asc' ? priceA - priceB : priceB - priceA;
            });
        }

        tableBody.innerHTML = '';
        filteredRows.forEach(row => tableBody.appendChild(row));
    }

    form.addEventListener('submit', function(event) {
        event.preventDefault();
        filterTable();
    });
});
</script>
<?php endif; ?>
