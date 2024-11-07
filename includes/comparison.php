<!-- ########################################## 
     ############# Product Compare Table ########### 
     ########################################## -->

     <style>
    .price-comparison {
        overflow-x: auto; /* Enables horizontal scrolling */
        -webkit-overflow-scrolling: touch; /* Smooth scrolling on iOS */
        position: relative;
    }

    .price-comparison-table {
        min-width: 600px; /* Adjust based on your content */
        border-collapse: collapse;
        table-layout: auto; /* Allows columns to adjust based on content */
    }

    .price-comparison-table th,
    .price-comparison-table td {
        padding: 10px;
        text-align: left;
        border: 1px solid #ddd;
        white-space: nowrap; /* Prevents text from wrapping */
    }

    .sticky {
        position: sticky;
        z-index: 1; /* Stack above other content */
    }


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

</style>

<?php
$headings = get_field('headings');

$first_header = $headings['first_header'];
$second_header = $headings['second_header'];
$specs_field_1_header = $headings['specs_field_1_header'];
$specs_field_2_header = $headings['specs_field_2_header'];
$specs_field_3_header = $headings['specs_field_3_header'];
$specs_field_4_header = $headings['specs_field_4_header'];
$price_header = $headings['price'];

// Initialize empty arrays to store unique values
$unique_makes = [];
$unique_models = [];

if (have_rows('items')) {
    while (have_rows('items')) {
        the_row();
        $make = get_sub_field('item_make');
        $model = get_sub_field('item_model');

        // Populate arrays only with unique makes and models
        if (!in_array($make, $unique_makes)) {
            $unique_makes[] = $make;
        }

        if (!in_array($model, $unique_models)) {
            $unique_models[] = $model;
        }
    }
}
?>

<?php
if ($enable_product_compare_table === 'on') {

<div id="button-anchor" class="button-anchor"></div>

<?php $product_compare_title = get_field('product_compare_title'); ?>
<h3 class="product_compare_title"><?php echo $product_compare_title; ?></h3>

<div class="button-container"></div>
<!-- Filters Container -->
<div class="filters-container">
    <!-- Company Checkbox Filter -->
    <div class="filter-container">
        <label for="companyCheckboxes">Manufacturers</label>
        <div id="companyCheckboxes">
            <?php foreach ($unique_makes as $make): ?>
                <label>
                    <input type="checkbox" value="<?php echo esc_attr(strtolower($make)); ?>" checked>
                    <?php echo esc_html($make); ?>
                </label>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Model Checkbox Filter -->
    <div class="filter-container">
        <label for="modelCheckboxes">Model</label>
        <div id="modelCheckboxes">
            <?php foreach ($unique_models as $model): ?>
                <label>
                    <input type="checkbox" value="<?php echo esc_attr(strtolower($model)); ?>" checked>
                    <?php echo esc_html($model); ?>
                </label>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<div class="price-comparison">
    <table class="table price-comparison-table">
        <?php if (have_rows('items')): ?>
            <thead class="table-dark">
                <tr>
                    <th><?php echo esc_html($first_header); ?></th>
                    <th><?php echo esc_html($second_header); ?></th>
                    <th><?php echo esc_html($specs_field_1_header); ?></th>
                    <th><?php echo esc_html($specs_field_2_header); ?></th>
                    <th><?php echo esc_html($specs_field_3_header); ?></th>
                    <th><?php echo esc_html($specs_field_4_header); ?></th>
                    <th><?php echo esc_html($price_header); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php while (have_rows('items')): the_row(); ?>
                    <tr class="grid-item" 
                        data-name="<?php echo esc_attr(get_sub_field('item_make')); ?>" 
                        data-category="<?php echo esc_attr(get_sub_field('item_model')); ?>">
                        <td><?php echo esc_html(get_sub_field('item_make')); ?></td>
                        <td><?php echo esc_html(get_sub_field('item_model')); ?></td>
                        <td><?php echo esc_html(get_sub_field('specs_1')); ?></td>
                        <td><?php echo esc_html(get_sub_field('specs_field_2')); ?></td>
                        <td><?php echo esc_html(get_sub_field('specs_field_3')); ?></td>
                        <td><?php echo esc_html(get_sub_field('specs_field_4')); ?></td>
                        <td><?php echo esc_html(get_sub_field('item_price')); ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        <?php endif; ?>
    </table>
</div>

<br>

<button id="backToTopBtn" style="display:block;">Back to Top &#8657;</button>

} else {

}
?>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var companyCheckboxes = document.getElementById('companyCheckboxes');
    var modelCheckboxes = document.getElementById('modelCheckboxes');
    var gridItems = document.querySelectorAll('.grid-item');
    var backToTopBtn = document.getElementById('backToTopBtn');

    var itemsPerPage = 16;
    var currentPage = 1;
    var totalItems = gridItems.length;

    // Helper function to get selected values from checkboxes
    function getSelectedValues(checkboxContainer) {
        var selected = [];
        var checkboxes = checkboxContainer.querySelectorAll('input[type="checkbox"]');
        checkboxes.forEach(function(checkbox) {
            if (checkbox.checked) {
                selected.push(checkbox.value.toLowerCase());
            }
        });
        return selected;
    }

    // Uncheck and hide models when a make is deselected and re-check them when make is re-selected
    function syncModelsWithMakeSelection() {
        var selectedCompanies = getSelectedValues(companyCheckboxes);

        modelCheckboxes.querySelectorAll('input[type="checkbox"]').forEach(function(modelCheckbox) {
            var modelValue = modelCheckbox.value.toLowerCase();
            var correspondingMake = getMakeForModel(modelValue);

            if (correspondingMake && !selectedCompanies.includes(correspondingMake.toLowerCase())) {
                // If the corresponding make is not selected, uncheck and hide the model
                modelCheckbox.checked = false;
                modelCheckbox.parentElement.style.display = 'none';
            } else if (correspondingMake && selectedCompanies.includes(correspondingMake.toLowerCase())) {
                // If the corresponding make is selected, recheck and show the model
                modelCheckbox.checked = true;
                modelCheckbox.parentElement.style.display = 'block';
            }
        });
    }

    // Helper function to find the make corresponding to a given model
    function getMakeForModel(model) {
        var matchingItem = Array.from(gridItems).find(function(item) {
            return item.getAttribute('data-category').toLowerCase() === model;
        });
        return matchingItem ? matchingItem.getAttribute('data-name') : null;
    }

    // Filter items based on selected checkboxes
    function filterItems() {
        var selectedCompanies = getSelectedValues(companyCheckboxes);
        var selectedModels = getSelectedValues(modelCheckboxes);

        var visibleCount = 0;
        var totalVisible = itemsPerPage * currentPage;

        gridItems.forEach(function(item, index) {
            var name = item.getAttribute('data-name').toLowerCase();
            var category = item.getAttribute('data-category').toLowerCase();

            // Show the item if both the make and model are selected
            var showItem = selectedCompanies.includes(name) && selectedModels.includes(category);

            if (showItem && visibleCount < totalVisible) {
                item.style.display = 'table-row';
                visibleCount++;
            } else {
                item.style.display = 'none';
            }
        });

        // Show or hide the load more button based on visible items
        if (visibleCount >= totalItems) {
            document.getElementById('loadMoreBtn').style.display = 'none';
        } else {
            document.getElementById('loadMoreBtn').style.display = 'block';
        }
    }

    // Handle checkbox change for filtering
    function handleCheckboxChange() {
        syncModelsWithMakeSelection();  // Sync models with the current make selection
        currentPage = 1;
        filterItems();
    }

    // Add event listeners for checkbox changes
    companyCheckboxes.addEventListener('change', function(event) {
        handleCheckboxChange();
    });

    modelCheckboxes.addEventListener('change', function() {
        handleCheckboxChange();
    });

    // Scroll back to top when the back-to-top button is clicked
    backToTopBtn.addEventListener('click', function() {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    });

    // Show or hide back-to-top button based on scrolling
    window.addEventListener('scroll', function() {
        if (window.scrollY > 300) {
            backToTopBtn.classList.add('show');
        } else {
            backToTopBtn.classList.remove('show');
        }
    });

    // Initial filter on page load
    filterItems();
});
</script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const priceComparison = document.querySelector('.price-comparison');
    const stickyHeaders = document.querySelectorAll('.sticky');

    priceComparison.addEventListener('scroll', function () {
        const scrollLeft = priceComparison.scrollLeft;

        stickyHeaders.forEach((header) => {
            header.style.transform = `translateX(${scrollLeft}px)`;
        });
    });
});
</script>

<!-- Removed jQuery since Bootstrap 5 doesn't require it -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.min.js"></script>
