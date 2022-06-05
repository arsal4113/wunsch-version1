<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-12">
        <h2><?= __('List of eBay Trading Api Call Limits') ?></h2>
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-content">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th><?= h('Call Name') ?></th>
                                <th><?= h('Daily Hard Limit') ?></th>
                                <th><?= h('Daily Soft Limit') ?></th>
                                <th><?= h('Daily Usage') ?></th>
                                <th><?= h('Hourly Hard Limit') ?></th>
                                <th><?= h('Hourly Soft Limit') ?></th>
                                <th><?= h('Hourly Usage') ?></th>
                                <th><?= h('Period') ?></th>
                                <th><?= h('Rule Status') ?></th>
                            </tr>
                            </thead>
                            <tbody>

                            <?php
                            if (isset($apiAccessRules->ApiAccessRule))
                                foreach ($apiAccessRules->ApiAccessRule as $apiAccessRule): ?>
                                    <tr>
                                        <td><?= (String)$apiAccessRule->CallName ?></td>
                                        <td><?= (String)$apiAccessRule->DailyHardLimit ?></td>
                                        <td><?= (String)$apiAccessRule->DailySoftLimit ?></td>
                                        <td><?= (String)$apiAccessRule->DailyUsage ?></td>
                                        <td><?= (String)$apiAccessRule->HourlyHardLimit ?></td>
                                        <td><?= (String)$apiAccessRule->HourlySoftLimit ?></td>
                                        <td><?= (String)$apiAccessRule->HourlyUsage ?></td>
                                        <td><?= (String)$apiAccessRule->Period ?></td>
                                        <td><?= (String)$apiAccessRule->RuleStatus ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
