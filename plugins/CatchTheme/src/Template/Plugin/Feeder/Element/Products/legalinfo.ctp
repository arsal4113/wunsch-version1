<div class="legal-info">
    <?php
    if (isset($ebayItem['items'][0]['seller']['legal_info'])) {
        $info = $ebayItem['items'][0]['seller']['legal_info'];
        ?>
        <table>
            <tr>
                <td><strong><?= ($info['name'] ?: null) ?></strong></td>
                <?php /* moved in another position, see WD-259 <td nowrap rowspan="6">
                    <strong><?= __("Telephone") . ": " . ($info['phone'] ?: "-") ?></strong><br/>
                    <strong><?= __("Fax") . ": " . ($info['fax'] ?: "-") ?></strong><br/>
                    <strong><?= __("E-Mail") . ": " . ($info['email'] ?: "-") ?></strong><br/>
                </td> */ ?>
            </tr>
            <tr>
                <td><strong><?= $info['legal_contact_first_name'] . " " . $info['legal_contact_last_name'] ?></strong>
                </td>
            </tr>
            <tr>
                <td>
                    <strong><?= $info['legal_address']['address_line_1'] . " " . $info['legal_address']['address_line_2'] ?></strong>
                </td>
            </tr>
            <tr>
                <td>
                    <strong><?= ($info['legal_address']['postal_code'] != 'default' ? $info['legal_address']['postal_code'] : null) . " " . ($info['legal_address']['city'] != 'default' ? $info['legal_address']['city'] : null) ?></strong>
                </td>
            </tr>
            <tr>
                <td>
                    <strong><?= ($info['legal_address']['state_or_province'] != 'default' ? $info['legal_address']['state_or_province'] : null) . " " . ($info['legal_address']['country_name'] != 'default' ? $info['legal_address']['country_name'] : null) ?></strong>
                </td>
            </tr>

            <tr><td colspan="2">&nbsp;</td></tr>
            <tr>
                <td colspan="2">
                    <div class="hidden-information">
                        <a href="Javascript:;" class="more"><?= __('Complete information') ?></a>
                        <span>
                            <strong><?= __("Telephone") . ": " . ($info['phone'] ?: "-") ?></strong>
                            <br />
                            <strong><?= __("Fax") . ": " . ($info['fax'] ?: "-") ?></strong>
                            <br />
                            <strong><?= __("E-Mail") . ": " . ($info['email'] ?: "-") ?></strong>
                        </span>
                        <a href="Javascript:;" class="less"><?= __('Less information') ?></a>
                    </div>
                </td>
            </tr>

            <?php
            if (!empty($info['imprint'])) {
                ?>
                <tr>
                    <td colspan="2">&nbsp;</td>
                </tr>
                <tr>
                    <td colspan="2" class="imprint-col"><?= $this->Feeder->filterLinks($info['imprint']) ?></td>
                </tr>
                <?php
            }
            ?>
            <tr>
                <td colspan="2">&nbsp;</td>
            </tr>
            <tr>
                <td colspan="2">
                    <strong><?= __("Commercial registry number") ?></strong>: <?= ($info['registration_number'] ?: "-") ?>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <strong><?= __("Tax identification number") ?></strong>: <?= ($info['vat_details']['issuing_country'] != 'default' ? $info['vat_details']['issuing_country'] : null) . " " . ($info['vat_details']['vat_id'] != 'default' ? $info['vat_details']['vat_id'] : null) ?>
                </td>
            </tr>

            <tr><td colspan="2">&nbsp;</td></tr>
            <tr>
                <td colspan="2">
                    <div class="hidden-information">
                        <a href="Javascript:;" class="more"><?= __('Complete cancellation policy') ?></a>
                        <span>
                            <?= nl2br(($ebayItem['items'][0]['return_terms']['return_instructions']) ?: "-") ?>
                        </span>
                        <a href="Javascript:;" class="less"><?= __('Less information') ?></a>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <div class="hidden-information">
                        <a href="Javascript:;" class="more"><?= __('Terms and conditions of this offer') ?></a>
                        <span>
                            <?= (nl2br($info['terms_of_service']) ?: "-") ?>
                        </span>
                        <a href="Javascript:;" class="less"><?= __('Less information') ?></a>
                    </div>
                </td>
            </tr>
        </table>
        <?php
    } else {
        ?>
        <p>
            <?= __("The seller has not provided any contact info.") ?>
        </p>
        <?php
    }
    ?>
</div>

<script type="text/javascript">
    $(function() {
        var information_toggler = $('.hidden-information > a');

        information_toggler.on('click', function () {

            $(this).parent().toggleClass('active');

        });
    });
</script>
