<?php
$this->start('script');
$this->fetch('script');
echo $this->Html->script('plugins/flot/jquery.flot');
echo $this->Html->script('plugins/flot/jquery.flot.tooltip.min');
echo $this->Html->script('plugins/flot/jquery.flot.spline');
echo $this->Html->script('plugins/flot/jquery.flot.resize');
echo $this->Html->script('plugins/flot/jquery.flot.pie');
echo $this->Html->script('plugins/flot/jquery.flot.symbol');
echo $this->Html->script('plugins/flot/jquery.flot.time');
$this->end();
?>


<?php if(empty($userDashboardConfigurations)): ?>
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <?= $this->cell('Dashboard.Customers::numberOfCustomers', [$dashboardType, $currentSellerId, $currentUserId]); ?>
        </div>
        <div class="row">
            <?= $this->cell('Dashboard.Orders::numberOfOrders', [$dashboardType, $currentSellerId, $currentUserId]); ?>
        </div>
        <div class="row">
            <?= $this->cell('Dashboard.Newsletters::numberOfNewsletters', [$dashboardType, $currentSellerId, $currentUserId]); ?>
        </div>
        <div class="row">
            <?= $this->cell('Dashboard.Orders::currentQuarterOrderInfo', [$dashboardType, $currentSellerId, $currentUserId]); ?>
        </div>
        <div class="row">
            <?= $this->cell('Dashboard.Orders::currentWeekTurnover', [$dashboardType, $currentSellerId, $currentUserId]); ?>
        </div>
        <div class="row">
            <?= $this->cell('Dashboard.Orders::getLastOrders', [$dashboardType, $currentSellerId, $currentUserId]); ?>
        </div>
    </div>
<?php else: ?>
    <div class="wrapper wrapper-content animated fadeInRight">
    <?php foreach($userDashboardConfigurations as $userDashboardConfiguration): ?>
        <?php
            $cellConfiguration = json_decode($userDashboardConfiguration->cell_configuration, true);

            $configurations = [];
            if(!empty($cellConfiguration)) {
                foreach($cellConfiguration as $configuration) {
                    if(!is_array($configuration) && isset(${$configuration})) {
                        $configurations[] = ${$configuration};
                    } else {
                        $configurations[] = $configuration;
                    }
                }
            }
        ?>
        <?= $this->cell($userDashboardConfiguration->cell_name, $configurations); ?>
    <?php endforeach; ?>
    </div>
<?php endif; ?>

<?php if(isset($this->request->data['chartNumberOfOrders']) && isset($this->request->data['chartRevenues'])): ?>
<script type="text/javascript">
    $(document).ready(function() {
        function gd(year, month, day) {
            return new Date(year, month - 1, day).getTime();
        }

        var numberOfOrders = [<?= $this->request->data['chartNumberOfOrders'] ?>];
        var payments = [<?= $this->request->data['chartRevenues'] ?>];

        var dataSet = [
            {
                label: "<?= __('Number of Orders'); ?>",
                data: numberOfOrders,
                color: "#1ab394",
                bars: {
                    show: true,
                    align: "center",
                    barWidth: 24 * 60 * 60 * 600,
                    lineWidth: 20
                }
            },
            {
                label: "<?= __('Revenue'); ?>",
                data: payments,
                yaxis: 2,
                color: "#1C84C6",
                lines: {
                    lineWidth:1,
                    show: true,
                    fill: true,
                    fillColor: {
                        colors: [{
                            opacity: 0.2
                        }, {
                            opacity: 0.4
                        }]
                    }
                }
            }
        ];

        var options = {
            xaxis: {
                mode: "time",
                timeformat: "%b",
                tickSize: [1, "month"],
                tickLength: 1,
                axisLabel: "Month",
                axisLabelUseCanvas: true,
                axisLabelFontSizePixels: 12,
                axisLabelFontFamily: 'Arial',
                axisLabelPadding: 0,
                color: "#d5d5d5"
            },
            yaxes: [{
                position: "left",
                color: "#d5d5d5",
                min: 0,
                axisLabelUseCanvas: true,
                axisLabelFontSizePixels: 12,
                axisLabelFontFamily: 'Arial',
                axisLabelPadding: 3
            }, {
                position: "right",
                color: "#d5d5d5",
                min: 0,
                axisLabelUseCanvas: true,
                axisLabelFontSizePixels: 12,
                axisLabelFontFamily: ' Arial',
                axisLabelPadding: 67
            }],
            legend: {
                noColumns: 1,
                labelBoxBorderColor: "#FFFFFF",
                position: "nw"
            },
            grid: {
                hoverable: false,
                borderWidth: 0
            }
        };

        $.plot($("#flot-dashboard-chart"), dataSet, options);
    });
</script>
<?php endif; ?>
