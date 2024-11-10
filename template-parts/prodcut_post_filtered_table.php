<!-- ########################################## 
     ############### Pricing Table ############ 
     ########################################## -->

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
                <!-- Add the headers for hidden columns (they will be conditionally hidden with CSS) -->
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
                    <!-- Apply the product-specific classes to target them with CSS -->
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
    // Reset filters button
    document.getElementById('reset-filters').addEventListener('click', function() {
        document.getElementById('refine-search-form').reset();
        window.location.href = window.location.pathname; // Reset the URL
    });
</script>

<?php
endif;
?>



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
