<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Product Filter</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
    .filter-container {
        padding: 1rem;
    }
    .form-select {
        width: 100%;
        max-width: 100%;
    }
    @media (max-width: 576px) {
        .filter-container {
            padding: 0.5rem;
        }
    }
</style>
</head>
<body>
<div class="container mt-4">
    <h2 class="text-center mb-4">Product Filter</h2>
    <div class="filter-container">
        <form id="product-filters" class="row gx-2 gy-3">
            <!-- Season Filter -->
            <div class="col-md-4 col-lg-3">
                <select id="season-filter" class="form-select">
                    <option value="">All Seasons</option>
                    <option value="Spring">Spring</option>
                    <option value="Summer">Summer</option>
                    <option value="Autumn">Autumn</option>
                    <option value="Winter">Winter</option>
                </select>
            </div>
            <!-- Specs Filter -->
            <div class="col-md-4 col-lg-3">
                <select id="specs-filter" class="form-select">
                    <option value="">All Specs</option>
                    <option value="Spec1">Spec1</option>
                    <option value="Spec2">Spec2</option>
                </select>
            </div>
            <!-- Height Filter -->
            <div class="col-md-4 col-lg-3">
                <select id="height-filter" class="form-select">
                    <option value="">All Heights</option>
                    <option value="Short">Short</option>
                    <option value="Medium">Medium</option>
                    <option value="Tall">Tall</option>
                </select>
            </div>
            <!-- Width Filter -->
            <div class="col-md-4 col-lg-3">
                <select id="width-filter" class="form-select">
                    <option value="">All Widths</option>
                    <option value="Narrow">Narrow</option>
                    <option value="Wide">Wide</option>
                </select>
            </div>
            <!-- Planting Position Filter -->
            <div class="col-md-4 col-lg-3">
                <select id="planting-position-filter" class="form-select">
                    <option value="">All Positions</option>
                    <option value="Full Sun">Full Sun</option>
                    <option value="Partial Shade">Partial Shade</option>
                </select>
            </div>
            <!-- Soil Type Filter -->
            <div class="col-md-4 col-lg-3">
                <select id="soil-type-filter" class="form-select">
                    <option value="">All Soil Types</option>
                    <option value="Clay">Clay</option>
                    <option value="Sandy">Sandy</option>
                    <option value="Loam">Loam</option>
                </select>
            </div>
            <!-- Submit Button -->
            <div class="col-md-4 col-lg-3">
                <button type="submit" class="btn btn-primary w-100">Filter</button>
            </div>
        </form>
    </div>
    
    <!-- Product List -->
    <div class="product-list">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Specs</th>
                    <th>Height</th>
                    <th>Width</th>
                    <th>Season</th>
                    <th>Planting Position</th>
                    <th>Soil Type</th>
                </tr>
            </thead>
            <tbody>
                <tr class="product-row" 
                    data-season="Spring" 
                    data-specs="Spec1" 
                    data-height="Tall" 
                    data-width="Wide" 
                    data-planting_position="Full Sun" 
                    data-soil_type="Loam">
                    <td>Product A</td>
                    <td>Spec1</td>
                    <td>Tall</td>
                    <td>Wide</td>
                    <td>Spring</td>
                    <td>Full Sun</td>
                    <td>Loam</td>
                </tr>
                <tr class="product-row" 
                    data-season="Winter" 
                    data-specs="Spec2" 
                    data-height="Short" 
                    data-width="Narrow" 
                    data-planting_position="Partial Shade" 
                    data-soil_type="Clay">
                    <td>Product B</td>
                    <td>Spec2</td>
                    <td>Short</td>
                    <td>Narrow</td>
                    <td>Winter</td>
                    <td>Partial Shade</td>
                    <td>Clay</td>
                </tr>
                <tr class="product-row" 
                    data-season="Summer" 
                    data-specs="Spec1" 
                    data-height="Medium" 
                    data-width="Wide" 
                    data-planting_position="Full Sun" 
                    data-soil_type="Sandy">
                    <td>Product C</td>
                    <td>Spec1</td>
                    <td>Medium</td>
                    <td>Wide</td>
                    <td>Summer</td>
                    <td>Full Sun</td>
                    <td>Sandy</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<script>
document.getElementById("product-filters").addEventListener("submit", function(event) {
    event.preventDefault();
    const filters = {
        season: document.getElementById("season-filter").value.toLowerCase(),
        specs: document.getElementById("specs-filter").value.toLowerCase(),
        height: document.getElementById("height-filter").value.toLowerCase(),
        width: document.getElementById("width-filter").value.toLowerCase(),
        planting_position: document.getElementById("planting-position-filter").value.toLowerCase(),
        soil_type: document.getElementById("soil-type-filter").value.toLowerCase()
    };
    const productRows = document.querySelectorAll(".product-row");
    
    productRows.forEach((row) => {
        const matches = Object.keys(filters).every((key) => {
            const filterValue = filters[key];
            const rowValue = row.getAttribute(`data-${key}`)?.toLowerCase() || "";
            return !filterValue || rowValue.includes(filterValue);
        });
        row.style.display = matches ? "" : "none";
    });
});
</script>
</body>
</html>
