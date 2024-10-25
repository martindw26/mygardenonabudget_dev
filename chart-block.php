<?php
// Get the repeater field data
$chart_axis = get_field('chart_axis');

// Initialize arrays to store chart labels and values
$labels = array();
$values = array();

// Iterate through the repeater field
if ($chart_axis) {
    foreach ($chart_axis as $axis) {
        // Check if 'values' key exists in the current repeater row
        if (isset($axis['values'])) {
            // Sanitize and validate data if needed
            $values[] = $axis['values'];
        }
        // Assuming each row in the repeater field has 'label' subfield
        if (isset($axis['label'])) {
            // Sanitize and validate data if needed
            $labels[] = $axis['label'];
        }
     
    }
}

// Remaining PHP code
$chart_height = get_field('chart_height');
$chart_axis_color = get_field('axis_color');
$chart_series_color = get_field('series_color');
$legend_text = get_field('chart_legend_text');
$chart_title = get_field('chart_title');
$chart_title_color = get_field('chart_title_color');
$chart_title_font_size = get_field('chart_title_font_size');
$show_legend = get_field('show_legend');
?>

<div id="chart-container"></div>

<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>
    document.addEventListener("DOMContentLoaded", function(event) {
        var options = {
            chart: {
                type: 'bar',
                events: {
            click: function(chart, w, e) {
              // console.log(chart, w, e)
            }
          },
                height: '<?php echo $chart_height; ?>px',
                background: '#fff',
                foreColor: '<?php echo $chart_axis_color; ?>',
                animations: {
                    enabled: false,
                    easing: "swing"
                },
                bar: {
                    isHorizontal: false,
                    strokeWidth: 2,
                    isNullValue: false,
                    isRangeBar: 0,
                    isVerticalGroupedRangeBar: 0,
                    isFunnel: false,
                    xRatio: null,
                    invertedXRatio: null,
                    invertedYRatio: 0.01985542766729749,
                    baseLineInvertedY: 0.1,
                    yaxisIndex: 0,
                    translationsIndex: 0,
                    seriesLen: 1,
                    pathArr: [{
                        title: {
                            align: "left",
                            margin: 5,
                            offsetX: 0,
                            offsetY: 0,
                            floating: false,
                            style: {
                                fontSize: "14px",
                                fontWeight: 900
                            }
                        }
                    }]
                }
            },
            series: [{
                name: '<?php echo $legend_text; ?>',
                data: <?php echo json_encode($values); ?>,
                color: "<?php echo $chart_series_color; ?>",
                dataLabels: {
                    enabled: true,
                    style: {
                        fontSize: '16px',
                        fontWeight: 'bold'
                    }
                },
                markers: {
                    width: 12,
                    height: 12,
                    strokeWidth: 0,
                    strokeColor: '#fff',
                    radius: 12
                }
            }],
            xaxis: {
                categories: <?php echo json_encode($labels); ?>
            },
            yaxis: {
                show: true,
                labels: {
                    formatter: function(value) {
                        return value.toString(); // Convert value to string for displaying as text
                    }
                }
            },
            title: {
                text: '<?php echo $chart_title; ?>',
                align: 'center',
                margin: 20,
                offsetY: 20,
                style: {
                    fontSize: '<?php echo $chart_title_font_size; ?>',
                    color: '<?php echo $chart_title_color; ?>'
                }
            },
            legend: {
                show: <?php echo $show_legend; ?>,
                showForSingleSeries: true,
                showForNullSeries: true,
                showForZeroSeries: true,
                position: 'bottom',
                horizontalAlign: 'center', 
                floating: false,
                fontSize: '14px',
                fontFamily: 'Helvetica, Arial',
                fontWeight: 400,
                formatter: undefined,
                inverseOrder: false,
                width: undefined,
                height: undefined,
                tooltipHoverFormatter: undefined,
                customLegendItems: [],
                offsetX: 0,
                offsetY: 0,
                labels: {
                    colors: '<?php echo $chart_axis_color; ?>',
                    useSeriesColors: true
                }
            },
            // Add the style object here
            style: {
                colors: '<?php echo $chart_axis_color; ?>',
                fontSize: '12px'
            }
        };

        var chart = new ApexCharts(document.querySelector("#chart-container"), options);
        chart.render();
    });
</script>
