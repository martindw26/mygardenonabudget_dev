
<style>

.price-comparison {
    overflow-x: auto;
    -webkit-overflow-scrolling: touch;
    position: relative;
}

.price-comparison-table {
    min-width: 600px;
    border-collapse: collapse;
    table-layout: auto;
}

.price-comparison-table th, .price-comparison-table td {
    padding: 10px;
    text-align: left;
    border: 1px solid #ddd;
    white-space: nowrap;
}

#backToTopBtn {
    background-color: white;
    color: black;
    border: none;
    padding: 10px 20px;
    cursor: pointer;
    font-size: 16px;
    border-radius: 5px;
    display: block;
    margin: 30px auto 10px;
}


</style>


<?php
// Register the custom block with ACF
function register_comparison_table_block() {
    acf_register_block_type(array(
        'name' => 'comparison-table',
        'title' => __('Comparison Table'),
        'description' => __('A custom comparison table block.'),
        'render_callback' => 'render_comparison_table_block',
        'category' => 'formatting',
        'icon' => 'editor-table',
        'keywords' => array('table', 'comparison'),
    ));
}
add_action('acf/init', 'register_comparison_table_block');

// Render callback for the custom block
function render_comparison_table_block($block) {
    // Block fields
    $headings = get_field('headings');
    $items = get_field('items');

    // Output the table markup
    ?>
    <div id="button-anchor" class="button-anchor"></div>
    <h3 class="product_compare_title"><?php echo esc_html($headings['product_compare_title']); ?></h3>

    <!-- Filters Container -->
    <div class="filters-container">
        <!-- Company Checkbox Filter -->
        <div class="filter-container">
            <label for="companyCheckboxes">Manufacturers</label>
            <div id="companyCheckboxes">
                <?php foreach ($items as $item) {
                    $make = $item['item_make'];
                    echo "<label><input type='checkbox' value='" . esc_attr(strtolower($make)) . "' checked> " . esc_html($make) . "</label>";
                } ?>
            </div>
        </div>

        <!-- Model Checkbox Filter -->
        <div class="filter-container">
            <label for="modelCheckboxes">Model</label>
            <div id="modelCheckboxes">
                <?php foreach ($items as $item) {
                    $model = $item['item_model'];
                    echo "<label><input type='checkbox' value='" . esc_attr(strtolower($model)) . "' checked> " . esc_html($model) . "</label>";
                } ?>
            </div>
        </div>
    </div>

    <div class="price-comparison">
        <table class="table price-comparison-table">
            <thead class="table-dark">
                <tr>
                    <th><?php echo esc_html($headings['first_header']); ?></th>
                    <th><?php echo esc_html($headings['second_header']); ?></th>
                    <th><?php echo esc_html($headings['specs_field_1_header']); ?></th>
                    <th><?php echo esc_html($headings['specs_field_2_header']); ?></th>
                    <th><?php echo esc_html($headings['specs_field_3_header']); ?></th>
                    <th><?php echo esc_html($headings['specs_field_4_header']); ?></th>
                    <th><?php echo esc_html($headings['price']); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($items as $item): ?>
                    <tr class="grid-item" data-name="<?php echo esc_attr($item['item_make']); ?>" data-category="<?php echo esc_attr($item['item_model']); ?>">
                        <td><?php echo esc_html($item['item_make']); ?></td>
                        <td><?php echo esc_html($item['item_model']); ?></td>
                        <td><?php echo esc_html($item['specs_1']); ?></td>
                        <td><?php echo esc_html($item['specs_field_2']); ?></td>
                        <td><?php echo esc_html($item['specs_field_3']); ?></td>
                        <td><?php echo esc_html($item['specs_field_4']); ?></td>
                        <td><?php echo esc_html($item['item_price']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <button id="backToTopBtn">Back to Top &#8657;</button>
    <?php
}


<script>

document.addEventListener('DOMContentLoaded', function () {
    const companyCheckboxes = document.getElementById('companyCheckboxes');
    const modelCheckboxes = document.getElementById('modelCheckboxes');
    const gridItems = document.querySelectorAll('.grid-item');
    const backToTopBtn = document.getElementById('backToTopBtn');

    // Get selected values from checkboxes
    function getSelectedValues(container) {
        return Array.from(container.querySelectorAll('input:checked')).map(checkbox => checkbox.value.toLowerCase());
    }

    // Filter items based on selected checkboxes
    function filterItems() {
        const selectedCompanies = getSelectedValues(companyCheckboxes);
        const selectedModels = getSelectedValues(modelCheckboxes);
        gridItems.forEach(item => {
            const name = item.getAttribute('data-name').toLowerCase();
            const category = item.getAttribute('data-category').toLowerCase();
            item.style.display = (selectedCompanies.includes(name) && selectedModels.includes(category)) ? 'table-row' : 'none';
        });
    }

    // Add event listeners
    companyCheckboxes.addEventListener('change', filterItems);
    modelCheckboxes.addEventListener('change', filterItems);

    backToTopBtn.addEventListener('click', () => {
        window.scrollTo({ top: 0, behavior: 'smooth' });
    });
});


</script>