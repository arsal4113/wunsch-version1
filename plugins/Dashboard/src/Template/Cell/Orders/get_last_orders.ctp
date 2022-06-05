<?php
$turnoverInfo = [];
$ordersInfo = [];
$highestTurnOver = 0;
$highestOrders = 0;
// For Past 30 days
for ($i = 14; $i >= 0; $i--) {
    $startDate = Date('Y-m-d', time() - ($i * 86400));

    if (isset($turnoverPerDay[$startDate])) {
        if ($highestTurnOver < $turnoverPerDay[$startDate]) {
            $highestTurnOver = $turnoverPerDay[$startDate];
        }
        array_push($turnoverInfo, [strtotime($startDate) * 1000, (float)$turnoverPerDay[$startDate]]);
    } else {
        array_push($turnoverInfo, [strtotime($startDate) * 1000, 0]);
    }

    if (isset($ordersPerDay[$startDate])) {
        if ($highestOrders < $ordersPerDay[$startDate]) {
            $highestOrders = $ordersPerDay[$startDate];
        }
        array_push($ordersInfo, [strtotime($startDate) * 1000, (float)$ordersPerDay[$startDate]]);
    } else {
        array_push($ordersInfo, [strtotime($startDate) * 1000, 0]);
    }
}
?>

<div class="row">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5><?= __('GMB') ?></h5>
            </div>
            <div class="ibox-content">
                <div class="flot-chart">
                    <div class="flot-chart-content" id="revenue-per-day-chart"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<br>

<div class="row">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5><?= __('Orders') ?></h5>
            </div>
            <div class="ibox-content">
                <div class="flot-chart">
                    <div class="flot-chart-content" id="orders-per-day-chart"></div>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    function revenuePerDay(data, highestTurnOver) {
        var dataset = [
            {
                label: "GMB Per Day",
                data: data,
                color: "#1ab394",
                bars: {
                    show: true,
                    align: "center",
                    barWidth: 24 * 60 * 60 * 600,
                    lineWidth: 0
                }

            }
        ];

        var options = {
            xaxis: {
                mode: "time",
                tickSize: [1, "day"],
                tickLength: 0,
                axisLabel: "Date",
                axisLabelUseCanvas: true,
                axisLabelFontSizePixels: 12,
                axisLabelFontFamily: 'Arial',
                axisLabelPadding: 10,
                color: "#d5d5d5"
            },
            yaxes: [{
                position: "left",
                max: highestTurnOver + 50,
                color: "#d5d5d5",
                axisLabelUseCanvas: true,
                axisLabelFontSizePixels: 12,
                axisLabelFontFamily: 'Arial',
                axisLabelPadding: 3
            }, {
                position: "right",
                clolor: "#d5d5d5",
                axisLabelUseCanvas: true,
                axisLabelFontSizePixels: 12,
                axisLabelFontFamily: ' Arial',
                axisLabelPadding: 67
            }
            ],
            legend: {
                noColumns: 1,
                labelBoxBorderColor: "#000000",
                position: "nw"
            },
            grid: {
                hoverable: false,
                borderWidth: 0
            }
        };

        $.plot($("#revenue-per-day-chart"), dataset, options);
    }

    function ordersPerDay(data, highestOrdersCount) {
        var dataset = [
            {
                label: "Orders Per Day",
                data: data,
                color: "#1ab394",
                bars: {
                    show: true,
                    align: "center",
                    barWidth: 24 * 60 * 60 * 600,
                    lineWidth: 0
                }

            }
        ];

        var options = {
            xaxis: {
                mode: "time",
                tickSize: [1, "day"],
                tickLength: 0,
                axisLabel: "Date",
                axisLabelUseCanvas: true,
                axisLabelFontSizePixels: 12,
                axisLabelFontFamily: 'Arial',
                axisLabelPadding: 10,
                color: "#d5d5d5"
            },
            yaxes: [{
                position: "left",
                max: highestOrdersCount + 10,
                color: "#d5d5d5",
                axisLabelUseCanvas: true,
                axisLabelFontSizePixels: 12,
                axisLabelFontFamily: 'Arial',
                axisLabelPadding: 3
            }, {
                position: "right",
                clolor: "#d5d5d5",
                axisLabelUseCanvas: true,
                axisLabelFontSizePixels: 12,
                axisLabelFontFamily: ' Arial',
                axisLabelPadding: 67
            }
            ],
            legend: {
                noColumns: 1,
                labelBoxBorderColor: "#000000",
                position: "nw"
            },
            grid: {
                hoverable: false,
                borderWidth: 0
            }
        };

        $.plot($("#orders-per-day-chart"), dataset, options);
    }

    $(document).ready(function () {
        revenuePerDay(<?= json_encode($turnoverInfo); ?>, <?= json_encode($highestTurnOver)?>);
        ordersPerDay(<?= json_encode($ordersInfo); ?>, <?= json_encode($highestOrders)?>);
    });

</script>
