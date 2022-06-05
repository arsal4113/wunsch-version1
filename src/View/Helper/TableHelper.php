<?php
namespace App\View\Helper;

use App\View\Helper\AppHelper;

/**
 * Tablehelper for CakePHP 3.0
 * Based on CakePHP TableHelper from Steve Klebanoff
 *
 * Usage:
 *    <code>
 *        <?php
 *            $htmlOptions = [
 *                'tableClass'    => 'table table-bordered table-striped table-condensed flip-content',
 *                'actionClass'    => 'actions text-center',
 *            ];
 *
 *            $displayFields = [
 *                $this->Paginator->sort('id', '#')                            => ['id'],
 *                $this->Paginator->sort('parent_id', 'Product Parent ID')    => ['parent_core_product.id', ['controller' => 'core_products', 'action' => 'view', 'parameters' => ['parent_core_product.id']], ['headerClass' => 'text-center', 'bodyClass' => 'text-center']],
 *                $this->Paginator->sort('core_product_type_id')                => ['core_product_type.code', ['controller' => 'core_product_types', 'action' => 'view', 'parameters' => ['core_product_type.id']], ['headerClass' => 'text-center', 'bodyClass' => 'text-center']],
 *                $this->Paginator->sort('core_seller_id')                    => ['core_seller.name', ['controller' => 'core_sellers', 'action' => 'view', 'parameters' => ['core_seller.id']], ['headerClass' => 'text-center', 'bodyClass' => 'text-center']],
 *                $this->Paginator->sort('created')                            => ['created', [], ['headerClass' => 'text-center', 'bodyClass' => 'text-center']],
 *                $this->Paginator->sort('modified')                            => ['modified', [], ['headerClass' => 'text-center', 'bodyClass' => 'text-center']],
 *            ];
 *
 *            $actions = [
 *                'View'        => ['controller' => 'core_products', 'action' => 'view', 'parameters' => ['id']],
 *                'Edit'        => ['controller' => 'core_products', 'action' => 'edit', 'parameters' => ['id']],
 *                'Delete'    => ['controller' => 'core_products', 'action' => 'delete', 'parameters' => ['id'], 'confirmMessage' => 'Are you sure you want to delete # %s?'],
 *            ];
 *
 *            echo $this->Table->createTable($coreProducts, $displayFields, $actions, __('You haven\'t saved any product'), $htmlOptions);
 *        ?>
 *    </code>
 */
class TableHelper extends AppHelper
{
    public $helpers = ['Html'];

    /**
     * Create HTML table
     *
     * @param array $tableEntries
     * @param array $tableDisplayFields
     * @param array $tableActions
     * @param string $noItemsMessage
     * @param array $htmlOptions
     */
    public function createTable($tableEntries = [], $tableDisplayFields = [], $tableActions = [], $noItemsMessage = "There are no items to display", $htmlOptions = [])
    {
        if (count($tableEntries) == 0) {
            return $noItemsMessage;
        }

        // Create HTML table
        $output = (isset($htmlOptions['tableClass']) && !empty($htmlOptions['tableClass']))
            ? "<table class=\"" . $htmlOptions['tableClass'] . "\">"
            : "<table>";

        // Create table header
        $output .= $this->createTableHeader($tableDisplayFields, $tableActions, $htmlOptions);

        // Create table entries
        $output .= $this->createTableEntries($tableDisplayFields, $tableEntries, $tableActions, $htmlOptions);

        $output .= "</table>";

        return $output;
    }

    /**
     * Create table header
     * @param array $tableDisplayFields
     * @param array $tableActions
     * @param array $htmlOptions
     * @return string
     */
    private function createTableHeader($tableDisplayFields, $tableActions, $htmlOptions)
    {
        $output = "<tr>";

        foreach ($tableDisplayFields as $tableDisplayFieldName => $tableDisplayField) {
            $fieldHtmlOptions = isset($tableDisplayField[2]) ? $tableDisplayField[2] : [];

            $output .= (isset($fieldHtmlOptions['headerClass']) && !empty($fieldHtmlOptions['headerClass']))
                ? "<th class=\"" . $fieldHtmlOptions['headerClass'] . "\">" . $tableDisplayFieldName . "</th>"
                : "<th>" . $tableDisplayFieldName . "</th>";
        }

        $hasActions = (!empty($tableActions));
        if ($hasActions) {
            $output .= (isset($htmlOptions['actionClass']) && !empty($htmlOptions['actionClass']))
                ? "<th class=\"" . $htmlOptions['actionClass'] . "\">Actions</th>"
                : "<th>Actions</th>";
        }

        $output .= "</tr>";

        return $output;
    }

    /**
     * Create table entries
     * @param array $tableDisplayFields
     * @param array $tableEntries
     * @param array $tableActions
     * @param array $htmlOptions
     * @return string
     */
    private function createTableEntries($tableDisplayFields, $tableEntries, $tableActions, $htmlOptions)
    {
        $output = "";

        foreach ($tableEntries as $entry) {
            $output .= "<tr>";

            // Table entries
            foreach ($tableDisplayFields as $tableDisplayFieldName => $tableDisplayField) {
                $fieldToDisplayPath = explode(".", $tableDisplayField[0]);
                for ($i = 0; $i < count($fieldToDisplayPath); $i++) {
                    if ($i == 0) {
                        if ($fieldToDisplayPath[$i] == 'created' || $fieldToDisplayPath[$i] == 'modified') {
                            $fieldToDisplay = $entry->$fieldToDisplayPath[$i]->format('F jS Y  h:i:s A');
                        } else {
                            $fieldToDisplay = $entry->$fieldToDisplayPath[$i];
                        }
                    } else {
                        if ($fieldToDisplayPath[$i] == 'created' || $fieldToDisplayPath[$i] == 'modified') {
                            $fieldToDisplay = $fieldToDisplay->$fieldToDisplayPath[$i]->format('F jS Y  h:i:s A');
                        } else {
                            $fieldToDisplay = $fieldToDisplay->$fieldToDisplayPath[$i];
                        }
                    }
                }

                $links = isset($tableDisplayField[1]) ? $tableDisplayField[1] : [];
                $fieldHtmlOptions = isset($tableDisplayField[2]) ? $tableDisplayField[2] : [];
                if (!empty($links)) {
                    $linkUrl = $this->buildLinkUrl($links, $entry);
                    $output .= (isset($fieldHtmlOptions['bodyClass']) && !empty($fieldHtmlOptions['bodyClass']))
                        ? "<td class=\"" . $fieldHtmlOptions['bodyClass'] . "\">" . $this->Html->link($fieldToDisplay, $linkUrl) . "</td>"
                        : "<td>" . $fieldToDisplay . "</td>";
                } else {
                    $output .= (isset($fieldHtmlOptions['bodyClass']) && !empty($fieldHtmlOptions['bodyClass']))
                        ? "<td class=\"" . $fieldHtmlOptions['bodyClass'] . "\">" . $fieldToDisplay . "</td>"
                        : "<td>" . $fieldToDisplay . "</td>";
                }
            }

            // Actions related to entries
            if (!empty($tableActions)) {
                $output .= (isset($htmlOptions['actionClass']) && !empty($htmlOptions['actionClass']))
                    ? "<td class=\"" . $htmlOptions['actionClass'] . "\">"
                    : "<td>";

                $j = 1;
                foreach ($tableActions as $tableActionName => $tableAction) {
                    $linkUrl = $this->buildLinkUrl($tableAction, $entry);
                    if (isset($tableAction['confirmMessage']) && !empty($tableAction['confirmMessage'])) {
                        $output .= $this->Html->link($tableActionName, $linkUrl, ['escape' => false], __($tableAction['confirmMessage'], $entry->id));
                    } else {
                        $output .= $this->Html->link($tableActionName, $linkUrl, ['escape' => false]);
                    }

                    if ($j != count($tableActions)) {
                        $output .= " | ";
                    }

                    $j++;
                }
                $output .= "</td>";
            }

            $output .= "</tr>";
        }

        return $output;
    }

    /**
     * Build link URL
     * @param array $linkData
     * @param array $dataEntry
     * @return string
     */
    private function buildLinkUrl($linkData, $dataEntry)
    {
        $linkUrl = "/";

        // Set controller
        if (isset($linkData['controller']) && !empty($linkData['controller'])) {
            $linkUrl .= $linkData['controller'] . "/";
        }

        // Set action
        if (isset($linkData['action']) && !empty($linkData['action'])) {
            $linkUrl .= $linkData['action'] . "/";
        }

        // Set parameters
        if (isset($linkData['parameters']) && !empty($linkData['parameters'])) {
            foreach ($linkData['parameters'] as $parameter) {
                $parameterValues = [];
                foreach ($linkData['parameters'] as $parameter) {
                    $parameterPath = explode(".", $parameter);
                    $parameterValue = "";
                    for ($i = 0; $i < count($parameterPath); $i++) {
                        if ($i == 0) {
                            if (isset($parameterPath[$i]) && !empty($parameterPath[$i])) {
                                if (isset($dataEntry->$parameterPath[$i])) {
                                    $parameterValue = $dataEntry->$parameterPath[$i];
                                }
                            }
                        } else {
                            if (isset($parameterPath[$i]) && !empty($parameterPath[$i])) {
                                if (isset($parameterValue->$parameterPath[$i])) {
                                    $parameterValue = $parameterValue->$parameterPath[$i];
                                } else {
                                    $parameterValue = "";
                                }
                            }
                        }
                    }

                    if (!empty($parameterValue)) {
                        $parameterValues[] = $parameterValue;
                    }
                }
            }

            if (isset($parameterValues) && !empty($parameterValues)) {
                $linkUrl .= "/" . implode("/", $parameterValues);
            }
        }

        return $linkUrl;
    }
}