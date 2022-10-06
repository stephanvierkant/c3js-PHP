<?php
/*
 * Copyright (C) 2015 Raphaël Doursenaud <rdoursenaud@gpcsolutions.fr>
 */

namespace Astroanu\C3jsPHP;

final class Data implements \JsonSerializable
{
    public const MIMETYPE_JSON = 'json';

    public const TYPE_LINE = 'line';
    public const TYPE_SPLINE = 'spline';
    public const TYPE_STEP = 'step';
    public const TYPE_AREA = 'area';
    public const TYPE_AREA_SPLINE = 'area-spline';
    public const TYPE_AREA_STEP = 'area-step';
    public const TYPE_BAR = 'bar';
    public const TYPE_SCATTER = 'scatter';
    public const TYPE_PIE = 'pie';
    public const TYPE_DONUT = 'donut';
    public const TYPE_GAUGE = 'gauge';

    public const ORDER_DESC = 'desc';
    public const ORDER_ASC = 'asc';

    /**
     * @var mixed[][]|\Astroanu\C3jsPHP\Callback[]
     */
    private array $data = [];

    /**
     * Set chart data from a JSON or CSV file
     *
     * @link http://c3js.org/reference.html#data-url
     * @see setMimeType()
     */
    public function setUrl(string $url): self
    {
        $this->data['url'] = $url;
        return $this;
    }

    /**
     * Set chart data from JSON
     *
     * @link http://c3js.org/reference.html#data-json
     * @param mixed[] $data
     */
    public function setJson(array $data): self
    {
        $this->data['json'] = $data;
        return $this;
    }

    /**
     * Set chart data as rows
     *
     * @link http://c3js.org/reference.html#data-rows
     * @param mixed[] $data
     */
    public function setRows(array $data): self
    {
        $this->data['rows'] = $data;
        return $this;
    }

    /**
     * Set chart data as columns
     *
     * @link http://c3js.org/reference.html#data-columns
     * @param mixed[] $data
     */
    public function setColumns(array $data): self
    {
        $this->data['columns'] = $data;
        return $this;
    }

    /**
     * Set data URL MIME type
     * @param string $mime Data URL mime type
     *
     * @link http://c3js.org/reference.html#data-mimeType
     * @see setUrl()
     */
    public function setMimeType(string $mime = self::MIMETYPE_JSON): self
    {
        $this->data['mimeType'] = $mime;
        return $this;
    }

    /**
     * Set which JSON object keys correspond to which data
     *
     * @link http://c3js.org/reference.html#data-keys
     * @param mixed[] $fields
     */
    public function setKeysValue(array $fields): self
    {
        $this->ensureKeys();
        $this->data['keys']['value'] = $fields;
        return $this;
    }

    /**
     * Set keys for x axis when axis x is on category type
     *
     * @link http://c3js.org/reference.html#data-keys
     */
    public function setKeysX(string $field): self
    {
        $this->ensureKeys();
        $this->data['keys']['x'] = $field;
        return $this;
    }

    /**
     * Set key of x values in data
     *
     * @link http://c3js.org/reference.html#data-x
     * @see setXs()
     */
    public function setX(string $x): self
    {
        $this->data['x'] = $x;
        return $this;
    }

    /**
     * Specify the keys of the x values for each data
     *
     * @link http://c3js.org/reference.html#data-xs
     * @see setX()
     * @param mixed[] $xs
     */
    public function setXs(array $xs): self
    {
        $this->data['xs'] = $xs;
        return $this;
    }

    /**
     * Set a format to parse string specifed as x
     *
     * @link http://c3js.org/reference.html#data-xFormat
     */
    public function setXFormat(string $format = '%Y-%m-%d'): self
    {
        $this->data['xFormat'] = $format;
        return $this;
    }

    /**
     * Set custom data name
     *
     * @link http://c3js.org/reference.html#data-names
     * @param mixed[] $names
     */
    public function setNames(array $names): self
    {
        $this->data['names'] = $names;
        return $this;
    }

    /**
     * Set custom data class
     *
     * @link http://c3js.org/reference.html#data-classes
     * @param mixed[] $classes
     */
    public function setClasses(array $classes): self
    {
        $this->data['classes'] = $classes;
        return $this;
    }

    /**
     * Set groups for the data for stacking
     *
     * @link http://c3js.org/reference.html#data-groups
     * @param mixed[] $groups
     */
    public function setGroups(array $groups): self
    {
        $this->data['groups'] = $groups;
        return $this;
    }

    /**
     * Set y axis the data related to. y and y2 can be used
     *
     * @link http://c3js.org/reference.html#data-axes
     * @param mixed[] $axes
     */
    public function setAxes(array $axes): self
    {
        $this->data['axes'] = $axes;
        return $this;
    }

    /**
     * Set chart type at once
     * @param TYPE_LINE|TYPE_SPLINE|TYPE_STEP|TYPE_AREA|TYPE_AREA_SPLINE|TYPE_AREA_STEP|TYPE_BAR|TYPE_SCATTER|TYPE_PIE|TYPE_DONUT|TYPE_GAUGE $type
     *
     * @link http://c3js.org/reference.html#data-type
     * @see setTypes()
     */
    public function setType($type = self::TYPE_LINE): self
    {
        $this->data['type'] = $type;
        return $this;
    }

    /**
     * Set chart type for each data
     *
     * @link http://c3js.org/reference.html#data-types
     * @see setType()
     * @param mixed[] $types
     */
    public function setTypes(array $types): self
    {
        $this->data['types'] = $types;
        return $this;
    }

    /**
     * Show labels on each data points
     *
     * @see http://c3js.org/reference.html#data-labels
     */
    public function showLabels(bool $labels = false): self
    {
        $this->data['labels'] = $labels;
        return $this;
    }

    /**
     * Set formatter function for data labels
     *
     * @link http://c3js.org/reference.html#data-labels-format
     */
    public function setLabelsFormat(string $format): self
    {
        if (!isset($this->data['labels'])) {
            $this->data['labels'] = [];
        }

        $this->data['labels']['format'] = $format;
        return $this;
    }

    /**
     * Define the order of the data
     * @param ORDER_DESC|ORDER_ASC|string|null $order
     *
     * @link http://c3js.org/reference.html#data-order
     */
    public function setOrder($order = self::ORDER_DESC): self
    {
        $this->data['order'] = $order;
        return $this;
    }

    /**
     * Define regions for each data
     *
     * @link http://c3js.org/reference.html#data-regions
     * @param mixed[] $regions
     */
    public function setRegions(array $regions): self
    {
        $this->data['regions'] = $regions;
        return $this;
    }

    /**
     * Set color converter function
     *
     * @link http://c3js.org/reference.html#data-color
     */
    public function setColor(string $color): self
    {
        $this->data['color'] = $color;
        return $this;
    }

    /**
     * Set color for each data
     *
     * @link http://c3js.org/reference.html#data-colors
     * @param mixed[] $colors
     */
    public function setColors(array $colors): self
    {
        $this->data['colors'] = $colors;
        return $this;

    }

    /**
     * Hide each data when the chart appears
     * @param bool|array $hide
     *
     * @link http://c3js.org/reference.html#data-hide
     */
    public function hide($hide = false): self
    {
        $this->data['hide'] = $hide;
        return $this;
    }

    /**
     * Set text displayed when empty data
     *
     * @link http://c3js.org/reference.html#data-empty-label-text
     */
    public function setEmptyLabelText(string $text = ''): self
    {
        if (!isset($this->data['empty'])) {
            $this->data['empty'] = [];
        }

        if (!isset($this->data['empty']['label'])) {
            $this->data['empty']['label'] = [];
        }

        $this->data['empty']['label']['text'] = $text;
        return $this;
    }

    /**
     * Set data selection enabled
     *
     * @link http://c3js.org/reference.html#data-selection-enabled
     */
    public function enableSelection(bool $selection = false): self
    {
        $this->ensureSelection();
        $this->data['selection']['enabled'] = $selection;
        return $this;
    }

    /**
     * Set grouped selection enabled
     *
     * @link http://c3js.org/reference.html#data-selection-grouped
     */
    public function enableGroupedSelection(bool $grouped = false): self
    {
        $this->ensureSelection();
        $this->data['selection']['grouped'] = $grouped;
        return $this;
    }

    /**
     * Set multiple data points selection enabled
     *
     * @link http://c3js.org/reference.html#data-selection-multiple
     */
    public function enableMultipleSelection(bool $multiple = false): self
    {
        $this->ensureSelection();
        $this->data['selection']['multiple'] = $multiple;
        return $this;
    }

    /**
     * Enable to select data points by dragging
     *
     * @link http://c3js.org/reference.html#data-selection-draggable
     */
    public function enableDraggableSeletion(bool $draggable = false): self
    {
        $this->ensureSelection();
        $this->data['selection']['draggable'] = $draggable;
        return $this;
    }

    /**
     * Set a callback for each data point to determine if it's selectable or not
     * @param Callback $callback
     *
     * @link http://c3js.org/reference.html#data-selection-isselectable
     */
    public function setIsSelectable(Callback $callback): self
    {
        $this->ensureSelection();
        $this->data['selection']['isselectable'] = $callback;
        return $this;
    }

    /**
     * Set a callback for click event on each data point
     * @param Callback $callback
     *
     * @link http://c3js.org/reference.html#data-onclick
     */
    public function setOnClick(Callback $callback): self
    {
        $this->data['onclick'] = $callback;
        return $this;
    }

    /**
     * Set a callback for mouseover event on each data point
     * @param Callback $callback
     *
     * @link http://c3js.org/reference.html#data-onmouseover
     */
    public function setOnMouseOver(Callback $callback): self
    {
        $this->data['onmouseover'] = $callback;
        return $this;
    }

    /**
     * Set a callback for mouseout event on each data point
     * @param Callback $callback
     *
     * @link http://c3js.org/reference.html#data-onmouseout
     */
    public function setOnMouseOut(Callback $callback): self
    {
        $this->data['onmousout'] = $callback;
        return $this;
    }

    public function JsonSerialize(): array
    {
        return $this->data;
    }

    private function ensureKeys(): void
    {
        if (!isset($this->data['keys'])) {
            $this->data['keys'] = [];
        }
    }

    private function ensureSelection(): void
    {
        if (!isset($this->data['selection'])) {
            $this->data['selection'] = [];
        }
    }
}
