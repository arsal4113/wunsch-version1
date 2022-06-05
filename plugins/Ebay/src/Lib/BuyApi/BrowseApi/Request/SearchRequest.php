<?php

namespace Ebay\Lib\BuyApi\BrowseApi\Request;

/**
 * Class SearchRequest
 * @package Ebay\Lib\BuyApi\BrowseApi\Request
 */
class SearchRequest extends AbstractRequest
{

    protected $requestMethod = 'get';
    private $query;
    private $categoryIds = [];
    private $filters = [];
    private $sort = [];
    private $limit;
    private $offset;
    private $fieldGroups = [];
    private $aspectFilter;
    private $epid;
    private $gtin;

    /**
     * @return mixed
     */
    public function getQuery()
    {
        return $this->query;
    }

    /**
     * @param $query
     * @return $this
     */
    public function setQuery($query)
    {
        $this->query = $query;
        return $this;
    }

    /**
     * @return array
     */
    public function getCategoryIds()
    {
        return $this->categoryIds;
    }

    /**
     * @param $categoryId
     * @return $this
     */
    public function appendCategoryIds($categoryId)
    {
        $this->categoryIds[] = $categoryId;
        return $this;
    }

    /**
     * @param $index
     * @return $this
     */
    public function removeCategoryIds($index)
    {
        array_splice($this->categoryIds, $index, 1);
        return $this;
    }

    /**
     * @param $categoryIds
     * @return $this
     */
    public function setCategoryIds($categoryIds)
    {
        $this->categoryIds = $categoryIds;
        return $this;
    }

    /**
     * @return array
     */
    public function getFilters()
    {
        return $this->filters;
    }

    /**
     * @param $filter
     * @return $this
     */
    public function appendFilter($filter)
    {
        $this->filters[] = $filter;
        return $this;
    }

    /**
     * @param $index
     * @return $this
     */
    public function removeFilter($index)
    {
        array_splice($this->filters, $index, 1);
        return $this;
    }

    /**
     * @param $filters
     * @return $this
     */
    public function setFilters($filters)
    {
        $this->filters = $filters;
        return $this;
    }

    /**
     * @return array
     */
    public function getSort()
    {
        return $this->sort;
    }

    /**
     * @param $sort
     * @return $this
     */
    public function setSort($sort)
    {
        $this->sort = $sort;
        return $this;
    }

    /**
     * @param $sortField
     * @return $this
     */
    public function appendSort($sortField)
    {
        $this->sort[] = $sortField;
        return $this;
    }

    /**
     * @param $index
     * @return $this
     */
    public function removeSort($index)
    {
        array_splice($this->sort, $index, 1);
        return $this;
    }

    /**
     * @return mixed
     */
    public function getLimit()
    {
        return $this->limit;
    }

    /**
     * @param $limit
     * @return $this
     */
    public function setLimit($limit)
    {
        $this->limit = $limit;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getOffset()
    {
        return $this->offset;
    }

    /**
     * @param $offset
     * @return $this
     */
    public function setOffset($offset)
    {
        $this->offset = $offset;
        return $this;
    }

    /**
     * @return array
     */
    public function getFieldGroups()
    {
        return $this->fieldGroups;
    }

    /**
     * @param $fieldGroups
     * @return $this
     */
    public function setFieldGroups($fieldGroups)
    {
        $this->fieldGroups = $fieldGroups;
        return $this;
    }

    /**
     * @param $fieldGroup
     * @return $this
     */
    public function appendFieldGroup($fieldGroup)
    {
        $this->fieldGroups[] = $fieldGroup;
        return $this;
    }

    /**
     * @param $index
     * @return $this
     */
    public function removeFieldGroup($index)
    {
        array_splice($this->fieldGroups, $index, 1);
        return $this;
    }

    /**
     * @return mixed
     */
    public function getAspectFilter()
    {
        return $this->aspectFilter;
    }

    /**
     * @param $aspectFilter
     * @return $this
     */
    public function setAspectFilter($aspectFilter)
    {
        $this->aspectFilter = $aspectFilter;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getEpid()
    {
        return $this->epid;
    }

    /**
     * @param $epid
     * @return $this
     */
    public function setEpid($epid)
    {
        $this->epid = $epid;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getGtin()
    {
        return $this->gtin;
    }

    /**
     * @param $gtin
     * @return $this
     */
    public function setGtin($gtin)
    {
        $this->gtin = $gtin;
        return $this;
    }

    /**
     * @return string
     */
    public function getCallName()
    {
        $callName = "item_summary/search?";
        if (!empty($this->query)) $callName .= 'q=' . $this->query . '&';
        if (!empty($this->epid)) $callName .= 'epid=' . $this->epid . '&';
        if (!empty($this->gtin)) $callName .= 'gtin=' . $this->gtin . '&';
        if (!empty($this->aspectFilter)) $callName .= 'aspect_filter=' . $this->aspectFilter->toString() . '&';
        if (!empty($this->offset)) $callName .= 'offset=' . $this->offset . '&';
        if (!empty($this->limit)) $callName .= 'limit=' . $this->limit . '&';

        if (!empty($this->sort)) {
            $callName .= 'sort=';
            foreach ($this->sort as $key => $field) {
                $fieldValue = $field->toString();
                if (!empty($fieldValue)) {
                    $callName .= $fieldValue;
                    if ($key != count($this->sort) - 1) {
                        $callName .= ',';
                    } else {
                        $callName .= '&';
                    }
                }
            }
        }

        if (!empty($this->fieldGroups)) {
            $callName .= "field_groups=";
            foreach ($this->fieldGroups as $key => $field) {
                if (!empty($field)) {
                    $callName .= $field;
                    if ($key != count($this->fieldGroups) - 1) {
                        $callName .= ',';
                    } else {
                        $callName .= '&';
                    }
                }
            }
        }

        if (!empty($this->categoryIds)) {
            $callName .= 'category_ids=';
            foreach ($this->categoryIds as $key => $categoryId) {
                $callName .= $categoryId;
                if ($key < count($this->categoryIds) - 1) {
                    $callName .= ',';
                } else {
                    $callName .= '&';
                }
            }
        }

        if (!empty($this->filters)) {
            $callName .= 'filter=';
            foreach ($this->filters as $key => $field) {
                $fieldValue = $field->toString();
                if (!empty($fieldValue)) {
                    $callName .= $fieldValue;
                    if ($key != count($this->filters) - 1) {
                        $callName .= ',';
                    } else {
                        $callName .= '&';
                    }
                }
            }
        }
        return trim($callName, '&');
    }
}
